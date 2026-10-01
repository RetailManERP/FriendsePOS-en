<div class="modal-dialog" role="document">
    <div class="modal-content">

        <?php echo Form::open(['url' => action('\Modules\Installment\Http\Controllers\InstallmentSystemController@update',[$data->id]), 'method' => 'put','id'=>'edit_installment_system' ]); ?>


        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Installment Plan</h4>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <?php echo Form::label('name','System Name :*'); ?>

                <?php echo Form::text('name',$data->name, ['class' => 'form-control', 'required', 'placeholder' =>'Name' ]); ?>

            </div>

            <div class="form-group">
                <?php echo Form::label('number',' Number of Installments:*'); ?>

                <div class="row">
                    <div class="col-lg-4">
                <?php echo Form::text('number', $data->number, ['class' => 'form-control integr', 'required' ]); ?>

                    </div>
                </div>
            </div>

            <div class="form-group">
                <?php echo Form::label('period',' Repayment period each:'); ?>

                <div class="row">
                    <div class="col-lg-4">
                        <?php echo Form::text('period', $data->period, ['class' => 'form-control integr', 'required' ]); ?>

                    </div>
                    <div class="col-lg-6">
                        <select class="form-control" name="type">
                            <option value="day" <?php if($data->type =='day'): ?> selected <?php endif; ?>> <?php echo app('translator')->get('installment::lang.day'); ?></option>
                            <option value="month" <?php if($data->type =='month'): ?> selected <?php endif; ?> ><?php echo app('translator')->get('installment::lang.month'); ?></option>
                            <option value="year" <?php if($data->type =='year'): ?> selected <?php endif; ?> ><?php echo app('translator')->get('installment::lang.year'); ?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
               <div class="row">
                    <div class="col-lg-4">
                        <?php echo Form::label('benefit','Interest Rate %:'); ?>

                        <?php echo Form::text('benefit', $data->benefit, ['class' => 'form-control decimal', 'required' ]); ?>

                    </div>
                    <div class="col-lg-4">
                        <?php echo Form::label('benefit_type','Interest Type:'); ?>

                           <select class="form-control" name="benefit_type">
                               <option value="simple" <?php if($data->benefit_type =='simple'): ?> selected <?php endif; ?>  ><?php echo app('translator')->get('installment::lang.simple'); ?></option>
                               <option value="complex" <?php if($data->benefit_type =='complex'): ?> selected <?php endif; ?> ><?php echo app('translator')->get('installment::lang.complex'); ?></option>

                           </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?php echo Form::label('latfines','Late Payment Fine % :'); ?>

                <div class="row">
                    <div class="col-lg-4">
                        <?php echo Form::text('latfines', $data->latfines, ['class' => 'form-control decimal', 'required' ]); ?>

                    </div>
                    <div class="col-lg-6">
                        <select class="form-control"  name="latfinestype">
                            <option value="day" <?php if($data->latfinestype =='day'): ?> selected <?php endif; ?>> <?php echo app('translator')->get('installment::lang.day'); ?></option>
                            <option value="month" <?php if($data->latfinestype =='month'): ?> selected <?php endif; ?> ><?php echo app('translator')->get('installment::lang.month'); ?></option>
                            <option value="year" <?php if($data->latfinestype =='year'): ?> selected <?php endif; ?> ><?php echo app('translator')->get('installment::lang.year'); ?></option>

                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?php echo Form::label('grace_period', __('installment::lang.grace_period') . ' (' . __('installment::lang.days') . '):'); ?>

                <div class="row">
                    <div class="col-lg-4">
                        <?php echo Form::number('grace_period', $data->grace_period ?? 0, ['class' => 'form-control', 'min' => '0', 'placeholder' => '0']); ?>

                    </div>
                    <div class="col-lg-8">
                        <small class="text-muted"><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('installment::lang.grace_period_help'); ?></small>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?php echo Form::label('early_settlement_discount', __('installment::lang.early_settlement_discount') . ' %:'); ?>

                <div class="row">
                    <div class="col-lg-4">
                        <?php echo Form::text('early_settlement_discount', $data->early_settlement_discount ?? 0, ['class' => 'form-control decimal', 'placeholder' => '0']); ?>

                    </div>
                    <div class="col-lg-8">
                        <small class="text-muted"><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('installment::lang.early_settlement_help'); ?></small>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?php echo Form::label('description','Description :'); ?>

                <?php echo Form::text('description', $data->description, ['class' => 'form-control'  ]); ?>

            </div>

     </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" ><?php echo app('translator')->get( 'messages.save' ); ?></button>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
        </div>

        <?php echo Form::close(); ?>


    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script>

</script>
