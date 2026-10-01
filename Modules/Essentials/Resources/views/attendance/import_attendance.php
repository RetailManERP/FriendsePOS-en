<div class="row">
    <div class="col-sm-12">
        <?php echo Form::open(['url' => action([\Modules\Essentials\Http\Controllers\AttendanceController::class, 'importAttendance']), 'method' => 'post', 'enctype' => 'multipart/form-data' ]); ?>

            <div class="row">
                <div class="col-sm-6">
                <div class="col-sm-8">
                    <div class="form-group">
                        <?php echo Form::label('name', __( 'product.file_to_import' ) . ':'); ?>

                        <?php echo Form::file('attendance', ['accept'=> '.xls', 'required' => 'required']); ?>

                      </div>
                </div>
                <div class="col-sm-4">
                <br>
                    <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.submit'); ?></button>
                </div>
                </div>
            </div>

        <?php echo Form::close(); ?>

        <br>
        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="row">
                    <a href="<?php echo e(asset('modules/essentials/files/import_attendance_template.xls'), false); ?>" class="btn btn-success my-1" download><i class="fa fa-download"></i> <?php echo app('translator')->get('lang_v1.download_template_file'); ?></a>
                    <a href="<?php echo e(asset('files/zktecho-api.zip'), false); ?>" class="btn btn-success my-1" download><i class="fa fa-download"></i> <?php echo app('translator')->get('lang_v1.download_zktecho_api'); ?></a>
                    <a href="<?php echo e(route('essentials.adms.devices.index'), false); ?>" class="btn btn-primary my-1">
                        <i class="fas fa-network-wired"></i> ADMS / SenseFace Devices
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-md-8">
                <div class="row">
            <?php
                 $settings = request()->session()->get('business.essentials_settings');
                 $settings = ! empty($settings) ? json_decode($settings, true) : [];
                 $business_id = request()->session()->get('user.business_id');
                 $all_users = \App\User::where('business_id', $business_id)->get();
                 $device_users_map = [];
                 foreach ($all_users as $u) {
                     $name = trim(($u->surname ?? '') . ' ' . ($u->first_name ?? '') . ' ' . ($u->last_name ?? ''));
                     if (!empty($u->essentials_attendence_uid)) {
                         $device_users_map[(string)$u->essentials_attendence_uid] = $name;
                     }
                     $device_users_map[(string)$u->id] = $name;
                 }
            ?>
            <script type="text/javascript">
                window.device_users_map = <?php echo json_encode($device_users_map); ?>;
            </script>
            <?php if(!empty($settings['attendence_terminal_api_key']) && !empty($settings['attendence_terminal_api_secret'])): ?>
            <div class="col-md-12">
                <b>Attendence Terminal Options:</b>
            </div>
            <div class="col-sm-4 my-1">
                <input type="hidden" id='terminal_api_key' value="<?php echo e($settings['attendence_terminal_api_key'], false); ?>">
                <input type="hidden" id='terminal_api_secret' value="<?php echo e($settings['attendence_terminal_api_secret'], false); ?>">
                <button class="btn btn-success sync_attendance btn-block"><?php echo app('translator')->get('lang_v1.sync_attendance'); ?> <i class="hide fas fa-sync fa-spin fa-fw"></i></button>
            </div>
            <div class="col-sm-4 my-1">
                
                <a href="#" data-href="<?php echo e(action([\Modules\Essentials\Http\Controllers\AttendanceController::class, 'getClearAttendance']), false); ?>" class="btn-modal btn btn-danger clear_attendance" data-container=".view_modal">
                    <?php echo app('translator')->get('lang_v1.clear_attendance'); ?> <i class="hide fas fa-sync fa-spin fa-fw"></i>
                </a>
            </div>
            <div class="col-sm-4 my-1">
                <button class="btn btn-success show_enrolled_users" data-container="#enrolled_users_list"><?php echo app('translator')->get('lang_v1.show_enrolled_users'); ?> <i class="hide fas fa-sync fa-spin fa-fw"></i></button>
                <div class="modal fade" id="enrolled_users_list" tabindex="-1" role="dialog" 
                    aria-labelledby="gridSystemModalLabel">
                    <?php echo $__env->make('essentials::attendance.enrolled_users_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>    
                </div>
            </div>
            <div class="col-sm-4 my-1">
                <button class="btn btn-info show_device_attendance" data-container="#device_attendance_list">Show Device Attendance <i class="hide fas fa-sync fa-spin fa-fw"></i></button>
                <div class="modal fade" id="device_attendance_list" tabindex="-1" role="dialog" 
                    aria-labelledby="gridSystemModalLabel">
                    <?php echo $__env->make('essentials::attendance.device_attendance_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>    
                </div>
            </div>  
            <?php endif; ?>
            </div>
            </div>
        </div>
        <br>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-th-skin" width="100%">
                    <tr>
                        <th><?php echo app('translator')->get('lang_v1.col_no'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.col_name'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.instruction'); ?></th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td><?php echo app('translator')->get('user.user_id'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.required'); ?>)</small></td>
                        <td><?php echo __('essentials::lang.user_id_ins'); ?></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><?php echo app('translator')->get('essentials::lang.clock_in_time'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.required'); ?>)</small></td>
                        <td><?php echo __('essentials::lang.clock_in_time_ins'); ?> (<?php echo e(\Carbon::now()->toDateTimeString(), false); ?>)</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><?php echo app('translator')->get('essentials::lang.clock_out_time'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                        <td><?php echo __('essentials::lang.clock_out_time_ins'); ?> (<?php echo e(\Carbon::now()->toDateTimeString(), false); ?>)</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><?php echo app('translator')->get('essentials::lang.shift'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><?php echo app('translator')->get('essentials::lang.clock_in_note'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td><?php echo app('translator')->get('essentials::lang.clock_out_note'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td><?php echo app('translator')->get('essentials::lang.ip_address'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="row">
            <div class="col-md-12">
              
                <div class="panel panel-default" style="border: 1px solid #d3e0ea; border-radius: 6px; padding: 20px 24px; background: #f4f8fb;">
                    <h4 style="margin-top:0; color:#1a5276;">
                        <i class="fas fa-info-circle text-primary"></i>
                        &nbsp;User Guide &mdash; Linking Attendance Machines
                    </h4>

                    <div class="alert alert-info" style="margin-bottom:14px;">
                        <strong>Compatible Attendance Machines (ZKTeco TCP/IP SDK&mdash;compatible):</strong>
                        <div style="margin-top:8px;">
                            <em class="text-muted" style="display:block; margin-bottom:4px;">Fingerprint / RFID terminals:</em>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">ZKT K14</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">ZKT K20</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">ZKT K30</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">ZKT K40</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">ZKT K50</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">ZKT K60</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">ZKT K70</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">ZKT K90</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">ZKT F18</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">ZKT F19</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">ZKT F22</span>
                        </div>
                        <div style="margin-top:6px;">
                            <em class="text-muted" style="display:block; margin-bottom:4px;">Multi-bio (face + fingerprint) terminals:</em>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">ZKT MB20</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">ZKT MB160</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">ZKT MB360</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">ZKT MB460</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">ZKT MB560</span>
                        </div>
                        <div style="margin-top:6px;">
                            <em class="text-muted" style="display:block; margin-bottom:4px;">iClock / SpeedFace / Network terminals:</em>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">iClock 360</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">iClock 660</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">iClock 880</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">iClock 990</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">SpeedFace V5L</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">SpeedFace H5L</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">UA300</span>
                            <span class="badge bg-success" style="font-size:13px; padding:5px 12px; margin:2px;">UA760</span>
                        </div>
                        <div style="margin-top:6px;">
                            <em class="text-muted" style="display:block; margin-bottom:4px;">ADMS / BioSecurity push (visible-light face) terminals &mdash; <strong>NEW</strong>:</em>
                            <span class="badge bg-primary" style="font-size:13px; padding:5px 12px; margin:2px;">SenseFace 2A</span>
                            <span class="badge bg-primary" style="font-size:13px; padding:5px 12px; margin:2px;">SenseFace 4A</span>
                            <span class="badge bg-primary" style="font-size:13px; padding:5px 12px; margin:2px;">SenseFace 7C</span>
                            <span class="badge bg-primary" style="font-size:13px; padding:5px 12px; margin:2px;">ProFace X</span>
                            <span class="badge bg-primary" style="font-size:13px; padding:5px 12px; margin:2px;">SpeedFace M5</span>
                            <span class="badge bg-primary" style="font-size:13px; padding:5px 12px; margin:2px;">G4</span>
                            <small class="text-muted" style="display:block; margin-top:4px;">
                                These devices push attendance directly to the application using the built-in
                                <code>/iclock/*</code> ADMS endpoints &mdash; no Python connector required.
                                Register them under
                                <a href="<?php echo e(route('essentials.adms.devices.index'), false); ?>"><strong>ADMS / SenseFace Devices</strong></a>
                                (button above) before configuring the device.
                            </small>
                        </div>
                        <small class="text-muted" style="display:block; margin-top:8px;">
                            <i class="fas fa-check-circle text-success"></i>
                            <strong>Officially tested:</strong> ZKT K50, ZKT MB460 (TCP/IP) &middot; SenseFace 2A (ADMS push).
                            <br>
                            <i class="fas fa-info-circle text-primary"></i>
                            Other listed models share the same protocol family and work with the bundled connector or ADMS push.
                            Cloud-only or proprietary OEM units are <strong>not</strong> guaranteed.
                        </small>
                    </div>

                    <ol style="line-height: 2.1;">
                        <li>
                            <strong>Configure Device Network</strong><br>
                            <span class="text-muted">On the device: Menu &rarr; Communication &rarr; Ethernet Settings &rarr; Assign a static IP, Subnet Mask, and Gateway. Connect device to the same network as your server and verify connectivity.</span>
                        </li>
                        <li>
                            <strong>Install Python (3.x)</strong><br>
                            <span class="text-muted">Download from <a href="https://www.python.org/downloads/" target="_blank">python.org/downloads</a>. During setup, enable <strong>Add Python to PATH</strong>, then restart your computer.</span>
                        </li>
                        <li>
                            <strong>Install ZKTeco Integration Files</strong><br>
                            <span class="text-muted">Download the ZKTeco API package above, extract it, open a command prompt inside the folder, then run:</span>
                            <div style="margin-top:4px;"><code>pip install -r requirements.txt</code></div>
                        </li>
                        <li>
                            <strong>Set Device IP in Configuration</strong><br>
                            <span class="text-muted">Edit <code>env.json</code> inside the extracted folder and update:</span>
                            <div style="margin-top:4px;"><code>{ "device_ip": "YOUR_DEVICE_IP" }</code></div>
                        </li>
                        <li>
                            <strong>Start the Attendance Sync Service</strong><br>
                            <span class="text-muted">In the same folder, run the following and keep the window open:</span>
                            <div style="margin-top:4px;"><code>python run.py</code></div>
                        </li>
                        <li>
                            <strong>Configure API Keys in HRM Settings</strong><br>
                            <span class="text-muted">In this application, go to <strong>HRM &rarr; Settings &rarr; Attendance</strong> tab and enter the <code>api_key</code> and <code>api_secret</code> matching your <code>env.json</code>. Use the <em>Sync Attendance</em> button above to pull records from the device.</span>
                        </li>
                    </ol>

                    <hr>
                    <h5 style="color:#1a5276; margin-top:18px;">
                        <i class="fas fa-bolt text-warning"></i>
                        Live Push Setup (SenseFace 2A / ADMS / BioSecurity devices)
                    </h5>
                    <p class="text-muted" style="margin-bottom:6px;">
                        Newer ZKTeco face-recognition terminals (SenseFace 2A, 4A, 7C, ProFace X, SpeedFace M5, G4)
                        push attendance directly to the server in real time &mdash; no Python connector needed.
                    </p>
                    <ol style="line-height: 2.0;">
                        <li>
                            <strong>Register the device in the application.</strong>
                            Open <a href="<?php echo e(route('essentials.adms.devices.index'), false); ?>"><strong>ADMS / SenseFace Devices</strong></a>,
                            click <em>Add Device</em>, enter the device's <strong>Serial Number</strong> (from
                            <em>Menu &rarr; System Info</em>), and copy the generated <strong>push token</strong>.
                        </li>
                        <li>
                            <strong>Map each employee to a device PIN.</strong>
                            On the user form set <strong>Attendance UID</strong> equal to the
                            <em>User ID / PIN</em> enrolled on the device.
                        </li>
                        <li>
                            <strong>Configure the device's Cloud Server / ADMS settings:</strong>
                            <div style="margin-top:4px;">
                                <code>Server Mode = ADMS</code><br>
                                <code>Server Address = <?php echo e(request()->getHost(), false); ?></code><br>
                                <code>Server Port = <?php echo e(request()->getPort(), false); ?></code><br>
                                <code>HTTPS = OFF</code> (most ZK devices do not support HTTPS push)<br>
                                <code>URL Path = /iclock/cdata?token=&lt;push-token&gt;</code>
                            </div>
                        </li>
                        <li>
                            <strong>Save settings on the device and reboot.</strong>
                            Within ~30 seconds the device should call <code>/iclock/cdata</code>; the
                            <em>Last Seen</em> column on the device list will update.
                        </li>
                        <li>
                            <strong>Verify.</strong> Punch in on the terminal &mdash; the record should
                            appear instantly under <em>HRM &rarr; Attendance</em> with the user's check-in time.
                        </li>
                    </ol>

                    <div style="margin-top:12px; border-top:1px solid #c8daea; padding-top:10px; font-size: 13px; color:#555;">
                        <i class="fas fa-book text-primary"></i>
                        &nbsp;For full setup instructions and troubleshooting, visit the
                        <a href="<?php echo e(route('docs.public', ['slug' => 'hrm-essentials']), false); ?>" target="_blank">
                            <strong>HRM Module &mdash; Software Documentation</strong>
                        </a>
                        page.
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
