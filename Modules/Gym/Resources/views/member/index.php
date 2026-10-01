
<?php $__env->startSection('title', __('gym::lang.members')); ?>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('gym::layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="content-header">
        <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black"> <?php echo app('translator')->get('gym::lang.members'); ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
       
        <?php $__env->startComponent('components.widget'); ?>
            <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('gym.manage_member')): ?>
                    <a class="btn btn-primary pull-right"
                        href="<?php echo e(action([\Modules\Gym\Http\Controllers\MemberController::class, 'create']), false); ?>">
                        <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                    </a>
                <?php endif; ?>
            </div>
            <?php $__env->endSlot(); ?>
            <div class="table-responsive">
<table class="table table-bordered table-striped" id="member_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('contact.name'); ?></th>
                        <th><?php echo app('translator')->get('gym::lang.age'); ?></th>
                        <th><?php echo app('translator')->get('business.email'); ?></th>
                        <th><?php echo app('translator')->get('contact.mobile'); ?></th>
                        <th><?php echo app('translator')->get('gym::lang.package'); ?></th>
                        <th>
                            <?php echo app('translator')->get('lang_v1.created_at'); ?>
                        </th>
                        <th>
                            <?php echo app('translator')->get('messages.action'); ?>
                        </th>
                    </tr>
                </thead>
            </table>
</div>
        <?php echo $__env->renderComponent(); ?>

    </section>
    <div class="modal fade view_modal_in" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
    </div>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            member_table = $('#member_table').DataTable({
                processing: true,
                serverSide: true,
                fixedHeader: false,
                ajax: {
                    url: "<?php echo e(action([\Modules\Gym\Http\Controllers\MemberController::class, 'index']), false); ?>",
                },
                aaSorting: [
                    [5, 'desc']
                ],
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'age',
                        name: 'age'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },
                    {
                        data: 'package',
                        name: 'package',
                        orderable: false
                    },
                    {
                        data: 'created_at',
                        name: 'contacts.created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ]
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>