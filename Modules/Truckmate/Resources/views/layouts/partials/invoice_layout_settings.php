<?php if($__is_truckmate_enabled): ?>

<?php
	$default = [
		'show_truckmate_status' => 1,
		'truckmate_status_label' => 'Repair Status',

		'show_truckmate_warranty' => 1,
		'truckmate_warranty_label' => 'Repair Warranty',

		'show_serial_no' => 1,
		'serial_no_label' => 'Serial No.',

		'show_defects' => 1,
		'defects_label' => 'Defects',
		'show_model' => 1,
		'model_no_label' => 'Model No.',
		'show_truckmate_checklist' => 1,
		'truckmate_checklist_label' => 'Repair Checklist',
		'show_device' => 1,
		'device_label' => 'Device',
		'show_brand' => 1,
		'brand_label' => 'Brand',
	];

	if(!empty($edit_il)){
		$default = [
			'show_truckmate_status' => !empty($module_info['truckmate']['show_truckmate_status']) ? 1 : 0,
			'truckmate_status_label' => !empty($module_info['truckmate']['truckmate_status_label']) ? $module_info['truckmate']['truckmate_status_label'] : '',

			'show_truckmate_warranty' => !empty($module_info['truckmate']['show_truckmate_warranty']) ? 1 : 0,
			'truckmate_warranty_label' => !empty($module_info['truckmate']['truckmate_warranty_label']) ? $module_info['truckmate']['truckmate_warranty_label'] : '',

			'show_serial_no' => !empty($module_info['truckmate']['show_serial_no']) ? 1 : 0,
			'serial_no_label' =>  !empty($module_info['truckmate']['serial_no_label']) ? $module_info['truckmate']['serial_no_label'] : '',

			'show_defects' => !empty($module_info['truckmate']['show_defects']) ? 1 : 0,
			'defects_label' =>  !empty($module_info['truckmate']['defects_label']) ? $module_info['truckmate']['defects_label'] : '',

			'show_model' => !empty($module_info['truckmate']['show_model']) ? 1 : 0,
			'model_no_label' =>  !empty($module_info['truckmate']['model_no_label']) ? $module_info['truckmate']['model_no_label'] : '',

			'show_truckmate_checklist' => !empty($module_info['truckmate']['show_truckmate_checklist']) ? 1 : 0,
			'truckmate_checklist_label' =>  !empty($module_info['truckmate']['truckmate_checklist_label']) ? $module_info['truckmate']['truckmate_checklist_label'] : '',

			'show_device' => !empty($module_info['truckmate']['show_device']) ? 1 : 0,
			'device_label' =>  !empty($module_info['truckmate']['device_label']) ? $module_info['truckmate']['device_label'] : '',

			'show_brand' => !empty($module_info['truckmate']['show_brand']) ? 1 : 0,
			'brand_label' =>  !empty($module_info['truckmate']['brand_label']) ? $module_info['truckmate']['brand_label'] : '',
		];
	}
	
