

<?php $__env->startSection('title', __('crm::lang.schedule')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('crm::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header no-print">
	<h1>
   		<?php echo app('translator')->get('crm::lang.schedule'); ?> 
        <code>(<?php echo e($schedule->title, false); ?>)</code>
	</h1>
</section>

<section class="content no-print">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
                <div class="card-header p-0">
                    <ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" href="#schedule_info" data-bs-toggle="tab" aria-expanded="true">
							<?php echo app('translator')->get('crm::lang.schedule_info'); ?>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#schedule_log" data-bs-toggle="tab" aria-expanded="true">
							<?php echo app('translator')->get('crm::lang.schedule_log'); ?>
						</a>
					</li>
				</ul>
			</div>
			<div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="schedule_info">
                    	<?php if ($__env->exists('crm::schedule.partial.schedule_info')) echo $__env->make('crm::schedule.partial.schedule_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="tab-pane fade" id="schedule_log">
                    	<?php if ($__env->exists('crm::schedule_log.index')) echo $__env->make('crm::schedule_log.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    	<input type="hidden" name="schedule_id" id="schedule_id" value="<?php echo e($schedule->id, false); ?>">
                    </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</section>
<div class="modal fade edit_schedule" tabindex="-1" role="dialog"></div>
<div class="modal fade schedule_log_modal" tabindex="-1" role="dialog"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('modules/crm/js/crm.js?v=' . $asset_v), false); ?>"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			getScheduleLog($("input#schedule_id").val());
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>