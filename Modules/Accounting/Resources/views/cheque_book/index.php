

<?php $__env->startSection('title', __('accounting::lang.cheque_books')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('accounting::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('accounting::lang.cheque_book_management'); ?>
        <small><?php echo app('translator')->get('accounting::lang.manage_cheque_sequences'); ?></small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0" style="border-radius:12px;overflow:hidden;">
                <div class="card-header bg-white d-flex align-items-center justify-content-between py-2 px-3" style="border-bottom:1px solid #f0f0f0;">
                    <h6 class="mb-0 fw-bold" style="font-size:14px;"><i class="fas fa-book me-2 text-primary"></i><?php echo app('translator')->get('accounting::lang.cheque_books'); ?></h6>
                    <div>
                        <button type="button" class="btn btn-primary btn-sm" id="cheque_book_print_btn">
                            <i class="fa fa-print me-1"></i><?php echo app('translator')->get('messages.print'); ?> A4
                        </button>
                        <button class="btn btn-primary btn-sm btn-modal"
                            data-href="<?php echo e(action([\Modules\Accounting\Http\Controllers\ChequeBookController::class, 'create']), false); ?>"
                            data-container="#cheque_book_modal">
                            <i class="fas fa-plus me-1"></i><?php echo app('translator')->get('accounting::lang.add_cheque_book'); ?>
                        </button>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="cheque_books_table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('accounting::lang.cheque_book_no'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.bank_account'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.prefix'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.range'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.current_number'); ?></th>
                                    <th><?php echo app('translator')->get('accounting::lang.remaining_leaves'); ?></th>
                                    <th><?php echo app('translator')->get('sale.status'); ?></th>
                                    <th><?php echo app('translator')->get('messages.action'); ?></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="cheque_book_modal" tabindex="-1" role="dialog"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        var cheque_books_table = $('#cheque_books_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '<?php echo e(action([\Modules\Accounting\Http\Controllers\ChequeBookController::class, "index"]), false); ?>',
            columns: [
                { data: 'cheque_book_no', name: 'cheque_book_no' },
                { data: 'bank_account_name', name: 'accounting_accounts.name' },
                { data: 'prefix', name: 'prefix' },
                { data: 'start_number', name: 'start_number', render: function(data, type, row) {
                    return row.start_number + ' - ' + row.end_number;
                }},
                { data: 'current_number', name: 'current_number' },
                { data: 'remaining', name: 'remaining', orderable: false, searchable: false },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
        });

        $('#cheque_book_print_btn').on('click', function(e) {
            e.preventDefault();
            window.open("<?php echo e(route('cheque-book.print'), false); ?>?" + $.param({
                tab: 'all'
            }), '_blank');
        });

        $(document).on('submit', 'form#cheque_book_form', function(e) {
            e.preventDefault();
            var form = $(this);
            var data = form.serialize();

            $.ajax({
                method: form.attr('method') || 'POST',
                url: form.attr('action'),
                dataType: 'json',
                data: data,
                beforeSend: function(xhr) {
                    form.find('button[type="submit"]').attr('disabled', true);
                },
                success: function(result) {
                    if (result.success == true) {
                        $('div#cheque_book_modal').modal('hide');
                        toastr.success(result.msg);
                        cheque_books_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
                error: function(xhr) {
                    toastr.error('Something went wrong');
                },
                complete: function() {
                    form.find('button[type="submit"]').attr('disabled', false);
                }
            });
        });

        $(document).on('click', '.cancel-cheque-book', function(e) {
            e.preventDefault();
            var url = $(this).data('href');
            swal({
                title: LANG.sure,
                text: '<?php echo e(__("accounting::lang.cancel_cheque_book_confirm"), false); ?>',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((confirmed) => {
                if (confirmed) {
                    $.ajax({
                        method: 'DELETE',
                        url: url,
                        dataType: 'json',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.msg);
                                cheque_books_table.ajax.reload();
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