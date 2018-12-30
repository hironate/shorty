<?php $__env->startSection('css'); ?>
<link rel='stylesheet' href='/css/admin.css'>
<link rel='stylesheet' href='/css/datatables.min.css'>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div ng-controller="AdminCtrl" class="ng-root">
    <div class='col-md-2'>
        <ul class='nav nav-pills nav-stacked admin-nav' role='tablist'>
            <li role='presentation' aria-controls="home" class='admin-nav-item active'><a href='#home'>Home</a></li>
            <li role='presentation' aria-controls="links" class='admin-nav-item'><a href='#links'>Links</a></li>
            <li role='presentation' aria-controls="settings" class='admin-nav-item'><a href='#settings'>Settings</a></li>

            <?php if($role == $admin_role): ?>
            <li role='presentation' class='admin-nav-item'><a href='#admin'>Admin</a></li>
            <?php endif; ?>

            <?php if($api_active == 1): ?>
            <li role='presentation' class='admin-nav-item'><a href='#developer'>Developer</a></li>
            <?php endif; ?>
        </ul>
    </div>
    <div class='col-md-10'>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <h2>Welcome to your <?php echo e(env('APP_NAME')); ?> dashboard!</h2>
                <p>Use the links on the left hand side to navigate your <?php echo e(env('APP_NAME')); ?> dashboard.</p>
            </div>

            <div role="tabpanel" class="tab-pane" id="links">
                <?php echo $__env->make('snippets.link_table', [
                    'table_id' => 'user_links_table'
                ], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <div role="tabpanel" class="tab-pane" id="settings">
                <h3>Change Password</h3>
                <form action='/admin/action/change_password' method='POST'>
                    Old Password: <input class="form-control password-box" type='password' name='current_password' />
                    New Password: <input class="form-control password-box" type='password' name='new_password' />
                    <input type="hidden" name='_token' value='<?php echo e(csrf_token()); ?>' />
                    <input type='submit' class='btn btn-success change-password-btn'/>
                </form>
            </div>

            <?php if($role == $admin_role): ?>
            <div role="tabpanel" class="tab-pane" id="admin">
                <h3>Links</h3>
                <?php echo $__env->make('snippets.link_table', [
                    'table_id' => 'admin_links_table'
                ], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <h3 class="users-heading">Users</h3>
                <a ng-click="state.showNewUserWell = !state.showNewUserWell" class="btn btn-primary btn-sm status-display">New</a>

                <div ng-if="state.showNewUserWell" class="new-user-fields well">
                    <table class="table">
                        <tr>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                        <tr id="new-user-form">
                            <td><input type="text" class="form-control" ng-model="newUserParams.username"></td>
                            <td><input type="password" class="form-control" ng-model="newUserParams.userPassword"></td>
                            <td><input type="email" class="form-control" ng-model="newUserParams.userEmail"></td>
                            <td>
                                <select class="form-control new-user-role" ng-model="newUserParams.userRole">
                                    <?php $__currentLoopData = $user_roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role_text => $role_val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($role_val); ?>"><?php echo e($role_text); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                            <td>
                                <a ng-click="addNewUser($event)" class="btn btn-primary btn-sm status-display new-user-add">Add</a>
                            </td>
                        </tr>
                    </table>
                </div>

                <?php echo $__env->make('snippets.user_table', [
                    'table_id' => 'admin_users_table'
                ], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            </div>
            <?php endif; ?>

            <?php if($api_active == 1): ?>
            <div role="tabpanel" class="tab-pane" id="developer">
                <h3>Developer</h3>

                <p>API keys and documentation for developers.</p>
                <p>
                    Documentation:
                    <a href=''>http://docs.shorty.me/en/latest/developer-guide/api/</a>
                </p>

                <h4>API Key: </h4>
                <div class='row'>
                    <div class='col-md-8'>
                        <input class='form-control status-display' disabled type='text' value='<?php echo e($api_key); ?>'>
                    </div>
                    <div class='col-md-4'>
                        <a href='#' ng-click="generateNewAPIKey($event, '<?php echo e($user_id); ?>', true)" id='api-reset-key' class='btn btn-danger'>Reset</a>
                    </div>
                </div>


                <h4>API Quota: </h4>
                <h2 class='api-quota'>
                    <?php if($api_quota == -1): ?>
                        unlimited
                    <?php else: ?>
                        <code><?php echo e($api_quota); ?></code>
                    <?php endif; ?>
                </h2>
                <span> requests per minute</span>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="angular-modals">
        <edit-long-link-modal ng-repeat="modal in modals.editLongLink" link-ending="modal.linkEnding"
            old-long-link="modal.oldLongLink" clean-modals="cleanModals"></edit-long-link-modal>
        <edit-user-api-info-modal ng-repeat="modal in modals.editUserApiInfo" user-id="modal.userId"
            api-quota="modal.apiQuota" api-active="modal.apiActive" api-key="modal.apiKey"
            generate-new-api-key="generateNewAPIKey" clean-modals="cleanModals"></edit-user-api-info>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php echo $__env->make('snippets.modals', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<script src='/js/datatables.min.js'></script>
<script src='/js/api.js'></script>
<script src='/js/AdminCtrl.js'></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>