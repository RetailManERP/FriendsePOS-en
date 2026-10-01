<div class="modal-dialog" role="document">
	<?php echo Form::open(['url' => action([\Modules\Crm\Http\Controllers\ContactLoginController::class, 'update'], [$user->id]), 'method' => 'put', 'id' => 'contact_login_edit' ]); ?>

	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<h4 class="modal-title" id="myModalLabel">
				<?php echo app('translator')->get('crm::lang.edit_login'); ?>
			</h4>
		</div>
		<div class="modal-body">
			<input type="hidden" name="user_id" id="user_id" value="<?php echo e($user->id, false); ?>">
			<div class="row">
				<div class="col-md-2">
			        <div class="form-group">
			         	<?php echo Form::label('surname', __( 'business.prefix' ) . ':'); ?>

			         	<?php echo Form::text('surname', $user->surname, ['class' => 'form-control', 'placeholder' => __( 'business.prefix_placeholder' ) ]); ?>

			        </div>
			    </div>
			    <div class="col-md-5">
			        <div class="form-group">
						<?php echo Form::label('first_name', __( 'business.first_name' ) . ':*'); ?>

						<?php echo Form::text('first_name', $user->first_name, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.first_name' ) ]); ?>

			        </div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<?php echo Form::label('last_name', __( 'business.last_name' ) . ':'); ?>

						<?php echo Form::text('last_name', $user->last_name, ['class' => 'form-control', 'placeholder' => __( 'business.last_name' ) ]); ?>

					</div>
				</div>
		      	<div class="clearfix"></div>
		      	<?php if(!empty($contacts)): ?>
		      		<div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('crm_contact_id', __('contact.contact') .':*'); ?>

                            <?php echo Form::select('crm_contact_id', $contacts, $user->crm_contact_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                <?php else: ?>
				<input type="hidden" name="crm_contact_id" value="<?php echo e($user->crm_contact_id, false); ?>">
		      	<?php endif; ?>
		      	<div class="col-md-6">
					<div class="form-group">
						<?php echo Form::label('email', __( 'business.email' ) . ':*'); ?>

						<?php echo Form::text('email', $user->email, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.email' ) ]); ?>

					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					    <?php echo Form::label("contact_no", __( 'lang_v1.mobile_number' ) . ':'); ?>

					    <?php echo Form::text('contact_no', $user->contact_no, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.mobile_number')]); ?>

					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
				    	<?php echo Form::label('alt_number', __( 'business.alternate_number' ) . ':'); ?>

				    	<?php echo Form::text('alt_number', !empty($user->alt_number) ? $user->alt_number : null, ['class' => 'form-control', 'placeholder' => __( 'business.alternate_number') ]); ?>

					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
				    	<?php echo Form::label('family_number', __( 'lang_v1.family_contact_number' ) . ':'); ?>

				    	<?php echo Form::text('family_number', !empty($user->family_number) ? $user->family_number : null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.family_contact_number') ]); ?>

				    </div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					    <?php echo Form::label("crm_department", __( 'lang_v1.department' ) . ':'); ?>

					    <?php echo Form::text("crm_department", !empty($user->crm_department) ? $user->crm_department : null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.department'), 'id'=>"crm_department" ]); ?>

					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					    <?php echo Form::label("crm_designation", __( 'lang_v1.designation' ) . ':'); ?>

					    <?php echo Form::text("crm_designation", !empty($user->crm_designation) ? $user->crm_designation : null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.designation'), 'id'=>"crm_designation" ]); ?>

					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<?php echo Form::label('password', __( 'business.password' ) . ':'); ?>

						<?php echo Form::password('password', ['class' => 'form-control', 'placeholder' => __( 'business.password' ) ]); ?>

						<p class="help-block"><?php echo app('translator')->get('user.leave_password_blank'); ?></p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<?php echo Form::label('confirm_password', __( 'business.confirm_password' ) . ':'); ?>

						<?php echo Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => __( 'business.confirm_password' ) ]); ?>

					</div>
				</div>
		      	<div class="clearfix"></div>
		      	<div class="col-md-6">
			        <div class="form-group">
			          <?php echo Form::label('cmmsn_percent', __( 'lang_v1.cmmsn_percent' ) . ':'); ?>

			            <?php echo Form::text('cmmsn_percent', $user->cmmsn_percent, ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.cmmsn_percent' ) ]); ?>

			        </div>
			    </div>
				<div class="col-md-4">
					<?php
						$status = $user->status;
						$is_active = !empty($status) && $status == 'active' ? true : false;
					?>
					<div class="form-group">
						<br>
						<label class="form-check-label">
<?php echo Form::checkbox('is_active', 'active', $is_active, ['class' => 'form-check-input status']); ?> <?php echo e(__('lang_v1.status_for_user'), false); ?>

						</label>
						<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_enable_user_active') . '"></i>';
                }
            ?>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			
			<button type="submit" class="btn btn-primary">
				<?php echo app('translator')->get( 'messages.update' ); ?>
			</button>
			<button type="button" class="btn btn-default" data-bs-dismiss="modal">
				<?php echo app('translator')->get( 'messages.close' ); ?>
			</button>
		</div>
	</div>
	<?php echo Form::close(); ?>

</div>
