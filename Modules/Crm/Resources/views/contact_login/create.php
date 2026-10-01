<div class="modal-dialog" role="document">
	<?php echo Form::open(['url' => action([\Modules\Crm\Http\Controllers\ContactLoginController::class, 'store']), 'method' => 'post', 'id' => 'contact_login_add' ]); ?>

	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<h4 class="modal-title" id="myModalLabel">
				<?php echo app('translator')->get("crm::lang.add_login"); ?>
			</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-2">
			        <div class="form-group">
			         	<?php echo Form::label('surname', __( 'business.prefix' ) . ':'); ?>

			         	<?php echo Form::text('surname', null, ['class' => 'form-control', 'placeholder' => __( 'business.prefix_placeholder' ) ]); ?>

			        </div>
			    </div>
			    <div class="col-md-5">
			        <div class="form-group">
						<?php echo Form::label('first_name', __( 'business.first_name' ) . ':*'); ?>

						<?php echo Form::text('first_name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.first_name' ) ]); ?>

			        </div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<?php echo Form::label('last_name', __( 'business.last_name' ) . ':'); ?>

						<?php echo Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => __( 'business.last_name' ) ]); ?>

					</div>
				</div>
		      	<div class="clearfix"></div>
		      	<?php if(!empty($contacts)): ?>
		      		<div class="col-md-6">
                        <div class="form-group">
                            <?php echo Form::label('crm_contact_id', __('contact.contact') .':*'); ?>

                            <?php echo Form::select('crm_contact_id', $contacts, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                <?php else: ?>
                <!-- conatct_id hidden field -->
				<input type="hidden" name="crm_contact_id" value="<?php echo e($crm_contact_id, false); ?>">
		      	<?php endif; ?>
				<div class="col-md-6">
					<div class="form-group">
						<?php echo Form::label('email', __( 'business.email' ) . ':*'); ?>

						<?php echo Form::text('email', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.email' ) ]); ?>

					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					    <?php echo Form::label("contact_no", __( 'lang_v1.mobile_number' ) . ':'); ?>

					    <?php echo Form::text('contact_no', null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.mobile_number')]); ?>

					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
				    	<?php echo Form::label('alt_number', __( 'business.alternate_number' ) . ':'); ?>

				    	<?php echo Form::text('alt_number', null, ['class' => 'form-control', 'placeholder' => __( 'business.alternate_number') ]); ?>

					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
				    	<?php echo Form::label('family_number', __( 'lang_v1.family_contact_number' ) . ':'); ?>

				    	<?php echo Form::text('family_number', null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.family_contact_number') ]); ?>

				    </div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					    <?php echo Form::label("crm_department", __( 'lang_v1.department' ) . ':'); ?>

					    <?php echo Form::text("crm_department", null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.department'), 'id'=>"crm_department" ]); ?>

					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					    <?php echo Form::label("crm_designation", __( 'lang_v1.designation' ) . ':'); ?>

					    <?php echo Form::text("crm_designation", null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.designation'), 'id'=>"crm_designation" ]); ?>

					</div>
				</div>
		      	<div class="col-md-6">
			        <div class="form-group">
			          <?php echo Form::label('cmmsn_percent', __( 'lang_v1.cmmsn_percent' ) . ':'); ?>

			            <?php echo Form::text('cmmsn_percent', null, ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.cmmsn_percent' ) ]); ?>

			        </div>
			    </div>
				<div class="col-md-6">
					<div class="form-group">
						<br>
						<label class="form-check-label">
<?php echo Form::checkbox('is_active', 'active', true, ['class' => 'form-check-input status']); ?> <?php echo e(__('lang_v1.status_for_user'), false); ?>

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
				<div class="clearfix"></div>
				<div class="col-md-6">
					<div class="form-group">
			            <div class="form-check">
			              <label class="form-check-label">
<?php echo Form::checkbox('allow_login', 1, false, 
			                [ 'class' => 'form-check-input allow_login', "data-loginDiv" => "crm_login_div"]); ?> <?php echo e(__( 'lang_v1.allow_login' ), false); ?>

			              </label>
			            </div>
			        </div>
				</div>
			</div>
			<div class="row hide" id="crm_login_div">
				<div class="col-md-6">
					<div class="form-group">
						<?php echo Form::label('username', __( 'business.username' ) . ':*'); ?>

						<?php echo Form::text('username', null, ['class' => 'form-control', 'placeholder' => __( 'business.username' ), 'required']); ?>

					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<?php echo Form::label('password', __( 'business.password' ) . ':*'); ?>

						<?php echo Form::password('password', ['class' => 'form-control', 'required', 'placeholder' => __( 'business.password' ) ]); ?>

					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<?php echo Form::label('confirm_password', __( 'business.confirm_password' ) . ':*'); ?>

						<?php echo Form::password('confirm_password', ['class' => 'form-control', 'required', 'placeholder' => __( 'business.confirm_password' ) ]); ?>

					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			
			<button type="submit" class="btn btn-primary">
				<?php echo app('translator')->get( 'messages.save' ); ?>
			</button>
			<button type="button" class="btn btn-default" data-bs-dismiss="modal">
				<?php echo app('translator')->get( 'messages.close' ); ?>
			</button>
		</div>
	</div>
	<?php echo Form::close(); ?>

</div>
