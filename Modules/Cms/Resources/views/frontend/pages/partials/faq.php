<?php if(!empty($faqs) && isset($faqs)): ?>
    <section class="block-39 space-between-blocks">
        <div class="container">
            
            <div class="col-lg-8 mx-auto text-center px-0 mb-5 reveal">
                <div class="section-badge mx-auto mb-3">
                    <i class="fas fa-question-circle"></i>
                    <span>FAQ</span>
                </div>
                <h2 class="section-title">Questions About POS &amp; ERP Software?</h2>
                <p class="section-subtitle mx-auto">Learn about inventory, business locations, modules and getting started. Explore the <a href="<?php echo e(route('docs.public'), false); ?>">software documentation</a> or <a href="<?php echo e(route('cms.contact.us'), false); ?>">contact our team</a> for more information.</p>
            </div>
            
            <div class="row px-2 g-4">
                <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-6 reveal">
                        <div class="content-block">
                            <h3 class="content-block__title">
                                <?php echo e($faq['question'] ?? '', false); ?>

                            </h3>
                            <p class="content-block__paragraph">
                                <?php echo e($faq['answer'] ?? '', false); ?>

                            </p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
