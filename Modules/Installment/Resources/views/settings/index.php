

<?php $__env->startSection('title', __('installment::lang.installment_settings')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('installment::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('installment::layouts.partials.style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="content-header">
        <h1><i class="fa fa-cog"></i> <?php echo app('translator')->get('installment::lang.installment_settings'); ?></h1>
    </section>

    <section class="content">
        <?php echo Form::open(['url' => url('/installment/settings'), 'method' => 'post', 'id' => 'installment_settings_form']); ?>

            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('installment::lang.settings')]); ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <?php echo Form::label('installment_collection_prefix', __('installment::lang.installment_collection_prefix') . ':'); ?>

                            <?php echo Form::text('installment_collection_prefix', $installment_collection_prefix, ['class' => 'form-control', 'placeholder' => 'IP', 'maxlength' => 20]); ?>

                            <p class="help-block"><?php echo app('translator')->get('installment::lang.installment_collection_prefix_help'); ?></p>
                        </div>
                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>

            <div class="row">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary pull-right">
                        <i class="fa fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>
                    </button>
                </div>
            </div>
        <?php echo Form::close(); ?>

    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>