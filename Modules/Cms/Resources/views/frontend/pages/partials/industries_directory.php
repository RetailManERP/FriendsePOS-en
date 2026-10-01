<?php
    $isFeatures = $landingGroup === 'features';
    $directorySingular = $isFeatures ? 'feature' : 'industry';
    $directoryPlural = $isFeatures ? 'features' : 'industries';
    $industryPresentation = [
        'retail-wholesale' => ['Retail & Wholesale', 'fas fa-store', 'Sales & stock', 'green'],
        'pharmacy' => ['Pharmacy', 'fas fa-prescription-bottle-alt', 'Batches & expiry', 'pink'],
        'electronics-mobile' => ['Electronics & Mobile', 'fas fa-mobile-alt', 'Serials & repairs', 'blue'],
        'repair-service' => ['Repair & Service', 'fas fa-tools', 'Jobs & spare parts', 'amber'],
        'manufacturing' => ['Manufacturing', 'fas fa-industry', 'Materials & production', 'green'],
        'warehouse-distribution' => ['Warehouse & Distribution', 'fas fa-warehouse', 'Stock & transfers', 'blue'],
        'ecommerce-retail' => ['eCommerce & Retail', 'fas fa-shopping-bag', 'Online & in-store', 'pink'],
        'rental' => ['Rental Businesses', 'fas fa-key', 'Availability & returns', 'amber'],
    ];
    if ($isFeatures) {
        $industryPresentation = [
            'pos-software' => ['Point of Sale', 'fas fa-cash-register', 'Sales & checkout', 'green'],
            'inventory-management' => ['Inventory Management', 'fas fa-boxes', 'Stock & purchasing', 'blue'],
            'manufacturing' => ['Manufacturing', 'fas fa-industry', 'Materials & production', 'amber'],
            'repair-management' => ['Repair Management', 'fas fa-tools', 'Jobs & spare parts', 'pink'],
            'warehouse-management' => ['Warehouse Management', 'fas fa-warehouse', 'Locations & transfers', 'blue'],
            'ecommerce-integrations' => ['eCommerce Integrations', 'fas fa-shopping-bag', 'Online & in-store', 'pink'],
            'rental-management' => ['Rental Management', 'fas fa-key', 'Bookings & returns', 'green'],
        ];
    }
