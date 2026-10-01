
<?php $__env->startSection('title', __('clinic::lang.lab_test_catalog')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 >
            <i class="fas fa-vials me-2"></i><?php echo app('translator')->get('clinic::lang.lab_test_catalog'); ?>
        </h1>
        <p><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('clinic::lang.manage_lab_tests_help'); ?></p>
    </section>

    <section class="content">
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <button type="button" class="btn btn-block btn-primary"
                            data-bs-toggle="modal" data-bs-target="#addTestModal">
                        <i class="fa fa-plus"></i> <?php echo app('translator')->get('clinic::lang.add_lab_test'); ?>
                    </button>
                </div>
            <?php $__env->endSlot(); ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="lab_tests_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.test_name'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.test_code'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.test_category'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.sample_type'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.normal_range'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.cost'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.is_active'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($test->name, false); ?></td>
                                <td><?php echo e($test->code ?? '-', false); ?></td>
                                <td><?php echo e($test->category ?? '-', false); ?></td>
                                <td><?php echo e($test->sample_type ?? '-', false); ?></td>
                                <td><?php echo e($test->normal_range ?? '-', false); ?></td>
                                <td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $test->cost, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                                <td><?php echo $test->is_active ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>'; ?></td>
                                <td>
                                    <a href="#" class="btn btn-xs btn-info edit_test"
                                       data-id="<?php echo e($test->id, false); ?>" data-name="<?php echo e($test->name, false); ?>" data-code="<?php echo e($test->code, false); ?>"
                                       data-category="<?php echo e($test->category, false); ?>" data-sample_type="<?php echo e($test->sample_type, false); ?>"
                                       data-normal_range="<?php echo e($test->normal_range, false); ?>" data-cost="<?php echo e($test->cost, false); ?>"
                                       data-turnaround_time="<?php echo e($test->turnaround_time, false); ?>" data-is_active="<?php echo e($test->is_active, false); ?>"
                                       data-description="<?php echo e($test->description, false); ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\LabController::class, 'destroyTest'], $test->id), false); ?>"
                                       class="btn btn-xs btn-danger delete_test">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php echo $__env->renderComponent(); ?>
    </section>

    
    <div class="modal fade" id="addTestModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php echo Form::open(['action' => '\Modules\Clinic\Http\Controllers\LabController@storeTest', 'method' => 'post', 'id' => 'test_form']); ?>

                <input type="hidden" name="test_id" id="test_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="testModalTitle"><?php echo app('translator')->get('clinic::lang.add_lab_test'); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <?php echo Form::label('test_name_input', __('clinic::lang.test_name') . ':*'); ?>

                        <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'id' => 'test_name_input']); ?>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <?php echo Form::label('test_code_input', __('clinic::lang.test_code') . ':'); ?>

                                <?php echo Form::text('code', null, ['class' => 'form-control', 'id' => 'test_code_input']); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <?php echo Form::label('test_category_input', __('clinic::lang.test_category') . ':'); ?>

                                <?php echo Form::text('category', null, ['class' => 'form-control', 'id' => 'test_category_input']); ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <?php echo Form::label('sample_type_input', __('clinic::lang.sample_type') . ':'); ?>

                                <?php echo Form::text('sample_type', null, ['class' => 'form-control', 'id' => 'sample_type_input']); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <?php echo Form::label('normal_range_input', __('clinic::lang.normal_range') . ':'); ?>

                                <?php echo Form::text('normal_range', null, ['class' => 'form-control', 'id' => 'normal_range_input']); ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <?php echo Form::label('cost_input', __('clinic::lang.cost') . ':'); ?>

                                <?php echo Form::number('cost', 0, ['class' => 'form-control', 'step' => '0.01', 'min' => '0', 'id' => 'cost_input']); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <?php echo Form::label('turnaround_input', __('clinic::lang.turnaround_time') . ':'); ?>

                                <?php echo Form::text('turn_around_time', null, ['class' => 'form-control', 'id' => 'turnaround_input', 'placeholder' => 'e.g. 24 hours']); ?>

                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <?php echo Form::label('description_input', __('clinic::lang.description') . ':'); ?>

                        <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => 2, 'id' => 'description_input']); ?>

                    </div>
                    <div class="form-check">
                        <?php echo Form::checkbox('is_active', 1, true, ['class' => 'form-check-input', 'id' => 'is_active_input']); ?>

                        <?php echo Form::label('is_active_input', __('clinic::lang.is_active'), ['class' => 'form-check-label']); ?>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i><?php echo app('translator')->get('messages.save'); ?>
                    </button>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        // Move modal to body to escape content-wrapper stacking context
        $('#addTestModal').appendTo('body');

        // Edit test
        $(document).on('click', '.edit_test', function(e) {
            e.preventDefault();
            $('#testModalTitle').text("<?php echo app('translator')->get('clinic::lang.edit_lab_test'); ?>");
            $('#test_id').val($(this).data('id'));
            $('#test_name_input').val($(this).data('name'));
            $('#test_code_input').val($(this).data('code'));
            $('#test_category_input').val($(this).data('category'));
            $('#sample_type_input').val($(this).data('sample_type'));
            $('#normal_range_input').val($(this).data('normal_range'));
            $('#cost_input').val($(this).data('cost'));
            $('#turnaround_input').val($(this).data('turnaround_time'));
            $('#description_input').val($(this).data('description'));
            $('#is_active_input').prop('checked', $(this).data('is_active') == 1);
            $('#addTestModal').modal('show');
        });

        // Save test via AJAX
        $('#test_form').on('submit', function(e) {
            e.preventDefault();
            var id = $('#test_id').val();
            var url = id
                ? "<?php echo e(url('clinic/lab-tests'), false); ?>/" + id
                : "<?php echo e(url('clinic/lab-tests'), false); ?>";
            var method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: $(this).serialize(),
                success: function(result) {
                    if (result.success) {
                        toastr.success(result.msg);
                        $('#addTestModal').modal('hide');
                        location.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
                error: function() {
                    toastr.error("<?php echo app('translator')->get('messages.something_went_wrong'); ?>");
                }
            });
        });

        // Reset modal on close
        $('#addTestModal').on('hidden.bs.modal', function() {
            $('#testModalTitle').text("<?php echo app('translator')->get('clinic::lang.add_lab_test'); ?>");
            $('#test_form')[0].reset();
            $('#test_id').val('');
        });

        // Delete test
        $(document).on('click', '.delete_test', function(e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                text: "<?php echo app('translator')->get('clinic::lang.delete_confirm'); ?>",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((confirmed) => {
                if (confirmed) {
                    $.ajax({
                        method: 'DELETE',
                        url: $(this).attr('href'),
                        data: { '_token': '<?php echo e(csrf_token(), false); ?>' },
                        success: function(result) {
                            if (result.success) {
                                toastr.success(result.msg);
                                location.reload();
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