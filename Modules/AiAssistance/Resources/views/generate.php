<div class="col-md-12">
    <div class="box box-success box-solid">
        <div class="box-body">
        
        <?php
            $class = rand();
        ?>

        <div id="<?php echo e($class, false); ?>" contenteditable="true" style="min-height: 80px; border: 1px solid #e0e0e0; background: #fcfcfc; padding: 10px; border-radius: 4px; outline: none;">
            <?php echo nl2br($text); ?>

        </div>

        <br/>

        <i class="fas fa-copy pull-right cursor-pointer" onclick="copyToClipboard(<?php echo e($class, false); ?>)" title="Copy"></i>
        </div>

    </div>

</div>