

<?php $__env->startSection('title', __('accounting::lang.journal_entry')); ?>

<?php $__env->startSection('css'); ?>
<style>
    .journal-entry-table .journal-entry-amount-heading,
    .journal-entry-table .journal-entry-amount-cell,
    .journal-entry-table .journal-entry-amount-input {
        text-align: right;
    }

    .journal-entry-table .journal-entry-amount-total {
        display: block;
        text-align: right;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'accounting::lang.journal_entry' ); ?> - <?php echo e($journal->ref_no, false); ?></h1>
</section>
<section class="content">

<?php echo Form::open(['url' => action([\Modules\Accounting\Http\Controllers\JournalEntryController::class, 'update'], $journal->id), 
    'method' => 'PUT', 'id' => 'journal_add_form']); ?>


	<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>

        <div class="row">
            <?php if(count($business_locations) == 1): ?>
            <?php
                $default_location = $journal->location_id;
                $search_disable = false;
            ?>
            <?php else: ?>
            <?php
                $default_location = $journal->location_id;
                $search_disable = true;
            ?>
            <?php endif; ?>
            <div class="col-sm-3">
                <div class="form-group">
                    <?php echo Form::label('location_id', __('purchase.business_location') . ':*'); ?>

                    <?php echo Form::select(
                        'location_id',
                        $business_locations,
                        $default_location,
                        ['class' => 'form-control select2', 'required'],
                    ); ?>

                </div>
            </div>

            <div class="col-sm-3">
				<div class="form-group">
					<?php echo Form::label('journal_date', __('accounting::lang.journal_date') . ':*'); ?>

					<div class="input-group">
						<span class="input-group-text">
							<i class="fa fa-calendar"></i>
						</span>
						<?php echo Form::text('journal_date', \Carbon::createFromTimestamp(strtotime($journal->operation_date))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control datetimepicker', 'readonly', 'required']); ?>

					</div>
				</div>
			</div>
            <?php if($truckmate_enabled): ?>
            <div class="col-sm-3">
                <div class="form-group">
                    <?php echo Form::hidden('hidden_job_sheet_id', $journal->truckmate_job_sheet_id, ['id' => 'hidden_job_sheet_id']); ?>

                    <?php echo Form::label('job_sheet_id', __('truckmate::lang.jobs').':*'); ?>

                    <?php echo Form::select('job_sheet_id', [], $journal->truckmate_job_sheet_id, ['class' => 'form-control select2', 'id' => 'job_sheet_ids', 'style' => 'width: 100%;']); ?>

                </div>
            </div>
            <?php endif; ?>

        </div>

        <div class="row">
            <div class="col-sm-12">

            <div class="table-responsive">
<table class="table table-bordered table-striped hide-footer table-th-skin journal-entry-table" id="journal_table">
                <thead>
                    <tr>
                        <th class="col-md-1">#</th>
                        <th class="col-md-4"><?php echo app('translator')->get( 'accounting::lang.account' ); ?></th>
                        <th class="col-md-3"><?php echo app('translator')->get( 'accounting::lang.narration' ); ?></th>
                        <th class="col-md-2 journal-entry-amount-heading"><?php echo app('translator')->get( 'accounting::lang.debit' ); ?> <?php if(!empty(session('currency.symbol'))): ?> (<?php echo e(session('currency.symbol'), false); ?>) <?php endif; ?></th>
                        <th class="col-md-2 journal-entry-amount-heading"><?php echo app('translator')->get( 'accounting::lang.credit' ); ?> <?php if(!empty(session('currency.symbol'))): ?> (<?php echo e(session('currency.symbol'), false); ?>) <?php endif; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $accounts_transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $rowIndex = $i + 1;
                            $account_id = $transaction['accounting_account_id'];
                            $debit = ($transaction['type'] == 'debit') ? $transaction['amount'] : '';
                            $credit = ($transaction['type'] == 'credit') ? $transaction['amount'] : '';
                            $default_array = [$account_id => $transaction['account']['name']];
                            $note = $transaction['note'];
                        ?>
                        <tr>
                            <?php echo Form::hidden('accounts_transactions_id[' . $rowIndex . ']', $transaction['id']); ?>

                            <td><?php echo e($rowIndex, false); ?></td>
                            <td>
                                <?php echo Form::select('account_id[' . $rowIndex . ']', $default_array, $account_id, 
                                            ['class' => 'form-control accounts-dropdown account_id', 
                                            'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

                            </td>
                            <td>
                                <?php echo Form::text('narration_note[' . $rowIndex . ']', $note, ['class' => 'form-control note']); ?>

                            </td>
                            <td class="journal-entry-amount-cell">
                                <?php echo Form::text('debit[' . $rowIndex . ']', $debit, ['class' => 'form-control input_number debit journal-entry-amount-input']); ?>

                            </td>
                            <td class="journal-entry-amount-cell">
                                <?php echo Form::text('credit[' . $rowIndex . ']', $credit, ['class' => 'form-control input_number credit journal-entry-amount-input']); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center" colspan="6">
                            <button type="button" class="btn btn-primary btn-sm add_new_account_row"><i class="fa fa-plus"></i> <?php echo app('translator')->get('accounting::lang.add_new_account_row'); ?></button>
                        </td>
                    </tr>
                </tbody>

                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th class="text-center"><?php echo app('translator')->get( 'accounting::lang.total' ); ?></th>
                        <th class="journal-entry-amount-cell"><input type="hidden" class="total_debit_hidden"><span class="total_debit journal-entry-amount-total"></span></th>
                        <th class="journal-entry-amount-cell"><input type="hidden" class="total_credit_hidden"><span class="total_credit journal-entry-amount-total"></span></th>
                    </tr>
                </tfoot>
            </table>
</div>

            </div>
        </div>

        
        <div class="row mb-2">
            <div class="col-md-12">
                <button type="button" class="btn btn-outline-info btn-sm" id="toggle_cheque_section">
                    <?php if(!empty($cheque_info)): ?>
                        <i class="fas fa-times"></i> <?php echo app('translator')->get('accounting::lang.hide_cheque_section'); ?>
                    <?php else: ?>
                        <i class="fas fa-money-check"></i> <?php echo app('translator')->get('accounting::lang.attach_cheque'); ?>
                    <?php endif; ?>
                </button>
            </div>
        </div>

        
        <div class="row mb-3" id="cheque_details_section" style="<?php echo e(!empty($cheque_info) ? '' : 'display:none;', false); ?>">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info text-white py-2 d-flex align-items-center">
                        <i class="fas fa-money-check me-1"></i>
                        <strong><?php echo app('translator')->get('accounting::lang.cheque_details'); ?></strong>
                        <button type="button" class="btn btn-sm btn-outline-light ms-auto" id="clear_cheque_selection">
                            <i class="fas fa-times"></i> <?php echo app('translator')->get('accounting::lang.clear_cheque'); ?>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo Form::label('cheque_bank_account_id', __('accounting::lang.bank_account') . ':'); ?>

                                    <select name="cheque_bank_account_id" id="cheque_bank_account_id" class="form-control cheque-select" style="width:100%">
                                        <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                                        <?php if(!empty($cheque_info) && $cheque_info->chequeBook && $cheque_info->chequeBook->bankAccount): ?>
                                            <option value="<?php echo e($cheque_info->chequeBook->accounting_account_id, false); ?>" selected>
                                                <?php echo e($cheque_info->chequeBook->bankAccount->name, false); ?>

                                            </option>
                                        <?php endif; ?>
                                    </select>
                                    <small class="text-muted"><?php echo app('translator')->get('accounting::lang.cheque_bank_help'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo Form::label('cheque_book_id', __('accounting::lang.cheque_book_no') . ':'); ?>

                                    <select name="cheque_book_id" id="cheque_book_id" class="form-control cheque-select" style="width:100%">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo Form::label('cheque_leaf_id', __('accounting::lang.cheque_number') . ':'); ?>

                                    <select name="cheque_leaf_id" id="cheque_leaf_id" class="form-control cheque-select" style="width:100%">
                                        <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                                        <?php $__currentLoopData = $cheque_leaves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leaf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($leaf->id, false); ?>" <?php echo e(!empty($cheque_info) && $cheque_info->id == $leaf->id ? 'selected' : '', false); ?>>
                                                <?php echo e($leaf->cheque_number, false); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo Form::label('cheque_date', __('accounting::lang.cheque_date') . ':'); ?>

                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        <?php echo Form::text('cheque_date', !empty($cheque_info) && $cheque_info->cheque_date ? \Carbon::createFromTimestamp(strtotime($cheque_info->cheque_date))->format(session('business.date_format')) : null, ['class' => 'form-control', 'placeholder' => __('accounting::lang.cheque_date'), 'id' => 'cheque_date_input', 'readonly']); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo Form::label('note', __('lang_v1.additional_notes')); ?>

                    <?php echo Form::textarea('note', $journal->note, ['class' => 'form-control', 'rows' => 3]); ?>

                </div>
            </div>
        </div>
        
    <?php echo $__env->renderComponent(); ?>

    <?php echo Form::close(); ?>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('accounting::accounting.common_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script type="text/javascript">
    $(document).ready(function(){
        calculate_total();

        // ── Cheque Details Toggle & Dynamic Loading ──
        var chequeRoutes = {
            booksByAccount: '<?php echo e(route("cheque-book.books-by-account"), false); ?>',
            unusedLeaves: '<?php echo e(route("cheque-book.unused-leaves"), false); ?>'
        };
        var chequeInitialized = false;

        function initChequeSelect2($el, placeholder) {
            if ($el.hasClass('select2-hidden-accessible')) {
                $el.select2('destroy');
            }
            $el.select2({
                placeholder: placeholder || '<?php echo app('translator')->get("messages.please_select"); ?>',
                allowClear: true,
                width: '100%'
            });
        }

        function initChequeDatepicker() {
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
            initChequeSelect2($('#cheque_bank_account_id'), '<?php echo app('translator')->get("messages.please_select"); ?>');
            initChequeSelect2($('#cheque_book_id'), '<?php echo app('translator')->get("messages.please_select"); ?>');
            initChequeSelect2($('#cheque_leaf_id'), '<?php echo app('translator')->get("messages.please_select"); ?>');
            initChequeDatepicker();
        }

        // Init immediately if cheque section is visible (editing existing cheque)
        <?php if(!empty($cheque_info)): ?>
            initChequeFields();
        <?php endif; ?>

        // Toggle cheque section
        $('#toggle_cheque_section').on('click', function() {
            var $section = $('#cheque_details_section');
            if ($section.is(':visible')) {
                $section.slideUp();
                $(this).html('<i class="fas fa-money-check"></i> <?php echo app('translator')->get("accounting::lang.attach_cheque"); ?>');
            } else {
                $section.slideDown(function() {
                    initChequeFields();
                    // Only load accounts if bank select is empty (new cheque)
                    if ($('#cheque_bank_account_id option').length <= 1) {
                        loadBankAccountsForCheque();
                    }
                });
                $(this).html('<i class="fas fa-times"></i> <?php echo app('translator')->get("accounting::lang.hide_cheque_section"); ?>');
            }
        });

        function loadBankAccountsForCheque() {
            var accountOptions = [];
            var seen = {};
            // Keep existing selected value
            var currentVal = $('#cheque_bank_account_id').val();

            $('#journal_table tbody .account_id').each(function() {
                var $opt = $(this).find('option:selected');
                if ($opt.val() && !seen[$opt.val()]) {
                    seen[$opt.val()] = true;
                    accountOptions.push({ id: $opt.val(), text: $opt.text() });
                }
            });

            // Also keep the pre-selected bank account from existing cheque
            <?php if(!empty($cheque_info) && $cheque_info->chequeBook && $cheque_info->chequeBook->bankAccount): ?>
                if (!seen['<?php echo e($cheque_info->chequeBook->accounting_account_id, false); ?>']) {
                    accountOptions.push({ id: '<?php echo e($cheque_info->chequeBook->accounting_account_id, false); ?>', text: '<?php echo e($cheque_info->chequeBook->bankAccount->name, false); ?>' });
                }
            <?php endif; ?>

            var $bankSelect = $('#cheque_bank_account_id');
            if ($bankSelect.hasClass('select2-hidden-accessible')) $bankSelect.select2('destroy');
            $bankSelect.empty().append('<option value=""><?php echo app('translator')->get("messages.please_select"); ?></option>');
            accountOptions.forEach(function(opt) {
                $bankSelect.append($('<option>', { value: opt.id, text: opt.text }));
            });
            if (currentVal) $bankSelect.val(currentVal);
            initChequeSelect2($bankSelect, '<?php echo app('translator')->get("messages.please_select"); ?>');
        }

        // When bank account changed, load cheque books
        $(document).on('change', '#cheque_bank_account_id', function() {
            var accountId = $(this).val();
            var $bookSelect = $('#cheque_book_id');
            var $leafSelect = $('#cheque_leaf_id');

            if ($bookSelect.hasClass('select2-hidden-accessible')) $bookSelect.select2('destroy');
            $bookSelect.empty().append('<option value=""><?php echo app('translator')->get("messages.please_select"); ?></option>');

            if ($leafSelect.hasClass('select2-hidden-accessible')) $leafSelect.select2('destroy');
            $leafSelect.empty().append('<option value=""><?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?></option>');
            initChequeSelect2($leafSelect, '<?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?>');

            if (!accountId) {
                initChequeSelect2($bookSelect, '<?php echo app('translator')->get("accounting::lang.select_bank_first"); ?>');
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
                    initChequeSelect2($bookSelect, '<?php echo app('translator')->get("messages.please_select"); ?>');
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
                initChequeSelect2($leafSelect, '<?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?>');
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
                        initChequeSelect2($leafSelect, '<?php echo app('translator')->get("messages.please_select"); ?>');
                        $leafSelect.val(data[0].id).trigger('change');
                    } else {
                        $leafSelect.empty().append('<option value=""><?php echo app('translator')->get("accounting::lang.book_exhausted"); ?></option>');
                        initChequeSelect2($leafSelect, '<?php echo app('translator')->get("accounting::lang.book_exhausted"); ?>');
                    }
                }
            });
        });

        // Clear cheque selection
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

            initChequeSelect2($bankSelect, '<?php echo app('translator')->get("messages.please_select"); ?>');
            initChequeSelect2($bookSelect, '<?php echo app('translator')->get("accounting::lang.select_bank_first"); ?>');
            initChequeSelect2($leafSelect, '<?php echo app('translator')->get("accounting::lang.select_cheque_book_first"); ?>');
            $('#cheque_date_input').val('');
        });

        $(document).on('change', '.account_id', function() {
            if ($('#cheque_details_section').is(':visible')) {
                loadBankAccountsForCheque();
            }
        });
        // ── End Cheque Details ──
        
        $('.journal_add_btn').click(function(e){
            //e.preventDefault();
            calculate_total();
            
            var is_valid = true;

            //check if same or not
            if($('.total_credit_hidden').val() != $('.total_debit_hidden').val()){
                is_valid = false;
                alert("<?php echo app('translator')->get('accounting::lang.credit_debit_equal'); ?>");
            }

            //check if all account selected or not
            $('table > tbody  > tr').each(function(index, tr) { 
                var credit = __read_number($(tr).find('.credit'));
                var debit = __read_number($(tr).find('.debit'));

                if(credit != 0 || debit != 0){
                    if($(tr).find('.account_id').val() == ''){
                        is_valid = false;
                        alert("<?php echo app('translator')->get('accounting::lang.select_all_accounts'); ?>");
                    }
                }
            });

            if(is_valid){
                $('.journal_add_btn').prop('disabled', true);
                $('form#journal_add_form').submit();
            }

            return is_valid;
        });

        $(document).on('change', '.credit', function(){
            if($(this).val() > 0){
                $(this).parents('tr').find('.debit').val('');
            }
            calculate_total();
        });
        $(document).on('change', '.debit', function(){
            if($(this).val() > 0){
                $(this).parents('tr').find('.credit').val('');
            }
            calculate_total();
        });
        $(document).on('change', '.account_id', function(){
            let firstNote = $('#journal_table tbody tr:first').find('.note').val(); // Get note from the first row
            $(this).closest('tr').find('.note').val(firstNote); // Set note
        });

        $(document).on('click', '.add_new_account_row', function(){
            // Get the last row index
            var lastRowIndex = 0;
            $('#journal_table tbody tr').each(function(){
                var rowIndex = parseInt($(this).find('td:first').text());
                if(!isNaN(rowIndex) && rowIndex > lastRowIndex){
                    lastRowIndex = rowIndex;
                }
            });
            var newIndex = lastRowIndex + 1;

            var newRow = `
                <tr>
                    <td>${newIndex}</td>
                    <td>
                        <select name="account_id[${newIndex}]" class="form-control accounts-dropdown account_id" style="width: 100%;">
                            <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="narration_note[${newIndex}]" class="form-control note">
                    </td>
                    <td class="journal-entry-amount-cell">
                        <input type="text" name="debit[${newIndex}]" class="form-control input_number debit journal-entry-amount-input">
                    </td>
                    <td class="journal-entry-amount-cell">
                        <input type="text" name="credit[${newIndex}]" class="form-control input_number credit journal-entry-amount-input">
                    </td>
                </tr>
            `;

            // Insert the new row before the "add new" button row
            $(this).closest('tr').before(newRow);

            // Initialize the accounts dropdown for the new row
            var newSelect = $('#journal_table tbody tr').eq(-2).find('.accounts-dropdown');
            newSelect.select2({
                ajax: {
                    url: '<?php echo e(route("accounts-dropdown"), false); ?>',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data
                        }
                    },
                },
                escapeMarkup: function(markup) {
                    return markup;
                },
                templateResult: function(data) {
                    return data.html;
                },
                templateSelection: function(data) {
                    return data.text;
                }
            });
        });

        // Load job sheets on page load
        if ($('select#location_id').val()) {
            get_job_sheets_for_expense();
        }
	});

      // Load job sheets when location changes
	$('select#location_id').change(function() {
		get_job_sheets_for_expense();
	});

	function get_job_sheets_for_expense() {
		var location_id = $('select#location_id').val();
		if ($('#job_sheet_ids').length && location_id) {
			$.ajax({
				url: '/truckmate/get-location-job-sheets?location_id=' + location_id,
				dataType: 'json',
				success: function(data) {
					if(data && data.length > 0){
						$('#job_sheet_ids').select2('destroy').empty().select2({data: data});
						
						// Pre-select job sheets if editing
						if($('#hidden_job_sheet_id').length && $('#hidden_job_sheet_id').val() != ''){
                            $('#job_sheet_ids').val($('#hidden_job_sheet_id').val()).trigger('change');
                        }
					
					} else {
						$('#job_sheet_ids').select2('destroy').empty().select2({data: [{id: '', text: 'No Jobs Available'}]});
					}
				},
				error: function() {
					$('#job_sheet_ids').select2('destroy').empty().select2({data: [{id: '', text: 'Click to Select'}]});
				}
			});
		}
	}

    function calculate_total(){

        var precision = $('#__precision').val();
        var total_credit = 0;
        var total_debit = 0;
        $('table > tbody  > tr').each(function(index, tr) { 
            var credit = __read_number($(tr).find('.credit'));
            total_credit += credit;

            var debit = __read_number($(tr).find('.debit'));
            total_debit += debit;
        });

        // Round total_credit and total_debit based on precision
        total_credit = parseFloat(total_credit.toFixed(precision));
        total_debit = parseFloat(total_debit.toFixed(precision));


        $('.total_credit_hidden').val(total_credit);
        $('.total_debit_hidden').val(total_debit);

        $('.total_credit').text(__currency_trans_from_en(total_credit, false));
        $('.total_debit').text(__currency_trans_from_en(total_debit, false));
    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>