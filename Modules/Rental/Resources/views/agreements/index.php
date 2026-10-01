

<?php $__env->startSection('title', __('rental::lang.rental_agreements')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('rental::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('rental.manage_agreements')): ?>
                    <a class="btn btn-block btn-primary" href="<?php echo e(action([\Modules\Rental\Http\Controllers\RentalAgreementController::class, 'create']), false); ?>">
                        <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php $__env->endSlot(); ?>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('agreement_status_filter', __('rental::lang.status') . ':'); ?>

                    <?php echo Form::select('agreement_status_filter', ['' => __('messages.all')] + $statuses, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('agreement_location_filter', __('purchase.business_location') . ':'); ?>

                    <?php echo Form::select('agreement_location_filter', $locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('agreement_date_range', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('agreement_date_range', null, ['class' => 'form-control daterange', 'placeholder' => __('lang_v1.select_a_date_range'), 'readonly']); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <?php echo Form::label('agreement_payment_status_filter', __('rental::lang.payment_status') . ':'); ?>

                    <?php echo Form::select('agreement_payment_status_filter', ['' => __('messages.all'), 'unpaid' => __('rental::lang.unpaid'), 'partial' => __('rental::lang.partial'), 'paid' => __('rental::lang.paid')], null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped" id="rental_agreements_table">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('rental::lang.agreement_no'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.customer'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.location'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.rental_period'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.total_amount'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.balance_due'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.status'); ?></th>
                    <th><?php echo app('translator')->get('rental::lang.payment_status'); ?></th>
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
        var agreements_table = $('#rental_agreements_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?php echo e(action([\Modules\Rental\Http\Controllers\RentalAgreementController::class, "index"]), false); ?>',
                data: function(d) {
                    d.status = $('#agreement_status_filter').val();
                    d.location_id = $('#agreement_location_filter').val();
                    d.date_range = $('#agreement_date_range').val();
                    d.payment_status = $('#agreement_payment_status_filter').val();
                }
            },
            columns: [
                { data: 'agreement_no', name: 'agreement_no' },
                { data: 'customer', name: 'contact_id' },
                { data: 'location', name: 'location_id' },
                { data: 'rental_period', name: 'rental_start' },
                { data: 'total_amount', name: 'total_amount' },
                { data: 'balance_due', name: 'balance_due' },
                { data: 'status', name: 'status' },
                { data: 'payment_status', name: 'payment_status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        $('#agreement_status_filter, #agreement_location_filter, #agreement_payment_status_filter').change(function() {
            agreements_table.ajax.reload();
        });

        $('#agreement_date_range').on('cancel.daterangepicker', function() {
            $(this).val('');
            agreements_table.ajax.reload();
        });
        $('#agreement_date_range').on('apply.daterangepicker', function() {
            agreements_table.ajax.reload();
        });

        $(document).on('click', '.delete_agreement', function(e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var href = $(this).data('href');
                    $.ajax({
                        method: 'DELETE',
                        url: href,
                        dataType: 'json',
                        success: function(result) {
                            if (result.success) {
                                toastr.success(result.msg);
                                agreements_table.ajax.reload();
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