<?php $__env->startSection('css'); ?>
<link rel='stylesheet' href='css/login.css' />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="center-text">
    <h1>Login</h1><br/><br/>
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <form action="login" method="POST">
            <input type="text" placeholder="username" name="username" class="form-control login-field" />
            <input type="password" placeholder="password" name="password" class="form-control login-field" />
            <input type="hidden" name='_token' value='<?php echo e(csrf_token()); ?>' />
            <input type="submit" value="Login" class="login-submit btn btn-success" />

            <p class='login-prompts'>
            <?php if(env('SHORTY_ALLOW_ACCT_CREATION') == true): ?>
                <small>Don't have an account? <a href='<?php echo e(route('signup')); ?>'>Register</a></small>
            <?php endif; ?>

            <?php if(env('SETTING_PASSWORD_RECOV') == true): ?>
                <small>Forgot your password? <a href='<?php echo e(route('lost_password')); ?>'>Reset</a></small>
            <?php endif; ?>
            </p>
        </form>
    </div>
    <div class="col-md-3"></div>
</div
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>