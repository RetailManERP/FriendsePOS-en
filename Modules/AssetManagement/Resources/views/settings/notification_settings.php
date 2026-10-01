<div class="pos-tab-content">
	<div class="box box-solid">
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<h4><?php echo app('translator')->get('assetmanagement::lang.asset_send_for_maintenance_notification'); ?>:</h4>
					<p class="help-block"><?php echo app('translator')->get('lang_v1.available_tags'); ?>: {asset_code}, {created_by}, {maintenance_id}, {status}, {priority}, {maintenance_note}</p>
				</div>
				<div class="col-md-12">
	                <div class="form-group">
	                    <?php echo Form::label('send_for_maintenence_recipients', __('assetmanagement::lang.recipients') . ':' ); ?>

	                    <?php echo Form::select('send_for_maintenence_recipients[]', $users, !empty($asset_settings['send_for_maintenence_recipients'])? $asset_settings['send_for_maintenence_recipients'] : null, ['class' => 'form-control select2', 'multiple', 'style' => 'width:100%']); ?>

	                </div>
	            </div>
				<div class="col-md-12">
					<div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
<input type="checkbox" name="enable_asset_send_for_maintenance_email" id="enable_asset_send_for_maintenance_email" class="form-check-input" value="1" <?php if(!empty($asset_settings['enable_asset_send_for_maintenance_email'])): ?> checked <?php endif; ?>>
                                <?php echo app('translator')->get('assetmanagement::lang.enable_email'); ?>
                            </label>
                        </div>
                    </div>
				</div>
			</div>
			<div class="row <?php if(empty($asset_settings['enable_asset_send_for_maintenance_email'])): ?> hide <?php endif; ?>" id="asset_send_for_maintenance_email_div">
				<div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('send_for_maintenance_subject',
                        __('lang_v1.email_subject').':'); ?>

                        <?php echo Form::text('send_for_maintenance[subject]', 
                        $send_for_maintenance_template['subject'], ['class' => 'form-control'
                        , 'placeholder' => __('lang_v1.email_subject'), 'id' =>'send_for_maintenance_subject']); ?>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('send_for_maintenance_email_body',
                        __('lang_v1.email_body').':'); ?>

                        <?php echo Form::textarea('send_for_maintenance[email_body]', 
                        $send_for_maintenance_template['email_body'], ['class' => 'form-control ckeditor'
                        , 'placeholder' => __('lang_v1.email_body'), 'id' => 'send_for_maintenance_email_body', 'rows' => 6]); ?>

                    </div>
                </div>
			</div>
		</div>
	</div>

	<div class="box box-solid">
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<h4><?php echo app('translator')->get('assetmanagement::lang.asset_assigned_for_maintenance_notification'); ?>:</h4>
					<p class="help-block"><?php echo app('translator')->get('lang_v1.available_tags'); ?>: {asset_code}, {created_by}, {maintenance_id}, {status}, {priority}, {send_for_maintenance_details}</p>
				</div>
				<div class="col-md-12">
					<div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
<input type="checkbox" name="enable_asset_assigned_for_maintenance_email" id="enable_asset_assigned_for_maintenance_email" class="form-check-input" value="1" <?php if(!empty($asset_settings['enable_asset_assigned_for_maintenance_email'])): ?> checked <?php endif; ?>>
                                <?php echo app('translator')->get('assetmanagement::lang.enable_email'); ?>
                            </label>
                        </div>
                    </div>
				</div>
			</div>
			<div class="row <?php if(empty($asset_settings['enable_asset_assigned_for_maintenance_email'])): ?> hide <?php endif; ?>" id="asset_assigned_for_maintenance_email_div">
				<div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('assigned_for_maintenance_subject',
                        __('lang_v1.email_subject').':'); ?>

                        <?php echo Form::text('assigned_for_maintenance[subject]', 
                        $assigned_for_maintenance_template['subject'], ['class' => 'form-control'
                        , 'placeholder' => __('lang_v1.email_subject'), 'id' =>'assigned_for_maintenance_subject']); ?>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('assigned_for_maintenance_email_body',
                        __('lang_v1.email_body').':'); ?>

                        <?php echo Form::textarea('assigned_for_maintenance[email_body]', 
                        $assigned_for_maintenance_template['email_body'], ['class' => 'form-control ckeditor'
                        , 'placeholder' => __('lang_v1.email_body'), 'id' => 'assigned_for_maintenance_email_body', 'rows' => 6]); ?>

                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
