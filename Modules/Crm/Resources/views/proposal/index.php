
<?php $__env->startSection('title', __('crm::lang.proposals')); ?>
<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('crm::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<!-- Content Header (Page header) -->
	<section class="content-header no-print">
	   <h1><?php echo app('translator')->get('crm::lang.proposals'); ?></h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
			<?php if(!empty($proposal_template) && auth()->user()->can('crm.access_proposal')): ?>
		        <?php $__env->slot('tool'); ?>
		            <div class="box-tools">
		                <a class="btn btn-primary float-end m-5" href="<?php echo e(action([\Modules\Crm\Http\Controllers\ProposalTemplateController::class, 'send']), false); ?>">
		                	<i class="fas fa-paper-plane"></i> <?php echo app('translator')->get('crm::lang.send'); ?>
		                </a>
		            </div>
		        <?php $__env->endSlot(); ?>
	        <?php endif; ?>
	        <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin" id="proposals" style="width: 100%;">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get( 'contact.contact' ); ?></th>
                            <th><?php echo app('translator')->get( 'crm::lang.subject' ); ?></th>
                            <th><?php echo app('translator')->get( 'crm::lang.sent_by' ); ?></th>
                            <th><?php echo app('translator')->get( 'receipt.date' ); ?></th>
                            <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
    	<?php echo $__env->renderComponent(); ?>
	</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready( function(){
            proposals_table = $('#proposals').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "<?php echo e(action([\Modules\Crm\Http\Controllers\ProposalController::class, 'index']), false); ?>"
                    },
                    columnDefs: [
                        {
                            targets: 4,
                            orderable: false,
                            searchable: false,
                        },
                    ],
                    aaSorting: [[3, 'desc']],
                    columns: [
                        { data: 'name', name: 'contacts.name'},
                        { data: 'subject', name: 'crm_proposals.subject'},
                        { data: 'sent_by_full_name', name: 'sent_by_full_name'},
                        { data: 'created_at', name: 'crm_proposals.created_at'},
                        { data: 'action', name: 'action' },
                    ]
            });

            $(document).on('click', 'a.delete_attachment', function (e) {
                e.preventDefault();
                var url = $(this).data('href');
                var this_btn = $(this);
                swal({
                    title: LANG.sure,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((confirmed) => {
                    if (confirmed) {
                        $.ajax({
                            method: 'DELETE',
                            url: url,
                            dataType: 'json',
                            success: function(result) {
                                if(result.success == true){
                                    this_btn.closest('tr').remove();
                                    toastr.success(result.msg);
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