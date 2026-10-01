
<?php $__env->startSection('title', __('hms::lang.housekeeping')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('hms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1><?php echo app('translator')->get('hms::lang.housekeeping'); ?>
        </h1>
        <p><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('hms::lang.housekeeping_overview'); ?></p>
    </section>

    <section class="content">
        
        <div class="row mb-4">
            <div class="col-md-3 col-sm-6">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="text-center">
                        <h3 class="fw-bold text-success"><?php echo e($status_counts['available'], false); ?></h3>
                        <p class="text-muted"><i class="fa fa-check-circle text-success"></i> <?php echo app('translator')->get('hms::lang.room_status_available'); ?></p>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-3 col-sm-6">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="text-center">
                        <h3 class="fw-bold text-danger"><?php echo e($status_counts['occupied'], false); ?></h3>
                        <p class="text-muted"><i class="fa fa-user text-danger"></i> <?php echo app('translator')->get('hms::lang.room_status_occupied'); ?></p>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-3 col-sm-6">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="text-center">
                        <h3 class="fw-bold text-warning"><?php echo e($status_counts['maintenance'], false); ?></h3>
                        <p class="text-muted"><i class="fa fa-wrench text-warning"></i> <?php echo app('translator')->get('hms::lang.room_status_maintenance'); ?></p>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <div class="col-md-3 col-sm-6">
                <?php $__env->startComponent('components.widget'); ?>
                    <div class="text-center">
                        <h3 class="fw-bold text-primary"><?php echo e($status_counts['cleaning'], false); ?></h3>
                        <p class="text-muted"><i class="fa fa-broom text-primary"></i> <?php echo app('translator')->get('hms::lang.room_status_cleaning'); ?></p>
                    </div>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>

        
        <?php $__currentLoopData = $room_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__env->startComponent('components.widget', ['title' => $type->type]); ?>
                <div class="row">
                    <?php $__currentLoopData = $type->rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $statusColor = match($room->status ?? 'available') {
                                'available' => 'bg-light-success border-success',
                                'occupied' => 'bg-light-danger border-danger',
                                'maintenance' => 'bg-light-warning border-warning',
                                'cleaning' => 'bg-light-info border-info',
                                default => 'bg-light border-secondary',
                            };
                            $statusIcon = match($room->status ?? 'available') {
                                'available' => 'fa-check-circle text-success',
                                'occupied' => 'fa-user text-danger',
                                'maintenance' => 'fa-wrench text-warning',
                                'cleaning' => 'fa-broom text-primary',
                                default => 'fa-question-circle text-secondary',
                            };
                        ?>
                        <div class="col-md-2 col-sm-3 col-xs-4 mb-3">
                            <div class="border rounded p-3 <?php echo e($statusColor, false); ?> text-center">
                                <div class="fs-5 fw-bold">
                                    <i class="fa <?php echo e($statusIcon, false); ?>"></i>
                                    <?php echo e($room->room_number, false); ?>

                                </div>
                                <div class="small text-muted mt-1">
                                    <?php echo e(ucfirst($room->status ?? 'available'), false); ?>

                                </div>
                                <div class="mt-2">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-xs btn-success update-room-status" data-room-id="<?php echo e($room->id, false); ?>" data-status="available" title="<?php echo app('translator')->get('hms::lang.mark_as_clean'); ?>">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-info update-room-status" data-room-id="<?php echo e($room->id, false); ?>" data-status="cleaning" title="<?php echo app('translator')->get('hms::lang.mark_as_dirty'); ?>">
                                            <i class="fa fa-broom"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-warning update-room-status" data-room-id="<?php echo e($room->id, false); ?>" data-status="maintenance" title="<?php echo app('translator')->get('hms::lang.mark_as_maintenance'); ?>">
                                            <i class="fa fa-wrench"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php echo $__env->renderComponent(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.update-room-status', function() {
                var room_id = $(this).data('room-id');
                var status = $(this).data('status');

                $.ajax({
                    method: 'POST',
                    url: '<?php echo e(action([\Modules\Hms\Http\Controllers\HousekeepingController::class, "updateStatus"]), false); ?>',
                    data: {
                        room_id: room_id,
                        status: status,
                        _token: '<?php echo e(csrf_token(), false); ?>'
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.success) {
                            toastr.success(result.msg);
                            location.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                    error: function() {
                        toastr.error("<?php echo e(__('messages.something_went_wrong'), false); ?>");
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>