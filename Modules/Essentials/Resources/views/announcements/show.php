<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"><i class="fas fa-bullhorn"></i> <?php echo e($announcement->title, false); ?></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-condensed">
                        <tr>
                            <th style="width: 150px;"><?php echo app('translator')->get('essentials::lang.period'); ?>:</th>
                            <td><?php echo e(\Carbon::createFromTimestamp(strtotime($announcement->start_date))->format(session('business.date_format')), false); ?> - <?php echo e(\Carbon::createFromTimestamp(strtotime($announcement->end_date))->format(session('business.date_format')), false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('essentials::lang.location'); ?>:</th>
                            <td><?php echo e($announcement->location ? $announcement->location->name : __('essentials::lang.all_locations'), false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('essentials::lang.department'); ?>:</th>
                            <td><?php echo e($announcement->department ? $announcement->department->name : __('essentials::lang.all_departments'), false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('essentials::lang.created_by'); ?>:</th>
                            <td><?php echo e($announcement->creator->user_full_name ?? '', false); ?></td>
                        </tr>
                        <tr>
                            <th><?php echo app('translator')->get('essentials::lang.status'); ?>:</th>
                            <td>
                                <span class="badge bg-<?php echo e($announcement->status == 'active' ? 'success' : 'secondary', false); ?>">
                                    <?php echo e(ucfirst($announcement->status), false); ?>

                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="well" style="white-space: pre-wrap;"><?php echo e($announcement->description, false); ?></div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
    </div>
</div>
