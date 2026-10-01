<style>
    .modal-dialog.installment-collection-modal {
        width: 800px;
        max-width: calc(100vw - 40px);
    }

    @media (max-width: 767px) {
        .modal-dialog.installment-collection-modal {
            width: auto;
            max-width: none;
            margin: 10px;
        }
    }
</style>

<div class="modal-dialog installment-collection-modal" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action('\Modules\Installment\Http\Controllers\InstallmentController@storepayment',$data->id), 'method' => 'post','id'=>'storepayment' ]); ?>

        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-money-bill-wave"></i> <?php echo app('translator')->get('installment::lang.pebt_Collection'); ?></h4>
        </div>
        <div class="modal-body">

            <input type="hidden" name="contact_id" value="<?php echo e($data->contact_id, false); ?>" >
            <input type="hidden" name="installment_id" value="<?php echo e($data->id, false); ?>" >

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <?php echo Form::label('number',' customer name :'); ?>

                        <?php echo Form::text('number', $contact->name, ['class' => 'form-control integr ', 'readonly','id'=>'number' ]); ?>

                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <?php echo Form::label('number','Installment number:'); ?>

                        <?php echo Form::text('number', $data->installment_number, ['class' => 'form-control integr ', 'readonly','id'=>'number' ]); ?>

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <?php echo Form::label('number','due date:'); ?>

                        <?php echo Form::text('number', $data->installmentdate, ['class' => 'form-control integr ', 'readonly','id'=>'number' ]); ?>

                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-4">
                    <div class="form-group">
                        <?php echo Form::label('installment_value','Installment Amount:'); ?>

                        <input type="text" name='installment_value' id="installment_value" value="<?php echo e($data->installment_value, false); ?>" class="form-control decimal intallparameter" readonly >
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <?php echo Form::label('benefit_value',' Benefit :'); ?>

                        <?php echo Form::text('benefit_value', $data->benefit_value, ['class' => 'form-control integr intallparameter', 'readonly','id'=>'benefit_value' ]); ?>

                    </div>
                </div>


            </div>


            <div class="row">
             <div class="col-lg-4">
                    <div class="form-group">
                        <?php echo Form::label('period',' Delay :'); ?>

                        <?php echo Form::text('period', $daylats, ['class' => 'form-control integr ', 'readonly','id'=>'period' ]); ?>

                        <?php if($grace_period > 0): ?>
                            <small class="text-info"><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('installment::lang.grace_period'); ?>: <?php echo e($grace_period, false); ?> <?php echo app('translator')->get('installment::lang.days'); ?></small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <?php echo Form::label('period',' Period :'); ?>

                        <?php echo Form::text('period', __('installment::lang.'.$data->latfinestype), ['class' => 'form-control integr intallparameter', 'readonly','id'=>'period' ]); ?>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <?php echo Form::label('period','fine rate :'); ?>

                        <?php echo Form::text('period', $data->latfines, ['class' => 'form-control integr ', 'readonly','id'=>'period' ]); ?>

                    </div>
                </div>




            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <?php echo Form::label('installmentdate','Due Date: '); ?>

                        <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                            <?php echo Form::text('installmentdate',Carbon::now()->format('Y-m-d'), ['class' => 'form-control date-picker','required', 'readonly','id'=>'installmentdate' ]); ?>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <?php echo Form::label('latfines','lat fine :'); ?>

                        <?php echo Form::text('latfines',$latfines_value, ['class' => 'form-control decimal intallparameter', 'required','id'=>'latfines' ]); ?>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <?php echo Form::label('totallpaid',' total paid:'); ?>

                        <?php echo Form::text('totallpaid',$latfines_value+$data->benefit_value+$data->installment_value, ['class' => 'form-control decimal intallparameter', 'required', 'readonly', 'id'=>'totallpaid' ]); ?>


                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <?php echo Form::label('payment_method', __('installment::lang.payment_method') . ':'); ?>

                        <select name="payment_method" id="payment_method" class="form-control">
                            <?php $__currentLoopData = $payment_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key, false); ?>"><?php echo e($label, false); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <?php if(!empty($accounts_enabled)): ?>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <?php echo Form::label('account_id',' Account:'); ?>

                            <?php echo Form::select('account_id',$accounts, null, ['class' => 'form-control select2 getinstallment','id'=>'account_id','style' => 'width:100%']); ?>

                        </div>
                    </div>
                <?php endif; ?>
            </div>





            <div class="modal-footer">
                <button type="submit" class="btn  btn-primary " > <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
            </div>






        </div><!-- /.modal-content -->
        <?php echo Form::close(); ?>

    </div><!-- /.modal-dialog -->
</div>


<script>

$(document).on('keyup','#latfines',function () {
    var latfines=$('#latfines').val();
    var benefit_value=$('#benefit_value').val();
    var installment_value=$('#installment_value').val();

    var total=(installment_value*1+benefit_value*1+latfines*1).toFixed(2);
    $('#totallpaid').val(total);
});


    $('.date-picker').datepicker({
        autoclose: true,
        format:'yyyy-m-d',
    });


</script>
