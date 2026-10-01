
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

<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
<?php echo Form::open(['url' => action([\Modules\Accounting\Http\Controllers\JournalEntryController::class, 'store']), 
    'method' => 'post', 'id' => 'journal_add_form']); ?>

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo app('translator')->get( 'expense.add_expense' ); ?> For (<?php echo e($job_sheet_no, false); ?>)</h4>
    </div>

    <div class="modal-body">

        <div class="row">
            <?php if(count($business_locations) == 1): ?>
            <?php
                $default_location = current(array_keys($business_locations->toArray()));
                $search_disable = false;
            ?>
            <?php else: ?>
            <?php
                $default_location = null;
                $search_disable = true;
            ?>
            <?php endif; ?>

            <?php if($location_id): ?>
                <?php
                    $default_location = $location_id;
                    $search_disable = false;
                ?>
            <?php endif; ?>

            <div class="col-sm-4">
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
            
            <div class="col-sm-4">
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

            <div class="col-sm-4">
				<div class="form-group">
					<?php echo Form::label('journal_date', __('accounting::lang.journal_date') . ':*'); ?>

					<div class="input-group">
						<span class="input-group-addon">
							<i class="fa fa-calendar"></i>
						</span>
						<?php echo Form::text('journal_date', \Carbon::createFromTimestamp(strtotime('now'))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control datetimepicker', 'readonly', 'required']); ?>

					</div>
				</div>
			</div>

            <?php if($truckmate_enabled): ?>
                <?php if(empty($job_sheet_id)): ?>
                <div class="col-sm-3">
                    <div class="form-group">
                        <?php echo Form::label('job_sheet_id', __('truckmate::lang.jobs').':*'); ?>

                        <?php echo Form::select('job_sheet_id', [], null, ['class' => 'form-control select2', 'id' => 'job_sheet_ids', 'style' => 'width: 100%;']); ?>

                    </div>
                </div>
                <?php else: ?>
                <input type="hidden" name="job_sheet_id" value="<?php echo e($job_sheet_id, false); ?>">
                <?php endif; ?>
            <?php endif; ?>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo Form::label('note', __('lang_v1.additional_notes')); ?>

                    <?php echo Form::textarea('note', null, ['class' => 'form-control', 'rows' => 3]); ?>

                </div>
            </div>
        </div>

        
        <div class="row mb-3" id="cheque_details_section" style="display:none;">
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="card-header bg-info text-white py-2 d-flex align-items-center">
                        <i class="fas fa-money-check me-2"></i>
                        <strong><?php echo app('translator')->get('accounting::lang.cheque_details'); ?></strong>
                        <button type="button" class="btn btn-sm btn-outline-light ms-auto" id="clear_cheque_selection">
                            <i class="fas fa-times"></i> <?php echo app('translator')->get('accounting::lang.clear_cheque'); ?>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo Form::label('cheque_book_id', __('accounting::lang.cheque_book_no') . ':'); ?>

                                    <select name="cheque_book_id" id="cheque_book_id" class="form-control cheque-select" style="width:100%">
                                        <option value=""><?php echo app('translator')->get('accounting::lang.select_bank_first'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo Form::label('cheque_leaf_id', __('accounting::lang.cheque_number') . ':'); ?>

                                    <select name="cheque_leaf_id" id="cheque_leaf_id" class="form-control cheque-select" style="width:100%">
                                        <option value=""><?php echo app('translator')->get('accounting::lang.select_cheque_book_first'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo Form::label('cheque_date', __('accounting::lang.cheque_date') . ':'); ?>

                                    <?php echo Form::text('cheque_date', null, ['class' => 'form-control', 'placeholder' => __('accounting::lang.cheque_date'), 'id' => 'cheque_date_input', 'readonly']); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-12">
                <button type="button" class="btn btn-outline-info btn-sm" id="toggle_cheque_section">
                    <i class="fas fa-money-check"></i> <?php echo app('translator')->get('accounting::lang.attach_cheque'); ?>
                </button>
            </div>
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
                    <?php for($i = 1; $i <= 2; $i++): ?>
                        <tr>
                            <td><?php echo e($i, false); ?></td>
                            <td>
                                <?php echo Form::select('account_id[' . $i . ']', [], null, 
                                            ['class' => 'form-control accounts-dropdown account_id', 
                                            'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

                            </td>
                            <td>
                                <?php echo Form::text('narration_note[' . $i . ']', null, ['class' => 'form-control note']); ?>

                            </td>
                            <td class="journal-entry-amount-cell">
                                <?php echo Form::text('debit[' . $i . ']', null, ['class' => 'form-control input_number debit journal-entry-amount-input']); ?>

                            </td>

                            <td class="journal-entry-amount-cell">
                                <?php echo Form::text('credit[' . $i . ']', null, ['class' => 'form-control input_number credit journal-entry-amount-input']); ?>

                            </td>
                        </tr>
                    <?php endfor; ?>
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
        </div>
        <div class="modal-footer">

        <div class="row">
            <div class="col-sm-12">
                <input type="hidden" name="from_truckmate" value='1' id="from_truckmate">
                <input type="hidden" name="save_and_print" value='0' id="save_and_print">
                <button type="button" class="btn btn-primary btn-flat journal_add_btn" id="save_btn" disabled><?php echo app('translator')->get('messages.save'); ?></button>
                <button type="button" class="btn btn-primary btn-flat journal_add_btn" disabled id="save_and_print_btn"><?php echo app('translator')->get( 'lang_v1.save_and_print' ); ?></button>
            </div>
        </div>
        </div>

    <?php echo Form::close(); ?>

</div>
</div>
