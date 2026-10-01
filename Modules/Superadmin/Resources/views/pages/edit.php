
<?php $__env->startSection('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.edit_page')); ?>

<?php $__env->startSection('content'); ?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('superadmin::lang.edit_page'); ?></h1>
</section>

<!-- Main content -->
<section class="content">

	<?php echo Form::open(['url' => action([\Modules\Superadmin\Http\Controllers\PageController::class, 'update'], $page->id), 'method' => 'put', 'id' => 'add_page_form']); ?>


	<div class="box box-primary">
		<div class="box-body">
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<?php echo Form::label('title', __('superadmin::lang.page_title').':'); ?>

						<?php echo Form::text('title', $page->title, ['class' => 'form-control', 'placeholder' => __('superadmin::lang.page_title')]); ?>

					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<?php echo Form::label('slug', __('superadmin::lang.slug').':'); ?>

						<?php echo Form::text('slug', $page->slug, ['class' => 'form-control', 'placeholder' => __('superadmin::lang.slug'), 'required']); ?>

					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<?php echo Form::label('menu_order', __('superadmin::lang.menu_order').':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('superadmin::lang.menu_order_tooltip') . '"></i>';
                }
            ?>
						<?php echo Form::number('menu_order', $page->menu_order, ['class' => 'form-control', 'placeholder' => __('superadmin::lang.menu_order')]); ?>

					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-check">
					<label class="form-check-label">
<?php echo Form::checkbox('is_shown', 1, !empty($page->is_shown), ['class' => 'form-check-input']); ?>

                        <?php echo e(__('superadmin::lang.is_visible'), false); ?>

					</label>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="box box-primary">
		<div class="box-body">
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<?php echo Form::label('content', __('superadmin::lang.page_content').':'); ?>

						<?php echo Form::textarea('content', $page->content, ['class' => 'form-control', 'placeholder' => __('superadmin::lang.page_content')]); ?>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<button type="submit" class="btn btn-primary float-end btn-flat"><?php echo app('translator')->get('messages.save'); ?></button>
		</div>
	</div>

	<?php echo Form::close(); ?>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<?php echo $__env->make('superadmin::pages.form_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>