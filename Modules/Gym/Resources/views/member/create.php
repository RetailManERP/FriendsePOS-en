
<?php $__env->startSection('title', __('gym::lang.members')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('gym::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black"> <?php echo app('translator')->get('gym::lang.add_member'); ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php $__env->startComponent('components.widget'); ?>
            <div class="row">
                <div class="col-md-12">
                    <?php echo Form::open([
                        'url' => action([\Modules\Gym\Http\Controllers\MemberController::class, 'store']),
                        'method' => 'post',
                        'id' => 'create_member',
                        'files' => true,
                    ]); ?>


                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('prefix', __('business.prefix') . ':'); ?>

                                <?php echo Form::text('prefix', null, ['class' => 'form-control', 'placeholder' => __('business.prefix_placeholder')]); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('first_name', __('business.first_name') . ':*'); ?>

                                <?php echo Form::text('first_name', null, [
                                    'class' => 'form-control',
                                    'required',
                                    'placeholder' => __('business.first_name'),
                                ]); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('middle_name', __('lang_v1.middle_name') . ':'); ?>

                                <?php echo Form::text('middle_name', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.middle_name')]); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('last_name', __('business.last_name') . ':'); ?>

                                <?php echo Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => __('business.last_name')]); ?>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('mobile', __('contact.mobile') . ':*'); ?>

                                <?php echo Form::text('mobile', null, ['class' => 'form-control', 'required', 'placeholder' => __('contact.mobile')]); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('alternate_number', __('contact.alternate_contact_number') . ':'); ?>

                                <?php echo Form::text('alternate_number', null, [
                                    'class' => 'form-control',
                                    'placeholder' => __('contact.alternate_contact_number'),
                                ]); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('landline', __('contact.landline') . ':'); ?>

                                <?php echo Form::text('landline', null, ['class' => 'form-control', 'placeholder' => __('contact.landline')]); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('email', __('business.email') . ':'); ?>

                                <?php echo Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('business.email')]); ?>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('dob', __('lang_v1.dob') . ':'); ?>

                                <?php echo Form::text('dob', null, [
                                    'class' => 'form-control dob-date-picker',
                                    'placeholder' => __('lang_v1.dob'),
                                    'readonly',
                                ]); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('gender', __('gym::lang.gender') . ':'); ?>

                                <?php echo Form::select('gym_member_gender', $genders, null, ['class' => 'form-control', 'placeholder' => __('gym::lang.gender')]); ?>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <hr>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('address_line_1', __('lang_v1.address_line_1') . ':'); ?>

                                <?php echo Form::text('address_line_1', null, [
                                    'class' => 'form-control',
                                    'required',
                                    'placeholder' => __('lang_v1.address_line_1'),
                                    'rows' => 3,
                                ]); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('address_line_2', __('lang_v1.address_line_2') . ':'); ?>

                                <?php echo Form::text('address_line_2', null, [
                                    'class' => 'form-control',
                                    'placeholder' => __('lang_v1.address_line_2'),
                                    'rows' => 3,
                                ]); ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('city', __('business.city') . ':'); ?>

                                <?php echo Form::text('city', null, ['class' => 'form-control', 'placeholder' => __('business.city')]); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('state', __('business.state') . ':'); ?>

                                <?php echo Form::text('state', null, ['class' => 'form-control', 'placeholder' => __('business.state')]); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('country', __('business.country') . ':'); ?>

                                <?php echo Form::text('country',null, ['class' => 'form-control', 'placeholder' => __('business.country')]); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('zip_code', __('business.zip_code') . ':'); ?>

                                <?php echo Form::text('zip_code', null, [
                                    'class' => 'form-control',
                                    'placeholder' => __('business.zip_code_placeholder'),
                                ]); ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Photo Upload -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('profile_photo', __('gym::lang.profile_photo') . ':'); ?>

                                <?php echo Form::file('profile_photo', [
                                    'class' => 'form-control-file',
                                    'accept' => 'image/*', // Accepts only image files
                                ]); ?>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 text-center">
                        <input type="hidden" name="submit_type" id="submit_type">
                        <button type="submit" name="submit_action" value="save_and_health"
                            class="btn tw-text-white bg-purple submit_form"><?php echo app('translator')->get('gym::lang.save_and_add_health'); ?></button>
                        <button type="submit" name="submit_action" value="save"
                            class="btn btn-primary tw-text-white submit_form"><?php echo app('translator')->get('messages.save'); ?></button>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dob-date-picker').datepicker({
                autoclose: true,
                endDate: 'today',
            });

            $("form#create_member").validate();

            $(document).on('click', '.submit_form', function(e) {
                e.preventDefault();
                var submit_type = $(this).attr('value');
                $('#submit_type').val(submit_type);
                if ($('form#create_member').valid()) {

                    $('form#create_member').submit();
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>