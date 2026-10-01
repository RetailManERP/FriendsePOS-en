
<?php $__env->startSection('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.communicator')); ?>

<?php $__env->startSection('css'); ?>
<style>
	.comm-compose-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 1rem; overflow: hidden; }
	.comm-compose-card .card-header { background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: #fff; padding: 1rem 1.5rem; }
	.comm-compose-card .card-header h4 { margin: 0; font-weight: 600; font-size: 1rem; }
	.comm-compose-card .card-body { padding: 1.5rem; }
	.comm-recipients-count { display: inline-block; background: rgba(255,255,255,.2); padding: .15rem .6rem; border-radius: 999px; font-size: .75rem; margin-left: .5rem; }
	.comm-history-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 1rem; overflow: hidden; }
	.comm-history-card .card-header { background: #f8fafc; padding: 1rem 1.5rem; border-bottom: 1px solid #e2e8f0; }
	.comm-history-card .card-header h4 { margin: 0; font-weight: 600; font-size: 1rem; color: #1e293b; }
	.comm-history-card .card-body { padding: 1rem 1.5rem; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('superadmin::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('superadmin::lang.communicator'); ?> <small><?php echo app('translator')->get('superadmin::lang.compose_message'); ?></small></h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="row g-3">
		<div class="col-lg-12 mb-3">
			<div class="comm-compose-card">
				<div class="card-header">
					<h4><i class="fa fa-paper-plane me-2"></i><?php echo app('translator')->get('superadmin::lang.compose_message'); ?>
						<span class="comm-recipients-count" id="recipient_count_badge">0 <?php echo app('translator')->get('superadmin::lang.recipients'); ?></span>
					</h4>
				</div>
		        <div class="card-body">
		        	<?php echo Form::open(['url' => action([\Modules\Superadmin\Http\Controllers\CommunicatorController::class, 'send']), 'method' => 'post', 'id' => 'communication_form']); ?>

		        		<div class="row mb-3">
		        			<div class="col-md-12 form-group">
		        				<?php echo Form::label('recipients', __('superadmin::lang.recipients').':*'); ?>

		        				<div class="mb-2">
		        					<button type="button" class="btn btn-outline-primary btn-sm select-all"><i class="fas fa-check-double me-1"></i><?php echo app('translator')->get('lang_v1.select_all'); ?></button>
		        					<button type="button" class="btn btn-outline-secondary btn-sm deselect-all"><i class="fas fa-times me-1"></i><?php echo app('translator')->get('lang_v1.deselect_all'); ?></button>
		        				</div>
								<?php echo Form::select('recipients[]', $businesses, null, ['class' => 'form-control select2', 'required', 'multiple', 'id' => 'recipients','style' => 'width: 100%;']); ?>

		        			</div>
		        		</div>
		        		<div class="row mb-3">
		        			<div class="col-md-12 form-group">
		        				<?php echo Form::label('subject', __('superadmin::lang.subject').':*'); ?>

		        				<?php echo Form::text('subject', null, ['class' => 'form-control', 'required', 'placeholder' => __('superadmin::lang.subject')]); ?>

		        			</div>
		        		</div>
		        		<div class="row mb-3">
		        			<div class="col-md-12 form-group">
		        				<?php echo Form::label('message', __('superadmin::lang.message').':*'); ?>

		        				<?php echo Form::textarea('message', null, ['class' => 'form-control', 'required', 'rows' => 6]); ?>

		        			</div>
		        		</div>
		        		<div class="row">
		        			<div class="col-md-12 text-end">
		        				<button type="submit" class="btn btn-primary" id="send_message">
		        					<i class="fas fa-paper-plane me-1"></i> <?php echo app('translator')->get('superadmin::lang.send'); ?>
		        				</button>
		        			</div>
		        		</div>
		        	<?php echo Form::close(); ?>

		        </div>
		    </div>
		</div>

		<div class="col-lg-12">
			<div class="comm-history-card">
				<div class="card-header">
					<h4><i class="fa fa-history me-2"></i><?php echo app('translator')->get('superadmin::lang.message_history'); ?></h4>
				</div>
		        <div class="card-body">
		        	<div class="table-responsive">
			        	<table class="table table-hover table-th-skin" id="message-history">
			        		<thead>
			        			<tr>
			        				<th><?php echo app('translator')->get('superadmin::lang.subject'); ?></th>
			        				<th><?php echo app('translator')->get('superadmin::lang.message'); ?></th>
			        				<th><?php echo app('translator')->get('lang_v1.date'); ?></th>
			        			</tr>
			        		</thead>
			        	</table>
		        	</div>
		        </div>
		     </div>
		</div>
	</div>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>

<script type="text/javascript">
	$(document).ready( function() {
		// Update recipient count badge
		function updateRecipientCount() {
			var count = $('#recipients').val() ? $('#recipients').val().length : 0;
			$('#recipient_count_badge').text(count + ' <?php echo e(__("superadmin::lang.recipients"), false); ?>');
		}
		$('#recipients').on('change', updateRecipientCount);
		updateRecipientCount();

		$('#send_message').click(function(e){
			e.preventDefault();
			if($('form#communication_form').valid()){
				swal({
	              title: LANG.sure,
	              icon: "warning",
	              buttons: true,
	              dangerMode: false,
	            }).then((sure) => {
	            	if(sure){
	            		$('form#communication_form').submit();
	            	} else {
	            		return false;
	            	}
	            });
	        }
		});

		$('#message-history').DataTable({
			dom:'lfrtip',
			processing: true,
			serverSide: true,
			ajax: '<?php echo e(action([\Modules\Superadmin\Http\Controllers\CommunicatorController::class, 'getHistory']), false); ?>'
	    });

	    init_tinymce('message');
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>