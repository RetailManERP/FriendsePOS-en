<div class="pos-tab-content">
    <div class="row">
        <div class="col-xs-12">
            <h4><?php echo app('translator')->get('superadmin::lang.maintenance_tools'); ?></h4>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <a href="<?php echo e(url('/superadmin/fix-uploads-folder'), false); ?>"
                   class="btn btn-warning btn-block"
                   id="fix_uploads_folder_btn"
                   onclick="return confirm('This will move files from legacy upload folders into business-specific folders. Continue?');">
                    <i class="fas fa-folder-open"></i> <?php echo app('translator')->get('superadmin::lang.fix_uploads_folder'); ?>
                </a>
                <p class="help-block"><?php echo app('translator')->get('superadmin::lang.fix_uploads_folder_help'); ?></p>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <a class="btn btn-success bg-green btn-block"
                    href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\SuperadminController::class, 'fixProductImageRepeats']), false); ?>">
                    Fix Default Product Image Repeats
                </a>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <a class="btn btn-primary btn-block"
                    href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\SuperadminController::class, 'renameProductImagesBySku']), false); ?>"
                    onclick="return confirm('This will rename existing product image files by SKU and update product/media records. Continue?');">
                    Rename Product Images By SKU
                </a>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <a class="btn btn-success bg-green btn-block"
                    href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\SuperadminController::class, 'fixQuantityMismatch']), false); ?>">
                    Fix Quantity Mismatch
                </a>
            </div>
        </div>
    </div>
</div>
