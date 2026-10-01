
<?php $__env->startSection('title', $landing['title'] ?? ucfirst($landingGroup)); ?>
<?php $__env->startSection('css'); ?>
<style>
    .commercial-page { padding-top: 3rem; padding-bottom: 4rem; }
    .commercial-page .intro { max-width: 850px; font-size: 1.15rem; line-height: 1.8; }
    .commercial-page h1 { max-width: 950px; margin: 1rem 0; }
    .commercial-page h2 { margin-bottom: 1rem; }
    .commercial-page p, .commercial-page li { line-height: 1.8; }
    .commercial-card { border: 1px solid var(--cms-gray-200, #e5e7eb); border-radius: 1rem; padding: 1.5rem; height: 100%; }
    .commercial-card h2 { font-size: 1.4rem; }
    .commercial-page a:focus-visible { outline: 3px solid var(--cms-primary, #3097D1); outline-offset: 4px; }
</style>
<?php if(!$landing): ?>
    <link rel="stylesheet" href="<?php echo e(asset('modules/cms/css/industries.css?v=' . filemtime(public_path('modules/cms/css/industries.css'))), false); ?>">
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
    $buttons = \Modules\Cms\Entities\CmsSiteDetail::getValue('btns');
    $navbar_btn = [
        'text' => $buttons['navbar']['text'] ?? 'Contact us',
        'link' => $buttons['navbar']['link'] ?? route('cms.contact.us'),
    ];
?>
<?php echo $__env->make('cms::frontend.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(!$landing): ?>
    <?php echo $__env->make('cms::frontend.pages.partials.industries_directory', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
<main class="container commercial-page">
    <nav aria-label="Breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(url('/'), false); ?>">Home</a></li>
            <?php if($landing): ?>
                <li class="breadcrumb-item"><a href="<?php echo e(url($landingGroup), false); ?>"><?php echo e(ucfirst($landingGroup), false); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e($landing['title'], false); ?></li>
            <?php else: ?>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(ucfirst($landingGroup), false); ?></li>
            <?php endif; ?>
        </ol>
    </nav>
    <?php if($landing): ?>
        <h1><?php echo e($landing['h1'], false); ?></h1>
        <p class="intro"><?php echo e(str_replace('{brand}', config('app.name'), $landing['intro']), false); ?></p>
        <div class="row g-4 my-4">
            <?php $__currentLoopData = $landing['sections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$heading, $text]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <section class="col-lg-4"><div class="commercial-card"><h2><?php echo e($heading, false); ?></h2><p><?php echo e($text, false); ?></p></div></section>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <section class="my-5">
            <h2><?php echo e($landingGroup === 'features' ? 'How it works' : 'A connected business workflow', false); ?></h2>
            <ol><?php $__currentLoopData = $landing['steps']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($step, false); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ol>
        </section>
        <section class="my-5"><h2>Example use case</h2><p><?php echo e($landing['example'], false); ?></p></section>
        <section class="my-5">
            <h2>Related features and industries</h2>
            <ul>
                <?php $__currentLoopData = $landing['related']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $path): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(url($path), false); ?>"><?php echo e(\App\Support\CommercialPages::all()[$path]['title'], false); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </section>
        <?php if(count($landingDocs)): ?>
            <section class="my-5"><h2>Setup and workflow guides</h2><ul>
                <?php $__currentLoopData = $landingDocs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $docSlug => $docTitle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(route('docs.public', ['slug' => $docSlug]), false); ?>"><?php echo e($docTitle, false); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul></section>
        <?php endif; ?>
    <?php else: ?>
        <h1><?php echo e($landingGroup === 'features' ? 'POS and ERP Features for Connected Business Operations' : 'Find POS and ERP Workflows for Your Industry', false); ?></h1>
        <p class="intro"><?php echo e($landingGroup === 'features'
            ? config('app.name') . ' connects sales and inventory with business modules for production, repairs, rentals, warehouses and online stores. Start with the workflow you need, then explore related modules and practical documentation.'
            : 'Explore how ' . config('app.name') . ' supports the day-to-day work of different businesses. Each guide connects a specific operational need with relevant features and documentation.', false); ?></p>
        <div class="row g-4 my-4">
            <?php $__currentLoopData = $landingPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $path => $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <section class="col-md-6 col-lg-4"><div class="commercial-card">
                    <h2><a href="<?php echo e(url($path), false); ?>"><?php echo e($entry['title'], false); ?></a></h2>
                    <p><?php echo e($entry['description'], false); ?></p>
                </div></section>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <p><a href="<?php echo e(url($landingGroup === 'features' ? 'industries' : 'features'), false); ?>"><?php echo e($landingGroup === 'features' ? 'Explore business and industry workflows' : 'Explore features and modules', false); ?></a></p>
        <p><a href="<?php echo e(route('docs.public'), false); ?>">Browse documentation for accounting, CRM, HR, projects and other modules</a></p>
    <?php endif; ?>
    <section class="commercial-card mt-5">
        <h2>Explore the setup for your business</h2>
        <p>Module availability and configuration depend on your subscription and business requirements. Review the available options and discuss the workflows your team needs.</p>
        <?php if($landingPricing): ?><a class="btn btn-primary me-2 mb-2" href="<?php echo e(route('pricing'), false); ?>">Explore pricing and modules</a><?php endif; ?>
        <a class="btn btn-outline-primary mb-2" href="<?php echo e(route('cms.contact.us'), false); ?>">Discuss your requirements</a>
    </section>
</main>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<?php if(!$landing): ?>
<script src="<?php echo e(asset('modules/cms/js/industries.js?v=' . filemtime(public_path('modules/cms/js/industries.js'))), false); ?>" defer></script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('cms::frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>