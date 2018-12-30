<?php $__env->startSection('title'); ?>
Setup Completed
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel='stylesheet' href='/css/default-bootstrap.min.css'>
<link rel='stylesheet' href='/css/setup.css'>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="navbar navbar-default navbar-fixed-top">
    <a class="navbar-brand" href="/">Shorty</a>
</div>

<div class='row'>
    <div class='col-md-3'></div>

    <div class='col-md-6 setup-body well'>
        <div class='setup-center'>
            <img class='setup-logo' src='/img/logo.png'>
        </div>
        <h2>Setup Complete</h2>
        <p>Your Shorty setup is complete. To continue, you may <a href='<?php echo e(route('login')); ?>'>login</a> or
            access your <a href='<?php echo e(route('index')); ?>'>home page</a>.
        </p>
        <p>Thanks for using Shorty!</p>
    </div>

    <div class='col-md-3'></div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.minimal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>