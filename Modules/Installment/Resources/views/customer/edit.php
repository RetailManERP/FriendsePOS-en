<style>
    .modal-dialog.installment-plan-edit-modal {
        width: 800px;
        max-width: calc(100vw - 40px);
    }

    @media (max-width: 767px) {
        .modal-dialog.installment-plan-edit-modal {
            width: auto;
            max-width: none;
            margin: 10px;
        }
    }
</style>

<div class="modal-dialog installment-plan-edit-modal" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action('\Modules\Installment\Http\Controllers\CustomerController@update', [$data->id]), 'method' => 'put', 'id' => 'edit_installment_plan']); ?>

        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Installment Plan</h4>
        </div>

        <div class="modal-body">
            <?php if($paid_count > 0): ?>
                <div class="alert alert-warning">
                    This plan has paid installments, so plan details cannot be edited.
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('customer_name', __('contact.customer') . ':'); ?>

                        <input type="text" id="customer_name" class="form-control" value="<?php echo e(optional($data->contact)->name, false); ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('invoice_no', __('sale.invoice_no') . ':'); ?>

                        <input type="text" id="invoice_no" class="form-control" value="<?php echo e(optional($data->transaction)->invoice_no, false); ?>" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('system_id', 'Installment Plan:'); ?>

                        <?php echo Form::select('system_id', $systems, $data->system_id, ['class' => 'form-control select2', 'id' => 'edit_system_id', 'disabled' => $paid_count > 0]); ?>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('installment_value', 'Installment value:'); ?>

                        <?php echo Form::text('installment_value', number_format((float) $data->installment_value, 2, '.', ''), ['class' => 'form-control decimal edit-plan-parameter', 'required', 'id' => 'edit_installment_value', 'readonly' => $paid_count > 0]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('number', 'Number of installments:*'); ?>

                        <?php echo Form::text('number', $data->number, ['class' => 'form-control integr edit-plan-parameter', 'required', 'id' => 'edit_number', 'readonly' => $paid_count > 0]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('period', 'Payment rate:'); ?>

                        <?php echo Form::text('period', $data->period, ['class' => 'form-control integr edit-plan-parameter', 'required', 'id' => 'edit_period', 'readonly' => $paid_count > 0]); ?>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('type', 'Period type:'); ?>

                        <select class="form-control edit-plan-select" name="type" id="edit_type" <?php if($paid_count > 0): ?> disabled <?php endif; ?>>
                            <option value="day" <?php if($data->type == 'day'): ?> selected <?php endif; ?>><?php echo app('translator')->get('installment::lang.day'); ?></option>
                            <option value="month" <?php if($data->type == 'month'): ?> selected <?php endif; ?>><?php echo app('translator')->get('installment::lang.month'); ?></option>
                            <option value="year" <?php if($data->type == 'year'): ?> selected <?php endif; ?>><?php echo app('translator')->get('installment::lang.year'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('benefit', 'Interest rate %:'); ?>

                        <?php echo Form::text('benefit', number_format((float) $data->benefit, 2, '.', ''), ['class' => 'form-control decimal edit-plan-parameter', 'required', 'id' => 'edit_benefit', 'readonly' => $paid_count > 0]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('benefit_type', 'Benefit type:'); ?>

                        <select class="form-control edit-plan-select" name="benefit_type" id="edit_benefit_type" <?php if($paid_count > 0): ?> disabled <?php endif; ?>>
                            <option value="simple" <?php if($data->benefit_type == 'simple'): ?> selected <?php endif; ?>><?php echo app('translator')->get('installment::lang.simple'); ?></option>
                            <option value="complex" <?php if($data->benefit_type == 'complex'): ?> selected <?php endif; ?>><?php echo app('translator')->get('installment::lang.complex'); ?></option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('latfines', 'Delay Penalty %:'); ?>

                        <?php echo Form::text('latfines', number_format((float) $data->latfines, 2, '.', ''), ['class' => 'form-control decimal', 'id' => 'edit_latfines', 'readonly' => $paid_count > 0]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('latfinestype', 'Penalty period:'); ?>

                        <select class="form-control" name="latfinestype" id="edit_latfinestype" <?php if($paid_count > 0): ?> disabled <?php endif; ?>>
                            <option value="day" <?php if($data->latfinestype == 'day'): ?> selected <?php endif; ?>><?php echo app('translator')->get('installment::lang.day'); ?></option>
                            <option value="month" <?php if($data->latfinestype == 'month'): ?> selected <?php endif; ?>><?php echo app('translator')->get('installment::lang.month'); ?></option>
                            <option value="year" <?php if($data->latfinestype == 'year'): ?> selected <?php endif; ?>><?php echo app('translator')->get('installment::lang.year'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('installmentdate', 'First installment date:'); ?>

                        <?php echo Form::text('installmentdate', optional($data->installmentdate)->format('Y-m-d'), ['class' => 'form-control date-picker', 'required', 'readonly', 'id' => 'edit_installmentdate']); ?>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('benefit_value', 'Total benefit:'); ?>

                        <?php echo Form::text('benefit_value', number_format((float) $data->benefit_value, 2, '.', ''), ['class' => 'form-control decimal', 'id' => 'edit_benefit_value', 'readonly']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('total', 'Total Payment:'); ?>

                        <?php echo Form::text('total', number_format((float) $data->total, 2, '.', ''), ['class' => 'form-control decimal', 'id' => 'edit_total', 'readonly']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('installment', 'Installment amount:'); ?>

                        <?php echo Form::text('installment', $data->number > 0 ? number_format((float) $data->total / $data->number, 2, '.', '') : '0.00', ['class' => 'form-control decimal', 'id' => 'edit_installment', 'readonly']); ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <?php if($paid_count == 0): ?>
                <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.save'); ?></button>
            <?php endif; ?>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>

<script>
    $(document).ready(function () {
        function calcEditInstallment() {
            var installmentValue = parseFloat($('#edit_installment_value').val()) || 0;
            var number = parseInt($('#edit_number').val()) || 0;
            var period = parseInt($('#edit_period').val()) || 0;
            var type = $('#edit_type').val();
            var benefit = parseFloat($('#edit_benefit').val()) || 0;
            var benefitType = $('#edit_benefit_type').val();

            if (installmentValue <= 0 || number <= 0 || period <= 0) {
                return;
            }

            var benefitValue = 0;
            var totalAmount = installmentValue;

            if (benefit > 0 && benefitType == 'simple') {
                var totalYears = 0;
                if (type == 'day') totalYears = (period * number) / 365;
                if (type == 'month') totalYears = (period * number) / 12;
                if (type == 'year') totalYears = period * number;

                benefitValue = installmentValue * (benefit / 100) * totalYears;
                totalAmount = installmentValue + benefitValue;
            } else if (benefit > 0) {
                var periodsPerYear = 1;
                if (type == 'day') periodsPerYear = 365 / period;
                if (type == 'month') periodsPerYear = 12 / period;
                if (type == 'year') periodsPerYear = 1 / period;

                var ratePerPeriod = (benefit / 100) / periodsPerYear;
                totalAmount = installmentValue * Math.pow(1 + ratePerPeriod, number);
                benefitValue = totalAmount - installmentValue;
            }

            $('#edit_benefit_value').val(benefitValue.toFixed(2));
            $('#edit_total').val(totalAmount.toFixed(2));
            $('#edit_installment').val((totalAmount / number).toFixed(2));
        }

        $('#edit_system_id').on('change', function () {
            $.ajax({
                method: 'GET',
                url: '<?php echo e(url('/installment/getsystemdata'), false); ?>',
                data: { id: $(this).val() },
                success: function(result) {
                    $('#edit_number').val(result.number);
                    $('#edit_period').val(result.period);
                    $('#edit_type').val(result.type);
                    $('#edit_benefit').val(result.benefit);
                    $('#edit_benefit_type').val(result.benefit_type);
                    $('#edit_latfines').val(result.latfines);
                    $('#edit_latfinestype').val(result.latfinestype);
                    calcEditInstallment();
                }
            });
        });

        $('.edit-plan-parameter').on('keyup change', calcEditInstallment);
        $('.edit-plan-select').on('change', calcEditInstallment);

        $('.date-picker').datepicker({
            autoclose: true,
            format: 'yyyy-m-d',
        });
    });
</script>
