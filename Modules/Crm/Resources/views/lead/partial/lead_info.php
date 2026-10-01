<div class="row">
	<div class="col-md-8">
		<?php echo $__env->make('contact.partials.contact_info_tab', ['reward_enabled' => 0], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>
	<div class="col-md-4 mt-56">
        <?php if(!empty($contact->Source)): ?>
    		<strong><i class="fas fa fa-search"></i>
                <?php echo app('translator')->get('crm::lang.source'); ?>
            </strong>
            <p><?php echo e($contact->Source->name, false); ?></p>
        <?php endif; ?>
        <?php if(!empty($contact->lifeStage)): ?>
            <strong><i class="fas fa fa-life-ring"></i>
                <?php echo app('translator')->get('crm::lang.life_stage'); ?>
            </strong> 
            <p><?php echo e($contact->lifeStage->name, false); ?></p>
        <?php endif; ?>

        <strong><i class="fas fa-users"></i>
            <?php echo app('translator')->get('crm::lang.assgined'); ?>
        </strong> <br>
        <p>
            <?php if ($__env->exists('components.avatar', ['max_count' => '10', 'members' => $contact->leadUsers])) echo $__env->make('components.avatar', ['max_count' => '10', 'members' => $contact->leadUsers], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </p>
	</div>
</div>
