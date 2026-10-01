
<?php $__env->startSection('title', __('messages.settings')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('gym::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Main content -->
    <section class="content">
        <!-- Custom Tabs -->
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('messages.settings') . ':']); ?>
            <?php echo Form::open([
                'url' => action([\Modules\Gym\Http\Controllers\SettingController::class, 'store']),
                'method' => 'post',
                'id' => 'setting',
                'files' => true,
            ]); ?>

            <?php
                $settings = json_decode($busines->gym_settings);
            ?>
            <div class="card">
                <div class="card-header p-0">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#cn_1" data-bs-toggle="tab" aria-expanded="true">
                                <?php echo app('translator')->get('gym::lang.settings'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#cn_2" data-bs-toggle="tab" aria-expanded="true">
                                <?php echo app('translator')->get('gym::lang.attendance'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="cn_1">
                        <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo Form::label('phone', __('contact.contact')); ?>

                                        <?php echo Form::text('phone', $settings->gym->phone ?? null, [
                                            'class' => 'form-control',
                                            'id' => 'phone',
                                            'placeholder' => __('contact.contact'),
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo Form::label('email', __('gym::lang.email')); ?>

                                        <?php echo Form::email('email', $settings->gym->email ?? null, [
                                            'class' => 'form-control',
                                            'id' => 'email',
                                            'placeholder' => __('gym::lang.email'),
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo Form::label('website', __('gym::lang.website')); ?>

                                        <?php echo Form::text('website', $settings->gym->website ?? null, [
                                            'class' => 'form-control',
                                            'id' => 'website',
                                            'placeholder' => __('gym::lang.website'),
                                        ]); ?>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo Form::label('address', __('gym::lang.address')); ?>

                                        <?php echo Form::textarea('address', $settings->gym->address ?? null, [
                                            'class' => 'form-control',
                                            'id' => 'address',
                                            'rows' => '4',
                                            'placeholder' => __('gym::lang.address'),
                                        ]); ?>

                                    </div>
                                </div>
                                

                        </div>
                    </div>
                    <div class="tab-pane fade" id="cn_2">
                        <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <?php echo Form::label('attendence_terminal_api_key',  __('gym::lang.attendence_terminal_api_key') . ':'); ?>

                                        <?php echo Form::text('attendence_terminal_api_key', !empty($settings->gym->attendence_terminal_api_key) ? $settings->gym->attendence_terminal_api_key : null, ['class' => 'form-control', 'id'=> 'terminal_api_key', 'placeholder' => __('gym::lang.attendence_terminal_api_key')]); ?>

                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <?php echo Form::label('attendence_terminal_api_secret',  __('gym::lang.attendence_terminal_api_secret') . ':'); ?>

                                        <?php echo Form::text('attendence_terminal_api_secret', !empty($settings->gym->attendence_terminal_api_secret) ? $settings->gym->attendence_terminal_api_secret : null, ['class' => 'form-control', 'id'=> 'terminal_api_secret', 'placeholder' => __('gym::lang.attendence_terminal_api_secret')]); ?>

                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <a href="<?php echo e(asset('files/zktecho-api.zip'), false); ?>" class="btn btn-info" download><i class="fa fa-download"></i> <?php echo app('translator')->get('lang_v1.download_zktecho_api'); ?></a>
                                </div>
                                <?php if(!empty($settings->gym->attendence_terminal_api_key) && !empty($settings->gym->attendence_terminal_api_secret)): ?>
                                <div class="col-sm-2">
                                    <b>Attendence Terminal Options:</b>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-success sync_attendance"><?php echo app('translator')->get('gym::lang.sync_attendance'); ?> <i class="hide fas fa-sync fa-spin fa-fw"></i></button>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-warning clear_attendance"><?php echo app('translator')->get('gym::lang.clear_attendance'); ?> <i class="hide fas fa-sync fa-spin fa-fw"></i></button>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-info show_enrolled_members" data-container="#enrolled_members_list"><?php echo app('translator')->get('gym::lang.show_enrolled_members'); ?> <i class="hide fas fa-sync fa-spin fa-fw"></i></button>
                                    <div class="modal fade" id="enrolled_members_list" tabindex="-1" role="dialog" 
                                        aria-labelledby="gridSystemModalLabel">
                                        <?php echo $__env->make('gym::setting.enrolled_members_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>    
                                    </div>
                                </div>
                                <?php endif; ?>
                                
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <?php echo Form::submit(__('messages.submit'), ['class' => 'btn btn-primary tw-dw-btn tw-dw-btn-success tw-text-white tw-dw-btn-lg']); ?>

            </div>
            <div class="col-xs-12">
                <p class="help-block"><i><?php echo __('gym::lang.version_info', ['version' => $module_version]); ?></i></p>
            </div>
            <?php echo Form::close(); ?>

        <?php echo $__env->renderComponent(); ?>
        
    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea#email_body',
        });
        tinymce.init({
            selector: 'textarea#footer_text',
        });
        $(document).on('click', 'button.sync_attendance', function() {
        var terminal_api_key = $('input#terminal_api_key').val();
        var terminal_api_secret = $('input#terminal_api_secret').val();
        var loading = $(this).find('i');
        loading.toggleClass('hide');
        data = {
            api_key: terminal_api_key,
            api_secret: terminal_api_secret,
            device_id: 'device1',
        };
        $.ajax({
            url: "http://127.0.0.1:5000/get_attendance",
            data: data,
            method: 'GET',
            dataType: 'json',
            success: function(result) {
                // console.log(result);
                if(result.success){
                    $.ajax({
                        method: 'POST',
                        url: "/gym/sync-attendance",
                      	data: JSON.stringify(result),
                        contentType: 'application/json',
                        processData: false,
                        success: function(result2) {
                            // console.log(result2);
                            if(result2.success){
                                toastr.success(result2.msg);
                            }else{
                                toastr.error(result2.msg);
                            }  
                            loading.toggleClass('hide');
                        },
                    });
                }else{
                    toastr.warning(result.message);
                    loading.toggleClass('hide');
                }
            },
            error: function(){
                loading.toggleClass('hide');
                toastr.error('Nothing Synced - Please Check If Conncetor Software is Running');
            },
        });
    });

    $(document).on('click', 'button.clear_attendance', function() {
        var terminal_api_key = $('input#terminal_api_key').val();
        var terminal_api_secret = $('input#terminal_api_secret').val();
        var loading = $(this).find('i');
        loading.toggleClass('hide');
        data = {
            api_key: terminal_api_key,
            api_secret: terminal_api_secret,
            device_id: 'device1',
        };
        $.ajax({
            url: "http://127.0.0.1:5000/clear_attendance",
            data: data,
            method: 'DELETE',
            dataType: 'json',
            success: function(result) {
                if(result.success){
                    toastr.success(result.message);
                    loading.toggleClass('hide');
                }else{
                    toastr.warning(result.message);
                    loading.toggleClass('hide');
                }
            },
            error: function(){
                loading.toggleClass('hide');
                toastr.error('Nothing Cleared - Please Check If Conncetor Software is Running');
            },
        });
    });

    $(document).on('click', 'button.show_enrolled_members', function() {
        var terminal_api_key = $('input#terminal_api_key').val();
        var terminal_api_secret = $('input#terminal_api_secret').val();
        var loading = $(this).find('i');
        loading.toggleClass('hide');
        data = {
            api_key: terminal_api_key,
            api_secret: terminal_api_secret,
            device_id: 'device1',
        };
        $.ajax({
            url: "http://127.0.0.1:5000/get_users",
            data: data,
            method: 'GET',
            dataType: 'json',
            success: function(result) {
                if(result.success){
                    $('table#enrolled_members_table tbody').html('');
                    result.users.forEach(element => {
                        var table_row = `
                        <tr>
                            <td>${element.user_id}</td>
                            <td>${element.privilege}</td>
                            <td>${element.name}</td>
                            <td>${element.password}</td>
                        </tr>`;
                        $('table#enrolled_members_table tbody').append(table_row);
                    });
                    loading.toggleClass('hide');
                    $('div#enrolled_members_list').modal('show');
                }else{
                    toastr.warning(result.message);
                    loading.toggleClass('hide');
                }
            },
            error: function(){
                loading.toggleClass('hide');
                toastr.error('Nothing Cleared - Please Check If Conncetor Software is Running');
            },
        });
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>