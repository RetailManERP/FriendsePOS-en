
<?php $__env->startSection('title', __('clinic::lang.patient_queue')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 >
            <i class="fas fa-list-ol me-2"></i><?php echo app('translator')->get('clinic::lang.queue_board'); ?>
        </h1>
    </section>

    <section class="content">
        <div class="row mb-4">
            <div class="col-md-12 d-flex justify-content-end gap-2">
                <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\QueueController::class, 'display']), false); ?>"
                   class="btn btn-info" target="_blank">
                    <i class="fas fa-tv me-1"></i><?php echo app('translator')->get('clinic::lang.queue_display'); ?>
                </a>
            </div>
        </div>

        
        <div class="row">
            <?php
                $departments = ['reception', 'vitals', 'consultation', 'pharmacy', 'lab', 'billing'];
                $deptColors = [
                    'reception' => 'border-primary',
                    'vitals' => 'border-warning',
                    'consultation' => 'border-success',
                    'pharmacy' => 'border-info',
                    'lab' => 'border-danger',
                    'billing' => 'border-secondary',
                ];
                $deptIcons = [
                    'reception' => 'fa-concierge-bell',
                    'vitals' => 'fa-heartbeat',
                    'consultation' => 'fa-stethoscope',
                    'pharmacy' => 'fa-pills',
                    'lab' => 'fa-flask',
                    'billing' => 'fa-cash-register',
                ];
            ?>
            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-2">
                    <?php $__env->startComponent('components.widget'); ?>
                        <h5 class="fw-bold text-center border-bottom border-2 <?php echo e($deptColors[$dept] ?? '', false); ?> pb-2 mb-3">
                            <i class="fas <?php echo e($deptIcons[$dept] ?? 'fa-circle', false); ?> me-1"></i>
                            <?php echo e(ucfirst(str_replace('_', ' ', $dept)), false); ?>

                            <span class="badge bg-secondary"><?php echo e(isset($queue_by_department[$dept]) ? $queue_by_department[$dept]->count() : 0, false); ?></span>
                        </h5>
                        <div class="queue-list" style="max-height: 500px; overflow-y: auto;">
                            <?php if(isset($queue_by_department[$dept])): ?>
                                <?php $__currentLoopData = $queue_by_department[$dept]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="border rounded p-3 mb-2 <?php echo e($q->status == 'in_service' ? 'bg-light-success' : 'bg-white', false); ?>">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fw-bold fs-5"><?php echo e($q->queue_number, false); ?></span>
                                            <?php if($q->priority == 'urgent' || $q->priority == 'emergency'): ?>
                                                <span class="badge bg-danger"><?php echo e(ucfirst($q->priority), false); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <p class="small mb-1"><?php echo e($q->patient->first_name ?? '', false); ?> <?php echo e($q->patient->last_name ?? '', false); ?></p>
                                        <p class="small text-muted mb-2">
                                            <?php if($q->doctor): ?> Dr. <?php echo e($q->doctor->first_name ?? '', false); ?> <?php echo e($q->doctor->last_name ?? '', false); ?> <?php endif; ?>
                                        </p>
                                        <div class="d-flex gap-1 flex-wrap">
                                            <?php if($q->status == 'waiting'): ?>
                                                <button class="btn btn-sm btn-success start-service" data-id="<?php echo e($q->id, false); ?>">
                                                    <i class="fas fa-play"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning skip-queue" data-id="<?php echo e($q->id, false); ?>">
                                                    <i class="fas fa-forward"></i>
                                                </button>
                                            <?php endif; ?>
                                            <div class="dropdown d-inline">
                                                <button class="btn btn-sm btn-info dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class="fas fa-arrow-right"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $moveDept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($moveDept != $dept): ?>
                                                            <li><a class="dropdown-item move-to" href="#"
                                                                   data-id="<?php echo e($q->id, false); ?>" data-dept="<?php echo e($moveDept, false); ?>">
                                                                <?php echo e(ucfirst(str_replace('_', ' ', $moveDept)), false); ?>

                                                            </a></li>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <p class="text-center text-muted small"><?php echo app('translator')->get('clinic::lang.no_data'); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php echo $__env->renderComponent(); ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        // Start service
        $(document).on('click', '.start-service', function() {
            var id = $(this).data('id');
            $.ajax({
                method: 'POST',
                url: "<?php echo e(url('clinic/queue'), false); ?>/" + id + "/start-service",
                data: { '_token': '<?php echo e(csrf_token(), false); ?>' },
                success: function(result) {
                    if (result.success) { toastr.success(result.msg); location.reload(); }
                    else { toastr.error(result.msg); }
                }
            });
        });

        // Skip queue
        $(document).on('click', '.skip-queue', function() {
            var id = $(this).data('id');
            $.ajax({
                method: 'POST',
                url: "<?php echo e(url('clinic/queue'), false); ?>/" + id + "/skip",
                data: { '_token': '<?php echo e(csrf_token(), false); ?>' },
                success: function(result) {
                    if (result.success) { toastr.success(result.msg); location.reload(); }
                    else { toastr.error(result.msg); }
                }
            });
        });

        // Move to department
        $(document).on('click', '.move-to', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var dept = $(this).data('dept');
            $.ajax({
                method: 'POST',
                url: "<?php echo e(url('clinic/queue'), false); ?>/" + id + "/move-to",
                data: { '_token': '<?php echo e(csrf_token(), false); ?>', 'department': dept },
                success: function(result) {
                    if (result.success) { toastr.success(result.msg); location.reload(); }
                    else { toastr.error(result.msg); }
                }
            });
        });

        // Auto-refresh every 30 seconds
        setInterval(function() { location.reload(); }, 30000);
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>