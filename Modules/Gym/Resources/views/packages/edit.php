<div class="modal-dialog" role="document">
    <div class="modal-content">

        <?php echo Form::open([
            'url' => action(
                [\Modules\Gym\Http\Controllers\PackageController::class, 'update'],
                ['gym_package' => $package->id],
            ),
            'method' => 'put',
            'id' => 'add_package',
        ]); ?>



        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get('gym::lang.packages'); ?></h4>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <?php echo Form::label('name', __('gym::lang.name') . '*'); ?>

                <?php echo Form::text('name', $package->name, [
                    'class' => 'form-control',
                    'required',
                    'placeholder' => __('gym::lang.name'),
                ]); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('amount', __('gym::lang.amount') . '*'); ?>

                <?php echo Form::number('amount', $package->amount, [
                    'class' => 'form-control',
                    'required',
                    'step' => '0.01',
                    'placeholder' => __('gym::lang.amount'),
                ]); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('duration', __('gym::lang.duration') . '*'); ?>

                <?php echo Form::select('duration', $durations, $package->duration, [
                    'class' => 'form-control',
                    'required',
                ]); ?>

            </div>
            <?php
                $package->classes = json_decode($package->classes, true);
            ?>
            <?php echo Form::label('duration', __('gym::lang.classes')); ?>

            <div class="row">
                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" <?php echo e(is_array($package->classes ?? []) && in_array($class->id, $package->classes) ? 'checked' : '', false); ?> name="classes[]"
                                        value="<?php echo e($class->id, false); ?>">
                                    <?php echo e($class->name, false); ?>  (<?php echo e($class->start_time ? \Carbon::createFromTimestamp(strtotime($class->start_time))->format('h:i A') : '', false); ?> <?php echo e($class->start_time || $class->end_time ? ' - ' : '', false); ?> <?php echo e($class->end_time ? \Carbon::createFromTimestamp(strtotime($class->end_time))->format('h:i A') : '', false); ?>)
                                </label>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="form-group">
                <?php echo Form::label('notes', __('gym::lang.notes')); ?>

                <?php echo Form::textarea('notes', $package->notes, [
                    'class' => 'form-control',
                    'rows' => 3,
                    'placeholder' => __('gym::lang.notes'),
                ]); ?>

            </div>

            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('enable', 1, $package->enabled, ['class' => 'form-check-input']); ?>

                        <?php echo app('translator')->get('gym::lang.enable'); ?>
                    </label>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary tw-text-white"><?php echo app('translator')->get('messages.save'); ?></button>
            <button type="button" class="btn btn-default tw-text-white"
                data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>

        <?php echo Form::close(); ?>


    </div><!-- /.modal-content -->
</div>
