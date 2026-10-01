
<?php
    $subscriptionKey = env('MULTIPAY_SUBSCRIPTION_KEY');
    $environment = env('MULTIPAY_ENVIRONMENT', 'sandbox');
    $hostedFieldUrl = env('MULTIPAY_HOSTED_FIELD_URL', 'https://multipay-sandbox.azure-api.net/hostedfield/v1/GetHostedFieldScript');
?>

<div class="col-md-12">
    <div id="multipay-payment-form">
        <form id="multipay-form" method="POST" action="<?php echo e(route('multipay.redirect'), false); ?>">
            <?php echo e(csrf_field(), false); ?>

            <input type="hidden" name="package_id" value="<?php echo e($package->id, false); ?>">
            <input type="hidden" name="price" value="<?php echo e($package->price, false); ?>">
            <input type="hidden" name="coupon_code" value="<?php echo e(request()->get('code') ?? '', false); ?>">
            <input type="hidden" name="card_token" id="multipay_card_token" value="">
            <input type="hidden" name="card_type" id="multipay_card_type" value="">

            <div class="row" style="margin-top: 10px;">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="card_number">Card Number</label>
                        <div class="hosted-field" id="card_number" style="height: 38px; border: 1px solid #ccc; border-radius: 4px; padding: 6px 12px;"></div>
                        <div id="multipay-card-error" class="text-danger" style="display:none; font-size: 12px; margin-top: 4px;"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cardholder_name">Cardholder Name</label>
                        <input type="text" class="form-control" name="cardholder_name" id="cardholder_name" placeholder="Name on Card" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="card_expiry">Expiry Date (MM/YY)</label>
                        <input type="text" class="form-control" name="expiry_date" id="card_expiry" placeholder="MM/YY" maxlength="5" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="card_cvv">CVV</label>
                        <input type="text" class="form-control" name="cvv" id="card_cvv" placeholder="CVV" maxlength="4" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" style="margin-top: 25px;">
                        <button type="submit" id="multipay-submit-btn" class="btn btn-sm text-white" disabled style="background: #0047AB; border-color: #0047AB;">
                            <i class="fas fa-credit-card text-white"></i>
                            <?php echo e($v, false); ?>

                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="multipay-processing" style="display:none;">
                        <i class="fas fa-spinner fa-spin"></i> Processing payment...
                    </div>
                    <p class="text-muted" style="font-size: 11px; margin-top: 5px;">
                        <img src="https://multipay-sandbox.developer.azure-api.net/content/poweredby.png" alt="Powered by PayPoint" style="height: 20px; vertical-align: middle;">
                        Secure payments processed by <a href="https://www.paypoint.com" target="_blank">PayPoint</a>
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>


<script src="<?php echo e($hostedFieldUrl, false); ?>?subscription-key=<?php echo e($subscriptionKey, false); ?>" type="text/javascript"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hosted Field callback - receives card token when PAN is valid
        function multipayCardTokenCallback(cardType, cardToken) {
            document.getElementById('multipay_card_token').value = cardToken;
            document.getElementById('multipay_card_type').value = cardType;
            document.getElementById('multipay-submit-btn').disabled = false;
            document.getElementById('multipay-card-error').style.display = 'none';
        }

        // Hosted Field error callback
        function multipayErrorCallback(status, statusText, errorMessage, errorCode) {
            var errorDiv = document.getElementById('multipay-card-error');
            errorDiv.textContent = errorMessage || 'Invalid card number';
            errorDiv.style.display = 'block';
            document.getElementById('multipay-submit-btn').disabled = true;
            document.getElementById('multipay_card_token').value = '';
            document.getElementById('multipay_card_type').value = '';
        }

        // Initialize Hosted Field
        if (typeof PayPointHostedFields !== 'undefined') {
            var _ = new PayPointHostedFields.HostedFields({
                field: {
                    placeHolder: 'card_number',
                    style: {
                        'width': '100%',
                        'height': '26px',
                        'color': '#333',
                        'border': 'none',
                        'background': 'transparent',
                        'font-size': '14px',
                        'font-family': '"Source Sans Pro", "Helvetica Neue", Helvetica, Arial, sans-serif',
                    },
                    errorStyle: {
                        'border': '1px solid #ff0000',
                    }
                },
                callback: multipayCardTokenCallback,
                doOnHostedFieldError: multipayErrorCallback
            });
        } else {
            console.warn('PayPoint Hosted Field library not loaded');
            document.getElementById('multipay-card-error').textContent = 'Card input service unavailable. Please try again later.';
            document.getElementById('multipay-card-error').style.display = 'block';
        }

        // Form submission handler
        document.getElementById('multipay-form').addEventListener('submit', function(e) {
            var cardToken = document.getElementById('multipay_card_token').value;
            if (!cardToken) {
                e.preventDefault();
                document.getElementById('multipay-card-error').textContent = 'Please enter a valid card number';
                document.getElementById('multipay-card-error').style.display = 'block';
                return false;
            }

            document.getElementById('multipay-submit-btn').disabled = true;
            document.getElementById('multipay-processing').style.display = 'block';
        });

        // Auto-format expiry date
        document.getElementById('card_expiry').addEventListener('input', function(e) {
            var val = this.value.replace(/\D/g, '');
            if (val.length >= 2) {
                this.value = val.substring(0, 2) + '/' + val.substring(2, 4);
            } else {
                this.value = val;
            }
        });
    });
</script>
