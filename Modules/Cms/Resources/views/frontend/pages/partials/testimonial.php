<?php if(!empty($testimonials) && count($testimonials) > 0): ?>
    <section class="block-20 space-between-blocks">
        <div class="container">
            
            <div class="col-lg-8 mx-auto text-center px-0 mb-5 reveal">
                <div class="section-badge mx-auto mb-3">
                    <i class="fas fa-heart"></i>
                    <span>Customer Success Stories</span>
                </div>
                <h2 class="section-title pb-3">Customer Experiences with <?php echo e(config('app.name'), false); ?></h2>
                <p class="section-subtitle mx-auto">Read customer feedback about using the software in daily business operations.</p>
            </div>
            
            <div class="row px-2 pt-4 mx-xxl-auto g-4" id="block__container">
                <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 mb-1 reveal">
                        <div class="testimonial-card-1">
                            <div class="block-20-person">
                                <div class="mb-2">
                                    <?php
                                        $__avatar_bg = 'EEF2FF';
                                        $__avatar_fg = '4F46E5';
                                        if (!empty($__cms_tc)) {
                                            $__avatar_fg = ltrim($__cms_tc['primary'], '#');
                                            $__avatar_bg = ltrim($__cms_tc['light'], '#');
                                        }
                                    ?>
                                    <img class="block-20-person__avatar" 
                                        src="<?php echo e($testimonial->feature_image_url ?? 'https://ui-avatars.com/api/?name='.urlencode($testimonial->title).'&background='.$__avatar_bg.'&color='.$__avatar_fg.'&bold=true', false); ?>"
                                        alt="<?php echo e($testimonial->title, false); ?>"
                                        loading="lazy">
                                </div>
                                <div class="flex-grow-1 d-flex flex-column">
                                    <span class="block-20-person__rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </span>
                                    <span class="block-20-person__name my-1">
                                        <?php echo e($testimonial->title, false); ?>

                                    </span>
                                </div>
                            </div>
                            <div class="testimonial-card-1__paragraph mb-3">
                                <?php echo $testimonial->content; ?>

                            </div>
                            <span class="testimonial-card-1__quote-symbol">
                                <i class="fas fa-quote-left"></i>
                            </span>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
