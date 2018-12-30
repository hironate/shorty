<?php $__env->startSection('css'); ?>
<link rel='stylesheet' href='/css/signup.css' />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class='col-md-6'>
    <h2 class='title'>Register</h2>

    <form action='/signup' method='POST'>
        Username: <input type='text' name='username' class='form-control form-field' placeholder='Username' />
        Password: <input type='password' name='password' class='form-control form-field' placeholder='Password' />
        Email: <input type='email' name='email' class='form-control form-field' placeholder='Email' />

        <?php if(env('SHORTY_ACCT_CREATION_RECAPTCHA')): ?>
        <div class="g-recaptcha" data-sitekey="<?php echo e(env('SHORTY_RECAPTCHA_SITE_KEY')); ?>"></div>
        <?php endif; ?>

        <input type="hidden" name='_token' value='<?php echo e(csrf_token()); ?>' />
        <input type="submit" class="btn btn-default btn-success" value="Register"/>
        <p class='login-prompt'>
            <small>Already have an account? <a href='<?php echo e(route('login')); ?>'>Login</a></small>
        </p>
    </form>
</div>
<div class='col-md-6 hidden-xs hidden-sm'>
    <div class='right-col-one'>
        <h4>Username</h4>
        <p>The username you will use to login to <?php echo e(env('APP_NAME')); ?>.</p>
    </p>
    <div class='right-col-next'>
        <div class='right-col'>
            <h4>Password</h4>
            <p>The secure password you will use to login to <?php echo e(env('APP_NAME')); ?>.</p>
        </p>
    </div>
    <div class='right-col-next'>
        <h4>Email</h4>
        <p>The email you will use to verify your account or to recover your account.</p>
    </p>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <?php if(env('SHORTY_ACCT_CREATION_RECAPTCHA')): ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>