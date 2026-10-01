<?php echo Form::open(['action' => '\Modules\Truckmate\Http\Controllers\TruckmateSettingsController@store', 'method' => 'post', 'id' => 'truckmate_settings_form']); ?>

<?php
    $custom_labels = json_decode(session('business.custom_labels'), true) ?? [];
?>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('truckmate_label', __('truckmate::lang.truckmate_label') . ':'); ?>

            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('truckmate::lang.truckmate_label_tooltip') . '"></i>';
                }
            ?>
            <?php echo Form::text('truckmate_label', !empty($custom_labels['truckmate_label']) ? $custom_labels['truckmate_label'] : null, 
                ['class' => 'form-control', 'id' => 'truckmate_label', 'placeholder' => __('truckmate::lang.truckmate_label')]); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="truckmate_status_id">
                <?php echo e(__('truckmate::lang.default_job_sheet_status') . ':', false); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('truckmate::lang.default_job_sheet_status_tooltip') . '"></i>';
                }
            ?>
            </label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fas fa-info-circle"></i>
                </span>
                <select name="default_status" class="form-control" id="truckmate_status_id"></select>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <?php echo Form::label('job_sheet_prefix', __('truckmate::lang.job_sheet_prefix') . ':'); ?>

            <?php echo Form::text('job_sheet_prefix', !empty($truckmate_settings['job_sheet_prefix'])? $truckmate_settings['job_sheet_prefix'] : '', ['class' => 'form-control', 'placeholder' => __('truckmate::lang.job_sheet_prefix')]); ?>

        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label>Update Existing To Multiple Points Feature</label>
            <button type="button" class="btn btn-warning update_job_sheets">Migrate Job Sheets</button>
        </div>
    </div>

</div>
<hr>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('job_sheet_custom_field_1', __('truckmate::lang.label_for_job_sheet_custom_field', ['number' => 1]) . ':'); ?>

            <?php echo Form::text('job_sheet_custom_field_1',!empty($truckmate_settings['job_sheet_custom_field_1'])? $truckmate_settings['job_sheet_custom_field_1'] : '', ['class' => 'form-control ', 'id' => 'job_sheet_custom_field_1']); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('job_sheet_custom_field_2', __('truckmate::lang.label_for_job_sheet_custom_field', ['number' => 2]) . ':'); ?>

            <?php echo Form::text('job_sheet_custom_field_2',!empty($truckmate_settings['job_sheet_custom_field_1'])? $truckmate_settings['job_sheet_custom_field_2'] : '', ['class' => 'form-control ', 'id' => 'job_sheet_custom_field_2']); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('job_sheet_custom_field_3', __('truckmate::lang.label_for_job_sheet_custom_field', ['number' => 3]) . ':'); ?>

            <?php echo Form::text('job_sheet_custom_field_3',!empty($truckmate_settings['job_sheet_custom_field_3'])? $truckmate_settings['job_sheet_custom_field_3'] : '', ['class' => 'form-control ', 'id' => 'job_sheet_custom_field_3']); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('job_sheet_custom_field_4', __('truckmate::lang.label_for_job_sheet_custom_field', ['number' => 4]) . ':'); ?>

            <?php echo Form::text('job_sheet_custom_field_4',!empty($truckmate_settings['job_sheet_custom_field_1'])? $truckmate_settings['job_sheet_custom_field_4'] : '', ['class' => 'form-control ', 'id' => 'job_sheet_custom_field_4']); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?php echo Form::label('job_sheet_custom_field_5', __('truckmate::lang.label_for_job_sheet_custom_field', ['number' => 5]) . ':'); ?>

            <?php echo Form::text('job_sheet_custom_field_5',!empty($truckmate_settings['job_sheet_custom_field_5'])? $truckmate_settings['job_sheet_custom_field_5'] : '', ['class' => 'form-control ', 'id' => 'job_sheet_custom_field_5']); ?>

        </div>
    </div>
</div>
<?php echo Form::close(); ?>