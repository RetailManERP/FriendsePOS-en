
<footer class="block-44">
    <div class="container py-4">
        <div class="row flex-column flex-md-row px-2 align-items-center justify-content-center">
            <?php if(isset($__site_details['follow_us']) && !empty($__site_details['follow_us'])): ?>
                <div class="flex-grow-1 col mb-3 mb-md-0">
                    <ul class="block-44__extra-links d-flex list-unstyled p-0 mb-0">
                        <?php $__currentLoopData = $__site_details['follow_us']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $follow_us): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($key == 'facebook' && !empty($follow_us)): ?>
                                <li class="mx-1">
                                    <a href="<?php echo e($follow_us??'#', false); ?>" target="_blank" rel="noopener" title="Facebook" aria-label="Facebook" class="block-44__link m-0">
                                        <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if($key == 'instagram' && !empty($follow_us)): ?>
                                <li class="mx-1">
                                    <a href="<?php echo e($follow_us??'#', false); ?>" target="_blank" rel="noopener" title="Instagram" aria-label="Instagram" class="block-44__link m-0">
                                        <i class="fab fa-instagram" aria-hidden="true"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if($key == 'twitter' && !empty($follow_us)): ?>
                                <li class="mx-1">
                                    <a href="<?php echo e($follow_us??'#', false); ?>" target="_blank" rel="noopener" title="Twitter" aria-label="Twitter" class="block-44__link m-0">
                                        <i class="fab fa-twitter" aria-hidden="true"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if($key == 'linkedin' && !empty($follow_us)): ?>
                                <li class="mx-1">
                                    <a href="<?php echo e($follow_us??'#', false); ?>" target="_blank" rel="noopener" title="LinkedIn" aria-label="LinkedIn" class="block-44__link m-0">
                                        <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if($key == 'youtube' && !empty($follow_us)): ?>
                                <li class="mx-1">
                                    <a href="<?php echo e($follow_us??'#', false); ?>" target="_blank" rel="noopener" title="YouTube" aria-label="YouTube" class="block-44__link m-0">
                                        <i class="fab fa-youtube" aria-hidden="true"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <p class="block-41__copyrights col col-md-auto text-md-end mb-0">
                &copy; <?php echo e(date('Y'), false); ?> <?php echo e(config('app.name', 'BitorePOS'), false); ?>. All rights reserved.
            </p>
        </div>
    </div>
</footer>
