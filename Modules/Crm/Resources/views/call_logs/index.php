

<?php $__env->startSection('title', __('crm::lang.call_log')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('crm::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header no-print">
   <h1><?php echo app('translator')->get('crm::lang.call_log'); ?></h1>
</section>

<section class="content no-print">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('contact_id', __('contact.contact') . ':'); ?>

                    <?php echo Form::select('contact_id', $contacts, null, ['class' => 'form-control select2', 'id' => 'contact_id', 'placeholder' => __('messages.all')]); ?>

                </div>    
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crm.view_all_call_log')): ?>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('user_id', __('crm::lang.call_log_created_by') . ':'); ?>

                        <?php echo Form::select('user_id', $users, null, ['class' => 'form-control select2', 'id' => 'user_id', 'placeholder' => __('messages.all')]); ?>

                    </div>    
                </div>
            <?php endif; ?>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('call_log_date_range', __('report.date_range') . ':'); ?>

                    <?php echo Form::text('call_log_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

	<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="call_logs_table" style="width: 100%;">
            <thead>
                <tr>
                    <?php if($is_admin): ?>
                        <th><input type="checkbox" id="select-all-row" data-table-id="call_logs_table"></th>
                    <?php endif; ?>
                    <th><?php echo app('translator')->get('restaurant.start_time'); ?></th>
                    <th><?php echo app('translator')->get('restaurant.end_time'); ?></th>
                    <th><?php echo app('translator')->get('crm::lang.call_duration'); ?></th>
                    <th><?php echo app('translator')->get('crm::lang.call_type'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.contact_no'); ?></th>
                    <th><?php echo app('translator')->get('report.contact'); ?></th>
                    <th><?php echo app('translator')->get('role.user'); ?></th>
                    <th><?php echo app('translator')->get('crm::lang.call_log_created_by'); ?></th>
                </tr>
            </thead>
            <?php if($is_admin): ?>
            <tfoot>
                <tr>
                    <td colspan="9">
                    <div style="display: flex; width: 100%;">
                        <?php echo Form::open(['url' => action([\Modules\Crm\Http\Controllers\CallLogController::class, 'massDestroy']), 'method' => 'post', 'id' => 'mass_delete_form' ]); ?>

                        <?php echo Form::hidden('selected_rows', null, ['id' => 'selected_rows']); ?>

                        <?php echo Form::submit(__('lang_v1.delete_selected'), array('class' => 'btn btn-xs btn-danger', 'id' => 'delete-selected')); ?>

                        <?php echo Form::close(); ?>

                    </div>
                    </td>
                </tr>
            </tfoot>
            <?php endif; ?>
        </table>
</div>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function(){

            $('#call_log_date_range').daterangepicker(
                dateRangeSettings,
                function (start, end) {
                    $('#call_log_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                    call_logs_table.ajax.reload();
                }
            );
            $('#call_log_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $('#call_log_date_range').val('');
                call_logs_table.ajax.reload();
            });

            call_logs_table = 
            $("#call_logs_table").DataTable({
                <?php if($is_admin): ?>
                    aaSorting: [[1, 'desc']],
                <?php endif; ?>
                processing: true,
                serverSide: true,
                scrollY: "75vh",
                scrollX: true,
                scrollCollapse: true,
                fixedHeader: false,
                'ajax': {
                    url: "<?php echo e(action([\Modules\Crm\Http\Controllers\CallLogController::class, 'index']), false); ?>",
                    data: function(d){
                        d.contact_id = $('#contact_id').val();
                        d.user_id = $('#user_id').val();

                        if ($('#call_log_date_range').val()) {
                            d.start_time = $('#call_log_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                            d.end_time = $('#call_log_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                        }
                    }
                },
                columns: [
                    <?php if($is_admin): ?>
                        { data: 'mass_delete',searchable: false, orderable: false  },
                    <?php endif; ?>
                    { data: 'start_time', name: 'start_time' },
                    { data: 'end_time', name: 'end_time' },
                    { data: 'duration', name: 'duration' },
                    { data: 'call_type', name: 'call_type' },
                    { data: 'contact_number', name: 'contact_number' },
                    { data: 'contact_name', name: 'contact_name' },
                    { data: 'user_full_name', name: 'user_full_name' },
                    { data: 'created_user_name', name: 'created_user_name'}
                ],
                createdRow: function( row, data, dataIndex ) {
                    $( row ).find('td:eq(0)').attr('class', 'selectable_td');
                }
            });

            $(document).on('change', '#contact_id, #user_id', function(e){
                call_logs_table.ajax.reload();
            })
        });

        $(document).on('click', '#delete-selected', function(e){
            e.preventDefault();
            var selected_rows = getSelectedRows();
            
            if(selected_rows.length > 0){
                $('input#selected_rows').val(selected_rows);
                swal({
                    title: LANG.sure,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $('form#mass_delete_form').submit();
                    }
                });
            } else{
                $('input#selected_rows').val('');
                swal('<?php echo app('translator')->get("lang_v1.no_row_selected"); ?>');
            }    
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>