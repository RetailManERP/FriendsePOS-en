
<?php $__env->startSection('title', __('gym::lang.subscription')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('gym::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-solid">
                    <div class="box-header">
                        <h3 class="box-title"> <?php echo app('translator')->get('gym::lang.add_package'); ?></h3>
                    </div>
                    <div class="box-body">
                        <?php echo Form::open([
                            'url' => action([\Modules\Gym\Http\Controllers\SubscriptionController::class, 'store']),
                            'method' => 'post',
                            'id' => 'create_subscription',
                        ]); ?>

                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    <?php echo Form::select('location_id', $business_locations, $default_location->id ?? null, ['class' => 'form-control', 'id' => 'select_location_id', 'required', 'autofocus'], $bl_attributes); ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pull-right col-sm-6">
						    <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('is_recurring', 1, false, ['class' => 'form-check-input', 'id' => 'is_recurring']); ?> <?php echo app('translator')->get('lang_v1.subscribe'); ?>?
                                </label>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#recurringInvoiceModal" class="hide"><i class="fa fa-external-link"></i></button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <input type="hidden" name="contact_id" value="<?php echo e($contact->id, false); ?>" id="contact_id">
                                    <?php echo Form::label('name', __('contact.customer') . ':*'); ?>

                                    <?php echo Form::text('name', $contact->name, [
                                        'class' => 'form-control name',
                                        'required',
                                        'readonly',
                                    ]); ?>

                                </div>
                                <small
                                    class="text-danger <?php if(empty($customer_due)): ?> hide <?php endif; ?> contact_due_text"><strong><?php echo app('translator')->get('account.customer_due'); ?>:</strong>
                                    <span><?php echo e($customer_due ?? '', false); ?></span></small>
                            </div>
                            <small>
                                <strong>
                                    <?php echo app('translator')->get('lang_v1.billing_address'); ?>:
                                </strong>
                                <div id="billing_address_div">
                                    <?php echo $contact->contact_address ?? ''; ?>

                                </div>
                            </small>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('package_id', __('gym::lang.packages') . ':*'); ?>

                                <select name="package_id" required class="form-control package_id" id="package_id">
                                    <option disabled selected value=""><?php echo app('translator')->get('gym::lang.choose_package'); ?></option>
                                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($package->id, false); ?>"> <?php echo e($package->name, false); ?> -( <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $package->amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> per
                                            <?php echo e($package->duration, false); ?> )</option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('start_date', __('gym::lang.start_date') . ':'); ?>

                                <?php echo Form::text('start_date', null, [
                                    'class' => 'form-control date_picker',
                                    'readonly',
                                    'required',
                                    'id' => 'start_date',
                                ]); ?>

                            </div>
                        </div>
                        <div class="col-md-6 end_date">
                            <div class="form-group">
                                <?php echo Form::label('end_date', __('gym::lang.end_date') . ':'); ?>

                                <?php echo Form::text('end_date', null, [
                                    'class' => 'form-control',
                                    'readonly',
                                    'required',
                                    'id' => 'end_date',
                                ]); ?>

                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="panel panel-default">
                        <div class="panel-heading status-heading">
                            <h3 class="panel-title">
                                <?php echo app('translator')->get('gym::lang.summary'); ?>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <strong><?php echo app('translator')->get('gym::lang.package_name'); ?> :</strong>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <strong class="package_name"></strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <strong><?php echo app('translator')->get('gym::lang.package_price'); ?> :</strong>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <div class="form-group hide">
                                        
                                        <?php echo Form::number('package_price', null, [
                                            'class' => 'form-control',
                                            'id' => 'package_price',
                                            'placeholder' => __('gym::lang.package_price'),
                                        ]); ?>

                                    </div>
                                    <strong class="package_price"></strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <strong><?php echo app('translator')->get('gym::lang.discount'); ?> :</strong>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <strong class="total_discount_show"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></strong>
                                </div>
                            </div>
                            <div class="row">
                                <hr>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <?php echo Form::number('discount_percent', null, [
                                            'class' => 'form-control',
                                            'id' => 'discount_percent',
                                            'placeholder' => __('gym::lang.discount'),
                                        ]); ?>

                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="total_discount" id="total_discount">
                            <input type="hidden" name="final_total_input" id="final_total_input">
                            <input type="hidden" name="discount_type" value="percent" id="percent">
                            <div class="row">
                                <div class="col-xs-6">
                                    <strong><?php echo app('translator')->get('gym::lang.total'); ?>:</strong>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <strong class="total"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-12">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="row">
                        <div class="box-body payment_row">
                            <?php echo $__env->make('hms::partials.payment_row_form', [
                                'row_index' => 0,
                                'show_date' => true,
                                'show_denomination' => true,
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                    <div class="payment_row">
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <strong>
                                    <?php echo app('translator')->get('lang_v1.change_return'); ?>:
                                </strong>
                                <br />
                                <span class="lead text-bold change_return_span">0</span>
                                <?php echo Form::hidden('change_return', $change_return['amount'], [
                                    'class' => 'form-control change_return input_number',
                                    'required',
                                    'id' => 'change_return',
                                ]); ?>

                                <!-- <span class="lead text-bold total_quantity">0</span> -->
                                <?php if(!empty($change_return['id'])): ?>
                                    <input type="hidden" name="change_return_id" value="<?php echo e($change_return['id'], false); ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="hide payment_row" id="change_return_payment_data">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo Form::label('change_return_method', __('lang_v1.change_return_payment_method') . ':*'); ?>

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fas fa-money-bill-alt"></i>
                                        </span>
                                        <?php
                                            $_payment_method =
                                                empty($change_return['method']) &&
                                                array_key_exists('cash', $payment_types)
                                                    ? 'cash'
                                                    : $change_return['method'];

                                            $_payment_types = $payment_types;
                                            if (isset($_payment_types['advance'])) {
                                                unset($_payment_types['advance']);
                                            }
                                        ?>
                                        <?php echo Form::select('payment[change_return][method]', $_payment_types, $_payment_method, [
                                            'class' => 'form-control col-md-12 payment_types_dropdown',
                                            'id' => 'change_return_method',
                                            'style' => 'width:100%;',
                                        ]); ?>

                                    </div>
                                </div>
                            </div>
                            <?php if(!empty($accounts)): ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo Form::label('change_return_account', __('lang_v1.change_return_payment_account') . ':'); ?>

                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fas fa-money-bill-alt"></i>
                                            </span>
                                            <?php echo Form::select(
                                                'payment[change_return][account_id]',
                                                $accounts,
                                                !empty($change_return['account_id']) ? $change_return['account_id'] : '',
                                                ['class' => 'form-control select2', 'id' => 'change_return_account', 'style' => 'width:100%;'],
                                            ); ?>

                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php echo $__env->make('hms::partials.payment_type_details', [
                                'payment_line' => $change_return,
                                'row_index' => 'change_return',
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="pull-right"><strong><?php echo app('translator')->get('lang_v1.balance'); ?>:</strong> <span
                                        class="balance_due">0.00</span></div>
                            </div>
                        </div>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>

            <?php echo $__env->make('sale_pos.partials.recurring_invoice_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="col-md-12 text-center">
                <?php echo Form::hidden('is_save_and_print', 0, ['id' => 'is_save_and_print']); ?>

                <button type="button" id="submit-sell" class="btn btn-primary btn-lg tw-text-white"><?php echo app('translator')->get('messages.save'); ?></button>
    			<button type="button" id="save-and-print" class="btn btn-success btn-lg tw-text-white"><?php echo app('translator')->get('lang_v1.save_and_print'); ?></button>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </section>
    

    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>

    <script>
        $(document).ready(function() {
            var currentDate = new Date();
            var currentDateTime = moment(currentDate);

            $('.date_picker').datetimepicker({
                format: moment_date_format,
                ignoreReadonly: true,
                defaultDate: currentDateTime
            });

            $('.date_picker').on('dp.change', function(e) {
                var id = $('#package_id').val();
                var start_date = $('#start_date').val();
                get_end_date(id, start_date);
            });

            $('.paid_on').datetimepicker({
                format: moment_date_format + ' ' + moment_time_format,
                ignoreReadonly: true,
            });

            $('#package_id').on('change', function(e) {
                var id = $(this).val();
                var start_date = $('#start_date').val();
                get_end_date(id, start_date);
            });

            $(document).on('change', '#is_recurring', function() {
                if ($(this).is(':checked')) {
                    $('#recurringInvoiceModal').modal('show');
                }
            });

            $(document).on('shown.bs.modal', '#recurringInvoiceModal', function() {
                $('input#recur_interval').focus();
            });

            $(document).on('change', '#recur_interval_type', function() {
                if ($(this).val() == 'months') {
                    $('.subscription_repeat_on_div').removeClass('hide');
                } else {
                    $('.subscription_repeat_on_div').addClass('hide');
                }
            });

            async function get_end_date(id, start_date) {
                if (id === null) {
                    alert('select package');
                    return false;
                }
                try {
                    const result = await $.ajax({
                        url: "<?php echo e(route('get_end_date'), false); ?>",
                        dataType: 'json',
                        data: {
                            'id': id,
                            'start_date': start_date,
                        }
                    });

                    if (result.status) {
                        $('#end_date').val(result.end_date);
                        if(result.package.duration == 'custom'){
                            $('#end_date').datetimepicker({
                                format: moment_date_format,
                                ignoreReadonly: true,
                            });
                            $('#package_price').attr('type', 'number');
                            $('#package_price').parents('div.form-group').removeClass('hide');
                            $('.package_price').addClass('hide');
                        }else{
                            if ($('#end_date').data("DateTimePicker")) {
                                $('#end_date').data("DateTimePicker").destroy();
                            }
                            $('#package_price').attr('type', 'hidden');
                            $('#package_price').parents('div.form-group').addClass('hide');
                            $('.package_price').removeClass('hide');
                        }
                        $('.package_name').text(result.package.name);
                        $('.package_price').text(__currency_trans_from_en(result.package.amount, true));
                        // $('#package_price').val(result.package.amount);
                        __write_number($('#package_price'), result.package.amount);
                    }

                    // Call calculate_total after the data is updated
                    calculate_total();

                } catch (error) {
                    console.error("Error fetching end date:", error);
                }
            }

            $("form#create_subscription").validate();


            $("#discount_percent").keyup(function() {
                if ($('#discount_percent').val() != '' && parseFloat($('#discount_percent').val()) > 0) {
                    // Ensure discount_percent and package_price are numeric
                    var discount_percent = parseFloat($('#discount_percent').val()) || 0;
                    var package_price = parseFloat($('#package_price').val()) || 0;

                    // Calculate the total discount based on the percentage
                    var total_discount = (discount_percent * package_price) / 100;

                    // Update the total discount field and the displayed value
                    $('#total_discount').val(total_discount);
                    $('.total_discount_show').text(__currency_trans_from_en(total_discount, true));
                }
                calculate_total();
            });

            $("#package_price").keyup(function() {
                if ($('#discount_percent').val() != '' && parseFloat($('#discount_percent').val()) > 0) {
                    // Ensure discount_percent and package_price are numeric
                    var discount_percent = parseFloat($('#discount_percent').val()) || 0;
                    var package_price = parseFloat($(this).val()) || 0;

                    // Calculate the total discount based on the percentage
                    var total_discount = (discount_percent * package_price) / 100;

                    // Update the total discount field and the displayed value
                    $('#total_discount').val(total_discount);
                    $('.total_discount_show').text(__currency_trans_from_en(total_discount, true));
                }
                calculate_total();
            });

            function calculate_total() {
                var package_price = parseFloat($('#package_price').val()) || 0;
                var discount = parseFloat($('#total_discount').val()) || 0;
                var total = (package_price - discount);
                $('.total').text(__currency_trans_from_en(total, true));
                $('#final_total_input').val(total);
                $('.payment-amount').val(total);
            }

            // 

            $(document).on('change', '.payment_types_dropdown', function(e) {
                var default_accounts = $('select#select_location_id').length ?
                    $('select#select_location_id')
                    .find(':selected')
                    .data('default_payment_accounts') : $('#location_id').data('default_payment_accounts');
                var payment_type = $(this).val();
                var payment_row = $(this).closest('.payment_row');
                if (payment_type && payment_type != 'advance') {
                    var default_account = default_accounts && default_accounts[payment_type]['account'] ?
                        default_accounts[payment_type]['account'] : '';
                    var row_index = payment_row.find('.payment_row_index').val();

                    var account_dropdown = payment_row.find('select#account_' + row_index);
                    if (account_dropdown.length && default_accounts) {
                        account_dropdown.val(default_account);
                        account_dropdown.change();
                    }
                }

                //Validate max amount and disable account if advance 
                amount_element = payment_row.find('.payment-amount');
                account_dropdown = payment_row.find('.account-dropdown');
                if (payment_type == 'advance') {
                    max_value = $('#advance_balance').val();
                    msg = $('#advance_balance').data('error-msg');
                    amount_element.rules('add', {
                        'max-value': max_value,
                        messages: {
                            'max-value': msg,
                        },
                    });
                    if (account_dropdown) {
                        account_dropdown.prop('disabled', true);
                        account_dropdown.closest('.form-group').addClass('hide');
                    }
                } else {
                    amount_element.rules("remove", "max-value");
                    if (account_dropdown) {
                        account_dropdown.prop('disabled', false);
                        account_dropdown.closest('.form-group').removeClass('hide');
                    }
                }
            });


            $(document).on('change', '.payment-amount', function() {
                calculate_balance_due();
            });

            function calculate_balance_due() {
                var total_payable = __read_number($('#final_total_input'));
                var total_paying = 0;
                $('.payment-amount')
                    .each(function() {
                        if (parseFloat($(this).val())) {
                            total_paying += __read_number($(this));
                        }
                    });
                var bal_due = total_payable - total_paying;
                var change_return = 0;

                //change_return
                if (bal_due < 0 || Math.abs(bal_due) < 0.05) {
                    __write_number($('input#change_return'), bal_due * -1);
                    $('span.change_return_span').text(__currency_trans_from_en(bal_due * -1, true));
                    change_return = bal_due * -1;
                    bal_due = 0;
                } else {
                    __write_number($('input#change_return'), 0);
                    $('span.change_return_span').text(__currency_trans_from_en(0, true));
                    change_return = 0;

                }

                if (change_return !== 0) {
                    $('#change_return_payment_data').removeClass('hide');
                } else {
                    $('#change_return_payment_data').addClass('hide');
                }

                __write_number($('input#total_paying_input'), total_paying);
                $('span.total_paying').text(__currency_trans_from_en(total_paying, true));

                __write_number($('input#in_balance_due'), bal_due);
                $('span.balance_due').text(__currency_trans_from_en(bal_due, true));

                __highlight(bal_due * -1, $('span.balance_due'));
                __highlight(change_return * -1, $('span.change_return_span'));
            }

            subscription_table = $('#subscription_table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: false,
                ajax: {
                    url: "<?php echo e(action([\Modules\Gym\Http\Controllers\SubscriptionController::class, 'index']), false); ?>",
                    "data": function(d) {
                            d.customer_id = $('#contact_id').val();
                    },
                },
                aaSorting: [
                    [6, 'desc']
                ],
                columns: [{
                        data: 'c_name',
                        name: 'c.name',
                    },
                    {
                        data: 'package',
                        name: 'package',
                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status',
                    },
                    {
                        data: 'payment_methods',
                        orderable: false,
                        "searchable": false
                    },
                    {
                        data: 'final_total',
                        name: 'final_total'
                    },
                    {
                        data: 'total_paid',
                        name: 'total_paid',
                        "searchable": false
                    },
                    {
                        data: 'total_remaining',
                        name: 'total_remaining'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                ],
            });
            if($('.payment_types_dropdown').length){
				$('.payment_types_dropdown').change();
			}

            $('button#submit-sell, button#save-and-print').click(function(e) {
                e.preventDefault();
                if ($(this).attr('id') == 'save-and-print') {
                    $('#is_save_and_print').val(1);
                } else {
                    $('#is_save_and_print').val(0);
                }
                if($("form#create_subscription").validate()){
                    $("form#create_subscription").submit();
                }

            });
            
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>