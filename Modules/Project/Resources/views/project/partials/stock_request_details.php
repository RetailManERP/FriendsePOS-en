<div class="modal-dialog project-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title"><?php echo app('translator')->get('messages.view'); ?> <?php echo app('translator')->get('lang_v1.stock_transfer'); ?></h4>
        </div>
        <div class="modal-body">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th><?php echo app('translator')->get('project::lang.project'); ?></th>
                        <td><?php echo e($project->name, false); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('lang_v1.product'); ?></th>
                        <td>
                            <?php echo e(optional($stock_request->product)->name ?? '-', false); ?>

                            <?php if(!empty(optional($stock_request->variation)->name) && optional($stock_request->variation)->name !== 'DUMMY'): ?>
                                (<?php echo e(optional($stock_request->variation)->name, false); ?>)
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('sale.qty'); ?></th>
                        <td><?php echo e(number_format($stock_request->quantity, 2), false); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('project::lang.from_location'); ?></th>
                        <td><?php echo e(optional($stock_request->sourceLocation)->name ?? '-', false); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('sale.status'); ?></th>
                        <td><?php echo e(ucfirst($stock_request->status), false); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('project::lang.requested_by'); ?></th>
                        <td><?php echo e(optional($stock_request->requestedBy)->user_full_name ?? '-', false); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo app('translator')->get('messages.date'); ?></th>
                        <td><?php echo e(optional($stock_request->created_at)->format('Y-m-d H:i'), false); ?></td>
                    </tr>
                    <?php if($stock_request->status === 'approved'): ?>
                        <tr>
                            <th><?php echo app('translator')->get('messages.approve'); ?></th>
                            <td>
                                <?php echo e(optional($stock_request->approved_at)->format('Y-m-d H:i'), false); ?>

                                <?php if(optional($stock_request->approvedBy)->user_full_name): ?>
                                    <br><?php echo e(optional($stock_request->approvedBy)->user_full_name, false); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <th><?php echo app('translator')->get('lang_v1.additional_notes'); ?></th>
                        <td><?php echo e($stock_request->notes ?: '-', false); ?></td>
                    </tr>
                </tbody>
            </table>
            <p class="text-muted">
                <?php if($stock_request->status === 'pending'): ?>
                    This request is pending. No stock transfer has been created yet.
                <?php elseif($stock_request->status === 'approved'): ?>
                    This request is approved. The stock transfer will appear here after fulfillment.
                <?php else: ?>
                    No linked stock transfer was found for this request.
                <?php endif; ?>
            </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
    </div>
</div>
