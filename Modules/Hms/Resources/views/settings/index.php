
<?php $__env->startSection('title', __('messages.settings')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('hms::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Main content -->
    <section class="content">
        <!-- Custom Tabs -->
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('messages.settings') . ':']); ?>
            <div class="card">
                <div class="card-header p-0">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#cn_1" data-bs-toggle="tab" aria-expanded="true">
                                <?php echo app('translator')->get('hms::lang.booking'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#cn_2" data-bs-toggle="tab" aria-expanded="true">
                                <?php echo app('translator')->get('lang_v1.customer_notifications'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#cn_3" data-bs-toggle="tab" aria-expanded="true">
                                <?php echo app('translator')->get('hms::lang.print_pdf'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="cn_1">
                        <div class="row">
                                <?php echo Form::open([
                                    'url' => action([\Modules\Hms\Http\Controllers\HmsSettingController::class, 'store']),
                                    'method' => 'post',
                                    'id' => 'hms_setting',
                                    'files' => true,
                                ]); ?>

                                <?php
                                    $settings = json_decode($busines->hms_settings);
                                ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo Form::label('booking_prefix', __('hms::lang.booking_prefix') . '*'); ?>

                                        <?php echo Form::text('booking_prefix', $settings->prefix ?? null, [
                                            'class' => 'form-control',
                                            'required',
                                            'placeholder' => __('hms::lang.booking_prefix'),
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-sm-12">
                                    <h4><?php echo app('translator')->get('hms::lang.labels_for_id_proof_fields'); ?>:</h4>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <?php echo Form::label('id_proof_label_1', __('hms::lang.id_proof_label_1')); ?>

                                        <div class="input-group">
                                            <?php echo Form::text('id_proof_label_1', $settings->id_proof_label_1 ?? null, ['class' => 'form-control', 'id' => 'id_proof_label_1']); ?>

                                            <div class="input-group-addon">
                                                <label class="form-check-label">
<input type="checkbox" name="is_id_proof_1_required" value="1" <?php if($settings->is_id_proof_1_required ?? false): echo 'checked'; endif; ?>> <?php echo app('translator')->get('lang_v1.is_required'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <?php echo Form::label('id_proof_label_2', __('hms::lang.id_proof_label_2')); ?>

                                        <div class="input-group">
                                            <?php echo Form::text('id_proof_label_2', $settings->id_proof_label_2 ?? null, ['class' => 'form-control', 'id' => 'id_proof_label_2']); ?>

                                            <div class="input-group-addon">
                                                <label class="form-check-label">
<input type="checkbox" name="is_id_proof_2_required" value="1" <?php if($settings->is_id_proof_2_required ?? false): echo 'checked'; endif; ?>> <?php echo app('translator')->get('lang_v1.is_required'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <?php echo Form::label('id_proof_label_3', __('hms::lang.id_proof_label_3')); ?>

                                        <div class="input-group">
                                            <?php echo Form::text('id_proof_label_3', $settings->id_proof_label_3 ?? null, ['class' => 'form-control', 'id' => 'id_proof_label_3']); ?>

                                            <div class="input-group-addon">
                                                <label class="form-check-label">
<input type="checkbox" name="is_id_proof_3_required" value="1" <?php if($settings->is_id_proof_3_required ?? false): echo 'checked'; endif; ?>> <?php echo app('translator')->get('lang_v1.is_required'); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <?php echo Form::submit(__('messages.submit'), ['class' => 'btn btn-lg btn-success']); ?>

                                </div>
                
                                <?php echo Form::close(); ?>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="cn_2">
                        <h3><?php echo app('translator')->get('hms::lang.new_booking'); ?></h3>
                        <div class="row">
                            <?php echo Form::open([
                                'url' => action([\Modules\Hms\Http\Controllers\HmsSettingController::class, 'store_email_template']),
                                'method' => 'post',
                            ]); ?>

                            <div class="col-md-12">
                                <strong><?php echo app('translator')->get('lang_v1.available_tags'); ?>:</strong>
                                <p class="help-block">
                                    <?php echo e(implode(', ', $tags), false); ?>

                                </p>
                            </div>
                            <div class="col-md-12 mt-10">
                                <div class="form-group">
                                    <?php echo Form::label('subject', __('lang_v1.email_subject') . ':'); ?>

                                    <?php echo Form::text('subject', empty($template->subject) ? null : $template->subject, [
                                        'class' => 'form-control',
                                        'placeholder' => __('lang_v1.email_subject'),
                                        'id' => 'subject',
                                    ]); ?>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo Form::label('cc', 'CC:'); ?>

                                    <?php echo Form::email('cc', empty($template->cc) ? null : $template->cc, [
                                        'class' => 'form-control',
                                        'placeholder' => 'CC',
                                        'id' => 'cc',
                                    ]); ?>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo Form::label('bcc', 'BCC:'); ?>

                                    <?php echo Form::email('bcc', empty($template->bcc) ? null : $template->bcc, [
                                        'class' => 'form-control',
                                        'placeholder' => 'BCC',
                                        'id' => 'bcc',
                                    ]); ?>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php echo Form::label('email_body', __('lang_v1.email_body') . ':'); ?>

                                    <?php echo Form::textarea('email_body', empty($template->email_body) ? null : $template->email_body, [
                                        'class' => 'form-control ckeditor',
                                        'placeholder' => __('lang_v1.email_body'),
                                        'id' => 'email_body',
                                        'rows' => 6,
                                    ]); ?>

                                </div>
                            </div>
                            <div class="col-md-12 mt-15">
                                <label class="checkbox-inline">
                                    <?php echo Form::checkbox('auto_send', 1, empty($template->auto_send) ? null : $template->auto_send, [
                                        'class' => 'form-check-input',
                                    ]); ?> <?php echo app('translator')->get('lang_v1.autosend_email'); ?>
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit"
                                        class="btn btn-lg btn-danger"><?php echo app('translator')->get('messages.save'); ?></button>
                                </div>
                            </div>
                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="cn_3">
                        <div class="row">
                                <?php echo Form::open([
                                    'url' => action([\Modules\Hms\Http\Controllers\HmsSettingController::class, 'post_pdf']),
                                    'method' => 'post',
                                    'id' => 'post_pdf',
                                    'files' => true,
                                ]); ?>

                                <?php
                                    $settings = json_decode($busines->hms_settings);
                                ?>
                            

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo Form::label('phone', __('contact.contact')); ?>

                                        <?php echo Form::text('phone', $settings->booking_pdf->phone ?? null, [
                                            'class' => 'form-control',
                                            'id' => 'phone',
                                            'placeholder' => __('contact.contact'),
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo Form::label('email', __('hms::lang.email')); ?>

                                        <?php echo Form::email('email', $settings->booking_pdf->email ?? null, [
                                            'class' => 'form-control',
                                            'id' => 'email',
                                            'placeholder' => __('hms::lang.email'),
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo Form::label('website', __('hms::lang.website')); ?>

                                        <?php echo Form::text('website', $settings->booking_pdf->website ?? null, [
                                            'class' => 'form-control',
                                            'id' => 'website',
                                            'placeholder' => __('hms::lang.website'),
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo Form::label('address', __('hms::lang.address')); ?>

                                        <?php echo Form::textarea('address', $settings->booking_pdf->address ?? null, [
                                            'class' => 'form-control',
                                            'id' => 'address',
                                            'rows' => '4',
                                            'placeholder' => __('hms::lang.address'),
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php echo Form::label('footer_text', __('hms::lang.footer_text')); ?>

                                        <?php echo Form::textarea('footer_text', $settings->booking_pdf->footer_text ?? null, [
                                            'class' => 'form-control',
                                            'placeholder' => __('hms::lang.footer_text'),
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <?php echo Form::submit(__('messages.submit'), ['class' => 'btn btn-lg btn-success']); ?>

                                </div>

                                <?php echo Form::close(); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <p class="help-block"><i><?php echo __('hms::lang.version_info', ['version' => $module_version]); ?></i></p>
            </div>
        <?php echo $__env->renderComponent(); ?>
    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea#email_body',
        });
        tinymce.init({
            selector: 'textarea#footer_text',
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>