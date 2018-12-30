<?php $__env->startSection('css'); ?>
<link rel='stylesheet' href='css/index.css' />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<h1 class='title'><?php echo e(env('APP_NAME')); ?></h1>

<form method='POST' action='/shorten' role='form'>
    <input type='url' autocomplete='off'
        class='form-control long-link-input' placeholder='http://' name='link-url' />

    <div class='row' id='options' ng-cloak>
        <p>Customize link</p>

        <?php if(!env('SETTING_PSEUDORANDOM_ENDING')): ?>
        
        <div class='btn-group btn-toggle visibility-toggler' data-toggle='buttons'>
            <label class='btn btn-primary btn-sm active'>
                <input type='radio' name='options' value='p' checked /> Public
            </label>
            <label class='btn btn-sm btn-default'>
                <input type='radio' name='options' value='s' /> Secret
            </label>
        </div>
        <?php endif; ?>

        <div>
            <div class='custom-link-text'>
                <h2 class='site-url-field'><?php echo e(env('APP_ADDRESS')); ?>/</h2>
                <input type='text' autocomplete="off" class='form-control custom-url-field' name='custom-ending' />
            </div>
            <div>
                <a href='#' class='btn btn-success btn-xs check-btn' id='check-link-availability'>Check Availability</a>
                <div id='link-availability-status'></div>
            </div>
        </div>
    </div>
    <input type='submit' class='btn btn-info' id='shorten' value='Shorten' />
    <a href='#' class='btn btn-warning' id='show-link-options'>Link Options</a>
    <input type="hidden" name='_token' value='<?php echo e(csrf_token()); ?>' />
</form>

<div id='tips' class='text-muted tips'>
    <i class='fa fa-spinner'></i> Loading Tips...
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src='js/index.js'></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>