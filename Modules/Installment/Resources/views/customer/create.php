<style>
    .modal-dialog.installment-plan-modal {
        width: 800px;
        max-width: calc(100vw - 40px);
    }

    .installment-plan-modal .modal-content {
        display: flex;
        flex-direction: column;
        max-height: calc(100vh - 40px);
        overflow: hidden;
    }

    .installment-plan-modal form#add_installment {
        display: flex;
        flex-direction: column;
        max-height: inherit;
        min-height: 0;
    }

    .installment-plan-modal .modal-header,
    .installment-plan-modal .modal-footer {
        background: #fff;
        flex: 0 0 auto;
        position: sticky;
        z-index: 1055;
    }

    .installment-plan-modal .modal-header {
        top: 0;
    }

    .installment-plan-modal .modal-body {
        flex: 1 1 auto;
        max-height: calc(100vh - 180px);
        overflow-y: auto;
    }

    .installment-plan-modal .modal-footer {
        bottom: 0;
    }

    @media (max-width: 767px) {
        .modal-dialog.installment-plan-modal {
            width: auto;
            max-width: none;
            margin: 10px;
        }

        .installment-plan-modal .modal-content {
            max-height: calc(100vh - 20px);
        }

        .installment-plan-modal .modal-body {
            max-height: calc(100vh - 160px);
        }
    }
</style>

<div class="modal-dialog installment-plan-modal" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action('\Modules\Installment\Http\Controllers\CustomerController@createinstallment'), 'method' => 'post','id'=>'add_installment' ]); ?>

        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add Installment</h4>
        </div>
        <div class="modal-body">

            <input type="hidden" name="contact_id" value="<?php echo e($transaction->contact_id, false); ?>">
            <input type="hidden" name="transaction_id" value="<?php echo e($transaction->id, false); ?>">
            <input type="hidden" name="advanced" id="advanced" value="0">

            <div class="row">
                <div class="col-lg-5">
                    <div class="form-group">
                        <?php echo Form::label('contactname','Client name :'); ?>

                        <input type="text" name='contactname' id="contactname" value=" <?php echo e($transaction->name, false); ?>" class="form-control decimal intallparameter"  >
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <?php echo Form::label('total_fat','Total Bill :'); ?>

                        <input type="text" name='total_fat' id="total_fat" value=" <?php echo e($total, false); ?>" class="form-control decimal intallparameter" readonly >
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <?php echo Form::label('total_paid','Total Paid :'); ?>

                        <input type="text" name='total_paid' id="total_paid" value=" <?php echo e($total_paid, false); ?>" class="form-control decimal intallparameter"  readonly >
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <?php echo Form::label('total_req','Payment due:'); ?>

                        <input type="text" name='total_req' id="total_req" value=" <?php echo e($total-$total_paid, false); ?>" class="form-control decimal intallparameter" readonly >
                    </div>
                </div>
            </div>

