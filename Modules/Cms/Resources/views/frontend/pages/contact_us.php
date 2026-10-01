
<?php $__env->startSection('title', 'Contact us'); ?>
<?php $__env->startSection('jquery_validation', true); ?>
<?php $__env->startSection('css'); ?>
<style type="text/css">
    .error {
        color: #ef4444 !important;
        font-size: 0.8125rem;
        margin-bottom: 0.5rem;
        margin-top: -0.25rem;
    }
    .non-bullet-list {
        list-style: none;
        margin-left: 0;
        padding-left: 0;
    }
    .non-bullet-list li {
        padding: 0.5rem 0;
        font-size: 0.9375rem;
        color: var(--cms-text-secondary);
    }
    .non-bullet-list li i {
        color: var(--cms-primary);
        width: 1.25rem;
    }
    .contact-info-title {
        font-family: var(--cms-font-display);
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--cms-text-primary);
    }
    .contact-verification-row {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    .contact-verification-row .contact-form__input {
        margin-bottom: 0;
    }
    .contact-verification-row .btn {
        flex: 0 0 auto;
        white-space: nowrap;
    }
    @media (max-width: 575.98px) {
        .contact-verification-row {
            flex-direction: column;
        }
        .contact-verification-row .btn {
            width: 100%;
        }
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
    $btns = $__site_details['btns'] ?? [];

    $navbar_btn['text'] = (isset($btns['navbar']) && is_array($btns['navbar']) && array_key_exists('text', $btns['navbar'])) ? ($btns['navbar']['text'] ?? '') : 'Try For Free';
    $navbar_btn['link'] = (isset($btns['navbar']) && is_array($btns['navbar']) && array_key_exists('link', $btns['navbar'])) ? ($btns['navbar']['link'] ?? '') : registration_url();
?>
<?php if ($__env->exists('cms::frontend.layouts.header')) echo $__env->make('cms::frontend.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="block-27 space-between-blocks">
    <?php
        $bg_img_url = asset('modules/cms/img/contact.jpg');
        if(!empty($page->feature_image_url)) {
            $bg_img_url = $page->feature_image_url;
        }
    ?>
    <div class="block-27__row d-block d-lg-flex row">
        <div class="block-27__image-column container col-lg-6 col-md-9 col-sm-9"
            style="background-image: url(<?php echo e($bg_img_url, false); ?>);">        
        </div>
    </div>
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-6 px-4 px-xl-5 py-3 text-center">
                <form class="contact-form text-center" id="contact_form" method="POST" action="<?php echo e(route('cms.submit.contact.form'), false); ?>" toolname="contact_sales" tooldescription="Send a sales or support enquiry to <?php echo e(config('app.name'), false); ?>.">
                    <?php echo csrf_field(); ?>
                    <div class="contact-form__header mb-5">
                        <div class="section-badge mx-auto mb-3">
                            <i class="fas fa-envelope"></i>
                            <span>We'd Love to Hear From You</span>
                        </div>
                        <h1 class="contact-form__title mb-3">
                            <?php echo e($page->title ?? 'Contact Us', false); ?>

                        </h1>
                        <p class="contact-form__paragraph mb-0 mx-auto">
                            <?php echo str_contains(optional($page)->content ?? '', 'our team typically replies within a few hours')
                                    ? 'Tell us about your sales, inventory, accounting and multi-location requirements. Contact our team to discuss the POS and ERP tools your business needs.'
                                    : (optional($page)->content ?: 'Have a question about POS or ERP software? Tell us what your business needs and how we can help.'); ?>

                        </p>
                    </div>
                    <div class="alert mt-4 alert-primary enquire_response_alert" role="alert" style="display:none; border-radius: var(--cms-radius-md);">
                        <span class="enquire_response"></span>
                    </div>
                    <label class="visually-hidden" for="contact_name">Full Name</label>
                    <input id="contact_name" type="text" name="name" class="contact-form__input" placeholder="Full Name" autocomplete="name" required toolparamdescription="The full name of the person making the enquiry.">
                    <label class="visually-hidden" for="contact_mobile">Mobile</label>
                    <input id="contact_mobile" type="tel" name="mobile" class="contact-form__input" placeholder="Mobile" autocomplete="tel" required toolparamdescription="A phone number where the team can follow up.">
                    <label class="visually-hidden" for="contact_email">Email</label>
                    <input id="contact_email" type="email" name="email" class="contact-form__input" placeholder="Email" autocomplete="email" required toolparamdescription="A valid email address for the enquiry response.">
                    <div class="contact-verification-row">
                        <div class="w-100">
                            <label class="visually-hidden" for="contact_email_verification_code">Email Verification Code</label>
                            <input id="contact_email_verification_code" type="text" inputmode="numeric" pattern="[0-9]{6}" maxlength="6" name="email_verification_code" class="contact-form__input" placeholder="6-digit email code" autocomplete="one-time-code" required toolparamdescription="The 6-digit code sent to the enquiry email address.">
                        </div>
                        <button id="send-code-btn" type="button" class="btn btn-outline-primary btn-lg">
                            Send Code
                        </button>
                    </div>
                    <label class="visually-hidden" for="contact_message">Message</label>
                    <textarea id="contact_message" class="contact-form__input" name="message" placeholder="Message" autocomplete="off" required toolparamdescription="The business requirements or question to send to the team."></textarea>
                    <button id="submit-btn" type="submit" class="btn btn-primary w-100 btn-lg">
                        <i class="fas fa-paper-plane me-2"></i>
                        Send Message
                    </button>
                </form>
            </div>
        </div>
        <?php
            $mail_us = (isset($__site_details['mail_us']) && !empty($__site_details['mail_us'])) ? $__site_details['mail_us'] : [];
            $mail_us_collection = collect($mail_us);
            $filtered_mail_us = $mail_us_collection->filter(function ($value, $key) {
                return !empty($value['label']) && !empty($value['email']);
            });

            $contact_us = (isset($__site_details['contact_us']) && !empty($__site_details['contact_us'])) ? $__site_details['contact_us'] : [];
            $contact_us_collection = collect($contact_us);
            $filtered_contact_us = $contact_us_collection->filter(function ($value, $key) {
                return !empty($value['label']) && !empty($value['num']);
            });
        ?>
        <?php if(!empty($filtered_contact_us) || !empty($filtered_mail_us)): ?>
            <div class="row flex-row-reverse">
                <div class="col-lg-6 px-4 px-xl-5 py-3">
                    <?php if(!empty($filtered_contact_us)): ?>
                        <h4 class="contact-info-title pt-3">
                            <i class="fas fa-phone-alt me-2" style="color: var(--cms-primary);"></i>
                            Call Us
                        </h4>
                        <ul class="non-bullet-list mt-2">
                            <?php $__currentLoopData = $filtered_contact_us; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filtered_contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <i class="fas fa-phone"></i> &nbsp;
                                    <strong class="text-dark">
                                        <?php echo e($filtered_contact['label'], false); ?>:
                                    </strong> &nbsp;
                                    <a href="tel:<?php echo e($filtered_contact['num'], false); ?>" class="text-dark text-decoration-none" target="_blank">
                                        <?php echo e($filtered_contact['num'], false); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                    <?php if(!empty($filtered_mail_us)): ?>
                        <h4 class="contact-info-title pt-3">
                            <i class="fas fa-envelope me-2" style="color: var(--cms-primary);"></i>
                            Mail Us
                        </h4>
                        <ul class="non-bullet-list mt-2">
                            <?php $__currentLoopData = $filtered_mail_us; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filtered_mail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <i class="fas fa-envelope"></i> &nbsp;
                                    <strong class="text-dark">
                                        <?php echo e($filtered_mail['label'], false); ?>:
                                    </strong> &nbsp;
                                    <a href="mailto:<?php echo e($filtered_mail['email'], false); ?>" target="_blank" class="text-dark text-decoration-none">
                                        <?php echo e($filtered_mail['email'], false); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    if (typeof Sticky !== "undefined") {
        new Sticky("[sticky]");
    }
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#contact_form").validate({
            rules: {
                email_verification_code: {
                    required: true,
                    digits: true,
                    minlength: 6,
                    maxlength: 6
                }
            },
            submitHandler: function(form, e) {
                if ($('#contact_form').valid()) {
                    let data = $(form).serialize();
                    $("#submit-btn").attr('disabled', true);
                    $.ajax({
                        method: 'POST',
                        dataType: "json",
                        url: form.action,
                        data:data,
                        success: function(result){
                            $("#submit-btn").attr('disabled', false);
                            if (result.success) {
                                $('form#contact_form').trigger("reset");
                                $('form#enquire_now_form').trigger("reset");
                                $("#send-code-btn").text('Send Code');
                                $(".enquire_response_alert").css({ 'display' : '' });
                                $(".enquire_response").text(result.msg);
                            } else {
                                $(".enquire_response_alert").css({ 'display' : '' });
                                $(".enquire_response").text(result.msg);
                            }
                        }
                    });
                }
            }
        });

        $("#send-code-btn").on('click', function() {
            let emailInput = $("#contact_email");
            let email = emailInput.val();
            if (!emailInput.valid()) {
                return;
            }

            let button = $(this);
            button.attr('disabled', true).text('Sending...');
            $.ajax({
                method: 'POST',
                dataType: "json",
                url: "<?php echo e(route('cms.send.contact.email.verification.code'), false); ?>",
                data: { email: email },
                success: function(result) {
                    $(".enquire_response_alert").css({ 'display' : '' });
                    $(".enquire_response").text(result.msg);
                    button.attr('disabled', false).text(result.success ? 'Resend Code' : 'Send Code');
                },
                error: function() {
                    $(".enquire_response_alert").css({ 'display' : '' });
                    $(".enquire_response").text('Could not send verification code. Please try again.');
                    button.attr('disabled', false).text('Send Code');
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('cms::frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>