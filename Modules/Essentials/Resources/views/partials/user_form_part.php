<?php $__env->startComponent('components.widget', ['title' => __('essentials::lang.hrm_details')]); ?>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('essentials_appointment_date', __( 'essentials::lang.appointment_date' ) . ':'); ?>

            <?php echo Form::text('essentials_appointment_date', !empty($user->essentials_appointment_date) ? \Carbon::createFromTimestamp(strtotime($user->essentials_appointment_date))->format(session('business.date_format')) : null, ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.appointment_date'), 'readonly', 'id' => 'essentials_appointment_date']); ?>

        </div>
    </div>
    <div class="clearfix"></div>
	<div class="col-md-4">
		<div class="form-group">
              <?php echo Form::label('essentials_department_id', __('essentials::lang.department') . ':'); ?>

              <div class="form-group mb-2">
                  <?php echo Form::select('essentials_department_id', $departments, !empty($user->essentials_department_id) ? $user->essentials_department_id : null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'placeholder' => __('messages.please_select') ]); ?>

              </div>
          </div>
	</div>

    <div class="col-md-4">
		<div class="form-group">
              <?php echo Form::label('essentials_sub_department_id', __('essentials::lang.sub_department') . ':'); ?>

              <div class="form-group">
                  <?php echo Form::select('essentials_sub_department_id', $sub_departments, !empty($user->essentials_sub_department_id) ? $user->essentials_sub_department_id : null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'placeholder' => __('messages.please_select') ]); ?>

              </div>
          </div>
	</div>
    
	<div class="col-md-4">
		<div class="form-group">
            <?php echo Form::label('essentials_designation_id', __('essentials::lang.designation') . ':'); ?>

            <div class="form-group mb-2">
                <?php echo Form::select('essentials_designation_id', $designations, !empty($user->essentials_designation_id) ? $user->essentials_designation_id : null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'placeholder' => __('messages.please_select') ]); ?>

            </div>
        </div>
	</div>
    <div class="clearfix"></div>
    <div class="col-md-5">
		<div class="form-group">
            <?php echo Form::label('essentials_attendence_uid', __('essentials::lang.essentials_attendence_uid') . ':'); ?>

            <div class="form-group mb-2">
                <?php echo Form::text('essentials_attendence_uid', !empty($user->essentials_attendence_uid) ? $user->essentials_attendence_uid : null, ['class' => 'form-control', 'style' => 'width: 100%;', 'placeholder' => __('essentials::lang.essentials_attendence_uid') ]); ?>

            </div>
        </div>
	</div>
    <?php
        $settings = request()->session()->get('business.essentials_settings');
        $settings = ! empty($settings) ? json_decode($settings, true) : [];   
    ?>
    <?php if(!empty($user->id) && !empty($settings['attendence_terminal_api_key']) && !empty($settings['attendence_terminal_api_secret'])): ?>
    <div class="col-md-2">
		<div class="form-group mb-2">
            <input type="hidden" id='terminal_api_key' value="<?php echo e($settings['attendence_terminal_api_key'], false); ?>">
            <input type="hidden" id='terminal_api_secret' value="<?php echo e($settings['attendence_terminal_api_secret'], false); ?>">
            <?php echo Form::label('enroll_user', __('essentials::lang.enroll_user') . ':'); ?>

            <div class="form-group mb-2">
                <button type="button" class="btn btn-primary enroll_user">Enroll in Terminal<i class="hide fas fa-sync fa-spin fa-fw"></i></button>
            </div>
        </div>
	</div>
    <div class="col-md-3">
		<div class="form-group mb-2">
            <?php echo Form::label('trigger_enroll_finger', __('essentials::lang.trigger_enroll_finger') . ':'); ?>

            <div class="form-group mb-2">
                <button type="button" class="btn btn-primary trigger_enroll_finger">Enroll Finger<i class="hide fas fa-sync fa-spin fa-fw"></i></button>
            </div>
            <?php echo Form::hidden('essentials_attendence_finger', $user->essentials_attendence_finger, ['id' => 'essentials_attendence_finger']); ?>

        </div>
	</div>
    <div class="col-md-2">
		<div class="form-group">
            <?php echo Form::label('trigger_enroll_face', __('essentials::lang.trigger_enroll_face') . ':'); ?>

            <div class="form-group">
                <button type="button" class="btn btn-primary trigger_enroll_face">Enroll Face<i class="hide fas fa-sync fa-spin fa-fw"></i></button>
            </div>
            <?php echo Form::hidden('essentials_attendence_face', $user->essentials_attendence_face, ['id' => 'essentials_attendence_face']); ?>

        </div>
	</div>
    <div class="col-md-2">
        <div class="form-group">
            <div class="form-check">
            <br>
            <label class="form-check-label">
