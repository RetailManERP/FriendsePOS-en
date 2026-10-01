

<?php $__env->startSection('title', 'ADMS / BioSecurity Devices'); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1>ZKTeco ADMS / BioSecurity Devices
        <small>Live attendance push from face / fingerprint terminals</small>
    </h1>
</section>

<section class="content">
    <div class="box box-solid">
        <div class="box-body">
            <div class="alert alert-info">
                <strong><i class="fas fa-server"></i> Server push URL:</strong>
                <code><?php echo e($base_url, false); ?>/cdata?SN=&lt;DEVICE_SERIAL&gt;</code>
                <br>
                <small class="text-muted">
                    Configure this URL on your ZKTeco device under
                    <strong>Comm. → Cloud Server / ADMS Setting</strong>.
                    Use <strong>HTTP</strong> (most ZK devices do not support HTTPS push).
                    If a push secret is set, append <code>&amp;token=&lt;secret&gt;</code> to the URL.
                </small>
            </div>

            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#add-adms-device">
                <i class="fa fa-plus"></i> Add Device
            </button>
            <div class="clearfix"></div>
            <br>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Serial Number</th>
                        <th>Model</th>
                        <th>Push Secret</th>
                        <th>Last Seen</th>
                        <th>Last IP</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_18 = true; $__currentLoopData = $devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                        <tr>
                            <td><?php echo e($device->name ?: '—', false); ?></td>
                            <td><code><?php echo e($device->serial_number, false); ?></code></td>
                            <td><?php echo e($device->model ?: '—', false); ?></td>
                            <td>
                                <?php if($device->push_secret): ?>
                                    <span class="label label-success">Set</span>
                                <?php else: ?>
                                    <span class="label label-default">None</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($device->last_seen_at ? $device->last_seen_at->diffForHumans() : '—', false); ?></td>
                            <td><?php echo e($device->last_ip ?: '—', false); ?></td>
                            <td>
                                <?php if($device->is_active): ?>
                                    <span class="label label-success">Active</span>
                                <?php else: ?>
                                    <span class="label label-default">Disabled</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <form method="POST"
                                      action="<?php echo e(route('essentials.adms.devices.update', $device->id), false); ?>"
                                      style="display:inline-block">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <input type="hidden" name="is_active" value="<?php echo e($device->is_active ? 0 : 1, false); ?>">
                                    <input type="hidden" name="name" value="<?php echo e($device->name, false); ?>">
                                    <input type="hidden" name="model" value="<?php echo e($device->model, false); ?>">
                                    <input type="hidden" name="location_id" value="<?php echo e($device->location_id, false); ?>">
                                    <button class="btn btn-xs btn-warning" type="submit">
                                        <?php echo e($device->is_active ? 'Disable' : 'Enable', false); ?>

                                    </button>
                                </form>

                                <form method="POST"
                                      action="<?php echo e(route('essentials.adms.devices.update', $device->id), false); ?>"
                                      style="display:inline-block">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <input type="hidden" name="regenerate_secret" value="1">
                                    <input type="hidden" name="is_active" value="<?php echo e($device->is_active ? 1 : 0, false); ?>">
                                    <input type="hidden" name="name" value="<?php echo e($device->name, false); ?>">
                                    <input type="hidden" name="model" value="<?php echo e($device->model, false); ?>">
                                    <input type="hidden" name="location_id" value="<?php echo e($device->location_id, false); ?>">
                                    <button class="btn btn-xs btn-info" type="submit">
                                        <i class="fa fa-key"></i> Rotate Secret
                                    </button>
                                </form>

                                <form method="POST"
                                      action="<?php echo e(route('essentials.adms.devices.destroy', $device->id), false); ?>"
                                      style="display:inline-block"
                                      onsubmit="return confirm('Delete this device registration?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-xs btn-danger" type="submit">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>

                                <?php if($device->push_secret): ?>
                                    <br><small class="text-muted">
                                        token=<code><?php echo e($device->push_secret, false); ?></code>
                                    </small>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                No devices registered yet. Add a device to start receiving live attendance pushes.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="modal fade" id="add-adms-device" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <form method="POST" action="<?php echo e(route('essentials.adms.devices.store'), false); ?>">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add ADMS Device</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Serial Number <span class="text-danger">*</span></label>
                            <input type="text" name="serial_number" class="form-control" required
                                   placeholder="As shown on the device sticker / Menu → System Info">
                            <small class="text-muted">Must match the device's actual serial number exactly.</small>
                        </div>
                        <div class="form-group">
                            <label>Display Name</label>
                            <input type="text" name="name" class="form-control"
                                   placeholder="e.g. Main Gate SenseFace">
                        </div>
                        <div class="form-group">
                            <label>Model</label>
                            <input type="text" name="model" class="form-control"
                                   placeholder="e.g. SenseFace 2A, MB460, K50">
                        </div>
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="generate_secret" value="1" checked>
                                Generate a random push secret (recommended)
                            </label>
                            <br>
                            <small class="text-muted">
                                When set, the device URL must include <code>&amp;token=&lt;secret&gt;</code>.
                                Leave unchecked to allow unauthenticated pushes from this serial.
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Device</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>