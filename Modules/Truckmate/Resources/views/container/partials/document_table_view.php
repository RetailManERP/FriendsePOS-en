<table class="table table-striped" id="container_documents_table">
    <thead>
        <tr>
            <th><?php echo app('translator')->get('truckmate::lang.document'); ?></th>
            <th><?php echo app('translator')->get('truckmate::lang.uploaded_on'); ?></th>
            <th><?php echo app('translator')->get('messages.action'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $medias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="media_row" data-document-name="<?php echo e($media->display_name, false); ?> <?php echo e($media->description, false); ?>" data-uploaded-at="<?php echo e(optional($media->created_at)->format('Y-m-d'), false); ?>">
                <td>
                    <?php if(isFileImage($media->display_url)): ?>
                        <?php echo $media->thumbnail(); ?>

                        <br>
                    <?php endif; ?>
                    <a href="<?php echo e($media->display_url, false); ?>" class="cursor-pointer" target="_blank">
                        <?php echo e($media->display_name, false); ?>

                        <?php echo e($media->description, false); ?>

                    </a>
                </td>
                <td>
                    <?php if(!empty($media->created_at)): ?>
                        <?php echo e(\Carbon::createFromTimestamp(strtotime($media->created_at))->format(session('business.date_format') . ' ' . 'h:i A'), false); ?>

                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo e($media->display_url, false); ?>" target="_blank" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i> <?php echo app('translator')->get('messages.view'); ?>
                    </a>
                    <a href="<?php echo e($media->display_url, false); ?>" download="<?php echo e($media->display_name, false); ?>" class="btn btn-success btn-sm">
                        <i class="fas fa-download"></i> <?php echo app('translator')->get('purchase.download_document'); ?>
                    </a>
                    <a data-href="<?php echo e(action([\Modules\Truckmate\Http\Controllers\ContainerController::class, 'deleteContainerDocument'], ['id' => $media->id]), false); ?>" class="btn btn-danger btn-sm delete_media">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr id="container_documents_no_results" style="display: none;">
            <td colspan="3" class="text-center text-muted">
                <?php echo app('translator')->get('truckmate::lang.no_documents_found'); ?>
            </td>
        </tr>
    </tbody>
</table>
