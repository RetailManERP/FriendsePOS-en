
<?php $__env->startSection('title', __('gym::lang.diets')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('gym::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content">
        <?php $__env->startComponent('components.widget'); ?>
            <div class="row">
                <div class="col-md-12">
                    <?php echo Form::open(['url' => action([\Modules\Gym\Http\Controllers\MemberDietController::class, 'store']), 'method' => 'post', 'id' => 'create_diet_plan']); ?>

                <input type="hidden" value="<?php echo e($contact->id, false); ?>" name="contact_id" id="contact_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('morning', __('gym::lang.morning') . ':'); ?>

                                <?php echo Form::text('morning', $diet->morning ?? null, ['class' => 'form-control', 'required']); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('breakfast', __('gym::lang.breakfast') . ':'); ?>

                                <?php echo Form::text('breakfast', $diet->breakfast ?? null, ['class' => 'form-control', 'required']); ?>

                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('before_lunch', __('gym::lang.before_lunch') . ':'); ?>

                                <?php echo Form::text('before_lunch', $diet->before_lunch ?? null, ['class' => 'form-control', 'required']); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('lunch', __('gym::lang.lunch') . ':'); ?>

                                <?php echo Form::text('lunch', $diet->lunch ?? null, ['class' => 'form-control', 'required']); ?>

                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('afternoon', __('gym::lang.afternoon') . ':'); ?>

                                <?php echo Form::text('afternoon', $diet->afternoon ?? null, ['class' => 'form-control', 'required']); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('evening', __('gym::lang.evening') . ':'); ?>

                                <?php echo Form::text('evening', $diet->evening ?? null, ['class' => 'form-control', 'required']); ?>

                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('dinner', __('gym::lang.dinner') . ':'); ?>

                                <?php echo Form::text('dinner', $diet->dinner ?? null, ['class' => 'form-control', 'required']); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('before_sleep', __('gym::lang.before_sleep') . ':'); ?>

                                <?php echo Form::text('before_sleep', $diet->before_sleep ?? null, ['class' => 'form-control', 'required']); ?>

                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('before_workout', __('gym::lang.before_workout') . ':'); ?>

                                <?php echo Form::text('before_workout', $diet->before_workout ?? null, ['class' => 'form-control', 'required']); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('after_workout', __('gym::lang.after_workout') . ':'); ?>

                                <?php echo Form::text('after_workout', $diet->after_workout ?? null, ['class' => 'form-control', 'required']); ?>

                            </div>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('remarks', __('gym::lang.remarks') . ':'); ?>

                                <?php echo Form::textarea('remarks', $diet->remarks ?? null, ['class' => 'form-control', 'rows' => 3, 'required']); ?>

                            </div>
                        </div>
                    </div>
                
                    <div class="col-md-12 text-center">
                        <button type="submit" name="submit_action" value="save" class="btn btn-primary tw-text-white">
                            <?php echo app('translator')->get('messages.save'); ?>
                        </button>
                    </div>
                
                    <?php echo Form::close(); ?>

                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $("form#create_diet_plan").validate();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>