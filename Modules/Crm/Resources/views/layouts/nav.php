<section class="no-print">
    <style type="text/css">
        #contacts_login_dropdown::after {
            display: inline-block;
            width: 0;
            height: 0;
            margin-left: 0.255em;
            vertical-align: 0.255em;
            content: "";
            border-top: 0.3em solid;
            border-right: 0.3em solid transparent;
            border-bottom: 0;
            border-left: 0.3em solid transparent;
        }
    </style>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm m-4 px-3">
        <div class="container-fluid px-0">
            <a class="navbar-brand fw-semibold" href="<?php echo e(action([\Modules\Crm\Http\Controllers\CrmDashboardController::class, 'index']), false); ?>"><i class="fas fa-broadcast-tower me-2"></i><?php echo e(__('crm::lang.crm'), false); ?></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#crm-navbar" aria-controls="crm-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="crm-navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if(auth()->user()->can('crm.access_all_leads') || auth()->user()->can('crm.access_own_leads')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'leads'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Crm\Http\Controllers\LeadController::class, 'index']). '?lead_view=list_view', false); ?>"><?php echo app('translator')->get('crm::lang.leads'); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if(auth()->user()->can('crm.access_all_schedule') || auth()->user()->can('crm.access_own_schedule')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'follow-ups'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Crm\Http\Controllers\ScheduleController::class, 'index']), false); ?>"><?php echo app('translator')->get('crm::lang.follow_ups'); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if(auth()->user()->can('crm.access_all_campaigns') || auth()->user()->can('crm.access_own_campaigns')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'campaigns'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Crm\Http\Controllers\CampaignController::class, 'index']), false); ?>"><?php echo app('translator')->get('crm::lang.campaigns'); ?></a>
                    </li>
                    <?php endif; ?>                    

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crm.access_contact_login')): ?>
                        <li class="nav-item dropdown <?php if(request()->segment(2) == 'all-contacts-login' || request()->segment(2) == 'commissions'): ?> active <?php endif; ?>">
                            <a class="nav-link dropdown-toggle" href="#" id="contacts_login_dropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo app('translator')->get('crm::lang.contacts_login'); ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="contacts_login_dropdown">
                              <a class="dropdown-item" href="<?php echo e(action([\Modules\Crm\Http\Controllers\ContactLoginController::class, 'allContactsLoginList']), false); ?>"> <?php echo app('translator')->get('crm::lang.contacts_login'); ?></a>
                              <a class="dropdown-item" href="<?php echo e(action([\Modules\Crm\Http\Controllers\ContactLoginController::class, 'commissions']), false); ?>"><?php echo app('translator')->get('crm::lang.commissions'); ?></a>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if((auth()->user()->can('crm.view_all_call_log') || auth()->user()->can('crm.view_own_call_log')) && config('constants.enable_crm_call_log')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'call-log'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Crm\Http\Controllers\CallLogController::class, 'index']), false); ?>"><?php echo app('translator')->get('crm::lang.call_log'); ?></a>
                    </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crm.view_reports')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'reports'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Crm\Http\Controllers\ReportController::class, 'index']), false); ?>"><?php echo app('translator')->get('report.reports'); ?></a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'proposal-template'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Crm\Http\Controllers\ProposalTemplateController::class, 'index']), false); ?>">
                            <?php echo app('translator')->get('crm::lang.proposal_template'); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'proposals'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Crm\Http\Controllers\ProposalController::class, 'index']), false); ?>">
                            <?php echo app('translator')->get('crm::lang.proposals'); ?>
                        </a>
                    </li>
                    <?php if(auth()->user()->can('crm.access_b2b_marketplace') && config('constants.enable_b2b_marketplace')): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'b2b-marketplace'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Crm\Http\Controllers\CrmMarketplaceController::class, 'index']), false); ?>">
                            <?php echo app('translator')->get('crm::lang.b2b_marketplace'); ?>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crm.access_sources')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->get('type') == 'source'): ?> active <?php endif; ?>" href="<?php echo e(action([\App\Http\Controllers\TaxonomyController::class, 'index']) . '?type=source', false); ?>"><?php echo app('translator')->get('crm::lang.sources'); ?></a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crm.access_life_stage')): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->get('type') == 'life_stage'): ?> active <?php endif; ?>" href="<?php echo e(action([\App\Http\Controllers\TaxonomyController::class, 'index']) . '?type=life_stage', false); ?>"><?php echo app('translator')->get('crm::lang.life_stage'); ?></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php if(request()->get('type') == 'followup_category'): ?> active <?php endif; ?>" href="<?php echo e(action([\App\Http\Controllers\TaxonomyController::class, 'index']) . '?type=followup_category', false); ?>"><?php echo app('translator')->get('crm::lang.followup_category'); ?></a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(request()->segment(2) == 'settings'): ?> active <?php endif; ?>" href="<?php echo e(action([\Modules\Crm\Http\Controllers\CrmSettingsController::class, 'index']), false); ?>">
                            <?php echo app('translator')->get('business.settings'); ?>
                        </a>
                    </li>
                </ul>

            </div>
        </div><!-- /.container-fluid -->
    </nav>
</section>
