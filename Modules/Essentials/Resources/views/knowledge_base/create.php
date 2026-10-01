

<?php
    $page_title = __( 'essentials::lang.add_knowledge_base' );
    $kb_type = '';
    if(!empty($parent)) {
        $kb_type = $parent->kb_type == 'knowledge_base' ? 'section' : 'article';
    }
    if($kb_type == 'section') {
        $page_title = __( 'essentials::lang.add_section' );
    } else if($kb_type == 'article') {
        $page_title = __( 'essentials::lang.add_article' );
    }
?>
<?php $__env->startSection('title', $page_title); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('essentials::layouts.nav_essentials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Main content -->
<section class="content">
<?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\KnowledgeBaseController::class, 'store']), 'method' => 'post' ]); ?>

    <?php if(!empty($parent)): ?>
        <?php echo Form::hidden('kb_type', $kb_type); ?>

        <?php echo Form::hidden('parent_id', $parent->id); ?>

    <?php endif; ?>
    <?php $__env->startComponent('components.widget', ['title' => $page_title]); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo Form::label('title', __( 'essentials::lang.title' ) . ':*'); ?>

                    <?php echo Form::text('title', null, ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.title' ), 'required' ]); ?>

                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo Form::label('content', __( 'essentials::lang.content' ) . ':'); ?>

                    <?php echo Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => __( 'essentials::lang.content' ) ]); ?>

                </div>
            </div>
            <?php if(empty($parent)): ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('share_with', __( 'essentials::lang.share_with' ) . ':'); ?>

                        <?php echo Form::select('share_with', ['public' => __('essentials::lang.public'), 'private' => __( 'essentials::lang.private' ), 'only_with' => __( 'essentials::lang.only_with' )], 'public', ['class' => 'form-control select2' ]); ?>

                    </div>
                </div>
                <div class="col-md-6" id="user_ids_div" style="display: none;">
                    <div class="form-group">
                        <?php echo Form::label('user_ids', __( 'essentials::lang.share_only_with' ) . ':'); ?>

                        <?php echo Form::select('user_ids[]', $users, null, ['class' => 'form-control select2', 'multiple', 'id' => 'user_ids', 'style' => 'width: 100%;' ]); ?>

                    </div>
                </div>
            <?php endif; ?>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary float-end"><?php echo app('translator')->get( 'messages.save' ); ?></button>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>
<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready( function(){
        init_tinymce('content');

        $('#share_with').change( function() {
            if ($(this).val() == 'only_with') {
                $('#user_ids_div').fadeIn();
            } else {
                $('#user_ids_div').fadeOut();
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>