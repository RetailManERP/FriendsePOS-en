<table class="table table-bordered table-striped table-th-skin">
    <thead>
        <tr>
            <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
            <th><?php echo app('translator')->get( 'user.name' ); ?></th>
            <th><?php echo app('translator')->get( 'accounting::lang.gl_code' ); ?></th>
            <th><?php echo app('translator')->get( 'accounting::lang.parent_account' ); ?></th>
            <th><?php echo app('translator')->get( 'accounting::lang.account_type' ); ?></th>
            <th><?php echo app('translator')->get( 'accounting::lang.account_sub_type' ); ?></th>
            <th><?php echo app('translator')->get( 'accounting::lang.detail_type' ); ?></th>
            <!-- <th><?php echo app('translator')->get( 'accounting::lang.primary_balance' ); ?></th> -->
            <th><?php echo app('translator')->get( 'accounting::lang.primary_balance' ); ?></th>
            <th><?php echo app('translator')->get( 'sale.status' ); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="bg-gray">
                <td>
                    <div class="btn-group"><button type="button" class="btn btn-info dropdown-toggle btn-xs" data-bs-toggle="dropdown" aria-expanded="false"><?php echo e(__("messages.actions"), false); ?><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                        <ul class="dropdown-menu dropdown-menu-left" role="menu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.ledger_report.view')): ?>
                            <li>
                                <a
                                href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'ledger'], $account->id), false); ?>">
                                <i class="fas fa-file-alt"></i> <?php echo app('translator')->get( 'accounting::lang.ledger' ); ?></a>
                            </li>
                            <?php endif; ?>

                            <?php if(empty($account->from_contact)): ?>
                            <li>
                                <a class="btn-modal" 
                                href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'edit'], $account->id), false); ?>" 
                                data-href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'edit'], $account->id), false); ?>" 
                                data-container="#create_account_modal">
                                <i class="fas fa-edit"></i> <?php echo app('translator')->get( 'messages.edit' ); ?></a>
                            </li>
                            <?php endif; ?>
                            <li>
                                <a class="activate-deactivate-btn" 
                                href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'activateDeactivate'], $account->id), false); ?>">
                                    <i class="fas fa-power-off"></i>
                                    <?php if($account->status=='active'): ?> <?php echo app('translator')->get('messages.deactivate'); ?> <?php else: ?> 
                                    <?php echo app('translator')->get('messages.activate'); ?> <?php endif; ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
                <td><?php echo e($account->name, false); ?></td>
                <td><?php echo e($account->gl_code, false); ?></td>
                <td></td>
                <td><?php if(!empty($account->account_primary_type)): ?><?php echo e(__('accounting::lang.' . $account->account_primary_type), false); ?><?php endif; ?></td>
                <td>
                    <?php if(!empty($account->account_sub_type)): ?>
                        <?php echo e(Str::contains(__('accounting::lang.' . $account->account_sub_type->name), 'lang.') ? $account->account_sub_type->name : __('accounting::lang.' . $account->account_sub_type->name), false); ?>

                    <?php endif; ?>
                </td>
                <td>
                    <?php if(!empty($account->detail_type)): ?>
                        <?php echo e(Str::contains(__('accounting::lang.' . $account->detail_type->name), 'lang.') ? $account->detail_type->name : __('accounting::lang.' . $account->detail_type->name), false); ?>

                    <?php endif; ?>
                </td>
                <td><?php if(!empty($account->balance)): ?> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $account->balance, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> <?php endif; ?></td>
                <!-- <td></td> -->
                <td><?php if($account->status == 'active'): ?> 
                        <span class="label bg-light-green"><?php echo app('translator')->get( 'accounting::lang.active' ); ?></span> 
                    <?php elseif($account->status == 'inactive'): ?> 
                        <span class="label bg-red"><?php echo app('translator')->get( 'lang_v1.inactive' ); ?></span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php if(count($account->child_accounts) > 0): ?>

                <?php $__currentLoopData = $account->child_accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child_account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                        <div class="btn-group"><button type="button" class="btn btn-info dropdown-toggle btn-xs" data-bs-toggle="dropdown" aria-expanded="false"><?php echo e(__("messages.actions"), false); ?><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('accounting.ledger_report.view')): ?>
                                <li>
                                    <a
                                    href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'ledger'], $child_account->id), false); ?>">
                                    <i class="fas fa-file-alt"></i> <?php echo app('translator')->get( 'accounting::lang.ledger' ); ?></a>
                                </li>
                                <?php endif; ?>

                                <?php if(empty($child_account->from_contact)): ?>
                                <li>
                                    <a class="btn-modal" 
                                    href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'edit'], $child_account->id), false); ?>" 
                                    data-href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'edit'], $child_account->id), false); ?>" 
                                    data-container="#create_account_modal">
                                    <i class="fas fa-edit"></i> <?php echo app('translator')->get( 'messages.edit' ); ?></a>
                                </li>
                                <?php endif; ?>
                                
                                <li>
                                    <a class="activate-deactivate-btn" 
                                    href="<?php echo e(action([\Modules\Accounting\Http\Controllers\CoaController::class, 'activateDeactivate'], $child_account->id), false); ?>">
                                        <i class="fas fa-power-off"></i>
                                        <?php if($child_account->status=='active'): ?> <?php echo app('translator')->get('messages.deactivate'); ?> <?php else: ?> 
                                        <?php echo app('translator')->get('messages.activate'); ?> <?php endif; ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        </td>
                        <td style="padding-left:30px"><?php echo e($child_account->name, false); ?></td>
                        <td><?php echo e($child_account->gl_code, false); ?></td>
                        <td><?php echo e($account->name, false); ?></td>
                        <td><?php if(!empty($child_account->account_primary_type)): ?><?php echo e(__('accounting::lang.' . $child_account->account_primary_type), false); ?><?php endif; ?></td>
                        <td>
                            <?php if(!empty($child_account->account_sub_type)): ?>
                                <?php echo e(Str::contains(__('accounting::lang.' . $child_account->account_sub_type->name), 'lang.') ? $child_account->account_sub_type->name : __('accounting::lang.' . $child_account->account_sub_type->name), false); ?>

                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if(!empty($child_account->detail_type)): ?>
                                <?php echo e(Str::contains(__('accounting::lang.' . $child_account->detail_type->name), 'lang.') ? $child_account->detail_type->name : __('accounting::lang.' . $child_account->detail_type->name), false); ?>

                            <?php endif; ?>
                        </td>
                        <td><?php if(!empty($child_account->balance)): ?> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $child_account->balance, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> <?php endif; ?></td>
                        <!-- <td></td> -->
                        <td>
                            <?php if($child_account->status == 'active'): ?> 
                                <span class="label bg-light-green"><?php echo app('translator')->get( 'accounting::lang.active' ); ?></span> 
                            <?php elseif($child_account->status == 'inactive'): ?> 
                                <span class="label bg-red"><?php echo app('translator')->get( 'lang_v1.inactive' ); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if(!$account_exist): ?>
            <tr>
                <td colspan="10" class="text-center">
                    <h3><?php echo app('translator')->get( 'accounting::lang.no_accounts' ); ?></h3>
                    <p><?php echo app('translator')->get( 'accounting::lang.add_default_accounts_help' ); ?></p>
                    <a href="<?php echo e(route('accounting.create-default-accounts'), false); ?>" class="btn btn-success btn-xs"><?php echo app('translator')->get( 'accounting::lang.add_default_accounts' ); ?> <i class="fas fa-file-import"></i></a>
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