<hr>

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <?php echo Form::label('system_id',' Installment Plan:'); ?>

                        <?php echo Form::select('system_id', $systems, null, ['class' => 'form-control select2','id'=>'system_id']); ?>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <?php echo Form::label('installment_value',' Installment value'); ?>

                        <input type="text" name='installment_value' id="installment_value" value=" <?php echo e($total-$total_paid, false); ?>" class="form-control decimal intallparameter" required >
                    </div>
                </div>



            </div>
            <?php
                $readonly='';
                if(auth()->user()->can('installment.system_edit'))
                   $readonly='readonly';

            ?>


                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <?php echo Form::label('number',' Number of installments:*'); ?>

                            <?php echo Form::text('number', null, ['class' => 'form-control integr intallparameter', 'required','id'=>'number',$readonly ]); ?>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <?php echo Form::label('period',' Payment rate:'); ?>

                            <?php echo Form::text('period', null, ['class' => 'form-control integr intallparameter', 'required','id'=>'period',$readonly ]); ?>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <?php echo Form::label('type',' '); ?>

                        <select class="form-control" name="type" id="type" >
                            <option value="day"><?php echo app('translator')->get('installment::lang.day'); ?></option>
                            <option value="month"><?php echo app('translator')->get('installment::lang.month'); ?></option>
                            <option value="year"><?php echo app('translator')->get('installment::lang.year'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <?php echo Form::label('benefit','interest rate %:'); ?>

                            <?php echo Form::text('benefit', null, ['class' => 'form-control decimal intallparameter', 'required','id'=>'benefit' ,$readonly]); ?>

                            <span style="color: red" id="benefit-type">Interest value for each year</span>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <?php echo Form::label('benefit_type','benefit type :'); ?>

                        <select class="form-control" name="benefit_type" id="benefit_type">
                            <option value="simple"><?php echo app('translator')->get('installment::lang.simple'); ?></option>
                            <option value="complex"><?php echo app('translator')->get('installment::lang.complex'); ?></option>
                        </select>
                    </div>
                </div>
                 <div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <?php echo Form::label('latfines','Delay Penalty % :'); ?>

            <?php echo Form::text('latfines', null, ['class' => 'form-control decimal intallparameter', 'required','id'=>'latfines' ,$readonly]); ?>

        </div>
    </div>
    <div class="col-lg-4">
        <?php echo Form::label('latfinestype',' '); ?>

        <select class="form-control" name="latfinestype" id="latfinestype">
            <option value="day"><?php echo app('translator')->get('installment::lang.day'); ?></option>
            <option value="month"><?php echo app('translator')->get('installment::lang.month'); ?></option>
            <option value="year"><?php echo app('translator')->get('installment::lang.year'); ?></option>
        </select>
    </div>
</div>



                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <?php echo Form::label('installmentdate','First installment date: '); ?>

                            <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                <?php echo Form::text('installmentdate',Carbon::now()->format('Y-m-d'), ['class' => 'form-control date-picker','required', 'readonly','id'=>'installmentdate' ]); ?>

                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <?php echo Form::label('benefit_value','Total benefit :'); ?>

                            <?php echo Form::text('benefit_value', '00.00', ['class' => 'form-control decimal','id'=>'benefit_value','readonly' ]); ?>

                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <?php echo Form::label('total','Total Payment :'); ?>

                            <?php echo Form::text('total', '00.00', ['class' => 'form-control decimal','id'=>'total','readonly' ]); ?>

                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <?php echo Form::label('installment','Installment amount:'); ?>

                            <?php echo Form::text('installment', '00.00', ['class' => 'form-control decimal','id'=>'installment' ,'readonly']); ?>

                        </div>
                    </div>

                </div>
        </div>
        <div class="modal-footer">
            <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?></button>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
        <?php echo Form::close(); ?>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->


<script>
    $(document).ready(function () {
        $('#system_id').on('change',function () {
            var system_id=$('#system_id').val();
            $.ajax({
                method: 'GET',
                url: '/installment/getsystemdata',
                data:{
                    id:system_id
                },
                success: function(result) {
                    $('#system_name').val(result['name']);
                    $('#number').val(result['number']);
                    $('#period').val(result['period']);
                    $('#type').val(result['type']);
                    $('#benefit').val(result['benefit']);
                    $('#benefit_type').val(result['benefit_type']);


                    $('#latfines').val(result['latfines']);
                    $('#latfinestype').val(result['latfinestype']);

                    calcinstallment();
                }
            });
        });

        function calcinstallment(){

           var advanced=parseFloat($('#advanced').val()) || 0;
           var total_req=parseFloat($('#total_req').val()) || 0;
           $('#installment_value').val(total_req-advanced);

            var installment_value=parseFloat($('#installment_value').val());
            if(!installment_value || installment_value <= 0)
                return true;
            var number=parseInt($('#number').val());
            if(!number || number <= 0)
                return true;
            var period=parseInt($('#period').val());
            if(!period || period <= 0)
                return true;

            var type=$('#type').val();

            var benefit=parseFloat($('#benefit').val());
            if(isNaN(benefit))
                return true;

            var benefit_type=$('#benefit_type').val();

            var benefit_value = 0;
            var totalAmount = 0;

            if(benefit <= 0) {
                // No interest
                benefit_value = 0;
                totalAmount = installment_value;
            } else if(benefit_type == 'simple') {
                // Simple Interest: I = P * r * t
                // r = annual rate, t = total time in years
                var totalYears = 0;
                if(type == 'day')
                    totalYears = (period * number) / 365;
                else if(type == 'month')
                    totalYears = (period * number) / 12;
                else if(type == 'year')
                    totalYears = period * number;

                benefit_value = installment_value * (benefit / 100) * totalYears;
                totalAmount = installment_value + benefit_value;
            } else {
                // Compound Interest: A = P * (1 + r/n)^(n*t) 
                // r = annual rate, n = periods per year, t = total years
                var periodsPerYear = 1;
                if(type == 'day')
                    periodsPerYear = 365 / period;
                else if(type == 'month')
                    periodsPerYear = 12 / period;
                else if(type == 'year')
                    periodsPerYear = 1 / period;

                var ratePerPeriod = (benefit / 100) / periodsPerYear;
                totalAmount = installment_value * Math.pow(1 + ratePerPeriod, number);
                benefit_value = totalAmount - installment_value;
            }

            $('#benefit_value').val(benefit_value.toFixed(2));
            var installmentAmount = totalAmount / number;
            $('#installment').val(installmentAmount.toFixed(2));
            $('#total').val(totalAmount.toFixed(2));

            // Update interest type helper text
            if(benefit_type == 'complex') {
                $('#benefit-type').text('Compound interest calculated per period');
            } else {
                $('#benefit-type').text('Simple interest calculated on total duration');
            }
        }

        $('.intallparameter').on('keyup',function () {
            calcinstallment();
        });

        $('#type').on('change',function () {
            calcinstallment();
        });



        $('.date-picker').datepicker({
            autoclose: true,
            format:'yyyy-m-d',
        });

        $(document).on('submit', 'form#add_installment', function(e) {
            e.preventDefault();
            if($('#installmentdate').val().trim()==''){
                toastr.error('Sorry, please enter the start date of the installment');
               return true;
            }

            if($('#system_id').val()=='')
            {
                toastr.error('Sorry, please choose the Installment Plan');
                return true;
            }

            document.getElementById("submit").disabled = true;
            var form = $(this);
            __disable_submit_button(form.find('button[type="submit"]'));

            var data = form.serialize();
            $.ajax({
                method: 'POST',
                url: '/installment/createinstallment',
                dataType: 'json',
                data: data,
                beforeSend: function (xhr) {
                    __disable_submit_button(form.find('button[type="submit"]'));
                },
                success: function (result) {
                    if (result.success == true) {
                        $('div.div_modal').modal('hide');
                        toastr.success(result.msg);
                        sell_table.ajax.reload();
                        } else {
                        toastr.error(result.msg);
                    }
                },
            });
        });
    });





</script>
