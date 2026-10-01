<?php $__env->startComponent('components.widget', ['title' => __('truckmate::lang.truckmate_details')]); ?>
<div class="row">
	<div class="col-md-4">
          <div class="form-group">
            <?php echo Form::label('driver_company', __('truckmate::lang.driver_company') . ':'); ?>

            <div class="form-group">
                <?php echo Form::text('truckmate_driver_company', !empty($user->truckmate_driver_company) ? $user->truckmate_driver_company : null, 
                ['class' => 'form-control', 'style' => 'width: 100%;', 'placeholder' => __('truckmate::lang.driver_company') ]); ?>

            </div>
        </div>
	</div>
    <div class="col-md-4">
		<div class="form-group">
              <?php echo Form::label('truckmate_driver_type', __('truckmate::lang.driver_shift') . ':'); ?>

              <div class="form-group">
                  <?php echo Form::select('truckmate_driver_type', ['day' => 'Day', 'night' => 'Night'], !empty($user->truckmate_driver_type) ? $user->truckmate_driver_type : null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'placeholder' => __('messages.please_select') ]); ?>

              </div>
          </div>
	</div>

    <div class="clearfix"></div>

    <div class="col-sm-3">
        <div class="form-group">
            <?php echo Form::label('truckmate_license_expiry', __('truckmate::lang.truckmate_license_expiry') . ':'); ?>

            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
                <?php echo Form::text('truckmate_license_expiry', !empty($user->truckmate_license_expiry) ? \Carbon::createFromTimestamp(strtotime($user->truckmate_license_expiry))->format(session('business.date_format')) : null, ['id' => 'truckmate_license_expiry', 'readonly', 'class' => 'form-control']); ?>

            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <?php echo Form::label('truckmate_tacograph_expiry', __('truckmate::lang.truckmate_tacograph_expiry') . ':'); ?>

            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
                <?php echo Form::text('truckmate_tacograph_expiry', !empty($user->truckmate_tacograph_expiry) ? \Carbon::createFromTimestamp(strtotime($user->truckmate_tacograph_expiry))->format(session('business.date_format')) : null, ['id' => 'truckmate_tacograph_expiry', 'readonly', 'class' => 'form-control']); ?>

            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <?php echo Form::label('truckmate_cpc_expiry', __('truckmate::lang.truckmate_cpc_expiry') . ':'); ?>

            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </span>
                <?php echo Form::text('truckmate_cpc_expiry', !empty($user->truckmate_cpc_expiry) ? \Carbon::createFromTimestamp(strtotime($user->truckmate_cpc_expiry))->format(session('business.date_format')) : null, ['id' => 'truckmate_cpc_expiry', 'readonly', 'class' => 'form-control']); ?>

            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    
    <div class="col-md-3">
		<div class="form-group">
            <?php echo Form::label('truckmate_day_rate', __('truckmate::lang.truckmate_day_rate') . ':'); ?>

            <div class="form-group">
                <?php echo Form::text('truckmate_day_rate', !empty($user->truckmate_day_rate) ? number_format($user->truckmate_day_rate, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : null, 
                ['class' => 'form-control', 'style' => 'width: 100%;', 'placeholder' => __('truckmate::lang.truckmate_day_rate') ]); ?>

            </div>
        </div>
	</div>

    <div class="col-md-3">
		<div class="form-group">
            <?php echo Form::label('truckmate_night_rate', __('truckmate::lang.truckmate_night_rate') . ':'); ?>

            <div class="form-group">
                <?php echo Form::text('truckmate_night_rate', !empty($user->truckmate_night_rate) ?  number_format($user->truckmate_night_rate, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator'])  : null, 
                ['class' => 'form-control', 'style' => 'width: 100%;', 'placeholder' => __('truckmate::lang.truckmate_night_rate') ]); ?>

            </div>
        </div>
	</div>

    <div class="col-md-3">
		<div class="form-group">
            <?php echo Form::label('truckmate_sat_rate', __('truckmate::lang.truckmate_sat_rate') . ':'); ?>

            <div class="form-group">
                <?php echo Form::text('truckmate_sat_rate', !empty($user->truckmate_sat_rate) ? number_format($user->truckmate_sat_rate, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : null, 
                ['class' => 'form-control', 'style' => 'width: 100%;', 'placeholder' => __('truckmate::lang.truckmate_sat_rate') ]); ?>

            </div>
        </div>
	</div>

    <div class="col-md-3">
		<div class="form-group">
            <?php echo Form::label('truckmate_sun_rate', __('truckmate::lang.truckmate_sun_rate') . ':'); ?>

            <div class="form-group">
                <?php echo Form::text('truckmate_sun_rate', !empty($user->truckmate_sun_rate) ? number_format($user->truckmate_sun_rate, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : null, 
                ['class' => 'form-control', 'style' => 'width: 100%;', 'placeholder' => __('truckmate::lang.truckmate_sun_rate') ]); ?>

            </div>
        </div>
	</div>

    <div class="col-md-6">
		<div class="form-group">
            <?php echo Form::label('truckmate_note', __('truckmate::lang.truckmate_note') . ':'); ?>

            <div class="form-group">
                <?php echo Form::text('truckmate_note', !empty($user->truckmate_note) ? $user->truckmate_note : null, 
                ['class' => 'form-control', 'style' => 'width: 100%;', 'placeholder' => __('truckmate::lang.truckmate_note') ]); ?>

            </div>
        </div>
	</div>

</div>
<?php echo $__env->renderComponent(); ?>