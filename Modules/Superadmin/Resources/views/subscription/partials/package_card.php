<div class="col-sm-6 col-lg-4">
    <div class="package-box" style="background:#fff;border:1px solid #e2e8f0;border-radius:1rem;padding:1.5rem 1.25rem;text-align:center;display:flex;flex-direction:column;height:100%;transition:transform .2s,box-shadow .2s;<?php echo e($package->mark_package_as_popular == 1 ? 'border-color:#6366f1;box-shadow:0 0 0 2px rgba(99,102,241,.15);' : '', false); ?>">

        
        <?php if($package->mark_package_as_popular == 1): ?>
        <div style="margin-bottom:.5rem;">
            <span style="display:inline-block;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;font-size:.7rem;font-weight:700;padding:.25rem .75rem;border-radius:999px;letter-spacing:.5px;text-transform:uppercase;">
                <i class="fa-solid fa-star me-1"></i><?php echo app('translator')->get('superadmin::lang.popular'); ?>
            </span>
        </div>
        <?php endif; ?>

        
        <h5 style="font-weight:700;color:#1e293b;margin-bottom:.75rem;font-size:1.1rem;"><?php echo e($package->name, false); ?></h5>

        
        <ul style="list-style:none;padding:0;margin:0 0 1rem;text-align:left;font-size:.88rem;color:#475569;line-height:2.2;">
            <li><i class="fa-solid fa-check" style="color:#10b981;width:18px;"></i>
                <?php if($package->location_count == 0): ?> <?php echo app('translator')->get('superadmin::lang.unlimited'); ?> <?php else: ?> <?php echo e($package->location_count, false); ?> <?php endif; ?>
                <?php echo app('translator')->get('business.business_locations'); ?>
            </li>
            <li><i class="fa-solid fa-check" style="color:#10b981;width:18px;"></i>
                <?php if($package->user_count == 0): ?> <?php echo app('translator')->get('superadmin::lang.unlimited'); ?> <?php else: ?> <?php echo e($package->user_count, false); ?> <?php endif; ?>
                <?php echo app('translator')->get('superadmin::lang.users'); ?>
            </li>
            <?php if(isset($package->workstation_count)): ?>
            <li><i class="fa-solid fa-check" style="color:#10b981;width:18px;"></i>
                <?php if($package->workstation_count == 0): ?> <?php echo app('translator')->get('superadmin::lang.unlimited'); ?> <?php else: ?> <?php echo e($package->workstation_count, false); ?> <?php endif; ?>
                <?php echo app('translator')->get('superadmin::lang.workstations'); ?>
            </li>
            <?php endif; ?>
            <li><i class="fa-solid fa-check" style="color:#10b981;width:18px;"></i>
                <?php if($package->product_count == 0): ?> <?php echo app('translator')->get('superadmin::lang.unlimited'); ?> <?php else: ?> <?php echo e($package->product_count, false); ?> <?php endif; ?>
                <?php echo app('translator')->get('superadmin::lang.products'); ?>
            </li>
            <li><i class="fa-solid fa-check" style="color:#10b981;width:18px;"></i>
                <?php if($package->invoice_count == 0): ?> <?php echo app('translator')->get('superadmin::lang.unlimited'); ?> <?php else: ?> <?php echo e($package->invoice_count, false); ?> <?php endif; ?>
                <?php echo app('translator')->get('superadmin::lang.invoices'); ?>
            </li>
            <?php if(!empty($package->custom_permissions)): ?>
                <?php $__currentLoopData = $package->custom_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(isset($permission_formatted[$permission])): ?>
                    <?php if(!empty($permission_numeric[$permission])): ?>
                        <?php if($value !== '' && $value !== null): ?>
                        <li><i class="fa-solid fa-layer-group" style="color:#6366f1;width:18px;"></i>
                            <?php if($value === 0 || $value === '0'): ?> <?php echo app('translator')->get('superadmin::lang.unlimited'); ?> <?php else: ?> <?php echo e($value, false); ?> <?php endif; ?>
                            <?php echo e($permission_formatted[$permission], false); ?>

                        </li>
                        <?php endif; ?>
                    <?php elseif(!empty($value)): ?>
                    <li><i class="fa-solid fa-check" style="color:#10b981;width:18px;"></i> <?php echo e($permission_formatted[$permission], false); ?></li>
                    <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <?php if($package->trial_days != 0): ?>
            <li><i class="fa-solid fa-gift" style="color:#6366f1;width:18px;"></i> <?php echo e($package->trial_days, false); ?> <?php echo app('translator')->get('superadmin::lang.trial_days'); ?></li>
            <?php endif; ?>
        </ul>

        
        <div style="margin-bottom:1rem;">
            <?php
                $interval_type = !empty($intervals[$package->interval]) ? $intervals[$package->interval] : __('lang_v1.' . $package->interval);
            ?>
            <?php if($package->price != 0): ?>
                <span style="font-size:1.5rem;font-weight:700;color:#6366f1;" class="display_currency" data-currency_symbol="true"><?php echo e($package->price, false); ?></span>
                <span style="font-size:.85rem;color:#94a3b8;font-weight:500;">/ <?php echo e($package->interval_count, false); ?> <?php echo e($interval_type, false); ?></span>
                <span class="converted_price_span hide" style="display:block;margin-top:.25rem;">
                    <input type="hidden" class="base_price" value="<?php echo e($package->price, false); ?>">
                    <span class="converted_price" style="font-size:.92rem;color:#64748b;font-weight:600;"></span>
                    <small style="color:#94a3b8;">/ <?php echo e($package->interval_count, false); ?> <?php echo e($interval_type, false); ?></small>
                </span>
            <?php else: ?>
                <span style="font-size:1.1rem;font-weight:700;color:#10b981;"><?php echo app('translator')->get('superadmin::lang.free_for_duration', ['duration' => $package->interval_count . ' ' . $interval_type]); ?></span>
            <?php endif; ?>
        </div>

        
        <div style="margin-top:auto;display:flex;flex-direction:column;gap:.45rem;">
            <?php if($package->enable_custom_link == 1): ?>
                <a href="<?php echo e($package->custom_link, false); ?>" class="btn btn-sm" style="background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:.5rem;font-weight:600;font-size:.85rem;padding:.55rem;"><?php echo e($package->custom_link_text, false); ?></a>
            <?php else: ?>
                <?php if(isset($action_type) && $action_type == 'register'): ?>
                    <a href="<?php echo e(registration_url(['package' => $package->id]), false); ?>" class="btn btn-sm" style="background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:.5rem;font-weight:600;font-size:.85rem;padding:.55rem;">
                        <?php if($package->price != 0): ?> <?php echo app('translator')->get('superadmin::lang.register_subscribe'); ?> <?php else: ?> <?php echo app('translator')->get('superadmin::lang.register_free'); ?> <?php endif; ?>
                    </a>
                <?php else: ?>
                    <?php if($package->price != 0 && empty($active) && $nexts->isEmpty() && $waiting->isEmpty() && $trial_ended->isEmpty() && empty($last_active)): ?>    
                    <form action="<?php echo e(action([\Modules\Superadmin\Http\Controllers\SubscriptionController::class, 'confirm'], [$package->id]), false); ?>" method="POST">
                        <?php echo e(csrf_field(), false); ?>

                        <input type="hidden" name="gateway" value="offline">
                        <input type="hidden" name="price" value="<?php echo e($package->price, false); ?>">
                        <input type="hidden" name="coupon_code" value="<?php echo e(null, false); ?>">
                        <button type="submit" class="btn btn-sm w-100" style="background:#ecfdf5;color:#059669;border:1px solid #a7f3d0;border-radius:.5rem;font-weight:600;font-size:.85rem;padding:.55rem;">
                            <i class="fa-solid fa-gift me-1"></i> <?php echo app('translator')->get('superadmin::lang.start_trial'); ?>
                        </button>
                    </form>
                    <?php endif; ?>
                    <a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\SubscriptionController::class, 'pay'], [$package->id]), false); ?>" class="btn btn-sm" style="background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:.5rem;font-weight:600;font-size:.85rem;padding:.55rem;">
                        <?php if($package->price != 0): ?> <i class="fa-solid fa-credit-card me-1"></i> <?php echo app('translator')->get('superadmin::lang.pay_and_subscribe'); ?> <?php else: ?> <?php echo app('translator')->get('superadmin::lang.subscribe'); ?> <?php endif; ?>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        
        <?php if($package->description): ?>
        <p style="font-size:.78rem;color:#94a3b8;margin-top:.75rem;margin-bottom:0;"><?php echo e($package->description, false); ?></p>
        <?php endif; ?>
    </div>
</div>
