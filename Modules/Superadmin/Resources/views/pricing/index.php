
<?php $__env->startSection('title', 'POS & ERP Software Pricing'); ?>
<?php $__env->startSection('meta'); ?>
    <?php echo $__env->make('layouts.partials.seo', [
        'seoTitle' => 'POS & ERP Software Pricing - ' . config('app.name'),
        'seoDescription' => 'Explore POS and ERP software pricing. Configure your package with the locations, users and modules your business needs, and review the available options.',
        'seoCanonical' => route('pricing'),
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php
    $intervals = ['days' => __('lang_v1.days'), 'months' => __('lang_v1.months'), 'years' => __('lang_v1.years')];
?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    /* ── Pricing Page – Aligned with Subscription Page design system ── */
    body { background: #f7f8fa; }

    /* ── Hero (public landing) ── */
    .pricing-hero { text-align: center; padding: 2rem 1rem .5rem; }
    .pricing-hero h1, .pricing-hero .h1 { font-size: 2rem; font-weight: 700; color: #1e293b; letter-spacing: -.5px; margin-bottom: .4rem; }
    .pricing-hero p.lead { font-size: 1.05rem; color: #64748b; max-width: 580px; margin: 0 auto; }

    /* ── Trial banner (matches sub-trial-banner) ── */
    .trial-banner {
        background: linear-gradient(90deg, rgb(var(--bs-primary-rgb)), rgba(var(--bs-primary-rgb), .7));
        color: #fff; border-radius: 1rem; padding: 1.25rem 2rem;
        display: flex; align-items: center; justify-content: center;
        gap: 1.25rem; flex-wrap: wrap; margin-bottom: 2rem;
        box-shadow: 0 8px 30px rgba(var(--bs-primary-rgb), .25);
    }
    .trial-banner .trial-icon { font-size: 2.5rem; line-height: 1; }
    .trial-banner .trial-text { flex: 1; min-width: 200px; }
    .trial-banner .trial-text strong { font-size: 1.25rem; display: block; }
    .trial-banner .trial-text span { opacity: .88; font-size: .92rem; }
    .trial-banner .btn-trial {
        background: #fff; color: var(--bs-primary); font-weight: 600; border: none;
        padding: .6rem 1.5rem; border-radius: .5rem; font-size: .95rem;
        text-decoration: none; transition: transform .15s, box-shadow .15s; white-space: nowrap;
    }
    .trial-banner .btn-trial:hover { transform: translateY(-2px); box-shadow: 0 4px 14px rgba(0,0,0,.12); }

    /* ── Widget wrapper (matches sub-widget) ── */
    .p-widget {
        background: #fff; border: 1px solid #e2e8f0; border-radius: 1rem;
        padding: 1.5rem; margin-bottom: 1.5rem;
    }
    .p-widget .widget-head {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 1.25rem; flex-wrap: wrap; gap: .5rem;
    }
    .p-widget .widget-head h5 { font-weight: 700; color: #1e293b; margin: 0; font-size: 1.1rem; }

    /* ── Section labels (matches sub-section-label) ── */
    .section-label {
        font-size: .75rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 1.5px; color: var(--bs-primary); margin-bottom: .35rem;
    }
    .section-title {
        font-size: 1.35rem; font-weight: 700; color: #1e293b; margin-bottom: 1.25rem;
    }

    /* ── Product cards (identical to subscription) ── */
    .pkg-card {
        background: #fff; border: 1px solid #e2e8f0; border-radius: 1rem;
        padding: 1.5rem 1.25rem; text-align: center;
        transition: transform .2s, box-shadow .2s;
        display: flex; flex-direction: column; height: 100%;
    }
    .pkg-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(0,0,0,.08); }
    .pkg-card.pkg-featured { border-color: var(--bs-primary); box-shadow: 0 0 0 2px rgba(var(--bs-primary-rgb),.15); }
    .pkg-icon {
        width: 56px; height: 56px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto .75rem; font-size: 1.4rem; color: #fff;
    }
    .pkg-icon.icon-indigo   { background: linear-gradient(135deg, #6366f1, #818cf8); }
    .pkg-icon.icon-emerald  { background: linear-gradient(135deg, #059669, #34d399); }
    .pkg-icon.icon-amber    { background: linear-gradient(135deg, #d97706, #fbbf24); }
    .pkg-icon.icon-rose     { background: linear-gradient(135deg, #e11d48, #fb7185); }
    .pkg-icon.icon-sky      { background: linear-gradient(135deg, #0284c7, #38bdf8); }
    .pkg-icon.icon-violet   { background: linear-gradient(135deg, #7c3aed, #a78bfa); }
    .pkg-icon.icon-teal     { background: linear-gradient(135deg, #0d9488, #5eead4); }
    .pkg-icon.icon-slate    { background: linear-gradient(135deg, #475569, #94a3b8); }

    .section-divider {
        display: flex; align-items: center; gap: 1rem; margin: 2rem 0 1.25rem;
    }
    .section-divider .section-icon {
        width: 40px; height: 40px; border-radius: 50%; display: flex;
        align-items: center; justify-content: center; font-size: 1rem; color: #fff; flex-shrink: 0;
    }
    .section-divider .section-icon.bg-indigo { background: linear-gradient(135deg, #6366f1, #818cf8); }
    .section-divider .section-icon.bg-violet { background: linear-gradient(135deg, #7c3aed, #a78bfa); }
    .section-divider .section-icon.bg-sky    { background: linear-gradient(135deg, #0284c7, #38bdf8); }
    .section-divider .section-text h6 { font-weight: 700; color: #1e293b; margin: 0; font-size: 1.1rem; }
    .section-divider .section-text small { font-size: .78rem; color: #64748b; }
    .pkg-card .pkg-name { font-size: 1rem; font-weight: 600; color: #1e293b; margin-bottom: .25rem; }
    .pkg-card .pkg-price { font-size: 1.35rem; font-weight: 700; color: var(--bs-primary); margin-bottom: .25rem; }
    .pkg-card .pkg-price-monthly { font-size: 1.35rem; font-weight: 700; color: var(--bs-primary); margin-bottom: .25rem; }
    .pkg-card .pkg-savings {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .35rem;
        margin: 0 auto .75rem;
        padding: .28rem .7rem;
        border-radius: 999px;
        background: #eff6ff;
        color: #1d4ed8;
        font-size: .72rem;
        font-weight: 700;
    }
    .summary-savings-wrap {
        display: flex;
        justify-content: flex-end;
        margin-bottom: .75rem;
    }
    .pkg-card .pkg-desc { font-size: .82rem; color: #94a3b8; margin-bottom: .75rem; }
    .pkg-card .pkg-actions { margin-top: auto; display: flex; flex-direction: column; gap: .4rem; }
    .pkg-card .btn-outline-primary { border-color: var(--bs-primary); color: var(--bs-primary); font-size: .82rem; border-radius: .5rem; }
    .pkg-card .btn-outline-primary:hover { background: var(--bs-primary); color: #fff; }
    .pkg-card .btn-primary-soft { background: var(--bs-primary); color: #fff; border: none; font-size: .82rem; border-radius: .5rem; }
    .pkg-card .btn-primary-soft:hover { background: var(--theme-primary-dark, var(--bs-primary)); }

    .badge-included {
        display: inline-block; background: #ecfdf5; color: #059669;
        font-size: .72rem; font-weight: 600; padding: .2rem .6rem;
        border-radius: 999px; margin-bottom: .4rem;
    }

    .billing-toggle-row {
        justify-content: center;
    }
    .billing-toggle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        padding: .3rem;
        background: #fff;
        border: 1px solid #dbe3ef;
        border-radius: .9rem;
        box-shadow: 0 10px 28px rgba(15, 23, 42, .06);
    }
    .billing-toggle .btn {
        min-width: 130px;
        border: 0;
        border-radius: .7rem !important;
        font-weight: 600;
        color: #475569;
        background: transparent;
        padding: .75rem 1.5rem;
    }
    .billing-toggle .btn:hover {
        color: var(--bs-primary);
        background: #f8fafc;
    }
    .billing-toggle .btn-check:checked + .btn {
        color: white !important;
        background: var(--bs-primary) !important;
        box-shadow: none;
    }

    /* ── Qty stepper (identical to subscription) ── */
    .qty-stepper {
        display: inline-flex; align-items: center; gap: 0;
        border: 1px solid #e2e8f0; border-radius: .5rem; overflow: hidden; margin-bottom: .5rem;
    }
    .qty-stepper .btn {
        border: none; border-radius: 0; width: 34px; height: 34px; padding: 0;
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem; background: #f8fafc; color: #475569;
    }
    .qty-stepper .btn:hover { background: #e2e8f0; }
    .qty-stepper input {
        width: 42px; text-align: center; border: none;
        border-left: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0;
        font-weight: 600; font-size: .9rem; height: 34px; padding: 0; background: #fff;
    }
    .qty-stepper input[readonly] {
        caret-color: transparent;
        cursor: default;
        pointer-events: none;
        user-select: none;
    }

    /* ── Summary panel ── */
    .summary-panel {
        background: #fff; border: 1px solid #e2e8f0; border-radius: 1rem;
        padding: 1.5rem; z-index: 1020;
        max-height: calc(100vh - 2rem); overflow-y: auto;
        transition: none;
    }
    .summary-panel.is-sticky {
        position: fixed;
    }
    .summary-col-placeholder {
        display: none;
    }
    .summary-panel .summary-head {
        display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;
    }
    .summary-panel .summary-head h5 { font-weight: 700; color: #1e293b; margin: 0; }
    .summary-panel table { width: 100%; font-size: .88rem; table-layout: fixed; }
    .summary-panel table th { color: #64748b; font-weight: 600; padding: .5rem 0; border-bottom: 2px solid #f1f5f9; }
    .summary-panel table td { padding: .45rem 0; color: #334155; border-bottom: 1px solid #f1f5f9; word-wrap: break-word; overflow-wrap: break-word; }
    .summary-panel table tfoot th { border-top: 2px solid #e2e8f0; border-bottom: none; padding-top: .75rem; }
    .summary-panel .total-row { font-size: 1.15rem; color: #1e293b; }
    .summary-panel .currency-row { font-size: .88rem; color: #64748b; }
    .summary-panel .currency-row select {
        border: 1px solid #e2e8f0; border-radius: .35rem; padding: .15rem .4rem;
        font-size: .82rem; color: #475569; background: #f8fafc;
    }

    .btn-get-quote {
        display: block; width: 100%;
        background: linear-gradient(135deg, rgb(var(--bs-primary-rgb)), rgba(var(--bs-primary-rgb), .7));
        color: #fff; font-weight: 600; font-size: 1.05rem;
        border: none; border-radius: .75rem; padding: .85rem; margin-top: 1.25rem;
        transition: transform .15s, box-shadow .15s;
    }
    .btn-get-quote:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(var(--bs-primary-rgb),.3); color: #fff; }

    /* ── Quote modal ── */
    .quote_customer_modal .modal-content { border-radius: 1rem; border: none; }
    .quote_customer_modal .modal-header { background: linear-gradient(135deg, rgb(var(--bs-primary-rgb)), rgba(var(--bs-primary-rgb), .7)); color: #fff; border-radius: 1rem 1rem 0 0; }
    .quote_customer_modal .modal-header .btn-close { filter: brightness(0) invert(1); }
    .quote_customer_modal .modal-body { padding: 1.5rem; }
    .quote_customer_modal .modal-footer { border-top: 1px solid #f1f5f9; }

    /* ── Hidden helper (core.css not loaded on auth layout) ── */
    .hidden { display: none !important; }

    /* ── Responsive ── */
    @media (max-width: 991px) {
        .summary-panel { margin-top: 2rem; max-height: none; overflow-y: visible; }
        .summary-panel.is-sticky { position: static !important; width: auto !important; }
    }
    @media (max-width: 575px) {
        .trial-banner { padding: 1rem; gap: .75rem; flex-direction: column; text-align: center; }
        .pricing-hero h1, .pricing-hero .h1 { font-size: 1.6rem; }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container" style="max-width: 1200px;">
    <?php echo $__env->make('superadmin::layouts.partials.currency', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <div class="pricing-hero">
        <?php echo $__env->make('layouts.partials.logo', ['plainBrandHeading' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <h1>POS &amp; ERP Software Pricing</h1>
        <p class="lead">Choose the base software, add locations, users &amp; powerful plugins &mdash; only pay for what you need.</p>
    </div>

    
    <div class="trial-banner">
        <div class="trial-icon"><i class="fa-solid fa-rocket"></i></div>
        <div class="trial-text">
            <strong>30 Days Free Trial &mdash; No Credit Card Required</strong>
            <span>Every package includes a full-featured 30-day trial. Explore everything risk-free.</span>
        </div>
        <a href="#pricing-builder" class="btn-trial">Start Free Trial <i class="fa-solid fa-arrow-right ms-1"></i></a>
    </div>

    
    <?php if($packages->count()): ?>
    <div class="p-widget">
        <div class="widget-head">
            <h5><i class="fa-solid fa-cubes me-2"></i> <?php echo app('translator')->get('superadmin::lang.packages'); ?></h5>
            <span class="badge bg-success bg-opacity-10 text-success" style="font-size:.78rem;"><i class="fa-solid fa-gift me-1"></i> 30-Day Trial Included</span>
        </div>
        <div class="row g-3">
            <?php $action_type = 'register'; ?>
            <?php echo $__env->make('superadmin::subscription.partials.packages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <?php endif; ?>

    <?php
        // ── Icon mapping: keyword → [icon, color-class] ──
        $iconMap = [
            'pos'           => ['fa-solid fa-cash-register',    'icon-indigo'],
            'point of sale' => ['fa-solid fa-cash-register',    'icon-indigo'],
            'base software' => ['fa-solid fa-cash-register',    'icon-indigo'],
            'location'      => ['fa-solid fa-store',            'icon-emerald'],
            'workstation'   => ['fa-solid fa-desktop',          'icon-sky'],
            'warehouse'     => ['fa-solid fa-warehouse',         'icon-amber'],
            'user'          => ['fa-solid fa-users',            'icon-violet'],
            'restaurant'    => ['fa-solid fa-utensils',         'icon-amber'],
            'manufacturing' => ['fa-solid fa-industry',         'icon-slate'],
            'repair'        => ['fa-solid fa-wrench',           'icon-amber'],
            'project'       => ['fa-solid fa-diagram-project',  'icon-teal'],
            'woocommerce'   => ['fa-solid fa-cart-shopping',    'icon-violet'],
            'e-commerce'    => ['fa-solid fa-globe',            'icon-sky'],
            'ecommerce'     => ['fa-solid fa-globe',            'icon-sky'],
            'accounting'    => ['fa-solid fa-calculator',       'icon-emerald'],
            'crm'           => ['fa-solid fa-address-book',     'icon-rose'],
            'hotel'         => ['fa-solid fa-hotel',            'icon-amber'],
            'hms'           => ['fa-solid fa-hotel',            'icon-amber'],
            'pharmacy'      => ['fa-solid fa-pills',            'icon-emerald'],
            'fbr'           => ['fa-solid fa-file-invoice',     'icon-sky'],
            'srb'           => ['fa-solid fa-file-invoice-dollar','icon-teal'],
            'api'           => ['fa-solid fa-code',             'icon-sky'],
            'integration'   => ['fa-solid fa-link',             'icon-sky'],
            'sms'           => ['fa-solid fa-comment-sms',      'icon-violet'],
            'whatsapp'      => ['fa-brands fa-whatsapp',        'icon-emerald'],
            'webhook'       => ['fa-solid fa-share-nodes',      'icon-teal'],
            'gateway'       => ['fa-solid fa-credit-card',      'icon-rose'],
            'payment'       => ['fa-solid fa-credit-card',      'icon-rose'],
            'inventory'     => ['fa-solid fa-boxes-stacked',    'icon-amber'],
            'report'        => ['fa-solid fa-chart-line',       'icon-teal'],
            'asset'         => ['fa-solid fa-building-columns', 'icon-slate'],
            'hr'            => ['fa-solid fa-people-group',     'icon-violet'],
            'human resource'=> ['fa-solid fa-people-group',     'icon-violet'],
            'barcode'       => ['fa-solid fa-barcode',          'icon-slate'],
            'label'         => ['fa-solid fa-tags',             'icon-amber'],
            'import'        => ['fa-solid fa-file-import',      'icon-teal'],
            'export'        => ['fa-solid fa-file-export',      'icon-sky'],
            'backup'        => ['fa-solid fa-cloud-arrow-up',   'icon-sky'],
            'notification'  => ['fa-solid fa-bell',             'icon-amber'],
        ];

        function getProductIcon($name, $iconMap) {
            $lower = strtolower($name);
            foreach ($iconMap as $keyword => $icon) {
                if (str_contains($lower, $keyword)) return $icon;
            }
            return ['fa-solid fa-puzzle-piece', 'icon-slate'];
        }

        // Section divider styles by category keyword
        $sectionStyles = [
            'core'        => ['icon' => 'fa-solid fa-microchip',     'bg' => 'bg-indigo'],
            'add-on'      => ['icon' => 'fa-solid fa-puzzle-piece',  'bg' => 'bg-violet'],
            'integration' => ['icon' => 'fa-solid fa-code',          'bg' => 'bg-sky'],
        ];
        $defaultSectionStyle = ['icon' => 'fa-solid fa-box', 'bg' => 'bg-slate'];

        function getSectionStyle($categoryName, $sectionStyles, $defaultSectionStyle) {
            $lower = strtolower($categoryName);
            foreach ($sectionStyles as $keyword => $style) {
                if (str_contains($lower, $keyword)) return $style;
            }
            return $defaultSectionStyle;
        }

        // Stepper config for PACKAGE# count products
        $stepperConfig = [
            'PACKAGE#location_count' => ['input_id' => 'location_count', 'name' => 'location_count', 'minus_id' => 'minus_location', 'plus_id' => 'plus_location', 'desc' => 'Per additional location'],
            'PACKAGE#workstation_count' => ['input_id' => 'workstation_count', 'name' => 'workstation_count', 'minus_id' => 'minus_workstation', 'plus_id' => 'plus_workstation', 'desc' => 'Per additional workstation'],
            'PACKAGE#warehouse_count' => ['input_id' => 'warehouse_count', 'name' => 'warehouse_count', 'minus_id' => 'minus_warehouse', 'plus_id' => 'plus_warehouse', 'desc' => 'Per additional warehouse'],
            'PACKAGE#user_count' => ['input_id' => 'user_count', 'name' => 'user_count', 'minus_id' => 'minus_user', 'plus_id' => 'plus_user', 'desc' => 'Per additional user'],
        ];

        $getPricingMeta = function ($product) {
            $variation = $product->variations[0] ?? null;
            $yearlyPrice = $variation->sell_price_inc_tax ?? 0;
            $monthlyGroupPrice = !empty($variation->group_prices) ? $variation->group_prices->first(function ($groupPrice) {
                return strcasecmp($groupPrice->price_group_name ?? '', 'Monthly') === 0;
            }) : null;
            $onetimeGroupPrice = !empty($variation->group_prices) ? $variation->group_prices->first(function ($groupPrice) {
                return strcasecmp($groupPrice->price_group_name ?? '', 'ONETIME') === 0;
            }) : null;
            $monthlyPrice = $monthlyGroupPrice->price_inc_tax ?? null;
            $onetimePrice = $onetimeGroupPrice->price_inc_tax ?? null;
            if (empty($monthlyPrice) || (float) $monthlyPrice <= 0) {
                $monthlyPrice = null;
            }
            if (empty($onetimePrice) || (float) $onetimePrice <= 0) {
                $onetimePrice = null;
            }
            $annualizedMonthlyPrice = !is_null($monthlyPrice) ? ($monthlyPrice * 12) : null;
            $yearlySavingsPercentage = null;

            if (!empty($annualizedMonthlyPrice) && $annualizedMonthlyPrice > $yearlyPrice) {
                $yearlySavingsPercentage = (int) round((($annualizedMonthlyPrice - $yearlyPrice) / $annualizedMonthlyPrice) * 100);
            }

            return [
                'yearly_price' => $yearlyPrice,
                'monthly_price' => $monthlyPrice,
                'onetime_price' => $onetimePrice,
                'has_monthly_price' => !is_null($monthlyPrice),
                'has_onetime_price' => !is_null($onetimePrice),
                'yearly_savings_percentage' => $yearlySavingsPercentage,
            ];
        };
    ?>

    <?php if($monthly_exists || $onetime_exists): ?>
    <div class="row g-1 mb-4 billing-toggle-row">
        <div class="btn-group billing-toggle" role="group" aria-label="Pricing type selector">
            <?php if($monthly_exists): ?>
            <input type="radio" class="btn-check" value="monthly" name="pricing_type" id="pricing_type_monthly" autocomplete="off">
            <label class="btn btn-outline-primary" for="pricing_type_monthly">Monthly</label>
            <?php endif; ?>

            <input type="radio" class="btn-check" value="yearly" name="pricing_type" id="pricing_type_yearly" autocomplete="off" checked>
            <label class="btn btn-outline-primary" for="pricing_type_yearly">Yearly</label>

            <?php if($onetime_exists): ?>
            <input type="radio" class="btn-check" value="onetime" name="pricing_type" id="pricing_type_onetime" autocomplete="off">
            <label class="btn btn-outline-primary" for="pricing_type_onetime">ONETIME</label>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    
    <?php if(!empty($location_count) && !empty($user_count) && !empty($base_software)): ?>
    <div class="p-widget" id="pricing-builder">
        <div class="widget-head">
            <h5><i class="fa-solid fa-wand-magic-sparkles me-2"></i> Create Your Own Package</h5>
            <span class="badge bg-success bg-opacity-10 text-success" style="font-size:.78rem;"><i class="fa-solid fa-gift me-1"></i> 30-Day Trial Included</span>
        </div>

        <?php echo Form::open(['url' => action([\Modules\Superadmin\Http\Controllers\PackagesController::class, 'postCreatePackageQuote']), 'method' => 'post', 'id' => 'create_custom_package_form' ]); ?>


        <input type="hidden" name="pricing_type" value="yearly" id="pricing_type_input">
        <div class="row g-4">
            
            <div class="col-lg-8">

                <?php $__currentLoopData = $productCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $catProducts = $productsByCategory[$category->id] ?? collect();
                        $sStyle = getSectionStyle($category->name, $sectionStyles, $defaultSectionStyle);
                    ?>
                    <?php if($catProducts->isNotEmpty()): ?>
                    <div class="section-divider product-section-divider">
                        <div class="section-icon <?php echo e($sStyle['bg'], false); ?>"><i class="<?php echo e($sStyle['icon'], false); ?>"></i></div>
                        <div class="section-text">
                            <h6><?php echo e($category->name, false); ?></h6>
                            <?php if($category->description): ?><small><?php echo e($category->description, false); ?></small><?php endif; ?>
                        </div>
                    </div>
                    <div class="row g-3 mb-4 product-section-row">
                        <?php $__currentLoopData = $catProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $pricingMeta = $getPricingMeta($product); ?>
                        <div class="col-sm-6 col-md-4 product-card-col" data-has-monthly="<?php echo e($pricingMeta['has_monthly_price'] ? 1 : 0, false); ?>" data-has-onetime="<?php echo e($pricingMeta['has_onetime_price'] ? 1 : 0, false); ?>">
                            <?php if($product->sku === 'PACKAGE#base_software'): ?>
                            
                            <div class="pkg-card pkg-featured">
                                <span class="badge-included"><i class="fa-solid fa-check me-1"></i> Included</span>
                                <?php [$pIcon, $pColor] = getProductIcon($product->name, $iconMap); ?>
                                <div class="pkg-icon <?php echo e($pColor, false); ?>"><i class="<?php echo e($pIcon, false); ?>"></i></div>
                                <div class="pkg-name"><?php echo e($product->name, false); ?></div>
                                <div class="pkg-price display_currency" data-currency_symbol="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pricingMeta['yearly_price'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                                <div class="pkg-price-monthly hidden display_currency" data-currency_symbol="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pricingMeta['monthly_price'] ?? 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                                <div class="pkg-price-onetime hidden display_currency" data-currency_symbol="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pricingMeta['onetime_price'] ?? 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                                <?php if(!is_null($pricingMeta['yearly_savings_percentage'])): ?>
                                    <div class="pkg-savings hidden"><i class="fa-solid fa-tag"></i> Save <?php echo e($pricingMeta['yearly_savings_percentage'], false); ?>% with yearly</div>
                                <?php endif; ?>
                                <div class="pkg-desc">Includes <?php echo e($product->product_custom_field1, false); ?> Location &amp; <?php echo e($product->product_custom_field2, false); ?> Users</div>
                                <div class="pkg-actions">
                                    <a class="btn btn-outline-primary btn-sm view-module" href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'viewModule'], ['id'=>$product->id, 'business_id'=>$product->business_id]), false); ?>"><i class="fa-solid fa-eye me-1"></i> View Details</a>
                                </div>
                            </div>
                            <?php elseif(isset($stepperConfig[$product->sku])): ?>
                            
                            <?php
                                $sc = $stepperConfig[$product->sku];
                            ?>
                            <div class="pkg-card">
                                <?php [$pIcon, $pColor] = getProductIcon($product->name, $iconMap); ?>
                                <div class="pkg-icon <?php echo e($pColor, false); ?>"><i class="<?php echo e($pIcon, false); ?>"></i></div>
                                <div class="pkg-name"><?php echo e($product->name, false); ?></div>
                                <div class="pkg-price display_currency" data-currency_symbol="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pricingMeta['yearly_price'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                                <div class="pkg-price-monthly hidden display_currency" data-currency_symbol="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pricingMeta['monthly_price'] ?? 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                                <div class="pkg-price-onetime hidden display_currency" data-currency_symbol="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pricingMeta['onetime_price'] ?? 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                                <?php if(!is_null($pricingMeta['yearly_savings_percentage'])): ?>
                                    <div class="pkg-savings hidden"><i class="fa-solid fa-tag"></i> Save <?php echo e($pricingMeta['yearly_savings_percentage'], false); ?>% with yearly</div>
                                <?php endif; ?>
                                <div class="pkg-desc"><?php echo e($sc['desc'], false); ?></div>
                                <div class="qty-stepper mx-auto">
                                    <button type="button" class="btn" id="<?php echo e($sc['minus_id'], false); ?>"><i class="fa-solid fa-minus"></i></button>
                                    <?php echo Form::number($sc['name'], 0, ['class'=>'form-control', 'id'=>$sc['input_id'], 'readonly', 'tabindex' => '-1', 'aria-readonly' => 'true', 'min'=> 0, 'max'=> 99, 'data-price'=> $pricingMeta['yearly_price'], 'data-price-yearly' => $pricingMeta['yearly_price'], 'data-price-monthly' => ($pricingMeta['monthly_price'] ?? 0), 'data-price-onetime' => ($pricingMeta['onetime_price'] ?? 0)]); ?>

                                    <button type="button" class="btn" id="<?php echo e($sc['plus_id'], false); ?>"><i class="fa-solid fa-plus"></i></button>
                                </div>
                                <div class="pkg-actions">
                                    <a class="btn btn-outline-primary btn-sm view-module" href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'viewModule'], ['id'=>$product->id, 'business_id'=>$product->business_id]), false); ?>"><i class="fa-solid fa-eye me-1"></i> View Details</a>
                                </div>
                            </div>
                            <?php else: ?>
                            
                            <div class="pkg-card">
                                <?php [$pIcon, $pColor] = getProductIcon($product->name, $iconMap); ?>
                                <div class="pkg-icon <?php echo e($pColor, false); ?>"><i class="<?php echo e($pIcon, false); ?>"></i></div>
                                <div class="pkg-name"><?php echo e($product->name, false); ?></div>
                                <div class="pkg-price display_currency" data-currency_symbol="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pricingMeta['yearly_price'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                                <div class="pkg-price-monthly hidden display_currency" data-currency_symbol="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pricingMeta['monthly_price'] ?? 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                                <div class="pkg-price-onetime hidden display_currency" data-currency_symbol="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pricingMeta['onetime_price'] ?? 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                                <?php if(!is_null($pricingMeta['yearly_savings_percentage'])): ?>
                                    <div class="pkg-savings hidden"><i class="fa-solid fa-tag"></i> Save <?php echo e($pricingMeta['yearly_savings_percentage'], false); ?>% with yearly</div>
                                <?php endif; ?>
                                <div class="pkg-desc">One-time add-on</div>
                                <div class="pkg-actions">
                                    <a class="btn btn-outline-primary btn-sm view-module" href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'viewModule'], ['id'=>$product->id, 'business_id'=>$product->business_id]), false); ?>"><i class="fa-solid fa-eye me-1"></i> View Details</a>
                                    <button type="button" class="btn btn-primary-soft btn-sm add_module"
                                        data-module_id="<?php echo e($product->id, false); ?>" data-module_name="<?php echo e($product->name, false); ?>" data-module_price="<?php echo e($pricingMeta['yearly_price'], false); ?>" data-module-price-yearly="<?php echo e($pricingMeta['yearly_price'], false); ?>" data-module-price-monthly="<?php echo e($pricingMeta['monthly_price'] ?? 0, false); ?>" data-module-price-onetime="<?php echo e($pricingMeta['onetime_price'] ?? 0, false); ?>">
                                        <i class="fa-solid fa-plus me-1"></i> Add to Package
                                    </button>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <?php $uncategorized = $productsByCategory->get('') ?? $productsByCategory->get(null) ?? collect(); ?>
                <?php if($uncategorized->isNotEmpty()): ?>
                <div class="section-divider product-section-divider">
                    <div class="section-icon bg-slate"><i class="fa-solid fa-box"></i></div>
                    <div class="section-text">
                        <h6>Other Products</h6>
                        <small>Additional items</small>
                    </div>
                </div>
                <div class="row g-3 mb-4 product-section-row">
                    <?php $__currentLoopData = $uncategorized; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $pricingMeta = $getPricingMeta($product); ?>
                    <div class="col-sm-6 col-md-4 product-card-col" data-has-monthly="<?php echo e($pricingMeta['has_monthly_price'] ? 1 : 0, false); ?>" data-has-onetime="<?php echo e($pricingMeta['has_onetime_price'] ? 1 : 0, false); ?>">
                        <?php if($product->sku === 'PACKAGE#base_software'): ?>
                        <div class="pkg-card pkg-featured">
                            <span class="badge-included"><i class="fa-solid fa-check me-1"></i> Included</span>
                            <?php [$pIcon, $pColor] = getProductIcon($product->name, $iconMap); ?>
                            <div class="pkg-icon <?php echo e($pColor, false); ?>"><i class="<?php echo e($pIcon, false); ?>"></i></div>
                            <div class="pkg-name"><?php echo e($product->name, false); ?></div>
                            <div class="pkg-price display_currency" data-currency_symbol="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pricingMeta['yearly_price'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                            <div class="pkg-price-monthly hidden display_currency" data-currency_symbol="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pricingMeta['monthly_price'] ?? 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                            <div class="pkg-price-onetime hidden display_currency" data-currency_symbol="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pricingMeta['onetime_price'] ?? 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                            <?php if(!is_null($pricingMeta['yearly_savings_percentage'])): ?>
                                <div class="pkg-savings hidden"><i class="fa-solid fa-tag"></i> Save <?php echo e($pricingMeta['yearly_savings_percentage'], false); ?>% with yearly</div>
                            <?php endif; ?>
                            <div class="pkg-desc">Includes <?php echo e($product->product_custom_field1, false); ?> Location &amp; <?php echo e($product->product_custom_field2, false); ?> Users</div>
                            <div class="pkg-actions">
                                <a class="btn btn-outline-primary btn-sm view-module" href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'viewModule'], ['id'=>$product->id, 'business_id'=>$product->business_id]), false); ?>"><i class="fa-solid fa-eye me-1"></i> View Details</a>
                            </div>
                        </div>
                        <?php elseif(isset($stepperConfig[$product->sku])): ?>
                        <?php
                            $sc = $stepperConfig[$product->sku];
                        ?>
                        <div class="pkg-card">
                            <?php [$pIcon, $pColor] = getProductIcon($product->name, $iconMap); ?>
                            <div class="pkg-icon <?php echo e($pColor, false); ?>"><i class="<?php echo e($pIcon, false); ?>"></i></div>
                            <div class="pkg-name"><?php echo e($product->name, false); ?></div>
                            <div class="pkg-price display_currency" data-currency_symbol="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pricingMeta['yearly_price'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                            <div class="pkg-price-monthly hidden display_currency" data-currency_symbol="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pricingMeta['monthly_price'] ?? 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                            <div class="pkg-price-onetime hidden display_currency" data-currency_symbol="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pricingMeta['onetime_price'] ?? 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                            <?php if(!is_null($pricingMeta['yearly_savings_percentage'])): ?>
                                <div class="pkg-savings hidden"><i class="fa-solid fa-tag"></i> Save <?php echo e($pricingMeta['yearly_savings_percentage'], false); ?>% with yearly</div>
                            <?php endif; ?>
                            <div class="pkg-desc"><?php echo e($sc['desc'], false); ?></div>
                            <div class="qty-stepper mx-auto">
                                <button type="button" class="btn" id="<?php echo e($sc['minus_id'], false); ?>"><i class="fa-solid fa-minus"></i></button>
                                <?php echo Form::number($sc['name'], 0, ['class'=>'form-control', 'id'=>$sc['input_id'], 'readonly', 'tabindex' => '-1', 'aria-readonly' => 'true', 'min'=> 0, 'max'=> 99, 'data-price'=> $pricingMeta['yearly_price'], 'data-price-yearly' => $pricingMeta['yearly_price'], 'data-price-monthly' => ($pricingMeta['monthly_price'] ?? 0), 'data-price-onetime' => ($pricingMeta['onetime_price'] ?? 0)]); ?>

                                <button type="button" class="btn" id="<?php echo e($sc['plus_id'], false); ?>"><i class="fa-solid fa-plus"></i></button>
                            </div>
                            <div class="pkg-actions">
                                <a class="btn btn-outline-primary btn-sm view-module" href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'viewModule'], ['id'=>$product->id, 'business_id'=>$product->business_id]), false); ?>"><i class="fa-solid fa-eye me-1"></i> View Details</a>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="pkg-card">
                            <?php [$pIcon, $pColor] = getProductIcon($product->name, $iconMap); ?>
                            <div class="pkg-icon <?php echo e($pColor, false); ?>"><i class="<?php echo e($pIcon, false); ?>"></i></div>
                            <div class="pkg-name"><?php echo e($product->name, false); ?></div>
                            <div class="pkg-price display_currency" data-currency_symbol="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pricingMeta['yearly_price'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                            <div class="pkg-price-monthly hidden display_currency" data-currency_symbol="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pricingMeta['monthly_price'] ?? 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                            <div class="pkg-price-onetime hidden display_currency" data-currency_symbol="true"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $pricingMeta['onetime_price'] ?? 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                            <?php if(!is_null($pricingMeta['yearly_savings_percentage'])): ?>
                                <div class="pkg-savings hidden"><i class="fa-solid fa-tag"></i> Save <?php echo e($pricingMeta['yearly_savings_percentage'], false); ?>% with yearly</div>
                            <?php endif; ?>
                            <div class="pkg-desc">One-time add-on</div>
                            <div class="pkg-actions">
                                <a class="btn btn-outline-primary btn-sm view-module" href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'viewModule'], ['id'=>$product->id, 'business_id'=>$product->business_id]), false); ?>"><i class="fa-solid fa-eye me-1"></i> View Details</a>
                                <button type="button" class="btn btn-primary-soft btn-sm add_module"
                                    data-module_id="<?php echo e($product->id, false); ?>" data-module_name="<?php echo e($product->name, false); ?>" data-module_price="<?php echo e($pricingMeta['yearly_price'], false); ?>" data-module-price-yearly="<?php echo e($pricingMeta['yearly_price'], false); ?>" data-module-price-monthly="<?php echo e($pricingMeta['monthly_price'] ?? 0, false); ?>" data-module-price-onetime="<?php echo e($pricingMeta['onetime_price'] ?? 0, false); ?>">
                                    <i class="fa-solid fa-plus me-1"></i> Add to Package
                                </button>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
            </div>

            
            <div class="col-lg-4 summary-col">
                <div class="summary-panel">
                    <?php
                        $baseSoftwarePricingMeta = !empty($base_software) ? $getPricingMeta($base_software) : null;
                        $locationPricingMeta = !empty($location_count) ? $getPricingMeta($location_count) : null;
                        $workstationPricingMeta = !empty($workstation_count) ? $getPricingMeta($workstation_count) : null;
                        $warehousePricingMeta = !empty($warehouse_count) ? $getPricingMeta($warehouse_count) : null;
                        $userPricingMeta = !empty($user_count) ? $getPricingMeta($user_count) : null;
                    ?>
                    <div class="summary-head">
                        <h5><i class="fa-solid fa-receipt me-2"></i>Your Package</h5>
                        <span class="badge bg-success bg-opacity-10 text-success" style="font-size:.78rem;"><i class="fa-solid fa-gift me-1"></i> 30-Day Trial</span>
                    </div>

                    <input type="hidden" id="row-count" value='0'>
                    <div>
<table id="package_detail_table">
                        <thead>
                            <tr>
                                <th style="width:55%">Item</th>
                                <th style="width:15%" class="text-center">Qty</th>
                                <th style="width:30%" class="text-end">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="base_module_tr" class="hidden">
                                <input type="hidden" value="">
                                <td id='module_name'></td>
                                <td class='item_qty text-center' data-item_qty="1">1</td>
                                <td id='module_price' class="display_currency item_price text-end" data-currency_symbol="true" data-item_price="0" data-item-price-yearly="0" data-item-price-monthly="0" data-item-price-onetime="0">0</td>
                            </tr>
                            <?php if(!empty($base_software)): ?>
                            <tr>
                                <input type="hidden" name="base_software" value="<?php echo e($base_software->id, false); ?>">
                                <td><?php echo e($base_software->name, false); ?> <br><small class="text-muted">(<?php echo e($base_software->product_custom_field1, false); ?> Loc, <?php echo e($base_software->product_custom_field2, false); ?> Users)</small></td>
                                <td class='item_qty text-center' data-item_qty="1">1</td>
                                <td class="display_currency item_price text-end" data-currency_symbol="true" data-item_price="<?php echo e($baseSoftwarePricingMeta['yearly_price'], false); ?>" data-item-price-yearly="<?php echo e($baseSoftwarePricingMeta['yearly_price'], false); ?>" data-item-price-monthly="<?php echo e($baseSoftwarePricingMeta['monthly_price'] ?? 0, false); ?>" data-item-price-onetime="<?php echo e($baseSoftwarePricingMeta['onetime_price'] ?? 0, false); ?>"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $baseSoftwarePricingMeta['yearly_price'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($location_count)): ?>
                            <tr id="additional_locations" class="hidden">
                                <td><?php echo e($location_count->name, false); ?> <br><small class="text-muted">+ <?php echo e($base_software->product_custom_field2, false); ?> Users</small></td>
                                <td id="package_locations" class='item_qty text-center' data-item_qty="0">0</td>
                                <td class="display_currency item_price text-end" data-currency_symbol="true" data-item_price="<?php echo e($locationPricingMeta['yearly_price'], false); ?>" data-item-price-yearly="<?php echo e($locationPricingMeta['yearly_price'], false); ?>" data-item-price-monthly="<?php echo e($locationPricingMeta['monthly_price'] ?? 0, false); ?>" data-item-price-onetime="<?php echo e($locationPricingMeta['onetime_price'] ?? 0, false); ?>"></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($workstation_count)): ?>
                            <tr id="additional_workstations" class="hidden">
                                <td><?php echo e($workstation_count->name, false); ?></td>
                                <td id="package_workstations" class='item_qty text-center' data-item_qty="0">0</td>
                                <td class="display_currency item_price text-end" data-currency_symbol="true" data-item_price="<?php echo e($workstationPricingMeta['yearly_price'], false); ?>" data-item-price-yearly="<?php echo e($workstationPricingMeta['yearly_price'], false); ?>" data-item-price-monthly="<?php echo e($workstationPricingMeta['monthly_price'] ?? 0, false); ?>" data-item-price-onetime="<?php echo e($workstationPricingMeta['onetime_price'] ?? 0, false); ?>"></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($warehouse_count)): ?>
                            <tr id="additional_warehouses" class="hidden">
                                <td><?php echo e($warehouse_count->name, false); ?></td>
                                <td id="package_warehouses" class='item_qty text-center' data-item_qty="0">0</td>
                                <td class="display_currency item_price text-end" data-currency_symbol="true" data-item_price="<?php echo e($warehousePricingMeta['yearly_price'], false); ?>" data-item-price-yearly="<?php echo e($warehousePricingMeta['yearly_price'], false); ?>" data-item-price-monthly="<?php echo e($warehousePricingMeta['monthly_price'] ?? 0, false); ?>" data-item-price-onetime="<?php echo e($warehousePricingMeta['onetime_price'] ?? 0, false); ?>"></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($user_count)): ?>
                            <tr id="additional_users" class="hidden">
                                <td><?php echo e($user_count->name, false); ?></td>
                                <td id="package_users" class='item_qty text-center' data-item_qty="0">0</td>
                                <td class="display_currency item_price text-end" data-currency_symbol="true" data-item_price="<?php echo e($userPricingMeta['yearly_price'], false); ?>" data-item-price-yearly="<?php echo e($userPricingMeta['yearly_price'], false); ?>" data-item-price-monthly="<?php echo e($userPricingMeta['monthly_price'] ?? 0, false); ?>" data-item-price-onetime="<?php echo e($userPricingMeta['onetime_price'] ?? 0, false); ?>"></td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot class="d-none">
                            <tr class="total-row">
                                <th></th>
                                <th>Total</th>
                                <th id="package_total" class="text-end" data-value="">0.00</th>
                            </tr>
                            <tr class="currency-row">
                                <td></td>
                                <td>
                                    Total in
                                    <select id="currency_code">
                                        <?php $default_currency = $detected_currency ?? $__system_currency->code; ?>
                                        <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($currency->code, false); ?>" data-symbol="<?php echo e($currency->symbol, false); ?>" data-country="<?php echo e($currency->country, false); ?>" <?php if($currency->code == $default_currency): ?> selected <?php endif; ?>><?php echo e($currency->code, false); ?> - <?php echo e($currency->country, false); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                                <td id="converted_price" class="text-end" data-value="">0.00</td>
                            </tr>
                        </tfoot>
                    </table>
</div>

                    <div class="d-flex justify-content-between align-items-center mt-3 pt-2" style="border-top: 2px solid #e2e8f0;">
                        <span style="font-size: 1.15rem; font-weight: 700; color: #1e293b;">Total</span>
                        <span id="package_total_fixed" style="font-size: 1.15rem; font-weight: 700; color: #1e293b;">0.00</span>
                    </div>
                    <div class="summary-savings-wrap">
                        <div id="package_total_savings" class="pkg-savings hidden"></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span style="font-size: .88rem; color: #64748b;">
                            Total in
                            <select id="currency_code_fixed" style="border: 1px solid #e2e8f0; border-radius: .35rem; padding: .15rem .4rem; font-size: .82rem; color: #475569; background: #f8fafc;">
                                <?php $default_currency = $detected_currency ?? $__system_currency->code; ?>
                                <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($currency->code, false); ?>" data-symbol="<?php echo e($currency->symbol, false); ?>" data-country="<?php echo e($currency->country, false); ?>" <?php if($currency->code == $default_currency): ?> selected <?php endif; ?>><?php echo e($currency->code, false); ?> - <?php echo e($currency->country, false); ?> (<?php echo e($currency->symbol, false); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </span>
                        <span id="converted_price_fixed" style="font-size: .88rem; color: #64748b;">0.00</span>
                    </div>

                    <a href="#" id="getQuote" class="btn btn-get-quote">
                        <i class="fa-solid fa-paper-plane me-2"></i> Get a Quote
                    </a>
                    <p class="text-center text-muted mt-2 mb-0" style="font-size:.78rem;">No commitment &mdash; we'll email your custom quote</p>

                    
                    <div class="modal fade quote_customer_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitle"><i class="fa-solid fa-envelope-open-text me-2"></i> Request Your Quote</h5>
                                    <button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">First Name <span class="text-danger">*</span></label>
                                            <?php echo Form::text('first_name', null, ['class' => 'form-control','placeholder' => 'First Name', 'required']); ?>

                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Last Name <span class="text-danger">*</span></label>
                                            <?php echo Form::text('last_name', null, ['class' => 'form-control','placeholder' => 'Last Name', 'required']); ?>

                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Business Name <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-building"></i></span>
                                                <?php echo Form::text('business_name', null, ['class' => 'form-control','placeholder' => 'Your Business Name', 'required']); ?>

                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                                <?php echo Form::email('email', null, ['class' => 'form-control','placeholder' => 'email@company.com', 'required']); ?>

                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold"><?php echo app('translator')->get('contact.mobile'); ?> <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                                <?php echo Form::text('mobile', null, ['class' => 'form-control', 'required', 'placeholder' => __('contact.mobile')]); ?>

                                            </div>
                                        </div>
                                        <?php if(config('constants.enable_recaptcha')): ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="g-recaptcha" data-sitekey="<?php echo e(config('constants.google_recaptcha_key'), false); ?>"></div>
                                                <?php if($errors->has('g-recaptcha-response')): ?>
                                                    <span class="text-danger"><?php echo e($errors->first('g-recaptcha-response'), false); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="request_quote" value="1">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
                                    <button type="submit" class="btn" style="background:linear-gradient(135deg,rgb(var(--bs-primary-rgb)),rgba(var(--bs-primary-rgb),.7));color:#fff;"><i class="fa-solid fa-paper-plane me-1"></i> Request Quote</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo Form::close(); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php if(config('constants.enable_recaptcha')): ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>
<script type="text/javascript">
    function updateSummarySavings(pricingType, yearlyTotal) {
        var savingsContainer = $('#package_total_savings');
        if (pricingType !== 'yearly') {
            savingsContainer.addClass('hidden').empty();
            return;
        }

        var monthlyAnnualTotal = 0;
        $('#package_detail_table tbody tr').not('.hidden').each(function(){
            var quantity = parseFloat($(this).find('.item_qty').attr('data-item_qty')) || 0;
            var monthlyUnitPrice = parseFloat($(this).find('.item_price').attr('data-item-price-monthly'));

            if (!quantity || isNaN(monthlyUnitPrice) || monthlyUnitPrice <= 0) {
                return;
            }

            monthlyAnnualTotal += quantity * monthlyUnitPrice * 12;
        });

        var savedAmount = monthlyAnnualTotal - yearlyTotal;
        if (savedAmount <= 0 || monthlyAnnualTotal <= 0) {
            savingsContainer.addClass('hidden').empty();
            return;
        }

        var savedPercentage = Math.round((savedAmount / monthlyAnnualTotal) * 100);
        savingsContainer
            .removeClass('hidden')
            .html('<i class="fa-solid fa-tag"></i> You saved ' + __currency_trans_from_en(savedAmount, true, true) + ' (' + savedPercentage + '%)');
    }

    function applyPricingType(pricingType) {
        $('#pricing_type_input').val(pricingType);

        var showMonthly = pricingType === 'monthly';
        var showOnetime = pricingType === 'onetime';
        var needsGroupPrice = showMonthly || showOnetime;
        $('.pkg-price').toggleClass('hidden', needsGroupPrice);
        $('.pkg-price-monthly').toggleClass('hidden', !showMonthly);
        $('.pkg-price-onetime').toggleClass('hidden', !showOnetime);
        $('.pkg-savings').toggleClass('hidden', !showMonthly);

        if (needsGroupPrice) {
            var groupPriceSuffix = showMonthly ? 'monthly' : 'onetime';
            // Remove selected modules that do not support the selected pricing.
            $('#package_detail_table tbody tr').each(function() {
                var row = $(this);
                var moduleInput = row.find('input[name^="modules["]');
                if (!moduleInput.length) {
                    return;
                }

                var groupRowPrice = parseFloat(row.find('.item_price').attr('data-item-price-' + groupPriceSuffix)) || 0;
                if (groupRowPrice > 0) {
                    return;
                }

                var moduleId = moduleInput.val();
                row.remove();

                if (moduleId) {
                    $('.add_module[data-module_id="' + moduleId + '"]')
                        .removeClass('btn-danger btn-success')
                        .addClass('btn-primary-soft')
                        .html('<i class="fa-solid fa-plus me-1"></i> Add to Package');
                }
            });

            // Reset additional counters to 0 if the selected pricing is unavailable.
            [
                {input: '#location_count', row: '#additional_locations', qty: '#package_locations'},
                {input: '#workstation_count', row: '#additional_workstations', qty: '#package_workstations'},
                {input: '#warehouse_count', row: '#additional_warehouses', qty: '#package_warehouses'},
                {input: '#user_count', row: '#additional_users', qty: '#package_users'}
            ].forEach(function(additionalItem) {
                var inputEl = $('#create_custom_package_form ' + additionalItem.input);
                if (!inputEl.length) {
                    return;
                }

                var groupUnitPrice = parseFloat(inputEl.attr('data-price-' + groupPriceSuffix)) || 0;
                if (groupUnitPrice > 0) {
                    return;
                }

                inputEl.val(0);
                var qtyEl = $('#package_detail_table ' + additionalItem.qty);
                qtyEl.text(0).attr('data-item_qty', 0);
                $('#package_detail_table ' + additionalItem.row).addClass('hidden');
            });
        }

        $('.product-card-col').each(function() {
            var hasMonthlyPricing = String($(this).attr('data-has-monthly')) === '1';
            var hasOnetimePricing = String($(this).attr('data-has-onetime')) === '1';
            $(this).toggle(!needsGroupPrice || (showMonthly && hasMonthlyPricing) || (showOnetime && hasOnetimePricing));
        });

        $('.product-section-row').each(function() {
            var hasVisibleProducts = $(this).find('.product-card-col:visible').length > 0;
            $(this).toggle(hasVisibleProducts);
            $(this).prev('.product-section-divider').toggle(hasVisibleProducts);
        });

        $('.add_module').each(function() {
            var nextPrice = $(this).attr('data-module-price-' + pricingType);
            if (typeof nextPrice === 'undefined' || nextPrice === false) {
                nextPrice = $(this).attr('data-module_price');
            }
            if (!nextPrice) {
                nextPrice = 0;
            }
            $(this).attr('data-module_price', nextPrice);
        });

        $('#create_custom_package_form input[data-price-yearly]').each(function() {
            var nextPrice = $(this).attr('data-price-' + pricingType);
            if (typeof nextPrice === 'undefined' || nextPrice === false) {
                nextPrice = $(this).attr('data-price');
            }
            if (!nextPrice) {
                nextPrice = 0;
            }
            $(this).attr('data-price', nextPrice);
        });

        $('#package_detail_table .item_price').each(function(){
            var nextPrice = $(this).attr('data-item-price-' + pricingType);
            if (typeof nextPrice !== 'undefined' && nextPrice !== false) {
                $(this).attr('data-item_price', nextPrice);
            }
        });

        get_custom_package_total();
    }

    $(document).ready(function(){
        $('#change_lang').change( function(){
            window.location = "<?php echo e(route('pricing'), false); ?>?lang=" + $(this).val();
        });
        function getSelectedPricingType() {
            return $('input[name="pricing_type"]:checked').val() || $('#pricing_type_input').val() || 'yearly';
        }

        $(document).on('change', '#pricing_type_monthly, #pricing_type_yearly, #pricing_type_onetime', function() {
            applyPricingType($(this).val());
        });

        $(document).on('click', 'a.view-module', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('href'),
                dataType: 'html',
                success: function(result) {
                    $('.view_modal')
                        .html(result)
                        .modal('show');
                    __currency_convert_recursively($('.view_modal'));
                },
            });
        });
        $(document).on('click', '#getQuote', function(e) {
            e.preventDefault();
            $('.quote_customer_modal').modal('show');
        });

        applyPricingType(getSelectedPricingType());

        // ── JS Sticky Summary Panel ──
        (function() {
            var panel = document.querySelector('.summary-panel');
            var col = document.querySelector('.summary-col');
            if (!panel || !col) return;

            var placeholder = document.createElement('div');
            placeholder.className = 'summary-col-placeholder';
            col.appendChild(placeholder);
            var savedH = 0;

            function onScroll() {
                if (window.innerWidth < 992) {
                    panel.classList.remove('is-sticky');
                    panel.style.cssText = '';
                    placeholder.style.display = 'none';
                    savedH = 0;
                    return;
                }
                var colRect = col.getBoundingClientRect();
                var panelH = panel.classList.contains('is-sticky') ? savedH : panel.offsetHeight;
                if (!panelH) panelH = panel.offsetHeight;
                var topGap = 16;

                if (colRect.top >= topGap) {
                    // Column top is in view – normal flow
                    panel.classList.remove('is-sticky');
                    panel.style.cssText = '';
                    placeholder.style.display = 'none';
                    savedH = panel.offsetHeight;
                } else if (colRect.bottom > panelH + topGap) {
                    // Column top scrolled past, but bottom still has room
                    if (!savedH) savedH = panel.offsetHeight;
                    placeholder.style.display = 'block';
                    placeholder.style.height = savedH + 'px';
                    panel.classList.add('is-sticky');
                    panel.style.position = 'fixed';
                    panel.style.top = topGap + 'px';
                    panel.style.left = colRect.left + 'px';
                    panel.style.width = colRect.width + 'px';
                } else {
                    // Scrolled past column bottom
                    if (!savedH) savedH = panel.offsetHeight;
                    placeholder.style.display = 'block';
                    placeholder.style.height = savedH + 'px';
                    panel.classList.add('is-sticky');
                    panel.style.position = 'fixed';
                    panel.style.top = (colRect.bottom - savedH) + 'px';
                    panel.style.left = colRect.left + 'px';
                    panel.style.width = colRect.width + 'px';
                }
            }

            // Capture-phase listener catches scroll on ANY ancestor
            document.addEventListener('scroll', onScroll, {capture: true, passive: true});
            window.addEventListener('scroll', onScroll, {passive: true});
            window.addEventListener('resize', function() { savedH = 0; onScroll(); });
            onScroll();
        })();
    });

    var p_conversion_price = 0;
    $('#currency_code, #currency_code_fixed').change(function(){
        var val = $(this).val();
        $('#currency_code').val(val);
        $('#currency_code_fixed').val(val);
        $('#__code').val(val);
        p_conversion_price = 0;
        get_custom_package_total();
    });

    // Auto-detect visitor's currency (server-side detected, auto-trigger conversion)
    $(document).ready(function(){
        var detectedCode = $('#currency_code_fixed').val();
        if (detectedCode) {
            $('#currency_code').val(detectedCode);
            $('#__code').val(detectedCode);
            p_conversion_price = 0;
            get_custom_package_total();
        }
    });

    async function get_custom_package_total(){
        var pricingType = $('#pricing_type_input').val() || 'yearly';
        var total = 0;
        $('#package_detail_table tbody tr').each(function(){
            var item_subtotal = $(this).find('.item_qty').attr('data-item_qty') * $(this).find('.item_price').attr('data-item_price');
            $(this).find('.item_price').text(__currency_trans_from_en(item_subtotal, true, true));
            total += item_subtotal;
        });

        $('#package_detail_table #package_total').text(__currency_trans_from_en(total, true, true));
        $('#package_detail_table #package_total').attr('data-value', total);

        const page_currency_code = $('#p_code').val().toLowerCase();
        const business_currency_code = $('#__code').val().toLowerCase();
        if(p_conversion_price == 0){
            await $.ajax({
                url: "<?php echo e(url('/'), false); ?>/business/convert-currency",
                type: "GET",
                data:{from:page_currency_code, to:business_currency_code},
                dataType: "json",
                success: function(result) {
                    if(result != 0){
                        p_conversion_price = result;
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + status);
                }
            });
        }

        var converted_total = total*p_conversion_price;
        $('#package_detail_table #converted_price').text(__currency_trans_from_en(converted_total));

        // Sync fixed total display outside the table
        $('#package_total_fixed').text($('#package_detail_table #package_total').text());
        $('#converted_price_fixed').text($('#package_detail_table #converted_price').text());
        updateSummarySavings(pricingType, total);
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>