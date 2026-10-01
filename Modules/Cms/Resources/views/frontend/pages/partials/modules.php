<?php
    $modules_data = $modules ?? [];
    $module_items = (isset($modules_data['content']) && is_array($modules_data['content'])) ? $modules_data['content'] : [];

    $modules_btn = [
        'text' => (isset($btns['modules']) && is_array($btns['modules']) && array_key_exists('text', $btns['modules'])) ? ($btns['modules']['text'] ?? '') : 'Explore All Modules',
        'link' => !empty($btns['modules']['link']) ? $btns['modules']['link'] : registration_url(),
    ];
?>
<?php if(!empty($module_items)): ?>
    <section class="block-modules space-between-blocks" id="modules">
        <div class="container">
            
            <div class="col-lg-8 mx-auto text-center px-0 mb-5 reveal">
                <div class="section-badge mx-auto mb-3">
                    <i class="fas fa-layer-group"></i>
                    <span>Advanced Modules</span>
                </div>
                <h2 class="section-title mb-3">
                    <?php echo e($modules_data['tagline'] ?? 'One Platform, Endless Capabilities', false); ?>

                </h2>
                <p class="section-subtitle mx-auto mb-0">
                    <?php echo e($modules_data['description'] ?? '', false); ?>

                </p>
            </div>

            
            <div id="cms-modules-splide" class="splide block-modules__splide reveal" aria-label="Advanced Modules">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php $__currentLoopData = $module_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!empty($item['title']) && !empty($item['description'])): ?>
                                <li class="splide__slide">
                                    <div class="module-card">
                                        <span class="module-card__icon">
                                            <i class="<?php echo e($item['icon'] ?? 'fas fa-cube', false); ?>"></i>
                                        </span>
                                        <?php if(!empty($item['tag'])): ?>
                                            <span class="module-card__tag"><?php echo e($item['tag'], false); ?></span>
                                        <?php endif; ?>
                                        <h3 class="module-card__title"><?php echo e($item['title'], false); ?></h3>
                                        <p class="module-card__desc"><?php echo e($item['description'], false); ?></p>
                                        <span class="module-card__link">
                                            <i class="fas fa-arrow-right"></i>
                                        </span>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>

            <?php if(!empty($modules_btn['text'])): ?>
                <div class="text-center mt-4 reveal">
                    <a href="<?php echo e($modules_btn['link'], false); ?>" class="btn btn-primary btn-lg">
                        <span><?php echo e($modules_btn['text'], false); ?></span>
                        <i class="fas fa-arrow-right" style="font-size: 0.8rem;"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>
