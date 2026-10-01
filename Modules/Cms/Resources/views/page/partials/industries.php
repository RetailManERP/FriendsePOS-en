<?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('cms::lang.industries')]); ?>
    <?php
        $industry = [];
        if(
            isset($page_meta['industry']) && 
            isset($page_meta['industry']['meta_value']) &&
            !empty($page_meta['industry']['meta_value'])
        ) {
            $industry = json_decode($page_meta['industry']['meta_value'], true);
        }
    ?>
    <input type="hidden" name="meta[industry][id]" value="<?php if(isset($page_meta['industry']) && isset($page_meta['industry']['id'])): ?><?php echo e($page_meta['industry']['id'], false); ?> <?php endif; ?>">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo Form::label('industry_title', __('cms::lang.title') . ':*' ); ?>

                <?php echo Form::text('meta[industry][title]', (isset($industry['title']) && !empty($industry['title'])) ? $industry['title'] : null, ['class' => 'form-control', 'id' => 'industry_title']); ?>

            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo Form::label('industry_content', __('cms::lang.description') . ':*' ); ?>

                <?php echo Form::textarea('meta[industry][description]', (isset($industry['description']) && !empty($industry['description'])) ? $industry['description'] : null, ['class' => 'form-control', 'id'=>'industry_content']); ?>

            </div>
        </div>
    </div>
    <?php for($i=0;$i<8;$i++): ?>
        <?php
            $industry_icon = '';
            $industry_title = '';
            $industry_description = '';
            if(isset($industry['content']) && !empty($industry['content'])) {
                $industry_icon = (isset($industry['content'][$i]) && isset($industry['content'][$i]['icon'])) ? $industry['content'][$i]['icon'] : '';
                $industry_title = (isset($industry['content'][$i]) && isset($industry['content'][$i]['title'])) ? $industry['content'][$i]['title'] : '';
                $industry_description = (isset($industry['content'][$i]) && isset($industry['content'][$i]['description'])) ? $industry['content'][$i]['description'] : '';
            }
        ?>
        <div class="row">
            <div class="col-md-4">
               <div class="form-group">
                   <?php echo Form::label('input_industry_icon_'.$i, __('cms::lang.icon') . ':' ); ?>

                    <div class="input-group">
                        <?php echo Form::text('meta[industry][content]['.$i.'][icon]', $industry_icon, ['class' => 'form-control', 'id' => 'input_industry_icon_'.$i, 'placeholder' => __('cms::lang.icon'), 'readonly']); ?>

                        <span class="input-group-text">
                            <button class="btn btn-outline-secondary"
                                id="industry_icon_<?php echo e($i, false); ?>"
                                data-icon="<?php echo e($industry_icon ?? 'fas fa-home', false); ?>" role="iconpicker">        
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('meta_industry_title_'.$i, __('cms::lang.title') . ':' ); ?>

                    <?php echo Form::text('meta[industry][content]['.$i.'][title]', $industry_title, ['class' => 'form-control', 'id' => 'meta_industry_title_'.$i, 'placeholder' => __('cms::lang.title')]); ?>

               </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php echo Form::label('meta_industry_description_'.$i, __('cms::lang.description') . ':' ); ?>

                    <?php echo Form::textarea('meta[industry][content]['.$i.'][description]', $industry_description, ['class' => 'form-control', 'rows' => 2, 'id' => 'meta_industry_description_'.$i, 'placeholder' => __('cms::lang.description')]); ?>

               </div>
            </div>
        </div>
    <?php endfor; ?>
<?php echo $__env->renderComponent(); ?>
