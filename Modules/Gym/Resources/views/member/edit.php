
<?php $__env->startSection('title', __('gym::lang.members')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('gym::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black"> <?php echo app('translator')->get('gym::lang.edit_member'); ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php $__env->startComponent('components.widget'); ?>
            <div class="row">
                <div class="col-md-12">
                    <?php echo Form::open([
                        'url' => action([\Modules\Gym\Http\Controllers\MemberController::class, 'update'], ['member'=> $contact->id]),
                        'method' => 'put',
                        'id' => 'edit_member',
                        'files' => true,
                    ]); ?>


                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('prefix', __('business.prefix') . ':'); ?>

                                <?php echo Form::text('prefix', $contact->prefix, ['class' => 'form-control', 'placeholder' => __('business.prefix_placeholder')]); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('first_name', __('business.first_name') . ':*'); ?>

                                <?php echo Form::text('first_name', $contact->first_name, [
                                    'class' => 'form-control',
                                    'required',
                                    'placeholder' => __('business.first_name'),
                                ]); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('middle_name', __('lang_v1.middle_name') . ':'); ?>

                                <?php echo Form::text('middle_name', $contact->middle_name, ['class' => 'form-control', 'placeholder' => __('lang_v1.middle_name')]); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('last_name', __('business.last_name') . ':'); ?>

                                <?php echo Form::text('last_name', $contact->last_name, ['class' => 'form-control', 'placeholder' => __('business.last_name')]); ?>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('mobile', __('contact.mobile') . ':*'); ?>

                                <?php echo Form::text('mobile', $contact->mobile, ['class' => 'form-control', 'required', 'placeholder' => __('contact.mobile')]); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('alternate_number', __('contact.alternate_contact_number') . ':'); ?>

                                <?php echo Form::text('alternate_number', $contact->alternate_number, [
                                    'class' => 'form-control',
                                    'placeholder' => __('contact.alternate_contact_number'),
                                ]); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('landline', __('contact.landline') . ':'); ?>

                                <?php echo Form::text('landline', $contact->landline, ['class' => 'form-control', 'placeholder' => __('contact.landline')]); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('email', __('business.email') . ':'); ?>

                                <?php echo Form::email('email', $contact->email, ['class' => 'form-control', 'placeholder' => __('business.email')]); ?>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('dob', __('lang_v1.dob') . ':'); ?>

                                <?php echo Form::text('dob', $contact->dob ? \Carbon::createFromTimestamp(strtotime($contact->dob))->format(session('business.date_format')) : null, [
                                    'class' => 'form-control dob-date-picker',
                                    'placeholder' => __('lang_v1.dob'),
                                    'readonly',
                                ]); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo Form::label('gender', __('gym::lang.gender') . ':'); ?>

                                <?php echo Form::select('gym_member_gender', $genders, $contact->gym_member_gender, ['class' => 'form-control', 'placeholder' => __('gym::lang.gender')]); ?>

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

                                <?php echo Form::text('address_line_1', $contact->address_line_1, [
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

                                <?php echo Form::text('address_line_2', $contact->address_line_2, [
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

                                <?php echo Form::text('city', $contact->city, ['class' => 'form-control', 'placeholder' => __('business.city')]); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('state', __('business.state') . ':'); ?>

                                <?php echo Form::text('state', $contact->state, ['class' => 'form-control', 'placeholder' => __('business.state')]); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('country', __('business.country') . ':'); ?>

                                <?php echo Form::text('country', $contact->country, ['class' => 'form-control', 'placeholder' => __('business.country')]); ?>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo Form::label('zip_code', __('business.zip_code') . ':'); ?>

                                <?php echo Form::text('zip_code', $contact->zip_code, [
                                    'class' => 'form-control',
                                    'placeholder' => __('business.zip_code_placeholder'),
                                ]); ?>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!--  Photo Upload -->
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
                        <button type="submit" name="submit_action" value="save"
                            class="btn btn-big btn-primary tw-text-white submit_form"><?php echo app('translator')->get('messages.save'); ?></button>
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

            $("form#edit_member").validate();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>