

<?php $__env->startSection('title', __('crm::lang.contacts_login')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('crm::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header no-print">
   <h1><?php echo app('translator')->get('crm::lang.contacts_login'); ?></h1>
</section>
<section class="content no-print">
	<input type="hidden" id="login_view_type" value="all_contacts_login">
	<?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('contact_id', __('contact.contact') . ':'); ?>

                    <?php echo Form::select('contact_id', $contacts, null, ['class' => 'form-control select2', 'id' => 'contact_id', 'placeholder' => __('messages.all'), 'style' => 'width:100%']); ?>

                </div>    
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>
	<?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('crm::lang.all_contacts_login')]); ?>
		<?php $__env->slot('tool'); ?>
			<div class="box-tools">
				<a class="btn btn-sm btn-primary float-end contact-login-add" data-href="<?php echo e(action([\Modules\Crm\Http\Controllers\ContactLoginController::class, 'create']), false); ?>" >
					<i class="fa fa-plus"></i>
					<?php echo app('translator')->get( 'messages.add' ); ?>
				</a>
			</div>
		<?php $__env->endSlot(); ?>
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-th-skin" id="all_contact_login_table" style="width: 100%;">
				<thead>
					<tr>
						<th><?php echo app('translator')->get('messages.action'); ?></th>
						<th><?php echo app('translator')->get('contact.contact'); ?></th>
						<th><?php echo app('translator')->get('business.username'); ?></th>
		                <th><?php echo app('translator')->get('user.name'); ?></th>
		                <th><?php echo app('translator')->get( 'business.email' ); ?></th>
		                <th><?php echo app('translator')->get( 'lang_v1.department' ); ?></th>
                		<th><?php echo app('translator')->get( 'lang_v1.designation' ); ?></th>
					</tr>
				</thead>
			</table>
		</div>
	<?php echo $__env->renderComponent(); ?>
	<div class="modal fade contact_login_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('modules/crm/js/crm.js?v=' . $asset_v), false); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>