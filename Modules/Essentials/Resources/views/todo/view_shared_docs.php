<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">
                <?php echo app('translator')->get('essentials::lang.view_shared_docs'); ?>
            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-striped table-th-skin">
                    <caption>
                        <?php echo app('translator')->get('essentials::lang.spreadsheets'); ?>
                    </caption>
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                <?php echo app('translator')->get('messages.name'); ?>
                            </th>
                            <th>
                                <?php echo app('translator')->get('messages.action'); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($sheets) > 0): ?>
                            <?php $__currentLoopData = $sheets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spreadsheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo e($loop->iteration, false); ?>

                                    </td>
                                    <td>
                                        <?php echo e($spreadsheet->sheet_name, false); ?>

                                    </td>
                                    <td>
                                        <a href="<?php echo e(action([\Modules\Spreadsheet\Http\Controllers\SpreadsheetController::class, 'show'], [$spreadsheet->sheet_id]), false); ?>" target="_blank" title="<?php echo app('translator')->get('messages.view'); ?>" class="btn btn-success btn-xs">
                                            <i class="fas fa-eye"></i>
                                            <?php echo app('translator')->get('messages.view'); ?>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">
                                    <h4 class="text-center">
                                        <?php echo app('translator')->get('essentials::lang.no_docs_found'); ?>
                                    </h4>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-th-skin">
                    <caption>
                        <?php echo app('translator')->get('lang_v1.documents'); ?>
                    </caption>
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th><?php echo app('translator')->get('lang_v1.file'); ?></th>
                            <th>
                                <?php echo app('translator')->get('messages.action'); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($todo->media->count()): ?>
                            <?php $__currentLoopData = $todo->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo e($loop->iteration, false); ?>

                                    </td>
                                    <td><?php echo e($media->display_name, false); ?></td>
                                    <td>
                                        <a href="<?php echo e($media->display_url, false); ?>" download class="btn btn-success btn-xs">
                                            <?php echo app('translator')->get('lang_v1.download'); ?>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">
                                    <h4 class="text-center">
                                        <?php echo app('translator')->get('essentials::lang.no_docs_found'); ?>
                                    </h4>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
            </button>
        </div>
    </div>
  </div>
