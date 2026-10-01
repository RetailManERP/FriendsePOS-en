

<?php $__env->startSection('title', __('crm::lang.b2b_marketplace')); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('crm::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header no-print">
   <h1><?php echo app('translator')->get('crm::lang.b2b_marketplace'); ?></h1>
</section>

<section class="content no-print">
	<div class="row">
		<div class="col-md-12">
			<?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => 'Exporters India']); ?>
				<div class="row">
					<div class="col-md-8">
						<?php echo Form::open(['url' => action([\Modules\Crm\Http\Controllers\CrmMarketplaceController::class, 'save']), 'method' => 'post' ]); ?>

							<input type="hidden" name="marketplace" value="exportersindia">
							<div class="form-group row">
							    <label for="site_key" class="col-sm-2 col-form-label"><?php echo app('translator')->get('crm::lang.key'); ?>*</label>
							    <div class="col-sm-10">
							      <input type="text"  class="form-control" id="site_key" 
							      value="<?php echo e($marketplace->site_key ?? '', false); ?>" name="site_key" required>
							    </div>
							</div>
							<div class="form-group row">
							    <label for="site_id" class="col-sm-2 col-form-label"><?php echo app('translator')->get('business.email'); ?>*</label>
							    <div class="col-sm-10">
							      <input type="email"  class="form-control" name="site_id" id="site_id" 
							      value="<?php echo e($marketplace->site_id ?? '', false); ?>" required>
							    </div>
							</div>                            
                     <div class="form-group row">
							   <label for="assigned_users" class="col-sm-2 col-form-label"><?php echo app('translator')->get('crm::lang.followup_assigned_to'); ?>*</label>
							   <div class="col-sm-10">
							      <?php echo Form::select('assigned_users[]', $users, $marketplace->assigned_users ?? [], ['class' => 'form-control select2', 'multiple', 'required', 'style' => 'width: 100%;', 'id' => 'assigned_users']); ?>

							   </div>
							</div>

							<div class="form-group row">
							   <label for="source_id" class="col-sm-2 col-form-label"><?php echo app('translator')->get('crm::lang.source'); ?>*</label>
							   <div class="col-sm-10">
							      <?php echo Form::select('source_id', $sources, $marketplace->source_id ?? '', ['class' => 'form-control select2', 'required', 'style' => 'width: 100%;', 'id' => 'source_id']); ?>

							   </div>
							</div>

							<div class="form-group row">
								<button type="submit" class="btn btn-primary float-end"><?php echo app('translator')->get('messages.submit'); ?></button>
							</div>
						<?php echo Form::close(); ?>

					</div>
				</div>
				<hr>
				<br>
				<div class="row">
					<div class="col-md-4 col-md-offset-4"><a href="<?php echo e(action([\Modules\Crm\Http\Controllers\CrmMarketplaceController::class, 'importLeads']), false); ?>" class="btn btn-success btn-block"><?php echo app('translator')->get('crm::lang.import_leads'); ?></a></div>
				</div>
			<?php echo $__env->renderComponent(); ?>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(document).ready( function() {
		$('#assigned_users').select2();
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>