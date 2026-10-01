
<?php $__env->startSection('title', 'eTIMS Items'); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1>eTIMS Items <small>KRA Product Registration</small></h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('kenyaetims.dashboard'), false); ?>">eTIMS</a></li>
        <li class="breadcrumb-item active">Items</li>
    </ol>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php echo e(session('status.msg'), false); ?>

        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Add New Item -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-plus-circle"></i> Add eTIMS Item</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('kenyaetims.items.store'), false); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label class="form-label">Link to POS Product</label>
                            <select name="product_id" class="form-select">
                                <option value="">-- None (Standalone) --</option>
                                <?php $__currentLoopData = $unlinked_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($product->id, false); ?>"><?php echo e($product->name, false); ?> (<?php echo e($product->sku, false); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Item Name <span class="text-danger">*</span></label>
                            <input type="text" name="item_nm" class="form-control" required value="<?php echo e(old('item_nm'), false); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Item Classification <span class="text-danger">*</span></label>
                            <select name="item_cls_cd" class="form-select" required>
                                <?php $__currentLoopData = $classifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($code, false); ?>"><?php echo e($code, false); ?> - <?php echo e($name, false); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <small class="text-muted">Sync with KRA to load classifications</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Item Type <span class="text-danger">*</span></label>
                            <select name="item_ty_cd" class="form-select" required>
                                <?php $__currentLoopData = $item_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($code, false); ?>" <?php echo e($code == '2' ? 'selected' : '', false); ?>><?php echo e($name, false); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tax Type <span class="text-danger">*</span></label>
                            <select name="tax_ty_cd" class="form-select" required>
                                <?php $__currentLoopData = $tax_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($code, false); ?>" <?php echo e($code === 'A' ? 'selected' : '', false); ?>>
                                        <?php echo e($code, false); ?> - <?php echo e($info['name'], false); ?> (<?php echo e($info['rate'], false); ?>%)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Quantity Unit <span class="text-danger">*</span></label>
                            <select name="qty_unit_cd" class="form-select" required>
                                <?php $__currentLoopData = $qty_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($code, false); ?>" <?php echo e($code === 'UN' ? 'selected' : '', false); ?>><?php echo e($code, false); ?> - <?php echo e($name, false); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Package Unit</label>
                            <select name="pkg_unit_cd" class="form-select">
                                <option value="">-- None --</option>
                                <?php $__currentLoopData = $qty_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($code, false); ?>"><?php echo e($code, false); ?> - <?php echo e($name, false); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Country of Origin</label>
                            <input type="text" name="origin_nat_cd" class="form-control" value="KE" maxlength="5">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Default Price <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="default_price" class="form-control" required value="0">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save"></i> Create Item
                        </button>
                    </form>
                </div>
            </div>

            <!-- Auto-Create from Products -->
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-magic"></i> Auto-Create from POS Products</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Automatically create eTIMS items from all POS products that are not yet linked.</p>
                    <form action="<?php echo e(route('kenyaetims.items.auto-create'), false); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label">Default Classification</label>
                            <select name="item_cls_cd" class="form-select" required>
                                <?php $__currentLoopData = $classifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($code, false); ?>"><?php echo e($code, false); ?> - <?php echo e($name, false); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Default Tax Type</label>
                            <select name="tax_ty_cd" class="form-select" required>
                                <?php $__currentLoopData = $tax_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($code, false); ?>" <?php echo e($code === 'A' ? 'selected' : '', false); ?>>
                                        <?php echo e($code, false); ?> - <?php echo e($info['name'], false); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info w-100" onclick="return confirm('Create eTIMS items for all unlinked POS products?')">
                            <i class="fas fa-magic"></i> Auto-Create (<?php echo e($unlinked_products->count(), false); ?> products)
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Items List -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0"><i class="fas fa-box"></i> eTIMS Items</h5>
                    <form action="<?php echo e(route('kenyaetims.items.bulk-register'), false); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Register all unregistered items with KRA?')">
                            <i class="fas fa-upload"></i> Bulk Register with KRA
                        </button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Item Code</th>
                                    <th>Name</th>
                                    <th>Classification</th>
                                    <th>Tax Type</th>
                                    <th>Price</th>
                                    <th>POS Product</th>
                                    <th>Registered</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_18 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                <tr>
                                    <td><code><?php echo e($item->item_cd, false); ?></code></td>
                                    <td><?php echo e($item->item_nm, false); ?></td>
                                    <td><small><?php echo e($item->item_cls_cd, false); ?></small></td>
                                    <td><span class="badge bg-info"><?php echo e($item->tax_ty_cd, false); ?></span></td>
                                    <td class="text-end"><?php echo e(number_format($item->default_price, 2), false); ?></td>
                                    <td>
                                        <?php if($item->product): ?>
                                            <small><?php echo e($item->product->name, false); ?></small>
                                        <?php else: ?>
                                            <small class="text-muted">-</small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($item->is_registered): ?>
                                            <span class="badge bg-success"><i class="fas fa-check"></i> Yes</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning">No</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if(!$item->is_registered): ?>
                                            <form action="<?php echo e(route('kenyaetims.items.register', $item->id), false); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-xs btn-success">
                                                    <i class="fas fa-upload"></i> Register
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <small class="text-muted"><?php echo e($item->registered_at ? $item->registered_at->format('Y-m-d') : '', false); ?></small>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        <i class="fas fa-box fa-2x mb-2"></i><br>
                                        No items yet. Create items or use auto-create.
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php echo e($items->links(), false); ?>

                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>