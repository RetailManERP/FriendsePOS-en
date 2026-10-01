

<?php $__env->startSection('title', __('rental::lang.maintenance')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('rental::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('rental.manage_maintenance')): ?>
                    <a class="btn btn-block btn-primary" href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalMaintenanceController::class, 'create']), false); ?>">
                        <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php $__env->endSlot(); ?>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('maint_type_filter', __('rental::lang.maintenance_type') . ':'); ?>

                    <?php echo Form::select('maint_type_filter', [
                        '' => __('messages.all'),
                        'routine' => __('rental::lang.maint_type_routine'),
                        'repair' => __('rental::lang.maint_type_repair'),
                        'inspection' => __('rental::lang.maint_type_inspection'),
                        'cleaning' => __('rental::lang.maint_type_cleaning'),
                        'replacement' => __('rental::lang.maint_type_replacement'),
                    ], null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('maint_status_filter', __('rental::lang.status') . ':'); ?>

                    <?php echo Form::select('maint_status_filter', [
                        '' => __('messages.all'),
                        'scheduled' => __('rental::lang.scheduled'),
                        'in_progress' => __('rental::lang.in_progress'),
                        'completed' => __('rental::lang.maintenance_completed'),
                        'cancelled' => __('rental::lang.cancelled'),
                    ], null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('maint_priority_filter', __('rental::lang.priority') . ':'); ?>

                    <?php echo Form::select('maint_priority_filter', [
                        '' => __('messages.all'),
                        'low' => __('rental::lang.priority_low'),
                        'normal' => __('rental::lang.priority_normal'),
                        'high' => __('rental::lang.priority_high'),
                        'urgent' => __('rental::lang.priority_urgent'),
                    ], null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped" id="maintenance_table">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('rental::lang.item'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.maintenance_type'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.priority'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.status'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.scheduled_date'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.cost'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.assigned_to'); ?></th>
                    <th><?php echo app('translator')->get('messages.action'); ?></th>
                </tr>
            </thead>
        </table>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        var maint_table = $('#maintenance_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?php echo e(action([\Modules\Rental\Http\Controllers\RentalMaintenanceController::class, "index"]), false); ?>',
                data: function(d) {
                    d.type = $('#maint_type_filter').val();
                    d.status = $('#maint_status_filter').val();
                    d.priority = $('#maint_priority_filter').val();
                }
            },
            columns: [
                { data: 'item_name', name: 'rental_maintenance_logs.rental_item_id' },
                { data: 'maintenance_type', name: 'maintenance_type' },
                { data: 'priority', name: 'priority' },
                { data: 'status', name: 'status' },
                { data: 'scheduled_date', name: 'scheduled_date' },
                { data: 'cost', name: 'cost' },
                { data: 'assigned_to_name', name: 'rental_maintenance_logs.assigned_to' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        $('#maint_type_filter, #maint_status_filter, #maint_priority_filter').change(function() {
            maint_table.ajax.reload();
        });

        $(document).on('click', '.delete-maintenance', function(e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        method: 'DELETE',
                        url: $(this).data('href'),
                        dataType: 'json',
                        success: function(result) {
                            if (result.success) {
                                toastr.success(result.msg);
                                maint_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
            });
        });

        $(document).on('click', '.complete-maintenance', function(e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                text: '<?php echo e(__("rental::lang.complete_maintenance_confirm"), false); ?>',
                icon: 'info',
                buttons: true,
            }).then((willComplete) => {
                if (willComplete) {
                    $.ajax({
                        method: 'POST',
                        url: $(this).data('href'),
                        dataType: 'json',
                        success: function(result) {
                            if (result.success) {
                                toastr.success(result.msg);
                                maint_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>