
<?php $__env->startSection('title', __('superadmin::lang.superadmin') . ' | Business'); ?>

<?php $__env->startSection('css'); ?>
<style>
    #superadmin_business_table_wrapper .dataTables_scroll,
    #superadmin_business_table_wrapper {
        overflow-x: auto;
        width: 100%;
    }
    #superadmin_business_table_wrapper .dataTables_scrollBody {
        overflow-x: auto !important;
    }
    .box-body > .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    .biz-stat-card {
        background: #fff; border: 1px solid #e2e8f0; border-radius: .75rem;
        padding: 1rem 1.25rem; display: flex; align-items: center; gap: .75rem;
        height: 100%;
    }
    .biz-stat-icon {
        width: 42px; height: 42px; border-radius: .5rem;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem; flex-shrink: 0;
    }
    .biz-stat-icon.green { background: #ecfdf5; color: #059669; }
    .biz-stat-icon.red { background: #fef2f2; color: #dc2626; }
    .biz-stat-icon.blue { background: #eef2ff; color: #6366f1; }
    .biz-stat-icon.amber { background: #fffbeb; color: #d97706; }
    .biz-stat-body h5 { font-size: 1.25rem; font-weight: 700; color: #1e293b; margin: 0; }
    .biz-stat-body p { font-size: .78rem; color: #64748b; margin: 0; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('superadmin::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'superadmin::lang.all_business' ); ?>
        <small><?php echo app('translator')->get( 'superadmin::lang.manage_business' ); ?></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('package_id',  __('superadmin::lang.packages') . ':'); ?>

                <?php echo Form::select('package_id', $packages, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('subscription_status',  __('superadmin::lang.subscription_status') . ':'); ?>

                <?php echo Form::select('subscription_status', $subscription_statuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('is_active',  __('sale.status') . ':'); ?>

                <?php echo Form::select('is_active', ['active' => __('business.is_active'), 'inactive' => __('lang_v1.inactive')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('last_transaction_date',  __('superadmin::lang.last_transaction_date') . ':'); ?>

                <?php echo Form::select('last_transaction_date', $last_transaction_date, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('messages.please_select')]); ?>

            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('no_transaction_since',  __('superadmin::lang.no_transaction_since') . ':'); ?>

                <?php echo Form::select('no_transaction_since', $last_transaction_date, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('messages.please_select')]); ?>

            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

	<div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">&nbsp;</h3>
        	<div class="box-tools">
                <button type="button" class="btn btn-success me-2" id="export_businesses" title="<?php echo app('translator')->get('superadmin::lang.export_csv'); ?>">
                    <i class="fas fa-file-csv"></i> <?php echo app('translator')->get('superadmin::lang.export_csv'); ?>
                </button>
                <?php if(config('app.env') != 'demo'): ?>
                    <a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\BusinessController::class, 'create']), false); ?>"
                        class="btn btn-block btn-primary">
                        <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="box-body">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin')): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-th-skin" id="superadmin_business_table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get( 'superadmin::lang.action' ); ?></th>
                                <th><?php echo app('translator')->get( 'superadmin::lang.business_id' ); ?></th>
                                <th>
                                    <?php echo app('translator')->get('superadmin::lang.registered_on'); ?>
                                </th>
                                <th><?php echo app('translator')->get('superadmin::lang.last_transaction'); ?></th>
                                <th><?php echo app('translator')->get( 'superadmin::lang.business_name' ); ?></th>
                                <th><?php echo app('translator')->get('business.owner'); ?></th>
                                <th><?php echo app('translator')->get('business.email'); ?></th>
                                <th><?php echo app('translator')->get('superadmin::lang.owner_number'); ?></th>
                                <th><?php echo app('translator')->get( 'superadmin::lang.business_contact_number' ); ?></th>
                                <th><?php echo app('translator')->get('business.address'); ?></th>
                                <th><?php echo app('translator')->get( 'sale.status' ); ?></th>
                                <th><?php echo app('translator')->get( 'superadmin::lang.current_subscription' ); ?></th>
                                <th><?php echo app('translator')->get( 'business.created_by' ); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

<script type="text/javascript">
    $(document).ready( function(){
        superadmin_business_table = $('#superadmin_business_table').DataTable({
            processing: true,
            serverSide: true,
            scrollX: true,
            ajax: {
                url: "<?php echo e(action([\Modules\Superadmin\Http\Controllers\BusinessController::class, 'index']), false); ?>",
                data: function(d) {
                    d.package_id = $('#package_id').val();
                    d.subscription_status = $('#subscription_status').val();
                    d.is_active = $('#is_active').val();
                    d.last_transaction_date = $('#last_transaction_date').val();
                    d.no_transaction_since = $('#no_transaction_since').val();
                },
            },
            aaSorting: [[1, 'asc']],
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'id', name: 'business.id' },    
                { data: 'created_at', name: 'business.created_at' },
                { data: 'last_transaction_at', name: 'last_transaction_at', searchable: false },
                { data: 'name', name: 'business.name' },
                { data: 'owner_name', name: 'owner_name', searchable: false},
                { data: 'owner_email', name: 'u.email' },
                { data: 'contact_number', name: 'u.contact_number' },
                { data: 'business_contact_number', name: 'business_contact_number' },
                { data: 'address', name: 'address' },
                { data: 'is_active', name: 'is_active', searchable: false },
                { data: 'current_subscription', name: 'p.name' },
                { data: 'biz_creator', name: 'biz_creator', searchable: false },
            ]
        });

        $('#package_id, #subscription_status, #is_active, #last_transaction_date, #no_transaction_since').change( function(){
            superadmin_business_table.ajax.reload();
        });

        // Export CSV button
        $(document).on('click', '#export_businesses', function(){
            var params = $.param({
                package_id: $('#package_id').val(),
                subscription_status: $('#subscription_status').val(),
                is_active: $('#is_active').val(),
                last_transaction_date: $('#last_transaction_date').val(),
                no_transaction_since: $('#no_transaction_since').val(),
                export_csv: 1
            });
            window.location.href = "<?php echo e(action([\Modules\Superadmin\Http\Controllers\BusinessController::class, 'index']), false); ?>" + '?' + params;
        });
    });
    $(document).on('click', 'a.delete_business_confirmation', function(e){
        e.preventDefault();
        swal({
            title: LANG.sure,
            text: "Once deleted, you will not be able to recover this business!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((confirmed) => {
            if (confirmed) {
                window.location.href = $(this).attr('href');
            }
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>