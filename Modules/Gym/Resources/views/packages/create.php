<div class="modal-dialog" role="document">
    <div class="modal-content">

        <?php echo Form::open([
            'url' => action([\Modules\Gym\Http\Controllers\PackageController::class, 'store']),
            'method' => 'post',
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

                <?php echo Form::text('name', null, [
                    'class' => 'form-control',
                    'required',
                    'placeholder' => __('gym::lang.name'),
                ]); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('amount', __('gym::lang.amount') . '*'); ?>

                <?php echo Form::number('amount', null, [
                    'class' => 'form-control',
                    'required',
                    'step' => '0.01',
                    'placeholder' => __('gym::lang.amount'),
                ]); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('duration', __('gym::lang.duration') . '*'); ?>

                <?php echo Form::select('duration', $durations, '', [
                    'class' => 'form-control',
                    'required',
                ]); ?>

            </div>
            <?php echo Form::label('duration', __('gym::lang.classes')); ?>

            <div class="row">
                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" name="classes[]" value="<?php echo e($class->id, false); ?>">
                                    <?php echo e($class->name, false); ?>  (<?php echo e($class->start_time ? \Carbon::createFromTimestamp(strtotime($class->start_time))->format('h:i A') : '', false); ?> <?php echo e($class->start_time || $class->end_time ? ' - ' : '', false); ?> <?php echo e($class->end_time ? \Carbon::createFromTimestamp(strtotime($class->end_time))->format('h:i A') : '', false); ?>)
                                </label>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="form-group">
                <?php echo Form::label('notes', __('gym::lang.notes')); ?>

                <?php echo Form::textarea('notes', null, [
                    'class' => 'form-control',
                    'placeholder' => __('gym::lang.notes'),
                    'rows' => 3,
                ]); ?>

            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
<?php echo Form::checkbox('enable', 1, ['class' => 'form-check-input']); ?>

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
</div><!-- /.modal-dialog -->
