<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\Modules\Accounting\Http\Controllers\TransferController::class, 'update'], 
        $mapping_transaction->id), 'method' => 'put', 'id' => 'transfer_form' ]); ?>


    <div class="modal-header">
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo app('translator')->get( 'accounting::lang.edit_transfer' ); ?></h4>
    </div>

    <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('location_id', __('purchase.business_location') . ':'); ?>

                    <?php echo Form::select(
                        'location_id',
                        $business_locations,
                        $mapping_transaction->location_id,
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
                    <?php echo Form::text('ref_no', $mapping_transaction->ref_no, ['class' => 'form-control']); ?>

                </div>
            </div>
        </div>
        
        <div class="form-group">
            <?php echo Form::label('to_account', __( 'lang_v1.transfer_to' ) .":*"); ?>

            <?php echo Form::select('to_account', [$credit_tansaction->accounting_account_id => $credit_tansaction->name], $credit_tansaction->accounting_account_id, ['class' => 'form-control accounts-dropdown', 'required', 
                'placeholder' => __('messages.please_select') ]); ?>

        </div>

        <div class="form-group">
            <?php echo Form::label('from_account', __( 'lang_v1.transfer_from' ) .":*"); ?>

            <?php echo Form::select('from_account', [$debit_tansaction->accounting_account_id => $debit_tansaction->name], $debit_tansaction->accounting_account_id, ['class' => 'form-control accounts-dropdown', 'required', 
                'placeholder' => __('messages.please_select') ]); ?>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('amount', __( 'sale.amount' ) .":*"); ?>

                    <?php echo Form::text('amount', number_format($debit_tansaction->amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 
                        'required','placeholder' => __( 'sale.amount' ) ]); ?>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php echo Form::label('operation_date', __( 'messages.date' ) .":*"); ?>

                    <div class="input-group">
                        <?php echo Form::text('operation_date', \Carbon::createFromTimestamp(strtotime($mapping_transaction->operation_date))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 
                            'required','placeholder' => __( 'messages.date' ), 'id' => 'operation_date' ]); ?>

                        <span class="input-group-text">
                        <span class="fa fa-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card border-info mt-3" id="cheque_details_section_edit" style="<?php echo e(!empty($cheque_info) ? '' : 'display:none;', false); ?>">
            <div class="card-header bg-info text-white py-2 d-flex align-items-center">
                <i class="fas fa-money-check me-1"></i>
                <strong><?php echo app('translator')->get('accounting::lang.cheque_details'); ?></strong>
                <button type="button" class="btn btn-sm btn-outline-light ms-auto" id="clear_cheque_selection_edit">
                    <i class="fas fa-times"></i> <?php echo app('translator')->get('accounting::lang.clear_cheque'); ?>
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('cheque_bank_account_id', __('accounting::lang.bank_account') . ':'); ?>

                            <select name="cheque_bank_account_id" id="cheque_bank_account_id_edit" class="form-control" style="width:100%">
                                <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                                <?php if(!empty($cheque_info) && $cheque_info->chequeBook && $cheque_info->chequeBook->bankAccount): ?>
                                    <option value="<?php echo e($cheque_info->chequeBook->accounting_account_id, false); ?>" selected>
                                        <?php echo e($cheque_info->chequeBook->bankAccount->name, false); ?>

                                    </option>
                                <?php endif; ?>
                            </select>
                            <small class="text-muted"><?php echo app('translator')->get('accounting::lang.cheque_bank_help_transfer'); ?></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('cheque_book_id', __('accounting::lang.cheque_book_no') . ':'); ?>

                            <select name="cheque_book_id" id="cheque_book_id_edit" class="form-control" style="width:100%">
                                <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                                <?php $__currentLoopData = $cheque_books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $remaining = $book->total_leaves - $book->used_leaves - $book->cancelled_leaves;
                                    ?>
                                    <option value="<?php echo e($book->id, false); ?>" <?php echo e(!empty($cheque_info) && $cheque_info->cheque_book_id == $book->id ? 'selected' : '', false); ?>>
                                        <?php echo e($book->cheque_book_no, false); ?> (<?php echo e($remaining, false); ?> leaves)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('cheque_leaf_id', __('accounting::lang.cheque_number') . ':'); ?>

                            <select name="cheque_leaf_id" id="cheque_leaf_id_edit" class="form-control" style="width:100%">
                                <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                                <?php $__currentLoopData = $cheque_leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leaf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($leaf->id, false); ?>" <?php echo e(!empty($cheque_info) && $cheque_info->id == $leaf->id ? 'selected' : '', false); ?>>
                                        <?php echo e($leaf->cheque_number, false); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('cheque_date', __('accounting::lang.cheque_date') . ':'); ?>

                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                <?php echo Form::text('cheque_date', !empty($cheque_info) && $cheque_info->cheque_date ? \Carbon::createFromTimestamp(strtotime($cheque_info->cheque_date))->format(session('business.date_format')) : null, ['class' => 'form-control', 'placeholder' => __('accounting::lang.cheque_date'), 'id' => 'cheque_date_input_edit', 'readonly']); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-2">
            <button type="button" class="btn btn-outline-info btn-sm" id="toggle_cheque_section_edit">
                <?php if(!empty($cheque_info)): ?>
                    <i class="fas fa-times"></i> <?php echo app('translator')->get('accounting::lang.hide_cheque_section'); ?>
                <?php else: ?>
                    <i class="fas fa-money-check"></i> <?php echo app('translator')->get('accounting::lang.attach_cheque'); ?>
                <?php endif; ?>
            </button>
        </div>

        <div class="form-group mt-3">
            <?php echo Form::label('note', __( 'brand.note' )); ?>

            <?php echo Form::textarea('note', $mapping_transaction->note, ['class' => 'form-control', 
                'placeholder' => __( 'brand.note' ), 'rows' => 4]); ?>

        </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
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
    var editChequeInitialized = false;

    function initEditChequeSelect2($el, placeholder) {
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

    function initEditChequeDatepicker() {
        if ($('#cheque_date_input_edit').data('daterangepicker')) return;
        $('#cheque_date_input_edit').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: false,
            locale: {
                format: moment_date_format,
                cancelLabel: 'Clear'
            }
        });
        $('#cheque_date_input_edit').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format(moment_date_format));
        });
        $('#cheque_date_input_edit').on('cancel.daterangepicker', function() {
            $(this).val('');
        });
    }

    function initEditChequeFields() {
        if (editChequeInitialized) return;
        editChequeInitialized = true;
        initEditChequeSelect2($('#cheque_bank_account_id_edit'), '<?php echo app('translator')->get("messages.please_select"); ?>');
        initEditChequeSelect2($('#cheque_book_id_edit'), '<?php echo app('translator')->get("messages.please_select"); ?>');
        initEditChequeSelect2($('#cheque_leaf_id_edit'), '<?php echo app('translator')->get("messages.please_select"); ?>');
        initEditChequeDatepicker();
    }

    function loadEditTransferBankAccounts() {
        var $bankSelect = $('#cheque_bank_account_id_edit');
        var currentVal = $bankSelect.val();
        var accountOptions = [];
        var seen = {};

        // Keep pre-selected value from existing cheque
        <?php if(!empty($cheque_info) && $cheque_info->chequeBook && $cheque_info->chequeBook->bankAccount): ?>
            accountOptions.push({ id: '<?php echo e($cheque_info->chequeBook->accounting_account_id, false); ?>', text: '<?php echo e($cheque_info->chequeBook->bankAccount->name, false); ?>' });
            seen['<?php echo e($cheque_info->chequeBook->accounting_account_id, false); ?>'] = true;
        <?php endif; ?>

        var $fromOpt = $('select[name="from_account"] option:selected');
        if ($fromOpt.val() && !seen[$fromOpt.val()]) {
            seen[$fromOpt.val()] = true;
            accountOptions.push({ id: $fromOpt.val(), text: $fromOpt.text() });
        }
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
        if (currentVal) $bankSelect.val(currentVal);
        initEditChequeSelect2($bankSelect, '<?php echo app('translator')->get("messages.please_select"); ?>');
    }

    // Init immediately if cheque section visible (editing existing cheque)
    <?php if(!empty($cheque_info)): ?>
        initEditChequeFields();
    <?php endif; ?>

    // Toggle
    $('#toggle_cheque_section_edit').on('click', function() {
        var $section = $('#cheque_details_section_edit');
        if ($section.is(':visible')) {
            $section.slideUp();
            $(this).html('<i class="fas fa-money-check"></i> <?php echo app('translator')->get("accounting::lang.attach_cheque"); ?>');
        } else {
            $section.slideDown(function() {
                initEditChequeFields();
                if ($('#cheque_bank_account_id_edit option').length <= 1) {
                    loadEditTransferBankAccounts();
                }
            });
            $(this).html('<i class="fas fa-times"></i> <?php echo app('translator')->get("accounting::lang.hide_cheque_section"); ?>');
        }
    });

    $(document).on('change', 'select[name="from_account"], select[name="to_account"]', function() {
        if ($('#cheque_details_section_edit').is(':visible')) {
            loadEditTransferBankAccounts();
        }
    });

    // Bank account change → load cheque books
    $(document).on('change', '#cheque_bank_account_id_edit', function() {
        var accountId = $(this).val();
        var $bookSelect = $('#cheque_book_id_edit');
        var $leafSelect = $('#cheque_leaf_id_edit');

        if ($bookSelect.hasClass('select2-hidden-accessible')) $bookSelect.select2('destroy');
        $bookSelect.empty().append('<option value=""><?php echo app('translator')->get("messages.please_select"); ?></option>');

        if ($leafSelect.hasClass('select2-hidden-accessible')) $leafSelect.select2('destroy');
        $leafSelect.empty().append('<option value=""><?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?></option>');
        initEditChequeSelect2($leafSelect, '<?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?>');

        if (!accountId) {
            initEditChequeSelect2($bookSelect, '<?php echo app('translator')->get("accounting::lang.select_bank_first"); ?>');
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
                initEditChequeSelect2($bookSelect, '<?php echo app('translator')->get("messages.please_select"); ?>');
            }
        });
    });

    // Cheque book change → load leaves
    $(document).on('change', '#cheque_book_id_edit', function() {
        var bookId = $(this).val();
        var $leafSelect = $('#cheque_leaf_id_edit');

        if ($leafSelect.hasClass('select2-hidden-accessible')) $leafSelect.select2('destroy');
        $leafSelect.empty().append('<option value=""><?php echo app('translator')->get("messages.please_select"); ?></option>');

        if (!bookId) {
            initEditChequeSelect2($leafSelect, '<?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?>');
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
                    initEditChequeSelect2($leafSelect, '<?php echo app('translator')->get("messages.please_select"); ?>');
                    $leafSelect.val(data[0].id).trigger('change');
                } else {
                    $leafSelect.empty().append('<option value=""><?php echo app('translator')->get("accounting::lang.book_exhausted"); ?></option>');
                    initEditChequeSelect2($leafSelect, '<?php echo app('translator')->get("accounting::lang.book_exhausted"); ?>');
                }
            }
        });
    });

    // Clear cheque
    $('#clear_cheque_selection_edit').on('click', function() {
        var $bankSelect = $('#cheque_bank_account_id_edit');
        var $bookSelect = $('#cheque_book_id_edit');
        var $leafSelect = $('#cheque_leaf_id_edit');

        if ($bankSelect.hasClass('select2-hidden-accessible')) $bankSelect.select2('destroy');
        if ($bookSelect.hasClass('select2-hidden-accessible')) $bookSelect.select2('destroy');
        if ($leafSelect.hasClass('select2-hidden-accessible')) $leafSelect.select2('destroy');

        $bankSelect.empty().append('<option value=""><?php echo app('translator')->get("messages.please_select"); ?></option>');
        $bookSelect.empty().append('<option value=""><?php echo app('translator')->get("accounting::lang.select_bank_first"); ?></option>');
        $leafSelect.empty().append('<option value=""><?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?></option>');

        initEditChequeSelect2($bankSelect, '<?php echo app('translator')->get("messages.please_select"); ?>');
        initEditChequeSelect2($bookSelect, '<?php echo app('translator')->get("accounting::lang.select_bank_first"); ?>');
        initEditChequeSelect2($leafSelect, '<?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?>');
        $('#cheque_date_input_edit').val('');
    });

});
</script>
