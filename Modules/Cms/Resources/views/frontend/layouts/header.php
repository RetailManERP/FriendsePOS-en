<header class="hero container-fluid" style="min-height: auto; box-shadow: none; background: var(--cms-gray-50);">
    <div class="hero__content container mx-auto">
        <?php if ($__env->exists('cms::frontend.layouts.navbar')) echo $__env->make('cms::frontend.layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</header>
