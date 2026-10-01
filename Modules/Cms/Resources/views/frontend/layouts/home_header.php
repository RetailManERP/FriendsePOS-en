<header class="hero container-fluid">
    <div class="hero__content container mx-auto">
        <?php if ($__env->exists('cms::frontend.layouts.navbar')) echo $__env->make('cms::frontend.layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php
            $home_title = optional($page)->title ?? config('app.name');
            $home_content = optional($page)->content ?? '';
            $use_seo_intro = empty($home_content) || str_contains($home_content, 'unifies POS, inventory, accounting, CRM, and HR with 40+');
            if ($home_title === 'One Intelligent Platform to Run, Forecast, and Scale Your Business' || empty(optional($page)->title)) {
                $home_title = 'POS & ERP Software for Retail and Growing Businesses';
            }
        ?>

        
        <div class="hero__body col-lg-7 px-0">
            <div class="section-badge mb-3 reveal">
                <i class="fas fa-robot"></i>
                <span>AI-Powered POS & ERP Platform</span>
            </div>
            <h1 class="hero__title mb-3">
                <?php echo e($home_title, false); ?>

            </h1>
            <div class="hero__paragraph mx-0 mb-4">
                <?php if($use_seo_intro): ?>
                    <p><strong><?php echo e(config('app.name'), false); ?></strong> is a cloud-based POS and ERP platform for retail, wholesale and growing businesses. Connect <a href="<?php echo e(route('docs.public', 'sales-pos-guide'), false); ?>">Point of Sale</a>, <a href="<?php echo e(route('docs.public', 'stock-management-guide'), false); ?>">inventory management</a>, purchases, expenses and <a href="<?php echo e(route('docs.public', 'module-accounting'), false); ?>">accounting</a> with CRM, HR and multi-location operations.</p>
                    <p>Review <a href="<?php echo e(route('docs.public', 'reports-guide'), false); ?>">business reports</a>, explore AI assistance and use the <a href="<?php echo e(route('docs.public', 'desktop-app-guide'), false); ?>">desktop application</a> for your sales counter. <strong>Complete Control, Anywhere.</strong></p>
                <?php else: ?>
                    <?php echo $home_content; ?>

                <?php endif; ?>
            </div>
            <?php if(!empty($hero_btn['text'])): ?>
            <div class="hero__btns-container">
                <a class="hero__btn btn btn-primary btn-lg" href="<?php echo e($hero_btn['link'], false); ?>">
                    <span><?php echo e($hero_btn['text'], false); ?></span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <?php endif; ?>
            
            <?php if((!empty($andriod_btn['text']) && !empty($andriod_btn['link'])) || (!empty($andriod_btn_2['text']) && !empty($andriod_btn_2['link']))): ?>
                <div class="hero__btns-container mt-2">
                    <?php if(!empty($andriod_btn['text']) && !empty($andriod_btn['link'])): ?>
                        <a class="hero__btn btn btn-outline-secondary btn-sm" href="<?php echo e($andriod_btn['link'], false); ?>">
                            <i class="fab fa-google-play"></i>
                            <span><?php echo e(str_ireplace('Andriod', 'Android', $andriod_btn['text']), false); ?></span>
                        </a>
                    <?php endif; ?>
                    <?php if(!empty($andriod_btn_2['text']) && !empty($andriod_btn_2['link'])): ?>
                        <a class="hero__btn btn btn-outline-secondary btn-sm" href="<?php echo e($andriod_btn_2['link'], false); ?>">
                            <i class="fab fa-google-play"></i>
                            <span><?php echo e(str_ireplace('Andriod', 'Android', $andriod_btn_2['text']), false); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <?php if((!empty($ios_btn['text']) && !empty($ios_btn['link'])) || (!empty($ios_btn_2['text']) && !empty($ios_btn_2['link']))): ?>
                <div class="hero__btns-container mt-2">
                    <?php if(!empty($ios_btn['text']) && !empty($ios_btn['link'])): ?>
                        <a class="hero__btn btn btn-outline-secondary btn-sm" href="<?php echo e($ios_btn['link'], false); ?>">
                            <i class="fab fa-apple"></i>
                            <span><?php echo e($ios_btn['text'], false); ?></span>
                        </a>
                    <?php endif; ?>
                    <?php if(!empty($ios_btn_2['text']) && !empty($ios_btn_2['link'])): ?>
                        <a class="hero__btn btn btn-outline-secondary btn-sm" href="<?php echo e($ios_btn_2['link'], false); ?>">
                            <i class="fab fa-apple"></i>
                            <span><?php echo e($ios_btn_2['text'], false); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <?php if((!empty($download_win_btn['text']) && !empty($download_win_btn['link'])) || (!empty($download_win_btn_2['text']) && !empty($download_win_btn_2['link'])) || (!empty($download_linux_btn['text']) && !empty($download_linux_btn['link'])) || (!empty($download_osx_btn['text']) && !empty($download_osx_btn['link']))): ?>
                <div class="hero__btns-container mt-2">
                    <?php if(!empty($download_win_btn['text']) && !empty($download_win_btn['link'])): ?>
                        <a class="hero__btn btn btn-outline-secondary btn-sm" href="<?php echo e($download_win_btn['link'], false); ?>">
                            <i class="fab fa-windows"></i>
                            <span><?php echo e($download_win_btn['text'], false); ?></span>
                        </a>
                    <?php endif; ?>
                    <?php if(!empty($download_win_btn_2['text']) && !empty($download_win_btn_2['link'])): ?>
                        <a class="hero__btn btn btn-outline-secondary btn-sm" href="<?php echo e($download_win_btn_2['link'], false); ?>">
                            <i class="fab fa-windows"></i>
                            <span><?php echo e($download_win_btn_2['text'], false); ?></span>
                        </a>
                    <?php endif; ?>
                    <?php if(!empty($download_linux_btn['text']) && !empty($download_linux_btn['link'])): ?>
                        <a class="hero__btn btn btn-outline-secondary btn-sm" href="<?php echo e($download_linux_btn['link'], false); ?>">
                            <i class="fab fa-linux"></i>
                            <span><?php echo e($download_linux_btn['text'], false); ?></span>
                        </a>
                    <?php endif; ?>
                    <?php if(!empty($download_osx_btn['text']) && !empty($download_osx_btn['link'])): ?>
                        <a class="hero__btn btn btn-outline-secondary btn-sm" href="<?php echo e($download_osx_btn['link'], false); ?>">
                            <i class="fab fa-apple"></i>
                            <span><?php echo e($download_osx_btn['text'], false); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="hero__row d-block d-lg-flex row">
        <div class="hero__empty-column col-lg-7"></div>
        <?php
            $bg_img_url = asset('modules/cms/img/home.webp');
            if(!empty(optional($page)->feature_image_url)) {
                $bg_img_url = $page->feature_image_url;
            }
        ?>
        <div class="hero__image-column col-lg-5" 
            style="background-image: url(<?php echo e($bg_img_url, false); ?>);">
        </div>
    </div>
</header>
