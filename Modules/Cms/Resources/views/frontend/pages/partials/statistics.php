<?php if(!empty($statistics)): ?>
    <section class="block-38 space-between-blocks">
        <div class="container">
            
            <div class="col-lg-8 mx-auto text-center px-0 mb-5 reveal">
                <div class="section-badge mx-auto mb-3">
                    <i class="fas fa-robot"></i>
                    <span>Business Overview</span>
                </div>
                <h2 class="section-title mb-3">
                    <?php echo e($statistics['tagline'] ?? '', false); ?>

                </h2>
                <p class="section-subtitle mx-auto mb-0">
                    <?php echo e($statistics['description'] ?? '', false); ?>

                </p>
            </div>
            
            <ul class="stats row list-unstyled text-center mx-auto p-4 p-lg-5 reveal">
                <?php if(isset($statistics['content']) && !empty($statistics['content'])): ?>
                    <?php $__currentLoopData = $statistics['content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="stats__li col-6 col-lg-3 p-0">
                            <span class="stats__number">
                                <?php echo e($stats['stats'] ?? '', false); ?>

                            </span>
                            <p class="stats__text">
                                <?php echo e($stats['title'] ?? '', false); ?>

                            </p>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </ul>
        </div>
    </section>
<?php endif; ?>