<?php echo Form::checkbox('essentials_attendence_overnight', 1, $user->essentials_attendence_overnight, ['class' => 'form-check-input']); ?> <?php echo e(__('essentials::lang.is_overnight'), false); ?>

            </label>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <div class="form-check">
            <br>
            <label class="form-check-label">
<?php echo Form::checkbox('essentials_payroll_fullmonth', 1, $user->essentials_payroll_fullmonth, ['class' => 'form-check-input']); ?> <?php echo e(__('essentials::lang.essentials_payroll_fullmonth'), false); ?>

            </label>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    
</div>
<?php echo $__env->renderComponent(); ?>
<?php $__env->startComponent('components.widget', ['title' => __('essentials::lang.payroll')]); ?>
<div class="row">
    <div class="col-md-4">
        <?php echo Form::label('location_id', __('lang_v1.primary_work_location') . ':'); ?>

        <?php echo Form::select('location_id', $locations, !empty($user->location_id) ? $user->location_id : $locations->keys()->first(), ['class' => 'form-control select2']); ?>

    </div>
    <div class="col-md-4">
        <div class="input-group mb-2">
            <div class="multi-input">
                <?php echo Form::label('essentials_salary', __('essentials::lang.salary') . ':'); ?>

                <br/>
                <?php echo Form::number('essentials_salary', !empty($user->essentials_salary) ? $user->essentials_salary : null, ['class' => 'form-control width-40 float-start', 'placeholder' => __('essentials::lang.salary')]); ?>


                <?php echo Form::select('essentials_pay_period', ['month' => __('essentials::lang.per'). ' '.__('lang_v1.month'), 'week' => __('essentials::lang.per'). ' '.__('essentials::lang.week'), 'day' => __('essentials::lang.per'). ' '.__('lang_v1.day')], !empty($user->essentials_pay_period) ? $user->essentials_pay_period : null, ['class' => 'form-select width-60 float-end']); ?>

            </div>
        </div>
    </div>
    <div class="form-group mb-2 col-md-4">
        <?php echo Form::label('pay_components', __('essentials::lang.pay_components') . ':'); ?>

        <?php echo Form::select('pay_components[]', $pay_comoponenets, !empty($allowance_deduction_ids) ? $allowance_deduction_ids : [], ['class' => 'form-control select2', 'multiple' ]); ?>

    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="form-check-label">
                <?php echo Form::checkbox('essentials_salary_tax_enabled', 1, !empty($user->essentials_salary_tax_enabled), ['class' => 'form-check-input']); ?>

                <?php echo app('translator')->get('essentials::lang.salary_tax_enabled'); ?>
            </label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('essentials_tax_number', __('essentials::lang.ntn_cnic_for_tax') . ':'); ?>

            <?php echo Form::text('essentials_tax_number', $user->essentials_tax_number ?? null, ['class' => 'form-control', 'maxlength' => 30]); ?>

        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo Form::label('essentials_annual_tax_adjustment', __('essentials::lang.annual_taxable_adjustment') . ':'); ?>

            <?php echo Form::number('essentials_annual_tax_adjustment', $user->essentials_annual_tax_adjustment ?? 0, ['class' => 'form-control', 'step' => '0.01']); ?>

            <small class="text-muted"><?php echo app('translator')->get('essentials::lang.annual_taxable_adjustment_help'); ?></small>
        </div>
    </div>
</div>
<?php echo $__env->renderComponent(); ?>
