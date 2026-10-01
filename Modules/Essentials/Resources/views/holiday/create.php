<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\EssentialsHolidayController::class, 'store']), 'method' => 'post', 'id' => 'add_holiday_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'essentials::lang.add_holiday' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
    	<div class="row">
    		<div class="form-group col-md-12">
	        	<?php echo Form::label('name', __( 'lang_v1.name' ) . ':*'); ?>

	          	<?php echo Form::text('name', null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.name' ), 'required']); ?>

	      	</div>

	      	<div class="form-group col-md-6">
	        	<?php echo Form::label('start_date', __( 'essentials::lang.start_date' ) . ':*'); ?>

	        	<div class="input-group data">
	        		<?php echo Form::text('start_date', null, ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.start_date' ), 'readonly' ]); ?>

	        		<span class="input-group-text"><i class="fa fa-calendar"></i></span>
	        	</div>
	      	</div>

	      	<div class="form-group col-md-6">
	        	<?php echo Form::label('end_date', __( 'essentials::lang.end_date' ) . ':*'); ?>

		        	<div class="input-group data">
		          	<?php echo Form::text('end_date', null, ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.end_date' ), 'readonly', 'required' ]); ?>

		          	<span class="input-group-text"><i class="fa fa-calendar"></i></span>
	        	</div>
	      	</div>

	      	<div class="form-group col-md-12">
	        	<?php echo Form::label('location_id', __( 'business.business_location' ) . ':'); ?>

	          	<?php echo Form::select('location_id', $locations, null, ['class' => 'form-control select2', 'placeholder' => __( 'lang_v1.all' ) ]); ?>

	      	</div>

	      	<div class="form-group col-md-12">
	        	<?php echo Form::label('note', __( 'brand.note' ) . ':'); ?>

	          	<?php echo Form::textarea('note', null, ['class' => 'form-control', 'placeholder' => __( 'brand.note' ), 'rows' => 3 ]); ?>

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
