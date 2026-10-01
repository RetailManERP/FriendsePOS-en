

<?php $__env->startSection('title', __('essentials::lang.memos')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('essentials::layouts.nav_essentials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content-header">
	<h1><?php echo app('translator')->get('essentials::lang.all_memos'); ?>
	</h1>
</section>
<section class="content">
	<?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('essentials::lang.all_memos')]); ?>
		<?php $__env->slot('tool'); ?>
			<div class="box-tools">
				<button type="button" class="btn btn-sm btn-primary add_memo">
					<i class="fa fa-plus"></i> 
					<?php echo app('translator')->get( 'messages.add' ); ?>
				</button>
			</div>
		<?php $__env->endSlot(); ?>
				<div class="row">
					<div class="col-md-12">
						<?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\DocumentController::class, 'store']), 'id' => 'upload_document_form','files' => true, 'style' => 'display:none']); ?>

						<div class="row">
                            <div class="col-sm-12">
	                            <div class="col-sm-6">
	                                <div class="form-group">
                                   		<?php echo Form::label('name', __('essentials::lang.heading') . ":*"); ?>


                                   		<?php echo Form::text('name', null, ['class' => 'form-control', 'required']); ?>

	                                 </div>
	                            </div>
	                            <div class="clearfix"></div>
	                            <div class="col-sm-6">
	                                <div class="form-group">
	                                    <?php echo Form::label('description', __('essentials::lang.description') . ":"); ?>

	                                    <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50']); ?>

	                                 </div>
	                            </div>
	                            <div class="clearfix"></div>
                        		<div class="col-sm-4">
                                	<button type="submit" class="btn btn-primary btn-sm">
                                		<?php echo app('translator')->get('essentials::lang.submit'); ?>
                                	</button>
                                	&nbsp;
									<button type="button" class="btn btn-danger btn-sm cancel_btn">
										<?php echo app('translator')->get('essentials::lang.cancel'); ?>
									</button>
                        		</div>
                            </div>
                        </div>
                        <br><hr>
					<?php echo Form::close(); ?>

					</div>

				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive" style="min-height: 80vh">
					<table class="table table-bordered table-striped table-hover documents table-th-skin">
						<thead>
							<tr>
								<th> <?php echo app('translator')->get('essentials::lang.heading'); ?></th>
								<th> <?php echo app('translator')->get('essentials::lang.description'); ?></th>
								<th> <?php echo app('translator')->get('essentials::lang.created_at'); ?></th>
								<th> <?php echo app('translator')->get('essentials::lang.action'); ?></th>
							</tr>
						</thead>
					</table>
				</div>
					</div>
				</div>
			</div>
	<?php echo $__env->renderComponent(); ?>
	</section>
	<!-- document share model -->
	<div class="modal fade document" id="documentShareModal" tabindex="-1" role="dialog" aria-labelledby="documentShareModalLabel" aria-hidden="true"></div>
	<!-- memos view model -->
	<div class="modal fade memos" id="memosViewModal" tabindex="-1" role="dialog" aria-labelledby="memosViewModalLabel" aria-hidden="true"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		//dataTable(memos)
		var documents = $(".documents").DataTable({
			processing: true,
			ajax: "/essentials/document"+'?type=memos',
			columns: [
						{data: "name", name:"documents.name"},
						{data: "description", name:"documents.description"},
						{data: "created_at", name:"documents.created_at"},
						{data: "action", name:"action", "orderable": false},
					]
		});

		//destroy a document
		$(document).on('click', '.delete_doc', function(){
			url = $(this).data("href");
			swal({
		      title: LANG.sure,
		      icon: "warning",
		      buttons: true,
		      dangerMode: true,
		    }).then((confirmed) => {
		        if (confirmed) {
		        $.ajax({
					method: "DELETE",
					url: url,
					dataType: "json",
					success: function(result)
					{
						if(result.success == true)
						{
							toastr.success(result.msg);
	                        documents.ajax.reload();
						} else {
							toastr.error(result.msg);
						}
					}
				});
			    }
		    });
		});

		//opening share_doc model
		$(document).on('click', '.share_doc', function(){
			var url = $(this).data('href')+'?type=memos';
			$.ajax({
				method: "GET",
				dataType: "html",
				url: url,
				success: function(result){
					$(".document").html(result).modal("show");
				}
			});
		});

		//sharing document(save in DB)
		$(document).on('submit', 'form#share_document_form', function(e){
			e.preventDefault();
			var url = $(this).attr("action");
			var data = $("form#share_document_form").serialize();
			$.ajax({
				method: "PUT",
				url: url,
				dataType: "json",
				data: data,
				success:function(result){
					if(result.success == true){
						$(".document").html(result).modal("hide");
						toastr.success(result.msg);
					} else {
						toastr.error(result.msg);
					}
				}
			});
		});

		//opening memos view model
		$(document).on('click', '.view_memos', function(){
			var url = $(this).data('href')+'?type=memos';
			$.ajax({
				method: "GET",
				dataType: "html",
				url: url,
				success: function(result){
					$(".memos").html(result).modal("show");
				}
			});
		});

		//show a hidden form on add_memo click
		$(document).on('click', '.add_memo', function(){
			$("form#upload_document_form").fadeIn();
		});

		//form cancel_btn
	    $(document).on('click', '.cancel_btn', function(){
	    	$("form#upload_document_form")[0].reset();
			$("form#upload_document_form").fadeOut();
	    });

	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>