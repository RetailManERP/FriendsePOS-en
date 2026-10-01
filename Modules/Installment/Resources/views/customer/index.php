
<?php $__env->startSection('title',__('installment::lang.customer_instalment')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('installment::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('installment::layouts.partials.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="content-header">
        <h1><?php echo app('translator')->get('installment::lang.customer_instalment'); ?></h1>
    </section>

    <?php echo csrf_field(); ?>
    <section class="content no-print">
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' =>'']); ?>
            <?php
                $can_view_installment_customers = auth()->user()->can('installment.view_customers')
                    || auth()->user()->can('installment.view');
            ?>
            <?php if($can_view_installment_customers): ?>


            <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('customer_id',__('installment::lang.customers') .' : '); ?>

                                <?php echo Form::select('customer_id', $customers, null, ['class' => 'form-control select2','id'=>'customer_id', 'style' => 'width:100%']); ?>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('balance_due',' Balance Due:'); ?>

                                <input type="balance_due" name='balance_due' id="balance_due" value="00.00" class="form-control text-disabled" readonly>
                            </div>
                        </div>


                    </div>



            <?php endif; ?>

           

            <?php if($can_view_installment_customers): ?>
                <div class="row mb-3 no-print">
                    <div class="col-md-12 text-end">
                        <button type="button" class="btn btn-primary" id="installment_customer_print_active_tab">
                            <i class="fa fa-print"></i> Print A4 Current Tab
                        </button>
                        <button type="button" class="btn btn-default" id="installment_customer_print_all_tabs">
                            <i class="fa fa-print"></i> Print A4 All Tabs
                        </button>
                    </div>
                </div>
            <?php endif; ?>

        <div class="view-div">
            <?php if($can_view_installment_customers): ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-th-skin" id="data_table2">
                        <thead>
                        <tr>
                            <th style="width: 140px">Installment start date</th>
                            <th style="width: 140px">Total amount</th>
                            <th>Installment value</th>
                            <th style="width: 100px">Number of installments</th>

                            <th>Number of installments Paid</th>
                            <th style="width: 150px"><?php echo app('translator')->get('messages.action'); ?></th>


                        </tr>
                        </thead>

                    </table>
                </div>


            <?php endif; ?>
        </div>



        <?php echo $__env->renderComponent(); ?>



    </section>

    <div class="modal fade div_modal" tabindex="-1" role="dialog"
         aria-labelledby="gridSystemModalLabel">
    </div>

    <section class="invoice print_section" id="installment_section">
    </section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('javascript'); ?>
 
 <?php echo $__env->make('installment::layouts.partials.javascripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<script type="text/javascript">
$(document).ready(function () {

    data_table2 = $('#data_table2').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url:'<?php echo e(url('/installment/getinstallment'), false); ?>',
            data:function(d) {
                d.id= $('#customer_id').val();
            }
        },
        columns: [
            { data: 'installmentdate', name: 'installmentdate' },
            { data: 'total', name: 'total' },
            { data: 'dd', name: 'dd' },
            { data: 'number', name: 'number' },
            { data: 'paidnumber', name: 'paidnumber' },
            { data: 'action', name: 'action' },
        ],
        columnDefs: [
            {
                targets:5,
                orderable: false,
                searchable: false,
            },
        ],
    });

    function get_installment_customer_print_params() {
        return {
            tab: 'plans',
            id: $('#customer_id').val()
        };
    }

    $(document).on('click', '#installment_customer_print_active_tab, #installment_customer_print_all_tabs', function() {
        window.open('<?php echo e(url('/installment/customer-print'), false); ?>?' + $.param(get_installment_customer_print_params()), '_blank');
    });

    $('#customer_id').on('change',function () {
        var customer_id = $('#customer_id').val();

        if (!customer_id) {
            $('#balance_due').val('00.00');
            data_table2.ajax.reload();
            return;
        }

        $.ajax({
            method: 'GET',
            url: '<?php echo e(url('/installment/getcustomerdata'), false); ?>/' + customer_id,
            data: {
                id: customer_id
            },
            success: function (result) {
                $('#balance_due').val(result['balance_due'].toFixed(2));
            }
        });
        data_table2.ajax.reload();

    });

});





$(document).on('click', 'button.delete_installment_button', function () {
    swal({
        title: LANG.sure,
        text: 'The installment group will be deleted ',
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
                        data_table2.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });
        }
    });

});



</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>