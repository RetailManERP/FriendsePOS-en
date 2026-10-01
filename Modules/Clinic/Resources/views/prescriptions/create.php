
<?php $__env->startSection('title', __('clinic::lang.add_prescription')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('clinic::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 >
            <i class="fas fa-prescription me-2"></i><?php echo app('translator')->get('clinic::lang.add_prescription'); ?>
        </h1>
    </section>

    <section class="content">
        <?php echo Form::open(['action' => '\Modules\Clinic\Http\Controllers\PrescriptionController@store', 'method' => 'post', 'id' => 'prescription_form']); ?>


        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.prescription_details')]); ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('patient_id', __('clinic::lang.select_patient') . ':*'); ?>

                        <?php echo Form::select('patient_id', $patients, request('patient_id'), ['class' => 'form-control select2', 'required', 'placeholder' => __('clinic::lang.select_one')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('doctor_id', __('clinic::lang.select_doctor') . ':*'); ?>

                        <?php echo Form::select('doctor_id', $doctors, request('doctor_id'), ['class' => 'form-control select2', 'required', 'placeholder' => __('clinic::lang.select_one')]); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('consultation_id', __('clinic::lang.consultation') . ':'); ?>

                        <?php echo Form::select('consultation_id', $consultations, request('consultation_id'), ['class' => 'form-control select2', 'placeholder' => __('clinic::lang.select_one')]); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('notes', __('clinic::lang.prescription_note') . ':'); ?>

                        <?php echo Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 2]); ?>

                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

        <?php $__env->startComponent('components.widget', ['title' => __('clinic::lang.prescriptions')]); ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="medicine_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('clinic::lang.medicine_name'); ?> *</th>
                            <th><?php echo app('translator')->get('clinic::lang.select_product'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.dosage'); ?> *</th>
                            <th><?php echo app('translator')->get('clinic::lang.frequency'); ?> *</th>
                            <th><?php echo app('translator')->get('clinic::lang.duration_days'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.route'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.quantity'); ?></th>
                            <th><?php echo app('translator')->get('clinic::lang.instructions'); ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="medicine_rows">
                        <tr class="medicine-row">
                            <td><input type="text" name="items[0][medicine_name]" class="form-control" required></td>
                            <td>
                                <select name="items[0][product_id]" class="form-control select2">
                                    <option value=""><?php echo app('translator')->get('clinic::lang.select_one'); ?></option>
                                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($id, false); ?>"><?php echo e($name, false); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                            <td><input type="text" name="items[0][dosage]" class="form-control" required placeholder="e.g. 500mg"></td>
                            <td><input type="text" name="items[0][frequency]" class="form-control" required placeholder="e.g. 3x daily"></td>
                            <td><input type="number" name="items[0][duration]" class="form-control" min="1" placeholder="7"></td>
                            <td>
                                <select name="items[0][route]" class="form-control">
                                    <option value="oral"><?php echo app('translator')->get('clinic::lang.oral'); ?></option>
                                    <option value="topical"><?php echo app('translator')->get('clinic::lang.topical'); ?></option>
                                    <option value="injection"><?php echo app('translator')->get('clinic::lang.injection'); ?></option>
                                    <option value="inhalation"><?php echo app('translator')->get('clinic::lang.inhalation'); ?></option>
                                    <option value="sublingual"><?php echo app('translator')->get('clinic::lang.sublingual'); ?></option>
                                    <option value="rectal"><?php echo app('translator')->get('clinic::lang.rectal'); ?></option>
                                </select>
                            </td>
                            <td><input type="number" name="items[0][quantity]" class="form-control" min="1" placeholder="1"></td>
                            <td><input type="text" name="items[0][instructions]" class="form-control" placeholder="After meals"></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove-medicine" style="display:none;"><i class="fas fa-times"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button type="button" class="btn btn-sm btn-info mt-2" id="add_medicine">
                <i class="fas fa-plus me-1"></i><?php echo app('translator')->get('clinic::lang.add_medicine'); ?>
            </button>
        <?php echo $__env->renderComponent(); ?>

        <?php echo Form::close(); ?>

    </section>

    
    <div id="prescription-footer-actions-template" class="d-none">
        <div>
            <button type="button" class="btn btn-primary" id="prescription_save_btn">
                <i class="fas fa-save me-2"></i><?php echo app('translator')->get('messages.save'); ?>
            </button>
            <a href="<?php echo e(action([\Modules\Clinic\Http\Controllers\PrescriptionController::class, 'index']), false); ?>"
               class="btn btn-default">
                <?php echo app('translator')->get('clinic::lang.back'); ?>
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        var medicineIndex = 1;
        $('#add_medicine').click(function() {
            var row = `<tr class="medicine-row">
                <td><input type="text" name="items[${medicineIndex}][medicine_name]" class="form-control" required></td>
                <td><select name="items[${medicineIndex}][product_id]" class="form-control"><option value=""><?php echo app('translator')->get('clinic::lang.select_one'); ?></option><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($id, false); ?>"><?php echo e($name, false); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></td>
                <td><input type="text" name="items[${medicineIndex}][dosage]" class="form-control" required placeholder="e.g. 500mg"></td>
                <td><input type="text" name="items[${medicineIndex}][frequency]" class="form-control" required placeholder="e.g. 3x daily"></td>
                <td><input type="number" name="items[${medicineIndex}][duration]" class="form-control" min="1" placeholder="7"></td>
                <td><select name="items[${medicineIndex}][route]" class="form-control">
                    <option value="oral"><?php echo app('translator')->get('clinic::lang.oral'); ?></option>
                    <option value="topical"><?php echo app('translator')->get('clinic::lang.topical'); ?></option>
                    <option value="injection"><?php echo app('translator')->get('clinic::lang.injection'); ?></option>
                    <option value="inhalation"><?php echo app('translator')->get('clinic::lang.inhalation'); ?></option>
                    <option value="sublingual"><?php echo app('translator')->get('clinic::lang.sublingual'); ?></option>
                    <option value="rectal"><?php echo app('translator')->get('clinic::lang.rectal'); ?></option>
                </select></td>
                <td><input type="number" name="items[${medicineIndex}][quantity]" class="form-control" min="1" placeholder="1"></td>
                <td><input type="text" name="items[${medicineIndex}][instructions]" class="form-control" placeholder="After meals"></td>
                <td><button type="button" class="btn btn-danger btn-sm remove-medicine"><i class="fas fa-times"></i></button></td>
            </tr>`;
            $('#medicine_rows').append(row);
            medicineIndex++;
        });

        $(document).on('click', '.remove-medicine', function() {
            $(this).closest('.medicine-row').remove();
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>