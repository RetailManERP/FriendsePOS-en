

<?php $__env->startSection('title', __('rental::lang.rental_items')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('rental::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('rental.manage_rental_items')): ?>
                <a class="btn btn-block btn-primary" href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalItemController::class, 'create']), false); ?>">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                </a>
                <?php endif; ?>
            </div>
        <?php $__env->endSlot(); ?>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('filter_category', __('rental::lang.rental_category') . ':'); ?>

                    <?php echo Form::select('filter_category', ['' => __('rental::lang.all')] + $categories->toArray(), null, ['class' => 'form-control select2', 'id' => 'filter_category']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('filter_location', __('rental::lang.location') . ':'); ?>

                    <?php echo Form::select('filter_location', ['' => __('rental::lang.all')] + $business_locations->toArray(), null, ['class' => 'form-control select2', 'id' => 'filter_location']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('filter_available', __('rental::lang.available_items') . ':'); ?>

                    <?php echo Form::select('filter_available', ['' => __('rental::lang.all'), '1' => __('messages.yes'), '0' => __('messages.no')], null, ['class' => 'form-control select2', 'id' => 'filter_available']); ?>

                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="rental_items_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('rental::lang.name'); ?></th>
                        <th><?php echo app('translator')->get('rental::lang.rental_sku'); ?></th>
                        <th><?php echo app('translator')->get('rental::lang.rental_category'); ?></th>
                        <th><?php echo app('translator')->get('rental::lang.daily_rate'); ?></th>
                        <th><?php echo app('translator')->get('rental::lang.available_quantity'); ?></th>
                        <th><?php echo app('translator')->get('rental::lang.condition'); ?></th>
                        <th><?php echo app('translator')->get('rental::lang.location'); ?></th>
                        <th><?php echo app('translator')->get('messages.action'); ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function() {
    var rental_items_table = $('#rental_items_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?php echo e(action([\Modules\Rental\Http\Controllers\RentalItemController::class, "index"]), false); ?>',
            data: function(d) {
                d.category_id = $('#filter_category').val();
                d.location_id = $('#filter_location').val();
                d.is_available = $('#filter_available').val();
            }
        },
        columns: [
            { data: 'name', name: 'name' },
            { data: 'rental_sku', name: 'rental_sku' },
            { data: 'rental_category_id', name: 'rental_category_id' },
            { data: 'daily_rate', name: 'daily_rate' },
            { data: 'availability', name: 'available_quantity' },
            { data: 'condition', name: 'condition' },
            { data: 'location_id', name: 'location_id' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
    });

    $('#filter_category, #filter_location, #filter_available').change(function() {
        rental_items_table.ajax.reload();
    });

    $(document).on('click', '.delete-rental-item', function(e) {
        e.preventDefault();
        swal({
            title: LANG.sure,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(function(confirmed) {
            if (confirmed) {
                var href = $(e.target).closest('.delete-rental-item').data('href');
                $.ajax({
                    method: 'DELETE',
                    url: href,
                    dataType: 'json',
                    success: function(result) {
                        if (result.success) {
                            toastr.success(result.msg);
                            rental_items_table.ajax.reload();
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