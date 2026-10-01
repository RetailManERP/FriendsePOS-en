
<?php if(!$account_exist): ?>
<div class="coa-empty-state">
    <h3><?php echo app('translator')->get( 'accounting::lang.no_accounts' ); ?></h3>
    <p><?php echo app('translator')->get( 'accounting::lang.add_default_accounts_help' ); ?></p>
    <a href="<?php echo e(route('accounting.create-default-accounts'), false); ?>" class="btn btn-success">
        <?php echo app('translator')->get( 'accounting::lang.add_default_accounts' ); ?> <i class="fas fa-file-import ms-1"></i>
    </a>
</div>
<?php else: ?>
<div class="coa-modern-tree">
    
    <div class="coa-search-bar">
        <input type="text" class="form-control" id="coa_tree_search" placeholder="<?php echo app('translator')->get('messages.search'); ?>...">
        <div class="coa-toolbar-btns">
            <button class="btn btn-sm" id="expand_all"><i class="fas fa-expand-arrows-alt me-1"></i> <?php echo app('translator')->get('accounting::lang.expand_all'); ?></button>
            <button class="btn btn-sm" id="collapse_all"><i class="fas fa-compress-arrows-alt me-1"></i> <?php echo app('translator')->get('accounting::lang.collapse_all'); ?></button>
        </div>
    </div>

    
    <?php $__currentLoopData = $account_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="coa-type-group">
        
        <div class="coa-type-header" data-coa-toggle="type">
            <i class="fas fa-chevron-down coa-chevron"></i>
            <span><?php echo e($value, false); ?></span>
        </div>
        <div class="coa-type-body">
            <?php $__currentLoopData = $account_sub_types->where('account_primary_type', $key)->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $subTypeAccounts = $accounts->where('account_sub_type_id', $sub_type->id)->sortBy('name');
            ?>
            <div class="coa-subtype-group">
                
                <div class="coa-subtype-header" data-coa-toggle="subtype">
                    <i class="fas fa-chevron-down coa-chevron"></i>
                    <span><?php echo e($sub_type->account_type_name, false); ?></span>
                    <span class="coa-subtype-count"><?php echo e($subTypeAccounts->count(), false); ?></span>
                </div>
                <div class="coa-subtype-body">
                    <?php $__currentLoopData = $subTypeAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <div class="coa-account-item" data-coa-name="<?php echo e(strtolower($account->name), false); ?> <?php echo e(strtolower($account->gl_code ?? ''), false); ?>">
                        <div class="coa-acct-info">
                            <?php if(count($account->child_accounts) > 0): ?>
                                <span class="coa-expand-icon coa-parent-toggle" data-coa-toggle="children">
                                    <i class="fas fa-chevron-down" style="font-size:10px;color:#8892a4;transition:transform .2s"></i>
                                </span>
                            <?php endif; ?>
                            <span class="coa-acct-icon">
                                <?php if(count($account->child_accounts) > 0): ?>
                                    <i class="fas fa-folder"></i>
                                <?php else: ?>
                                    <i class="fas fa-file-invoice"></i>
                                <?php endif; ?>
                            </span>
                            <span class="coa-acct-name">
                                <?php if(!empty($account->gl_code)): ?><span class="coa-gl"><?php echo e($account->gl_code, false); ?></span><?php endif; ?>
                                <?php echo e($account->name, false); ?>

                            </span>
                        </div>
                        <span class="coa-acct-balance">
                            <?php if($account->is_non_posting): ?>
                                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $account->child_total_balance, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                            <?php else: ?>
                                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $account->balance, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                            <?php endif; ?>
                        </span>
                        <span class="coa-acct-status" title="<?php echo e($account->status == 'active' ? __('accounting::lang.active') : __('lang_v1.inactive'), false); ?>">
                            <?php if($account->status == 'active'): ?>
                                <i class="fas fa-check"></i>
                            <?php else: ?>
                                <i class="fas fa-times"></i>
                            <?php endif; ?>
                        </span>
                        <span class="coa-node-actions btn-group">
                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.ledger_report.view')): ?>
                                <li>
                                    <a class="ledger-link" 
                                        href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'ledger'], $account->id), false); ?>?start=<?php echo e(\Carbon::now()->startOfYear()->toDateString(), false); ?>&end=<?php echo e(\Carbon::now()->endOfYear()->toDateString(), false); ?>">
                                        <i class="fas fa-file-alt"></i> <?php echo app('translator')->get('accounting::lang.ledger'); ?>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if(empty($account->from_contact)): ?>
                                <li>
                                    <a class="btn-modal" 
                                        href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'edit'], $account->id), false); ?>" 
                                        data-href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'edit'], $account->id), false); ?>" 
                                        data-container="#create_account_modal">
                                        <i class="fas fa-edit"></i> <?php echo app('translator')->get('messages.edit'); ?>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <li>
                                    <a class="activate-deactivate-btn" 
                                        href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'activateDeactivate'], $account->id), false); ?>">
                                        <i class="fas fa-power-off"></i> 
                                        <?php if($account->status=='active'): ?> <?php echo app('translator')->get('messages.deactivate'); ?> <?php else: ?> <?php echo app('translator')->get('messages.activate'); ?> <?php endif; ?>
                                    </a>
                                </li>
                            </ul>
                        </span>
                    </div>

                    
                    <?php if(count($account->child_accounts) > 0): ?>
                    <div class="coa-children">
                        <?php $__currentLoopData = $account->child_accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child_account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($child_account->status == 'inactive'): ?>
                                <?php continue; ?>
                            <?php endif; ?>
                        <div class="coa-account-item" data-coa-name="<?php echo e(strtolower($child_account->name), false); ?> <?php echo e(strtolower($child_account->gl_code ?? ''), false); ?>">
                            <div class="coa-acct-info">
                                <span class="coa-acct-icon">
                                    <i class="fas fa-file-invoice"></i>
                                </span>
                                <span class="coa-acct-name">
                                    <?php if(!empty($child_account->gl_code)): ?><span class="coa-gl"><?php echo e($child_account->gl_code, false); ?></span><?php endif; ?>
                                    <?php echo e($child_account->name, false); ?>

                                </span>
                            </div>
                            <span class="coa-acct-balance"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $child_account->balance, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
                            <span class="coa-acct-status" title="<?php echo e($child_account->status == 'active' ? __('accounting::lang.active') : __('lang_v1.inactive'), false); ?>">
                                <?php if($child_account->status == 'active'): ?>
                                    <i class="fas fa-check"></i>
                                <?php else: ?>
                                    <i class="fas fa-times"></i>
                                <?php endif; ?>
                            </span>
                            <span class="coa-node-actions btn-group">
                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.ledger_report.view')): ?>
                                    <li>
                                        <a class="ledger-link" 
                                            href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'ledger'], $child_account->id), false); ?>?start=<?php echo e(\Carbon::now()->startOfYear()->toDateString(), false); ?>&end=<?php echo e(\Carbon::now()->endOfYear()->toDateString(), false); ?>">
                                            <i class="fas fa-file-alt"></i> <?php echo app('translator')->get('accounting::lang.ledger'); ?>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(empty($child_account->from_contact)): ?>
                                    <li>
                                        <a class="btn-modal" 
                                            href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'edit'], $child_account->id), false); ?>" 
                                            data-href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'edit'], $child_account->id), false); ?>" 
                                            data-container="#create_account_modal">
                                            <i class="fas fa-edit"></i> <?php echo app('translator')->get('messages.edit'); ?>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <li>
                                        <a class="activate-deactivate-btn" 
                                            href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'activateDeactivate'], $child_account->id), false); ?>">
                                            <i class="fas fa-power-off"></i>
                                            <?php if($child_account->status=='active'): ?> <?php echo app('translator')->get('messages.deactivate'); ?> <?php else: ?> <?php echo app('translator')->get('messages.activate'); ?> <?php endif; ?>
                                        </a>
                                    </li>
                                </ul>
                            </span>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>
