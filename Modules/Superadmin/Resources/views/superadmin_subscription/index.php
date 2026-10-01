
<?php $__env->startSection('title', 'Superadmin Subscription'); ?>

<?php $__env->startSection('css'); ?>
<style>
    .sub-stat-card {
        background: #fff; border-radius: .75rem; padding: 1.25rem;
        border: 1px solid #e2e8f0; text-align: center; transition: box-shadow .2s;
    }
    .sub-stat-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,.06); }
    .sub-stat-card .stat-icon { width: 42px; height: 42px; border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center; margin-bottom: .5rem; font-size: 1.1rem; }
    .sub-stat-card .stat-value { font-size: 1.5rem; font-weight: 700; color: #1e293b; display: block; }
    .sub-stat-card .stat-label { font-size: .78rem; color: #94a3b8; text-transform: uppercase; letter-spacing: .5px; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('superadmin::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'superadmin::lang.subscription' ); ?>
        <small><?php echo app('translator')->get( 'superadmin::lang.view_subscription' ); ?></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <?php echo $__env->make('superadmin::layouts.partials.currency', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <div class="row mb-3 g-3">
        <div class="col-md-3 col-sm-6">
            <div class="sub-stat-card">
                <div class="stat-icon" style="background:#eef2ff;color:#6366f1;"><i class="fas fa-file-invoice"></i></div>
                <span class="stat-value"><?php echo e(number_format($total_subscriptions), false); ?></span>
                <span class="stat-label"><?php echo app('translator')->get('superadmin::lang.total'); ?> <?php echo app('translator')->get('superadmin::lang.subscription'); ?></span>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="sub-stat-card">
                <div class="stat-icon" style="background:#ecfdf5;color:#059669;"><i class="fas fa-check-circle"></i></div>
                <span class="stat-value"><?php echo e(number_format($active_subscriptions), false); ?></span>
                <span class="stat-label"><?php echo app('translator')->get('superadmin::lang.active'); ?> <?php echo app('translator')->get('superadmin::lang.subscription'); ?></span>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="sub-stat-card">
                <div class="stat-icon" style="background:#fef3c7;color:#d97706;"><i class="fas fa-clock"></i></div>
                <span class="stat-value"><?php echo e(number_format($pending_approvals), false); ?></span>
                <span class="stat-label"><?php echo app('translator')->get('superadmin::lang.waiting'); ?></span>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="sub-stat-card">
                <div class="stat-icon" style="background:#ede9fe;color:#7c3aed;"><i class="fas fa-dollar-sign"></i></div>
                <span class="stat-value"><span class="display_currency" data-currency_symbol="true"><?php echo e($total_revenue, false); ?></span></span>
                <span class="stat-label"><?php echo app('translator')->get('superadmin::lang.total'); ?> <?php echo app('translator')->get('superadmin::lang.revenue'); ?></span>
            </div>
        </div>
    </div>
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('package_id',  __('superadmin::lang.packages') . ':'); ?>

                <?php echo Form::select('package_id', $packages, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('subscription_status',  __('superadmin::lang.status') . ':'); ?>

                <?php echo Form::select('subscription_status', $subscription_statuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?php echo Form::label('created_at', __('lang_v1.created_at') . ':'); ?>

                <?php echo Form::text('created_at', null, ['placeholder' => __('lang_v1.select_a_date_range'), 
                    'class' => 'form-control', 'readonly']); ?>

            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>
    <div class="box box-primary">  
        <div class="box-body">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin')): ?>
                <div class="table-responsive">
            	<table class="table table-bordered table-striped table-hover table-th-skin" id="superadmin_subscription_table">
            		<thead>
            			<tr>
                            <th><?php echo app('translator')->get( 'superadmin::lang.business_name' ); ?></th>
            				<th><?php echo app('translator')->get( 'superadmin::lang.package_name' ); ?></th>
                            <th><?php echo app('translator')->get( 'superadmin::lang.status' ); ?></th>
                            <th><?php echo app('translator')->get( 'lang_v1.created_at' ); ?></th>
                            <th><?php echo app('translator')->get( 'superadmin::lang.start_date' ); ?></th>
            				<th><?php echo app('translator')->get( 'superadmin::lang.trial_end_date' ); ?></th>
                            <th><?php echo app('translator')->get( 'superadmin::lang.end_date' ); ?></th>
                            <th><?php echo app('translator')->get( 'superadmin::lang.coupon_code' ); ?></th>
                            <th><?php echo app('translator')->get( 'superadmin::lang.original_price'); ?></th>
            				<th><?php echo app('translator')->get( 'superadmin::lang.paid_amount' ); ?></th>
                            <th><?php echo app('translator')->get( 'superadmin::lang.paid_via' ); ?></th>
            				<th><?php echo app('translator')->get( 'superadmin::lang.payment_transaction_id' ); ?></th>
                            <th><?php echo app('translator')->get( 'superadmin::lang.action' ); ?></th>
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
<?php $__env->startSection('modals'); ?>
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function(){

        $('#created_at').daterangepicker(
        dateRangeSettings,
            function (start, end) {
                $('#created_at').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                superadmin_subscription_table.ajax.reload();
            }
        );
        $('#created_at').on('cancel.daterangepicker', function(ev, picker) {
            $('#created_at').val('');
            superadmin_subscription_table.ajax.reload();
        });

        $('#package_id, #subscription_status').change( function(){
            superadmin_subscription_table.ajax.reload();
        });

        // superadmin_subscription_table
        var superadmin_subscription_table = $('#superadmin_subscription_table').DataTable({
                        processing: true,
                        serverSide: true,
                        scrollY: '75vh',
                        scrollX: true,
                        scrollCollapse: true,
                        ajax: {
                            url: '/superadmin/superadmin-subscription',
                            data: function(d) {
                                if ($('#package_id').length) {
                                    d.package_id = $('#package_id').val();
                                }
                                if ($('#subscription_status').length) {
                                    d.status = $('#subscription_status').val();
                                }

                                var start = '';
                                var end = '';
                                if ($('#created_at').val()) {
                                    start = $('input#created_at')
                                        .data('daterangepicker')
                                        .startDate.format('YYYY-MM-DD');
                                    end = $('input#created_at')
                                        .data('daterangepicker')
                                        .endDate.format('YYYY-MM-DD');
                                }
                                d.start_date = start;
                                d.end_date = end;

                                d = __datatable_ajax_callback(d);
                            },
                        },
                        columns: [
                            { data: 'business_name', name: 'business.name' },
                            { data: 'package_name', name: 'packages.name' },
                            { data: 'status', name: 'subscriptions.status' },
                            { data: 'created_at', name: 'subscriptions.created_at' },
                            { data: 'start_date', name: 'subscriptions.start_date' },
                            { data: 'trial_end_date', name: 'subscriptions.trial_end_date' },
                            { data: 'end_date', name: 'subscriptions.end_date' },
                            { data: 'coupon_code', name: 'subscriptions.coupon_code' },
                            { data: 'original_price', name: 'subscriptions.original_price' },
                            { data: 'package_price', name: 'subscriptions.package_price' },
                            { data: 'paid_via', name: 'subscriptions.paid_via' },
                            { data: 'payment_transaction_id', name: 'subscriptions.payment_transaction_id' },
                            { data: 'action', name: 'action', orderable: false, searchable: false },
                        ],
                        "fnDrawCallback": function (oSettings) {
                         __currency_convert_recursively($('#superadmin_subscription_table'), true);
                        }
                    });


        function hideStatusModal() {
            var modalEl = document.getElementById('statusModal');
            var $modal = $("div#statusModal");

            $modal.one('hidden.bs.modal', function() {
                $modal.empty();
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open').css({ overflow: '', paddingRight: '' });
            });

            if (window.bootstrap && modalEl) {
                var modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) {
                    modal.hide();
                    return;
                }
            }

            $modal.modal('hide');
        }

        // change_status button
        $(document).on('click', 'button.change_status', function(){
            $("div#statusModal").load($(this).data('href'), function(){
                var modalEl = this;

                if (window.bootstrap) {
                    bootstrap.Modal.getOrCreateInstance(modalEl).show();
                } else {
                    $(modalEl).modal('show');
                }

                $("form#status_change_form").off('submit').on('submit', function(e){
                    e.preventDefault();
                    var $form = $(this);
                    var url = $form.attr("action");
                    var data = $form.serialize();
                    $.ajax({
                        method: "POST",
                        dataType: "json",
                        data: data,
                        url: url,
                        success:function(result){
                            if( result.success == true){
                                hideStatusModal();
                                toastr.success(result.msg);
                                superadmin_subscription_table.ajax.reload(null, false);
                            }else{
                                toastr.error(result.msg);
                            }
                        },
                        error: function(){
                            toastr.error('<?php echo app('translator')->get("messages.something_went_wrong"); ?>');
                        }
                    });
                });
            });
        });

        $(document).on('shown.bs.modal', '.view_modal', function(){
            $('.edit-subscription-modal .datepicker').datepicker('remove').datepicker({
                autoclose: true,
                format: datepicker_date_format,
                container: '.edit-subscription-modal'
            });
            $("form#edit_subscription_form").submit(function(e){
              e.preventDefault();
              var url = $(this).attr("action");
              var data = $(this).serialize();
              $.ajax({
                  method: "POST",
                  dataType: "json",
                  data: data,
                  url: url,
                  success:function(result){
                      if( result.success == true){
                          $("div.view_modal").modal('hide');
                          toastr.success(result.msg);
                          superadmin_subscription_table.ajax.reload();
                      }else{
                          toastr.error(result.msg);
                      }
                  }
              });
            });
        });

    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>