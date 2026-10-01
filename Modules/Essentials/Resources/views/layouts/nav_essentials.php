<section class="no-print">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm m-4 px-3">
        <div class="container-fluid px-0">
            <a class="navbar-brand fw-semibold" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\ToDoController::class, 'index']), false); ?>"><i class="fas fa-check-circle me-2"></i><?php echo e(__('essentials::lang.essentials'), false); ?></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#essentials-navbar" aria-controls="essentials-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="essentials-navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'todo'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\ToDoController::class, 'index']), false); ?>"><?php echo app('translator')->get('essentials::lang.todo'); ?></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'document' && request()->get('type') != 'memos'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\DocumentController::class, 'index']), false); ?>"><?php echo app('translator')->get('essentials::lang.document'); ?></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'document' && request()->get('type') == 'memos'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\DocumentController::class, 'index']) .'?type=memos', false); ?>"><?php echo app('translator')->get('essentials::lang.memos'); ?></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'reminder'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\ReminderController::class, 'index']), false); ?>"><?php echo app('translator')->get('essentials::lang.reminders'); ?></a>
                    </li>
                    <?php if(auth()->user()->can('essentials.view_message') || auth()->user()->can('essentials.create_message')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'messages'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\EssentialsMessageController::class, 'index']), false); ?>"><?php echo app('translator')->get('essentials::lang.messages'); ?></a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'knowledge-base'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\KnowledgeBaseController::class, 'index']), false); ?>"><?php echo app('translator')->get('essentials::lang.knowledge_base'); ?></a>
                    </li>
                    <?php if(auth()->user()->can('edit_essentials_settings')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->segment(2) == 'hrm' && request()->segment(2) == 'settings'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Essentials\Http\Controllers\EssentialsSettingsController::class, 'edit']), false); ?>"><?php echo app('translator')->get('business.settings'); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</section>
