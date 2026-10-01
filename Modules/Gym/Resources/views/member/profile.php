
<?php $__env->startSection('title', __('gym::lang.profile')); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('gym::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1><?php echo app('translator')->get('gym::lang.profile'); ?></h1>
    </section>
    <section class="content">
        <?php $__env->startComponent('components.widget'); ?>
            <div class="row">
                <div class="col-md-3">
                    <img <?php if($contact->gym_member_profile_photo): ?> src="<?php echo e(asset('uploads/gym/' . $contact->gym_member_profile_photo), false); ?>" <?php else: ?> src="<?php echo e(asset('img/gym_profile.png'), false); ?>" <?php endif; ?>  alt="User profile picture"
                        style="height:275px;">
                </div>
                <div class="col-md-4">
                    <h3 class="profile-username"><?php echo e($contact->name, false); ?></h3>
                    <p class="text-muted"> <?php echo app('translator')->get('gym::lang.member_id'); ?> : <?php echo e($contact->contact_id, false); ?></p>
                    <ul class="list-group list-group-unbordered mt-5">
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('business.email'); ?></b> <span class="pull-right"><?php echo e($contact->email, false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('contact.mobile'); ?></b> <span class="pull-right"><?php echo e($contact->mobile, false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('contact.alternate_contact_number'); ?></b> <span class="pull-right"><?php echo e($contact->alternate_number, false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('contact.landline'); ?></b> <span class="pull-right"><?php echo e($contact->landline, false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('lang_v1.address_line_1'); ?></b> <span class="pull-right"><?php echo e($contact->address_line_1, false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('lang_v1.address_line_2'); ?></b> <span class="pull-right"><?php echo e($contact->address_line_2, false); ?></span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-5">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('lang_v1.dob'); ?></b> <span class="pull-right"><?php echo e($contact->dob ? \Carbon::createFromTimestamp(strtotime($contact->dob))->format(session('business.date_format')) : '', false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('gym::lang.age'); ?></b> <span class="pull-right"><?php echo e($contact->dob ? \Carbon\Carbon::parse($contact->dob)->age . ' ' . __('gym::lang.years') : '', false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('business.city'); ?></b> <span class="pull-right"><?php echo e($contact->city, false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('business.state'); ?></b> <span class="pull-right"><?php echo e($contact->state, false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('business.country'); ?></b> <span class="pull-right"><?php echo e($contact->country, false); ?></span>
                        </li>
                        <li class="list-group-item">
                            <b><?php echo app('translator')->get('business.zip_code'); ?></b> <span class="pull-right"><?php echo e($contact->zip_code, false); ?></span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="<?php echo e(action([\Modules\Gym\Http\Controllers\MemberController::class, 'id_card'], ['id'=> $contact->id]), false); ?>"
                        class="btn btn-primary tw-text-white submit_form"> <i class="fas fa-id-card"> </i> <?php echo app('translator')->get('gym::lang.id_card'); ?></a>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>