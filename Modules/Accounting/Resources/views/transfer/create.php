<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\Modules\Accounting\Http\Controllers\TransferController::class, 'store']), 
        'method' => 'post', 'id' => 'transfer_form' ]); ?>


    <div class="modal-header">
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo app('translator')->get( 'accounting::lang.add_transfer' ); ?></h4>
    </div>

    <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('location_id', __('purchase.business_location') . ':'); ?>

                    <?php echo Form::select(
                        'location_id',
                        $business_locations,
                        null,
                        ['class' => 'form-control select2', 'required'],
                    ); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('ref_no', __('purchase.ref_no').':'); ?>

                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.leave_empty_to_autogenerate') . '"></i>';
                }
            ?>
                    <?php echo Form::text('ref_no', null, ['class' => 'form-control']); ?>

                </div>
            </div>
        </div>
        
        <div class="form-group">
            <?php echo Form::label('to_account', __( 'lang_v1.transfer_to' ) .":*"); ?>

            <?php echo Form::select('to_account', [], null, ['class' => 'form-control accounts-dropdown', 'required', 
                'placeholder' => __('messages.please_select') ]); ?>

        </div>
        
        <div class="form-group">
            <?php echo Form::label('from_account', __( 'lang_v1.transfer_from' ) .":*"); ?>

            <?php echo Form::select('from_account', [], null, ['class' => 'form-control accounts-dropdown', 'required', 
                'placeholder' => __('messages.please_select') ]); ?>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('amount', __( 'sale.amount' ) .":*"); ?>

                    <?php echo Form::text('amount', 0, ['class' => 'form-control input_number', 
                        'required','placeholder' => __( 'sale.amount' ) ]); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('operation_date', __( 'messages.date' ) .":*"); ?>

                    <div class="input-group">
                        <?php echo Form::text('operation_date', null, ['class' => 'form-control', 
                            'required','placeholder' => __( 'messages.date' ), 'id' => 'operation_date' ]); ?>

                        <span class="input-group-text">
                        <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card border-info mt-3" id="cheque_details_section" style="display:none;">
            <div class="card-header bg-info text-white py-2 d-flex align-items-center">
                <i class="fas fa-money-check me-1"></i>
                <strong><?php echo app('translator')->get('accounting::lang.cheque_details'); ?></strong>
                <button type="button" class="btn btn-sm btn-outline-light ms-auto" id="clear_cheque_selection">
                    <i class="fas fa-times"></i> <?php echo app('translator')->get('accounting::lang.clear_cheque'); ?>
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('cheque_bank_account_id', __('accounting::lang.bank_account') . ':'); ?>

                            <select name="cheque_bank_account_id" id="cheque_bank_account_id" class="form-control" style="width:100%">
                                <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                            </select>
                            <small class="text-muted"><?php echo app('translator')->get('accounting::lang.cheque_bank_help_transfer'); ?></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('cheque_book_id', __('accounting::lang.cheque_book_no') . ':'); ?>

                            <select name="cheque_book_id" id="cheque_book_id" class="form-control" style="width:100%">
                                <option value=""><?php echo app('translator')->get('accounting::lang.select_bank_first'); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('cheque_leaf_id', __('accounting::lang.cheque_number') . ':'); ?>

                            <select name="cheque_leaf_id" id="cheque_leaf_id" class="form-control" style="width:100%">
                                <option value=""><?php echo app('translator')->get('accounting::lang.select_cheque_book_first'); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('cheque_date', __('accounting::lang.cheque_date') . ':'); ?>

                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                <?php echo Form::text('cheque_date', null, ['class' => 'form-control', 'placeholder' => __('accounting::lang.cheque_date'), 'id' => 'cheque_date_input', 'readonly']); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-2">
            <button type="button" class="btn btn-outline-info btn-sm" id="toggle_cheque_section">
                <i class="fas fa-money-check"></i> <?php echo app('translator')->get('accounting::lang.attach_cheque'); ?>
            </button>
        </div>

        <div class="form-group mt-3">
            <?php echo Form::label('note', __( 'brand.note' )); ?>

            <?php echo Form::textarea('note', null, ['class' => 'form-control', 
                'placeholder' => __( 'brand.note' ), 'rows' => 4]); ?>

        </div>
    </div>

    <div class="modal-footer">
        <input type="hidden" name="save_and_print" value='0' id="save_and_print">
        <button type="button" class="btn btn-primary" disabled id="save_and_print_btn"><?php echo app('translator')->get( 'lang_v1.save_and_print' ); ?></button>

      <button type="submit" id="save_btn" class="btn btn-primary" disabled><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script>
