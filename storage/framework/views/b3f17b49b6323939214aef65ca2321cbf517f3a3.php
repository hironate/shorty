<?php $__env->startSection('css'); ?>
<link rel='stylesheet' href='/css/shorten_result.css' />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<h3>Shortened URL</h3>
<div class="input-group">
    <input type='text' class='result-box form-control' value='<?php echo e($short_url); ?>' id='short_url' />
    <div class='input-group-addon' id='clipboard-copy' data-clipboard-target='#short_url' data-toggle='tooltip' data-placement='bottom' data-title='Copied!'>
        <i class='fa fa-clipboard' aria-hidden='true' title='Copy to clipboard'></i>
    </div>
</div>
<a id="generate-qr-code" class='btn btn-primary'>Generate QR Code</a>
<a href='<?php echo e(route('index')); ?>' class='btn btn-info'>Shorten another</a>

<div class="qr-code-container"></div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
<script src='/js/qrcode.min.js'></script>
<script src='/js/clipboard.min.js'></script>
<script src='/js/shorten_result.js'></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>