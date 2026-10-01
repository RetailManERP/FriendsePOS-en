<div class="modal-dialog" role="document">
  	<div class="modal-content">
  		<div class="modal-header">
	      	<h4 class="modal-title"><?php echo app('translator')->get( 'essentials::lang.activity' ); ?></h4>
	      	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	    </div>
  		<div class="modal-body">
  			<div class="row">
  				<div class="col-md-12">
  					<h4><?php echo app('translator')->get('essentials::lang.leave'); ?>: <?php echo e($leave->ref_no, false); ?></h4>
  					<strong><?php echo app('translator')->get( 'essentials::lang.start_date' ); ?>:</strong> <?php echo e(\Carbon::createFromTimestamp(strtotime($leave->start_date))->format(session('business.date_format')), false); ?> &nbsp; &nbsp;
  					<strong><?php echo app('translator')->get( 'essentials::lang.end_date' ); ?>:</strong> <?php if(!empty($leave->end_date)): ?><?php echo e(\Carbon::createFromTimestamp(strtotime($leave->end_date))->format(session('business.date_format')), false); ?><?php endif; ?> 
  				</div>
  			</div>
  			<br>
  			<div class="row">
  				<div class="col-md-12">
		  			<table class="table table-condensed bg-gray table-th-skin">
		                <tr>
		                    <th><?php echo app('translator')->get('lang_v1.date'); ?></th>
		                    <th><?php echo app('translator')->get('messages.action'); ?></th>
		                    <th><?php echo app('translator')->get('lang_v1.by'); ?></th>
		                    <th><?php echo app('translator')->get('brand.note'); ?></th>
		                </tr>
		                <?php $__empty_18 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
		                    <tr>
		                        <td><?php echo format_datetime_br($activity->created_at); ?></td>
		                        <td>
		                        	<?php echo app('translator')->get('lang_v1.' . $activity->description); ?>
		                        </td>
		                        <td><?php echo e($activity->causer->user_full_name, false); ?></td>
		                        <td>
		                        	<?php if(!empty($activity->changes['attributes']['status_note'])): ?>
		                        	<?php echo e($activity->changes['attributes']['status_note'], false); ?>

		                        	<br>
		                        	<?php endif; ?>
		                            <?php if($activity->description == 'updated'): ?>
		                            	<?php if(!empty($activity->changes['attributes']['status'])): ?>
		                                	<?php echo app('translator')->get('essentials::lang.status_changed_to', ['status' => $activity->changes['attributes']['status']]); ?>
		                                <?php endif; ?>
		                            <?php endif; ?>
		                        </td>
		                    </tr>
		                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
		                    <tr>
		                      <td colspan="4" class="text-center">
		                        <?php echo app('translator')->get('purchase.no_records_found'); ?>
		                      </td>
		                    </tr>
		                <?php endif; ?>
		            </table>
		        </div>
		    </div>
  		</div>
  		<div class="modal-footer">
	      	<button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
	    </div>
  	</div>
</div>
