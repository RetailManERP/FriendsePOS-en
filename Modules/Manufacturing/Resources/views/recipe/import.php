
<?php $__env->startSection('title', __('manufacturing::lang.import_recipes')); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('manufacturing::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('manufacturing::lang.import_recipes'); ?></h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php echo Form::open(['url' => action([\Modules\Manufacturing\Http\Controllers\RecipeController::class, 'importRecipes']), 'method' => 'post', 'enctype' => 'multipart/form-data']); ?>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('recipes_file', __('manufacturing::lang.recipe_excel_file') . ':'); ?>

                        <?php echo Form::file('recipes_file', ['class' => 'form-control', 'accept' => '.xls,.xlsx,.csv', 'required']); ?>

                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <br>
                    <a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\RecipeController::class, 'downloadImportSample']), false); ?>" class="btn btn-warning">
                        <i class="fa fa-file-excel-o"></i> <?php echo app('translator')->get('manufacturing::lang.download_sample_with_data'); ?>
                    </a>
                    <a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\RecipeController::class, 'downloadImportTemplate']), false); ?>" class="btn btn-success">
                        <i class="fa fa-download"></i> <?php echo app('translator')->get('lang_v1.download_template_file'); ?>
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-upload"></i> <?php echo app('translator')->get('messages.submit'); ?>
                    </button>
                    <a href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\RecipeController::class, 'index']), false); ?>" class="btn btn-default">
                        <?php echo app('translator')->get('messages.back'); ?>
                    </a>
                </div>
            </div>
        <?php echo Form::close(); ?>

    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-info', 'title' => __('manufacturing::lang.import_file_format')]); ?>
        <p class="help-block">
            <i class="fa fa-info-circle"></i>
            <?php echo app('translator')->get('manufacturing::lang.recipe_template_has_examples'); ?>
        </p>
        <div class="alert alert-success">
            <strong><i class="fa fa-lightbulb-o"></i> <?php echo app('translator')->get('manufacturing::lang.simple_format_tip_title'); ?></strong>
            <ul style="margin-bottom: 0;">
                <li><?php echo app('translator')->get('manufacturing::lang.simple_format_tip_1'); ?></li>
                <li><?php echo app('translator')->get('manufacturing::lang.simple_format_tip_2'); ?></li>
                <li><?php echo app('translator')->get('manufacturing::lang.simple_format_tip_3'); ?></li>
            </ul>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Column</th>
                        <th><?php echo app('translator')->get('lang_v1.description'); ?></th>
                        <th class="text-center"><?php echo app('translator')->get('lang_v1.required'); ?>?</th>
                        <th><?php echo app('translator')->get('lang_v1.example'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Product SKU</strong></td>
                        <td><?php echo app('translator')->get('manufacturing::lang.import_recipe_product_sku_help'); ?></td>
                        <td class="text-center"><span class="label label-danger"><?php echo app('translator')->get('messages.yes'); ?></span></td>
                        <td><code>CAKE-001</code></td>
                    </tr>
                    <tr>
                        <td>Total Quantity</td>
                        <td><?php echo app('translator')->get('manufacturing::lang.import_total_qty_help'); ?></td>
                        <td class="text-center"><span class="label label-default"><?php echo app('translator')->get('messages.no'); ?></span></td>
                        <td>10</td>
                    </tr>
                    <tr>
                        <td>Recipe Unit</td>
                        <td><?php echo app('translator')->get('manufacturing::lang.import_recipe_unit_help'); ?></td>
                        <td class="text-center"><span class="label label-default"><?php echo app('translator')->get('messages.no'); ?></span></td>
                        <td>Pcs</td>
                    </tr>
                    <tr>
                        <td><strong>Ingredient SKU</strong></td>
                        <td><?php echo app('translator')->get('manufacturing::lang.import_ingredient_sku_help'); ?></td>
                        <td class="text-center"><span class="label label-danger"><?php echo app('translator')->get('messages.yes'); ?></span></td>
                        <td><code>FLOUR-001</code></td>
                    </tr>
                    <tr>
                        <td><strong>Ingredient Quantity</strong></td>
                        <td><?php echo app('translator')->get('manufacturing::lang.import_ingredient_qty_help'); ?></td>
                        <td class="text-center"><span class="label label-danger"><?php echo app('translator')->get('messages.yes'); ?></span></td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>Ingredient Unit</td>
                        <td><?php echo app('translator')->get('manufacturing::lang.import_ingredient_unit_help'); ?></td>
                        <td class="text-center"><span class="label label-default"><?php echo app('translator')->get('messages.no'); ?></span></td>
                        <td>Kg</td>
                    </tr>
                    <tr>
                        <td>Ingredient Waste %</td>
                        <td><?php echo app('translator')->get('manufacturing::lang.waste_percent'); ?></td>
                        <td class="text-center"><span class="label label-default"><?php echo app('translator')->get('messages.no'); ?></span></td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>Extra Cost</td>
                        <td><?php echo app('translator')->get('manufacturing::lang.production_cost'); ?> (<?php echo app('translator')->get('manufacturing::lang.first_row_only'); ?>)</td>
                        <td class="text-center"><span class="label label-default"><?php echo app('translator')->get('messages.no'); ?></span></td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>Production Cost Type</td>
                        <td>fixed, percentage, per_unit (<?php echo app('translator')->get('manufacturing::lang.first_row_only'); ?>)</td>
                        <td class="text-center"><span class="label label-default"><?php echo app('translator')->get('messages.no'); ?></span></td>
                        <td>fixed</td>
                    </tr>
                    <tr>
                        <td>Instructions</td>
                        <td><?php echo app('translator')->get('manufacturing::lang.recipe_instructions'); ?> (<?php echo app('translator')->get('manufacturing::lang.first_row_only'); ?>)</td>
                        <td class="text-center"><span class="label label-default"><?php echo app('translator')->get('messages.no'); ?></span></td>
                        <td>Bake, cool, and pack</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h4><?php echo app('translator')->get('manufacturing::lang.example_layout'); ?></h4>
        <p class="help-block"><?php echo app('translator')->get('manufacturing::lang.example_layout_help'); ?></p>
        <div class="table-responsive">
            <table class="table table-bordered table-condensed" style="font-size: 12px;">
                <thead style="background-color:#d9edf7;">
                    <tr>
                        <th>Product SKU</th>
                        <th>Total Qty</th>
                        <th>Recipe Unit</th>
                        <th>Ingredient SKU</th>
                        <th>Ing. Qty</th>
                        <th>Ing. Unit</th>
                        <th>Waste %</th>
                        <th>Extra Cost</th>
                        <th>Cost Type</th>
                        <th>Instructions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>CAKE-001</strong></td><td>10</td><td>Pcs</td>
                        <td>FLOUR-001</td><td>2</td><td>Kg</td><td>0</td>
                        <td>5</td><td>percentage</td><td>Bake, cool, and pack</td>
                    </tr>
                    <tr>
                        <td><strong>CAKE-001</strong></td><td></td><td></td>
                        <td>SUGAR-001</td><td>0.5</td><td>Kg</td><td>0</td>
                        <td></td><td></td><td></td>
                    </tr>
                    <tr>
                        <td><strong>CAKE-001</strong></td><td></td><td></td>
                        <td>CREAM-001</td><td>1</td><td>Ltr</td><td>2</td>
                        <td></td><td></td><td></td>
                    </tr>
                    <tr>
                        <td><strong>JUICE-001</strong></td><td>12</td><td>Bottle</td>
                        <td>FRUIT-001</td><td>6</td><td>Kg</td><td>1</td>
                        <td>3</td><td>per_unit</td><td>Blend and bottle</td>
                    </tr>
                    <tr>
                        <td><strong>JUICE-001</strong></td><td></td><td></td>
                        <td>BOTTLE-001</td><td>12</td><td>Pcs</td><td>0</td>
                        <td></td><td></td><td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>