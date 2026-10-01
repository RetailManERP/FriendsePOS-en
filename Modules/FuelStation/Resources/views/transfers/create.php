
<?php $__env->startSection('title', __('fuelstation::lang.add_transfer')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('fuelstation::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header"><h1><?php echo app('translator')->get('fuelstation::lang.add_transfer'); ?></h1></section>

<section class="content">
    <?php echo Form::open(['url' => action([\Modules\FuelStation\Http\Controllers\FuelTankTransferController::class, 'store']), 'method' => 'post']); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('fuelstation::lang.add_transfer')]); ?>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('from_tank_id', __('fuelstation::lang.from_tank') . ':*'); ?>

                    <?php echo Form::select('from_tank_id', $tanks, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'required', 'placeholder' => __('messages.please_select')]); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('to_tank_id', __('fuelstation::lang.to_tank') . ':*'); ?>

                    <?php echo Form::select('to_tank_id', $tanks, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'required', 'placeholder' => __('messages.please_select')]); ?>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('transfer_date', __('fuelstation::lang.transfer_date') . ':*'); ?>

                    <?php echo Form::text('transfer_date', \Carbon\Carbon::now()->format('Y-m-d H:i'), ['class' => 'form-control', 'required']); ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('quantity', __('fuelstation::lang.quantity') . ' (L):*'); ?>

                    <?php echo Form::number('quantity', null, ['class' => 'form-control', 'step' => 'any', 'required']); ?>

                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <?php echo Form::label('notes', __('fuelstation::lang.notes') . ':'); ?>

                    <?php echo Form::text('notes', null, ['class' => 'form-control']); ?>

                </div>
            </div>
        </div>
        <?php $__env->slot('footer'); ?>
            <button type="submit" class="btn btn-primary pull-right"><?php echo app('translator')->get('fuelstation::lang.save'); ?></button>
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>