
<?php $__env->startSection('title', __('crm::lang.proposal_template')); ?>
<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('crm::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<!-- Content Header (Page header) -->
	<section class="content-header no-print">
	   <h1><?php echo app('translator')->get('crm::lang.proposal_template'); ?></h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
			<?php if(empty($proposal_template) && auth()->user()->can('crm.add_proposal_template')): ?>
		        <?php $__env->slot('tool'); ?>
		            <div class="box-tools">
		                <a class="btn btn-primary float-end m-5" href="<?php echo e(action([\Modules\Crm\Http\Controllers\ProposalTemplateController::class, 'create']), false); ?>">
		                	<i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
		                </a>
		            </div>
		        <?php $__env->endSlot(); ?>
	        <?php endif; ?>
	        <?php if(!empty($proposal_template)): ?>
		        <div class="row">
		        	<div class="col-md-4 col-md-offset-4">
		        		<div class="box box-info box-primary">
		        			<div class="box-body">
		        				<strong>
		        					<?php echo e($proposal_template->subject, false); ?>

		        				</strong>
		        			</div>
		        			<div class="box-footer clearfix">
		        				<div class="row">
		        					<?php if(auth()->user()->can('crm.add_proposal_template')): ?>
			        					<div class="col-md-4">
			        						<a href="<?php echo e(action([\Modules\Crm\Http\Controllers\ProposalTemplateController::class, 'getEdit']), false); ?>" class="btn btn-primary float-start">
			        							<?php echo app('translator')->get('messages.edit'); ?>
			        						</a>
			        					</div>
			        				<?php endif; ?>
			        				<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crm.access_proposal')): ?>
			        					<div class="col-md-4">
			        						<a href="<?php echo e(action([\Modules\Crm\Http\Controllers\ProposalTemplateController::class, 'getView']), false); ?>" class="btn btn-info">
			        							<?php echo app('translator')->get('messages.view'); ?>
			        						</a>
			        					</div>
			        					<div class="col-md-4">
			        						<a href="<?php echo e(action([\Modules\Crm\Http\Controllers\ProposalTemplateController::class, 'send']), false); ?>" class="btn btn-success float-end">
			        							<?php echo app('translator')->get('crm::lang.send'); ?>
			        						</a>
			        					</div>
			        				<?php endif; ?>
		        				</div>
		        			</div>
		        		</div>
		        	</div>
		        </div>
		    <?php else: ?>
		    	<div class="callout callout-info">
		            <h4>
		            	<?php echo e(__('crm::lang.no_template_found'), false); ?>

		            </h4>
		        </div>
		    <?php endif; ?>
    	<?php echo $__env->renderComponent(); ?>
	</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>