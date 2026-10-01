

<?php $__env->startSection('title', __('aiassistance::lang.aiassistance')); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('aiassistance::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'aiassistance::lang.aiassistance' ); ?></h1>
</section>

<section class="content no-print">
    <div class="alert alert-warning" style="font-size: 1.1em;">
        <i class="fa fa-exclamation-triangle"></i>
        <?php echo e(__('aiassistance::lang.sensitive_data_warning'), false); ?>

    </div>
    <div class="row">
        <form action="<?php echo e(action([\Modules\AiAssistance\Http\Controllers\AiAssistanceController::class, 'generate'], ['tool' => $tool_details['name']]), false); ?>" method="POST" id="create_form">
            <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <div class="box box-success box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo e($tool_details['label'], false); ?></h3>
                        <div class="box-tools pull-right">
                            <i class="<?php echo e($tool_details['icon'], false); ?>"></i>
                        </div>
                        <p><?php echo e($tool_details['description'], false); ?></p>
                    </div>

                    <div class="box-body">
                            <div class="row">
                        <?php if(!empty($tool_details['example'])): ?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p class="help-block" style="margin-top: 10px;"><?php echo e($tool_details['example'], false); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if(in_array($tool_details['name'], ['brandproduct-descriptions', 'google-ads', 'fb-ads', 'product_review'])): ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo Form::label('name', __('aiassistance::lang.brandproduct_name') . ':*' ); ?>

                                <?php echo Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('aiassistance::lang.brandproduct_name'), 'required', 'autofocus']); ?>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo Form::label('description', __( 'aiassistance::lang.brandproduct_details' ) . ':*'); ?>

                                <?php echo Form::textarea('description', null, ['class' => 'form-control',
                                'placeholder' => __( 'aiassistance::lang.brandproduct_placeholder' ), 'rows' => 3, 'required', 'maxlength' => 200]); ?>

                            </div>
                        </div>

                        <?php endif; ?>

                        <?php if(in_array($tool_details['name'], ['product_review'])): ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo Form::label('features_liked', __('aiassistance::lang.product_review_what_like') . ':*' ); ?>

                                <?php echo Form::text('features_liked', null, ['class' => 'form-control', 'placeholder' => __('aiassistance::lang.product_review_what_like'), 'required']); ?>

                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if(in_array($tool_details['name'], ['review_response'])): ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo Form::label('customer_review', __( 'aiassistance::lang.customer_review' ) . ':*'); ?>

                                <?php echo Form::textarea('customer_review', null, ['class' => 'form-control',
                                'placeholder' => __( 'aiassistance::lang.customer_review' ), 'rows' => 3, 'required', 'maxlength' => 200]); ?>

                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if($tool_details['name'] == 'social_post'): ?>

                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo Form::label('description', __( 'aiassistance::lang.social_post_details' ) . ':*'); ?>

                                <?php echo Form::textarea('description', null, ['class' => 'form-control',
                                'placeholder' => __( 'aiassistance::lang.social_post_details' ), 'rows' => 3, 'required', 'maxlength' => 200]); ?>

                            </div>
                        </div>

                        <?php endif; ?>

                        <?php if($tool_details['name'] == 'copywriting'): ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo Form::label('description', __( 'aiassistance::lang.product_service_description' ) . ':*'); ?>

                                <?php echo Form::textarea('description', null, ['class' => 'form-control',
                                'placeholder' => __( 'aiassistance::lang.product_service_description' ), 'rows' => 2, 'required', 'maxlength' => 200]); ?>

                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if(in_array($tool_details['name'], ['email'])): ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo Form::label('sender', __('aiassistance::lang.sender') . ':*' ); ?>

                                <?php echo Form::text('sender', null, ['class' => 'form-control', 'placeholder' => __('aiassistance::lang.sender_placeholder'), 'required']); ?>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo Form::label('recipient', __('aiassistance::lang.recipient') . ':*' ); ?>

                                <?php echo Form::text('recipient', null, ['class' => 'form-control', 'placeholder' => __('aiassistance::lang.recipient_placeholder'), 'required']); ?>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo Form::label('email_about', __( 'aiassistance::lang.email_about' ) . ':*'); ?>

                                <?php echo Form::textarea('email_about', null, ['class' => 'form-control',
                                'placeholder' => __( 'aiassistance::lang.email_about' ), 'rows' => 2, 'required', 'maxlength' => 200]); ?>

                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if(in_array($tool_details['name'], ['email'])): ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo Form::label('tone', __( 'aiassistance::lang.tone' ) . ':'); ?>

                                <select class="form-control" style="width: 50%;" name="tone">
                                    <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                                    <?php $__currentLoopData = $tones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($k, false); ?>"><?php echo e($v, false); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <?php endif; ?>


                        <?php if($tool_details['name'] == 'proposal'): ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo Form::label('what_biz_does', __( 'aiassistance::lang.what_biz_does' ) . ':*'); ?>

                                <?php echo Form::textarea('what_biz_does', null, ['class' => 'form-control',
                                'placeholder' => __( 'aiassistance::lang.what_biz_does' ), 'rows' => 2, 'required', 'maxlength' => 200]); ?>

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo Form::label('what_do_for_client', __( 'aiassistance::lang.what_do_for_client' ) . ':*'); ?>

                                <?php echo Form::textarea('what_do_for_client', null, ['class' => 'form-control',
                                'placeholder' => __( 'aiassistance::lang.what_do_for_client' ), 'rows' => 2, 'required', 'maxlength' => 200]); ?>

                            </div>
                        </div>

                        <?php endif; ?>

                        <?php if($tool_details['name'] == 'kb'): ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo Form::label('kb_details', __( 'aiassistance::lang.kb_details' ) . ':*'); ?>

                                <?php echo Form::textarea('kb_details', null, ['class' => 'form-control',
                                'placeholder' => __( 'aiassistance::lang.kb_details' ), 'rows' => 2, 'required', 'maxlength' => 200]); ?>

                            </div>
                        </div>

                        <?php endif; ?>

                        <?php if($tool_details['name'] == 'customer_support_reply'): ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo Form::label('customer_message', __( 'aiassistance::lang.customer_message' ) . ':*'); ?>

                                <?php echo Form::textarea('customer_message', null, ['class' => 'form-control',
                                'placeholder' => __( 'aiassistance::lang.customer_message' ), 'rows' => 3, 'required', 'maxlength' => 200]); ?>

                            </div>
                        </div>
                        <?php endif; ?>

                            </div><!-- /.row -->
                    </div>

                    <div class="box-footer">
                        <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo Form::label('language', __( 'business.language' ) . ':'); ?>

                                <select class="form-control" style="width: 50%;" name="language">
                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($v, false); ?>" <?php if($v == $default_lang): ?> selected <?php endif; ?>><?php echo e($v, false); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-5 pull-right">
                            <button type="reset" class="btn btn-secondary"><?php echo app('translator')->get( 'aiassistance::lang.reset' ); ?></button>

                            <button type="submit" class="btn btn-primary pull-right ladda-button" id="submit_btn"><?php echo app('translator')->get( 'aiassistance::lang.create' ); ?></button>
                        </div>
                        </div><!-- /.row -->
                    </div>

                </div>
            <?php echo $__env->renderComponent(); ?>
            </div>
        </form>

    </div>
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row output_row">

        </div>
    <?php echo $__env->renderComponent(); ?>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function() {
        $('#create_form').on('submit', function(e) {
            e.preventDefault();
            url = $('form#create_form').attr('action');

            var ladda = Ladda.create(document.querySelector('.ladda-button'));
		    ladda.start();

            $.ajax({
                url: url,
                method: "post",
                data: $('form#create_form').serialize(),
                dataType: "json",
                success: function(response) {
                    // $('#submit_btn').removeAttr('disabled');
                    ladda.stop();
                    if (response.success == true) {
                        var htmlObject = $(response.html);
                        $('.output_row').append(htmlObject);

                        $('html, body').animate({
                            scrollTop: $(htmlObject).offset().top - 350
                        }, 2000);
                    } else {
                        alert(response.msg);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    ladda.stop();
                    alert("something went wrong, please try again");
                    // $('#submit_btn').removeAttr('disabled');
                }
            });
        });
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>