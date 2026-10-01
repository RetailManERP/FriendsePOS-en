
<?php $__env->startSection('title',__('installment::lang.installment_plan')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('installment::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- <style>
        .table-striped th{
            background-color: #626161;
            color: #ffffff;
        }
    </style> -->
    <section class="content-header">
        <h1><?php echo app('translator')->get('installment::lang.installment_plan'); ?></h1>
    </section>

    <section class="content">
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' =>'']); ?>
            <?php
                $can_view_installment_system = auth()->user()->can('installment.system_view')
                    || auth()->user()->can('installment.system_add')
                    || auth()->user()->can('installment.system_edit')
                    || auth()->user()->can('installment.system_delete')
                    || auth()->user()->can('installment.view');
            ?>
            <?php if($can_view_installment_system): ?>
                <?php $__env->slot('tool'); ?>
                    <div class="box-tools">

                <?php if(auth()->user()->can('installment.system_add')): ?>
                            <button type="button" class="btn btn-block btn-primary add_button" >
                                <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></button>
                        <?php endif; ?>
                    </div>
                <?php $__env->endSlot(); ?>
            <?php endif; ?>
            <?php if($can_view_installment_system): ?>

                <div class="row mb-3 no-print">
                    <div class="col-md-12 text-right text-end">
                        <button type="button" class="btn btn-primary" id="installment_plans_print_active_tab">
                            <i class="fa fa-print"></i> Print A4 Current Tab
                        </button>
                        <button type="button" class="btn btn-default" id="installment_plans_print_all_tabs">
                            <i class="fa fa-print"></i> Print A4 All Tabs
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-th-skin" id="data_table">
                        <thead>
                        <tr>
                            <th>Installment Plan</th>
                            <th>Number of Installments</th>
                            <th>Payment Period </th>
                            <th>Type </th>
                            <th>Interest Rate</th>
                            <th>Interest Type </th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                    </table>
                </div>


            <?php endif; ?>
        <?php echo $__env->renderComponent(); ?>



    </section>

    <div class="modal fade div_modal" tabindex="-1" role="dialog"
         aria-labelledby="gridSystemModalLabel" style="z-index: 11000 !important;">
    </div>

    <style>
        .div_modal .modal-dialog {
            z-index: 11001 !important;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('javascript'); ?>
 <script type="text/javascript">
$(document).ready(function () {
    var data_table = $('#data_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '<?php echo e(url('/installment/plans'), false); ?>',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'number', name: 'number' },
            { data: 'period', name: 'period' },
            { data: 'type', name: 'type' },
            { data: 'benefit', name: 'benefit' },
            { data: 'benefit_type', name: 'benefit_type' },
            { data: 'description', name: 'description' },
            { data: 'action', name: 'action' },
        ],
        columnDefs: [
            {
                targets: 7,
                orderable: false,
                searchable: false,
            },
        ],
    });

    function get_installment_plans_print_params() {
        return {
            tab: 'plans',
            search: $('#data_table_filter input').length ? $('#data_table_filter input').val() : ''
        };
    }

    $(document).on('click', '#installment_plans_print_active_tab, #installment_plans_print_all_tabs', function () {
        window.open('<?php echo e(url('/installment/plans-print'), false); ?>?' + $.param(get_installment_plans_print_params()), '_blank');
    });

    $(document).on('click', 'button.delete_button', function () {
        swal({
            title: LANG.sure,
            text: 'This system will be deleted ',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                var href = $(this).data('href');
                var data = $(this).serialize();
                $.ajax({
                    method: 'DELETE',
                    url: href,
                    dataType: 'json',
                    data: data,
                    success: function (result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                            data_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });

    });

    $(document).on('click', 'button.edit_button', function () {
        $.ajax({
            method: 'GET',
            url: $(this).data('href'),
            dataType: 'html',
            success: function (result) {
                $(".div_modal").html(result).modal('show');
            },
        });

    });

    $(document).on('click', 'button.add_button', function () {
        $.ajax({
            method: 'GET',
            url: '<?php echo e(url('/installment/plans/create'), false); ?>',
            dataType: 'html',
            success: function (result) {
                $(".div_modal").html(result).modal('show');
                data_table.ajax.reload();
            },
        });

    });

    $(document).on('submit', 'form#add_installment_system', function(e) {
        e.preventDefault();
        var form = $(this);
        var data = form.serialize()
        $.ajax({
            method: 'POST',
            url: form.attr('action'),
            dataType: 'json',
            data: data,
            beforeSend: function (xhr) {
                __disable_submit_button(form.find('button[type="submit"]'));
            },
            success: function (result) {
                if (result.success == true) {
                    $('div.div_modal').modal('hide');
                    toastr.success(result.msg);
                    data_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $(document).on('submit', 'form#edit_installment_system', function(e) {
        e.preventDefault();
        var form = $(this);
        var data = form.serialize();

        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            beforeSend: function(xhr) {
                __disable_submit_button(form.find('button[type="submit"]'));
            },
            success: function(result) {
                if (result.success == true) {
                    $('div.div_modal').modal('hide');

                    toastr.success(result.msg);
                    data_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>