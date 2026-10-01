<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\EssentialsAllowanceAndDeductionController::class, 'store']), 'method' => 'post', 'id' => 'add_allowance_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'essentials::lang.add_pay_component' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
    	<div class="row">
    		<div class="form-group col-md-12">
	        	<?php echo Form::label('description', __( 'lang_v1.description' ) . ':*'); ?>

	          	<?php echo Form::text('description', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.description' ) ]); ?>

	      	</div>

	      	<div class="form-group col-md-12">
	        	<?php echo Form::label('type', __( 'lang_v1.type' ) . ':*'); ?>

	          	<?php echo Form::select('type', ['allowance' => __('essentials::lang.allowance'), 'deduction' => __('essentials::lang.deduction')], 'allowance', ['class' => 'form-control', 'required' ]); ?>

	      	</div>

	      	<div class="form-group col-md-12">
	        	<?php echo Form::label('employees', __('essentials::lang.employee') . ':'); ?>

	          	<?php echo Form::select('employees[]', $users, null, ['class' => 'form-control select2', 'multiple' ]); ?>

	      	</div>

	      	<div class="form-group col-md-6">
	        	<?php echo Form::label('amount_type', __( 'essentials::lang.amount_type' ) . ':*'); ?>

	          	<?php echo Form::select('amount_type', ['fixed' => __('lang_v1.fixed'), 'percent' => __('lang_v1.percentage')], 'fixed', ['class' => 'form-control', 'required' ]); ?>

	      	</div>
	      	
	      	<div class="form-group col-md-6">
	        	<?php echo Form::label('amount', __( 'sale.amount' ) . ':*'); ?>

	          	<?php echo Form::text('amount', null, ['class' => 'form-control input_number', 'placeholder' => __( 'sale.amount' ), 'required' ]); ?>

	      	</div>

	      	<div class="form-group col-md-12">
	        	<?php echo Form::label('applicable_date', __( 'essentials::lang.applicable_date' ) . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('essentials::lang.applicable_date_help') . '"></i>';
                }
            ?>
	        	<div class="input-group data">
	        		<?php echo Form::text('applicable_date', null, ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.applicable_date' ), 'readonly' ]); ?>

	        		<span class="input-group-text"><i class="fa fa-calendar"></i></span>
	        	</div>
	      	</div>
    	</div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
