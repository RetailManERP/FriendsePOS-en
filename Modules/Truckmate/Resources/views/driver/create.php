

<?php $__env->startSection('title', __('truckmate::lang.add_vehicle')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('truckmate::vehicle.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <div class="tm-page-header">
        <h1><i class="fas fa-plus-circle" style="color:var(--tm-primary)"></i> <?php echo app('translator')->get('truckmate::lang.add_vehicle'); ?></h1>
    </div>
</section>
<section class="content tm-content">

    <?php echo Form::open(['action' => '\Modules\Truckmate\Http\Controllers\VehicleController@store', 'id' => 'vehicle_form', 'method' => 'post', 'files' => true]); ?>

        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <?php echo Form::label('name',__('truckmate::lang.vehicle_name') . ':*',); ?>

                        <?php echo Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('truckmate::lang.vehicle_name'), 'required']); ?>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <?php echo Form::label('number',__('truckmate::lang.vehicle_number') . ':*',); ?>

                        <?php echo Form::text('number', null, ['class' => 'form-control', 'placeholder' => __('truckmate::lang.vehicle_number'), 'required']); ?>

                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <?php echo Form::label('pmi_brake_date', __('truckmate::lang.pmi_brake_date') . ':*'); ?>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <?php echo Form::text('pmi_brake_date', null, ['id' => 'pmi_brake_date', 'class' => 'form-control', 'required']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <?php echo Form::label('mot_date', __('truckmate::lang.mot_date') . ':*'); ?>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <?php echo Form::text('mot_date', null, ['id' => 'mot_date', 'class' => 'form-control', 'required']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <?php echo Form::label('road_tax_date', __('truckmate::lang.road_tax_date') . ':*'); ?>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <?php echo Form::text('road_tax_date', null, ['id' => 'road_tax_date', 'class' => 'form-control', 'required']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <?php echo Form::label('insurance_date', __('truckmate::lang.insurance_date') . ':*'); ?>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <?php echo Form::text('insurance_date', null, ['id' => 'insurance_date', 'class' => 'form-control', 'required']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <?php echo Form::label('calibration_date', __('truckmate::lang.calibration_date') . ':*'); ?>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <?php echo Form::text('calibration_date', null, ['id' => 'calibration_date', 'class' => 'form-control', 'required']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('notes', __('truckmate::lang.notes')); ?>

                        <?php echo Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-primary pull-right"><?php echo app('translator')->get('messages.save'); ?></button>
                </div>
                </div>
            </div>
        </div>
        
    <?php echo Form::close(); ?> <!-- /form close -->

</section>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <style>
        .bootstrap-datetimepicker-widget.dropdown-menu {
            z-index: 99999 !important;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready( function() {

            $('form#job_sheet_form').validate({
                errorPlacement: function(error, element) {
                    if (element.parent('.iradio_square-blue').length) {
                        error.insertAfter($(".radio_btns"));
                    } else if (element.hasClass('status')) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            var truckmateDateFields = '#pmi_brake_date, #mot_date, #road_tax_date, #insurance_date, #calibration_date';
            $(truckmateDateFields).datetimepicker({
                format: moment_date_format,
                ignoreReadonly: true,
            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>