?>
<main class="industry-directory">
    <section class="industry-hero" aria-labelledby="industries-heading">
        <img class="industry-hero__image" src="<?php echo e(asset('modules/cms/img/industries-retail.jpg'), false); ?>" alt="" fetchpriority="high" width="1800" height="1200">
        <div class="container industry-hero__content">
            <nav aria-label="Breadcrumb" class="industry-breadcrumb"><a href="<?php echo e(url('/'), false); ?>">Home</a><i class="fas fa-chevron-right" aria-hidden="true"></i><span aria-current="page"><?php echo e(ucfirst($landingGroup), false); ?></span></nav>
            <p class="industry-eyebrow"><?php echo e(config('app.name'), false); ?> / <?php echo e($isFeatures ? 'Features & modules' : 'Business solutions', false); ?></p>
            <h1 id="industries-heading"><?php if($isFeatures): ?>POS & ERP features<br>for your business.<?php else: ?> POS & ERP for<br>your industry.<?php endif; ?></h1>
            <p class="industry-hero__intro"><?php echo e($isFeatures ? 'Connect checkout, inventory and business operations with practical modules for production, repairs, rentals, warehouses and online stores.' : 'From the shop floor to the warehouse, connect your sales, stock and everyday operations with workflows built around your business.', false); ?></p>
            <a href="#industry-explorer" class="industry-action industry-action--light"><?php echo e($isFeatures ? 'Explore features' : 'Find your industry', false); ?> <i class="fas fa-arrow-down" aria-hidden="true"></i></a>
        </div>
    </section>

    <section id="industry-explorer" class="industry-explorer container" aria-labelledby="explorer-heading">
        <div class="industry-explorer__header">
            <div><p class="industry-eyebrow"><?php echo e($isFeatures ? 'Your workflows. One connected platform.' : 'Different businesses. Connected operations.', false); ?></p><h2 id="explorer-heading"><?php echo e($isFeatures ? 'Find the tools you need.' : 'Find your business.', false); ?></h2><p>Explore the workflows that matter to your team.</p></div>
            <div class="industry-search"><label for="industry-search">Search <?php echo e($directoryPlural, false); ?></label><div class="industry-search__control"><i class="fas fa-search" aria-hidden="true"></i><input type="search" id="industry-search" placeholder="<?php echo e($isFeatures ? 'Search features & modules' : 'Search your industry', false); ?>" autocomplete="off" aria-controls="industry-grid" data-singular="<?php echo e($directorySingular, false); ?>" data-plural="<?php echo e($directoryPlural, false); ?>"></div></div>
        </div>
        <p id="industry-results" class="industry-results" role="status" aria-live="polite"><?php echo e(count($landingPages), false); ?> <?php echo e($directoryPlural, false); ?></p>
        <div id="industry-grid" class="industry-grid">
            <?php $__currentLoopData = $landingPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $path => $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $slug = basename($path);
                    [$label, $icon, $workflow, $tone] = $industryPresentation[$slug] ?? [$entry['title'], 'fas fa-building', 'Business operations', 'green'];
                ?>
                <a class="industry-tile industry-tile--<?php echo e($tone, false); ?>" href="<?php echo e(url($path), false); ?>" data-industry-search="<?php echo e(strtolower($label . ' ' . $entry['title'] . ' ' . $entry['description'] . ' ' . $workflow), false); ?>">
                    <div class="industry-tile__top"><span class="industry-tile__icon"><i class="<?php echo e($icon, false); ?>" aria-hidden="true"></i></span><span class="industry-tile__workflow"><?php echo e($workflow, false); ?></span></div>
                    <h3><?php echo e($label, false); ?></h3><p><?php echo e($entry['description'], false); ?></p>
                    <span class="industry-tile__link"><?php echo e($isFeatures ? 'Explore feature' : 'Explore solution', false); ?> <i class="fas fa-arrow-right" aria-hidden="true"></i></span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div id="industry-empty" class="industry-empty" hidden><i class="fas fa-search" aria-hidden="true"></i><h3>No matching <?php echo e($directoryPlural, false); ?></h3><p>Try a different search or talk to us about your business.</p><button type="button" id="industry-reset" class="industry-action">Clear search <i class="fas fa-times" aria-hidden="true"></i></button></div>
    </section>

    <section class="industry-resources">
        <div class="container industry-resources__inner"><div><p class="industry-eyebrow">One connected platform</p><h2>The right tools for your next step.</h2><p>Explore modules and practical guides for your business operations.</p></div><div class="industry-resources__links"><a href="<?php echo e(url($isFeatures ? 'industries' : 'features'), false); ?>"><span><i class="fas <?php echo e($isFeatures ? 'fa-store' : 'fa-th-large', false); ?>" aria-hidden="true"></i><?php echo e($isFeatures ? 'Explore industry solutions' : 'Explore features & modules', false); ?></span><i class="fas fa-arrow-right" aria-hidden="true"></i></a><a href="<?php echo e(route('docs.public'), false); ?>"><span><i class="fas fa-book-open" aria-hidden="true"></i>Browse workflow guides</span><i class="fas fa-arrow-right" aria-hidden="true"></i></a></div></div>
    </section>
    <section class="industry-contact container"><div><p class="industry-eyebrow">Let's talk business</p><h2>Find the setup that fits.</h2><p>Tell us what your team needs. We'll help you explore available modules and configuration options.</p></div><div class="industry-contact__actions"><a href="<?php echo e(route('cms.contact.us'), false); ?>" class="industry-action">Discuss your requirements <i class="fas fa-arrow-right" aria-hidden="true"></i></a><?php if($landingPricing): ?><a class="industry-pricing" href="<?php echo e(route('pricing'), false); ?>">View pricing <i class="fas fa-arrow-right" aria-hidden="true"></i></a><?php endif; ?></div></section>
</main>
