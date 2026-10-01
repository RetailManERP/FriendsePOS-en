<div class="pos-tab-content active">
	<div class="row">
		<div class="col-8">
            <div class="form-group mb-3">
                <?php echo Form::label('logo', __('cms::lang.logo') . ':' ); ?>

                
                    <?php echo Form::file('logo', ['id' => 'logo', 'accept' => 'image/*', 'class'=>'form-control']); ?>

                
                <p class="help-block text-muted">
                    <?php echo app('translator')->get('cms::lang.previously_uploaded_will_be_removed'); ?>
                    <br>
                    <?php echo app('translator')->get('cms::lang.logo_dimension_help_txt'); ?>
                </p>
            </div>
        </div>
        <div class="col-4">
            <?php if(!empty($logo) && !empty($logo->logo_url)): ?>
                <img src="<?php echo e($logo->logo_url, false); ?>" alt="Logo" class="app-logo">
            <?php endif; ?>
        </div>
	</div>
    <h4>
        <?php echo app('translator')->get('cms::lang.notification'); ?>
    </h4>
    <div class="row">
        <div class="col-12">
            <div class="form-group mb-3">
                <?php echo Form::label('notifiable_email', __('cms::lang.email') . ':' ); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('cms::lang.inquiry_notification_help_text') . '"></i>';
                }
            ?>
                <?php echo Form::text('notifiable_email', !empty($details['notifiable_email']) ? $details['notifiable_email'] : '', ['class' => 'form-control', 'id' => 'notifiable_email']); ?>

           </div>
           <p>
           		<small>
           			<?php echo e(__('cms::lang.inquiry_notification_help_text'), false); ?>

           		</small>
           </p>
        </div>
    </div>
</div>
