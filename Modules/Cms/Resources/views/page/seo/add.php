<div class="row">
    <div class="col-md-9">
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('cms::lang.seo')]); ?>
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo Form::label('meta_description', __('cms::lang.meta_description') . ':' ); ?>

                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('cms::lang.content_summary_help_text') . '"></i>';
                }
            ?>
                    <?php echo Form::textarea('meta_description', null, ['class' => 'form-control', 'rows' => 5, 'maxlength' => '300']); ?>

                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo Form::label('tags', __('cms::lang.tags') . ':' ); ?>

                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('cms::lang.tags_help_text') . '"></i>';
                }
            ?> <br>
                    <?php echo Form::text('tags', null, ['class' => 'form-control' ]); ?>

                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>  
    </div>
</div>