$(document).ready(function(){

        var chequeRoutes = {
            booksByAccount: '<?php echo e(route("cheque-book.books-by-account"), false); ?>',
            unusedLeaves: '<?php echo e(route("cheque-book.unused-leaves"), false); ?>'
        };
        var chequeInitialized = false;

        function initTransferChequeSelect2($el, placeholder) {
            if ($el.hasClass('select2-hidden-accessible')) {
                $el.select2('destroy');
            }
            $el.select2({
                placeholder: placeholder || '<?php echo app('translator')->get("messages.please_select"); ?>',
                allowClear: true,
                width: '100%',
                dropdownParent: $('#create_transfer_modal')
            });
        }

        function initTransferChequeDatepicker() {
            if ($('#cheque_date_input').data('daterangepicker')) return;
            $('#cheque_date_input').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoUpdateInput: false,
                locale: {
                    format: moment_date_format,
                    cancelLabel: 'Clear'
                }
            });
            $('#cheque_date_input').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format(moment_date_format));
            });
            $('#cheque_date_input').on('cancel.daterangepicker', function() {
                $(this).val('');
            });
        }

        function initChequeFields() {
            if (chequeInitialized) return;
            chequeInitialized = true;
            initTransferChequeSelect2($('#cheque_bank_account_id'), '<?php echo app('translator')->get("messages.please_select"); ?>');
            initTransferChequeSelect2($('#cheque_book_id'), '<?php echo app('translator')->get("accounting::lang.select_bank_first"); ?>');
            initTransferChequeSelect2($('#cheque_leaf_id'), '<?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?>');
            initTransferChequeDatepicker();
        }

        function loadTransferBankAccounts() {
            var $bankSelect = $('#cheque_bank_account_id');
            var accountOptions = [];
            var seen = {};

            // Get Transfer From account
            var $fromOpt = $('select[name="from_account"] option:selected');
            if ($fromOpt.val() && !seen[$fromOpt.val()]) {
                seen[$fromOpt.val()] = true;
                accountOptions.push({ id: $fromOpt.val(), text: $fromOpt.text() });
            }
            // Get Transfer To account
            var $toOpt = $('select[name="to_account"] option:selected');
            if ($toOpt.val() && !seen[$toOpt.val()]) {
                seen[$toOpt.val()] = true;
                accountOptions.push({ id: $toOpt.val(), text: $toOpt.text() });
            }

            if ($bankSelect.hasClass('select2-hidden-accessible')) $bankSelect.select2('destroy');
            $bankSelect.empty().append('<option value=""><?php echo app('translator')->get("messages.please_select"); ?></option>');
            accountOptions.forEach(function(opt) {
                $bankSelect.append($('<option>', { value: opt.id, text: opt.text }));
            });
            initTransferChequeSelect2($bankSelect, '<?php echo app('translator')->get("messages.please_select"); ?>');
        }

        // Toggle cheque section
        $('#toggle_cheque_section').on('click', function() {
            var $section = $('#cheque_details_section');
            if ($section.is(':visible')) {
                $section.slideUp();
                $(this).html('<i class="fas fa-money-check"></i> <?php echo app('translator')->get("accounting::lang.attach_cheque"); ?>');
            } else {
                $section.slideDown(function() {
                    initChequeFields();
                    loadTransferBankAccounts();
                });
                $(this).html('<i class="fas fa-times"></i> <?php echo app('translator')->get("accounting::lang.hide_cheque_section"); ?>');
            }
        });

        // Reload bank accounts when from/to changes
        $(document).on('change', 'select[name="from_account"], select[name="to_account"]', function() {
            if ($('#cheque_details_section').is(':visible')) {
                loadTransferBankAccounts();
            }
        });

        // When bank account changed, load cheque books
        $(document).on('change', '#cheque_bank_account_id', function() {
            var accountId = $(this).val();
            var $bookSelect = $('#cheque_book_id');
            var $leafSelect = $('#cheque_leaf_id');

            if ($bookSelect.hasClass('select2-hidden-accessible')) $bookSelect.select2('destroy');
            $bookSelect.empty().append('<option value=""><?php echo app('translator')->get("messages.please_select"); ?></option>');

            if ($leafSelect.hasClass('select2-hidden-accessible')) $leafSelect.select2('destroy');
            $leafSelect.empty().append('<option value=""><?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?></option>');
            initTransferChequeSelect2($leafSelect, '<?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?>');

            if (!accountId) {
                initTransferChequeSelect2($bookSelect, '<?php echo app('translator')->get("accounting::lang.select_bank_first"); ?>');
                return;
            }

            $.ajax({
                url: chequeRoutes.booksByAccount,
                data: { account_id: accountId },
                dataType: 'json',
                success: function(data) {
                    if (data.length > 0) {
                        data.forEach(function(book) {
                            $bookSelect.append($('<option>', { value: book.id, text: book.text }));
                        });
                    } else {
                        $bookSelect.empty().append('<option value=""><?php echo app('translator')->get("accounting::lang.no_active_cheque_book"); ?></option>');
                    }
                    initTransferChequeSelect2($bookSelect, '<?php echo app('translator')->get("messages.please_select"); ?>');
                }
            });
        });

        // When cheque book changed, load unused leaves
        $(document).on('change', '#cheque_book_id', function() {
            var bookId = $(this).val();
            var $leafSelect = $('#cheque_leaf_id');

            if ($leafSelect.hasClass('select2-hidden-accessible')) $leafSelect.select2('destroy');
            $leafSelect.empty().append('<option value=""><?php echo app('translator')->get("messages.please_select"); ?></option>');

            if (!bookId) {
                initTransferChequeSelect2($leafSelect, '<?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?>');
                return;
            }

            $.ajax({
                url: chequeRoutes.unusedLeaves,
                data: { cheque_book_id: bookId },
                dataType: 'json',
                success: function(data) {
                    if (data.length > 0) {
                        data.forEach(function(leaf) {
                            $leafSelect.append($('<option>', { value: leaf.id, text: leaf.text }));
                        });
                        initTransferChequeSelect2($leafSelect, '<?php echo app('translator')->get("messages.please_select"); ?>');
                        $leafSelect.val(data[0].id).trigger('change');
                    } else {
                        $leafSelect.empty().append('<option value=""><?php echo app('translator')->get("accounting::lang.book_exhausted"); ?></option>');
                        initTransferChequeSelect2($leafSelect, '<?php echo app('translator')->get("accounting::lang.book_exhausted"); ?>');
                    }
                }
            });
        });

        // Clear cheque
        $('#clear_cheque_selection').on('click', function() {
            var $bankSelect = $('#cheque_bank_account_id');
            var $bookSelect = $('#cheque_book_id');
            var $leafSelect = $('#cheque_leaf_id');

            if ($bankSelect.hasClass('select2-hidden-accessible')) $bankSelect.select2('destroy');
            if ($bookSelect.hasClass('select2-hidden-accessible')) $bookSelect.select2('destroy');
            if ($leafSelect.hasClass('select2-hidden-accessible')) $leafSelect.select2('destroy');

            $bankSelect.empty().append('<option value=""><?php echo app('translator')->get("messages.please_select"); ?></option>');
            $bookSelect.empty().append('<option value=""><?php echo app('translator')->get("accounting::lang.select_bank_first"); ?></option>');
            $leafSelect.empty().append('<option value=""><?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?></option>');

            initTransferChequeSelect2($bankSelect, '<?php echo app('translator')->get("messages.please_select"); ?>');
            initTransferChequeSelect2($bookSelect, '<?php echo app('translator')->get("accounting::lang.select_bank_first"); ?>');
            initTransferChequeSelect2($leafSelect, '<?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?>');
            $('#cheque_date_input').val('');
        });

        $(document).on('click', '#transfer_form #save_and_print_btn', function(e){
            e.preventDefault();
            $('#transfer_form #save_and_print').val(1);
            $('#save_and_print_btn').prop('disabled', true);
            $('#save_btn').prop('disabled', true);
            $('#transfer_form').submit();
        });

        $("#amount").keyup(function(){
            if ($('#amount').val() != 0) {
                $('#save_btn').prop('disabled', false);
                $('#save_and_print_btn').prop('disabled', false);
            } else {
                $('#save_btn').prop('disabled', true);
                $('#save_and_print_btn').prop('disabled', true);
            }
            });
        });
   

</script>