?>

	<?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('truckmate::lang.truckmate_module_settings')]); ?>
       <div class="col-sm-3">
			<div class="form-group">
				<div class="checkbox">
					<label>
						<?php echo Form::checkbox('module_info[truckmate][show_truckmate_status]', 1, $default['show_truckmate_status'], ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('truckmate::lang.show_truckmate_status'); ?>
					</label>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<?php echo Form::label('module_info[truckmate][truckmate_status_label]', __('truckmate::lang.truckmate_status_label') . ':' ); ?>

				<?php echo Form::text('module_info[truckmate][truckmate_status_label]', $default['truckmate_status_label'], ['class' => 'form-control', 'placeholder' => __('truckmate::lang.truckmate_status_label') ]); ?>

			</div>
		</div>

		<div class="col-sm-3">
			<div class="form-group">
				<div class="checkbox">
					<label>
						<?php echo Form::checkbox('module_info[truckmate][show_truckmate_warranty]', 1, $default['show_truckmate_warranty'], ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('truckmate::lang.show_truckmate_warranty'); ?>
					</label>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<?php echo Form::label('module_info[truckmate][truckmate_warranty_label]', __('truckmate::lang.truckmate_warranty_label') . ':' ); ?>

				<?php echo Form::text('module_info[truckmate][truckmate_warranty_label]', $default['truckmate_warranty_label'], ['class' => 'form-control', 'placeholder' => __('truckmate::lang.truckmate_warranty_label') ]); ?>

			</div>
		</div>

		<div class="col-sm-3">
			<div class="form-group">
				<div class="checkbox">
					<label>
						<?php echo Form::checkbox('module_info[truckmate][show_brand]', 1, $default['show_brand'], ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('truckmate::lang.show_brand'); ?>
					</label>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<?php echo Form::label('module_info[truckmate][brand_label]', __('truckmate::lang.brand_label') . ':' ); ?>

				<?php echo Form::text('module_info[truckmate][brand_label]', $default['brand_label'], ['class' => 'form-control', 'placeholder' => __('truckmate::lang.brand_label') ]); ?>

			</div>
		</div>
		
		<div class="col-sm-3">
			<div class="form-group">
				<div class="checkbox">
					<label>
						<?php echo Form::checkbox('module_info[truckmate][show_device]', 1, $default['show_device'], ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('truckmate::lang.show_device'); ?>
					</label>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<?php echo Form::label('module_info[truckmate][device_label]', __('truckmate::lang.device_label') . ':' ); ?>

				<?php echo Form::text('module_info[truckmate][device_label]', $default['device_label'], ['class' => 'form-control', 'placeholder' => __('truckmate::lang.device_label') ]); ?>

			</div>
		</div>

		<div class="col-sm-3">
			<div class="form-group">
				<div class="checkbox">
					<label>
						<?php echo Form::checkbox('module_info[truckmate][show_model]', 1, $default['show_model'], ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('truckmate::lang.show_model'); ?>
					</label>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<?php echo Form::label('module_info[truckmate][model_no_label]', __('truckmate::lang.model_no_label') . ':' ); ?>

				<?php echo Form::text('module_info[truckmate][model_no_label]', $default['model_no_label'], ['class' => 'form-control', 'placeholder' => __('truckmate::lang.model_no_label') ]); ?>

			</div>
		</div>

		<div class="col-sm-3">
			<div class="form-group">
				<div class="checkbox">
					<label>
						<?php echo Form::checkbox('module_info[truckmate][show_serial_no]', 1, $default['show_serial_no'], ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('truckmate::lang.show_serial_no'); ?>
					</label>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<?php echo Form::label('module_info[truckmate][serial_no_label]', __('truckmate::lang.serial_no_label') . ':' ); ?>

				<?php echo Form::text('module_info[truckmate][serial_no_label]', $default['serial_no_label'], ['class' => 'form-control', 'placeholder' => __('truckmate::lang.serial_no_label') ]); ?>

			</div>
		</div>

		<div class="col-sm-3">
			<div class="form-group">
				<div class="checkbox">
					<label>
						<?php echo Form::checkbox('module_info[truckmate][show_defects]', 1, $default['show_defects'], ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('truckmate::lang.show_defects'); ?>
					</label>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<?php echo Form::label('module_info[truckmate][defects_label]', __('truckmate::lang.defects_label') . ':' ); ?>

				<?php echo Form::text('module_info[truckmate][defects_label]', $default['defects_label'], ['class' => 'form-control', 'placeholder' => __('truckmate::lang.defects_label') ]); ?>

			</div>
		</div>
		
		<div class="col-sm-3">
			<div class="form-group">
				<div class="checkbox">
					<label>
						<?php echo Form::checkbox('module_info[truckmate][show_truckmate_checklist]', 1, $default['show_truckmate_checklist'], ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('truckmate::lang.show_truckmate_checklist'); ?>
					</label>
				</div>
			</div>
		</div>
		<div class="col-sm-3">
			<div class="form-group">
				<?php echo Form::label('module_info[truckmate][truckmate_checklist_label]', __('truckmate::lang.truckmate_checklist_label') . ':' ); ?>

				<?php echo Form::text('module_info[truckmate][truckmate_checklist_label]', $default['truckmate_checklist_label'], ['class' => 'form-control', 'placeholder' => __('truckmate::lang.truckmate_checklist_label') ]); ?>

			</div>
		</div>
    <?php echo $__env->renderComponent(); ?>
<?php endif; ?>