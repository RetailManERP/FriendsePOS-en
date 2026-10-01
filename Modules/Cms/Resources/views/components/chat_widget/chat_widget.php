<?php
    //filter out chat
    $chats = (isset($__site_details['chat']) && !empty($__site_details['chat']['whatsapp'])) ? $__site_details['chat']['whatsapp'] : [];
    $chats_collection = collect($chats);
    $filtered_chats = $chats_collection->filter(function ($value, $key) {
        return !empty($value);
    });

    //filter out contact us to be included in chat widget
    $contact_us = (isset($__site_details['chat']) && !empty($__site_details['chat']['mobile'])) ? $__site_details['chat']['mobile'] : [];
    $contact_us_collection = collect($contact_us);
    $filtered_contact = $contact_us_collection->filter(function ($value, $key) {
        return !empty($value);
    });

    //filter out mail us to be included in chat widget
    $mail_us = (isset($__site_details['chat']) && !empty($__site_details['chat']['mail'])) ? $__site_details['chat']['mail'] : [];
    $mail_us_collection = collect($mail_us);
    $filtered_mail = $mail_us_collection->filter(function ($value, $key) {
        return !empty($value);
    });

    $filtered_socials = [];
    if(isset($__site_details['chat']) && !empty($__site_details['chat']['messanger_link'])) {
        $filtered_socials['messanger_link'] = $__site_details['chat']['messanger_link'];
    }

    if(isset($__site_details['chat']) && !empty($__site_details['chat']['telegram'])) {
        $filtered_socials['telegram'] = $__site_details['chat']['telegram'];
    }
?>
<!-- Start chatWidget Style Container ( Required )  -->
<?php if(count($filtered_chats) > 0 || count($filtered_contact) > 0 || count($filtered_mail) > 0 || count($filtered_socials) > 0): ?>
    <div class="container">
         
        <!-- Click To chatWidget Container --> 
        <div class="cp-style1 cp-right-bottom">
            
            <!-- Start Floating Panel Container -->
            <div class="cp-panel" id="contact-options-panel">
                
                <!-- Chat Button For Whatsapp -->
                 <?php if(count($filtered_chats) > 0): ?>
                    <?php $__currentLoopData = $filtered_chats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($chat)): ?>
                            <a class="cp-list cp-whatsapp" href="https://wa.me/<?php echo e(preg_replace('/\D+/', '', $chat), false); ?>" data-number="<?php echo e(preg_replace('/\D+/', '', $chat), false); ?>" data-message="" target="_blank" rel="noopener noreferrer">
                                <div class="cp-image">
                                    <i class="fab fa-whatsapp text-white fa-2x mt-2"></i>
                                </div>  
                                <div class="cp-content">
                                    <h2>Whatsapp</h2>
                                    <p>
                                        Chat on Whatsapp
                                    </p>
                                </div>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <!-- Chat Button For Facebook Messenger -->
                <?php if(!empty($filtered_socials['messanger_link'])): ?> 
                    <a class="cp-list" href="<?php echo e($filtered_socials['messanger_link'], false); ?>" target="_blank">
                        <div class="cp-image">
                            <i class="fab fa-facebook-messenger text-white fa-2x mt-2"></i>
                        </div>  
                        <div class="cp-content">
                            <h2>FB Messenger</h2>
                            <p>Get connected with Facebook</p>
                        </div>
                    </a>
                <?php endif; ?>

                <!-- Chat Button For Telegram -->
                <?php if(!empty($filtered_socials['telegram'])): ?>
                    <a class="cp-list" href="<?php echo e($filtered_socials['telegram'], false); ?>" target="_blank">
                        <div class="cp-image">
                            <i class="fab fa-telegram-plane text-white fa-2x mt-2"></i>
                        </div>  
                        <div class="cp-content">
                            <h2>Telegram</h2>
                            <p>Chat on Telegram</p>
                        </div>
                    </a>
                <?php endif; ?>

                <!-- Mail Button For Email -->
                <?php if(count($filtered_mail) > 0): ?>
                    <?php $__currentLoopData = $filtered_mail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="cp-list" href="mailto:<?php echo e($chat, false); ?>" target="_blank">
                            <div class="cp-image">
                                <i class="far fa-envelope text-white fa-2x mt-2"></i>
                            </div>  
                            <div class="cp-content">
                                <h2>Email</h2>
                                <p>Send Email</p>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <!-- Call Button For Phone Number -->
                <?php if(count($filtered_contact) > 0): ?>
                    <?php $__currentLoopData = $filtered_contact; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($chat)): ?>
                            <a class="cp-list" href="tel:+<?php echo e($chat, false); ?>" target="_blank">
                                <div class="cp-image">
                                    <i class="fas fa-phone-volume text-white fa-2x mt-2"></i>
                                </div>  
                                <div class="cp-content">
                                    <h2>Call</h2>
                                    <p>Talk with us over telephone</p>
                                </div>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

            </div>
            <!--/ End Floating Panel Container -->

            <!-- Start Right Floating Button -->
            <button type="button" class="cp-button cp-right-bottom" aria-label="Open contact options" aria-controls="contact-options-panel" aria-expanded="false">
                <i id="cp-cmt-o" class="far fa-comments fa-lg"></i>
            </button>
            <!--/ End Right Floating Button -->

        </div>
    </div>
<?php endif; ?>
<!--/ End chatWidget Style Container -->
