<?php if($__is_essentials_enabled): ?>
<li class="bg-navy treeview <?php echo e(in_array($request->segment(1), ['essentials']) ? 'active active-sub' : '', false); ?>">
    <a href="#">
        <i class="fas fa-check-circle"></i>
        <span class="title"><?php echo app('translator')->get('essentials::lang.essentials'); ?></span>
        <span class="float-end-container">
            <i class="fa fa-angle-left float-end"></i>
        </span>
    </a>

    <ul class="treeview-menu">
        <li class="<?php echo e($request->segment(2) == 'todo' ? 'active active-sub' : '', false); ?>">
            <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\ToDoController::class, 'index']), false); ?>">
                <i class="fa fa-list-ul"></i>
                <span class="title"><?php echo app('translator')->get('essentials::lang.todo'); ?></span>
            </a>
        </li>
		<li class="<?php echo e(($request->segment(2) == 'document' && $request->get('type') != 'memos') ? 'active active-sub' : '', false); ?>">
				<a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\DocumentController::class, 'index']), false); ?>">
				<i class="fa fa-file"></i>
				<span class="title"> <?php echo app('translator')->get('essentials::lang.document'); ?> </span>
			</a>
		</li>
        <li class="<?php echo e(($request->segment(2) == 'document' && $request->get('type') == 'memos') ? 'active active-sub' : '', false); ?>">
            <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\DocumentController::class, 'index']) .'?type=memos', false); ?>">
                <i class="fa fa-envelope-open"></i>
                <span class="title">
                    <?php echo app('translator')->get('essentials::lang.memos'); ?>
                </span>
            </a>
        </li>
        <li class="<?php echo e($request->segment(2) == 'reminder' ? 'active active-sub' : '', false); ?>">
            <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\ReminderController::class, 'index']), false); ?>">
                <i class="fa fa-bell"></i>
                <span class="title">
                    <?php echo app('translator')->get('essentials::lang.reminders'); ?>
                </span>
            </a>
        </li>
        <?php if(auth()->user()->can('essentials.view_message') || auth()->user()->can('essentials.create_message')): ?>
        <li class="<?php echo e($request->segment(2) == 'messages' ? 'active active-sub' : '', false); ?>">
            <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\EssentialsMessageController::class, 'index']), false); ?>">
                <i class="fa fa-comments"></i>
                <span class="title">
                    <?php echo app('translator')->get('essentials::lang.messages'); ?>
                </span>
            </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit_essentials_settings')): ?>
            <li class="<?php echo e($request->segment(2) == 'settings' ? 'active active-sub' : '', false); ?>">
                <a href="<?php echo e(action([\Modules\Essentials\Http\Controllers\EssentialsSettingsController::class, 'edit']), false); ?>">
                    <i class="fa fa-cogs"></i>
                    <span class="title"><?php echo app('translator')->get('business.settings'); ?></span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</li>
<?php endif; ?>
