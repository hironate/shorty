<!--
Shorty a superfast URL Shortner with API
Built in Latest Laravel 5.7

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
-->

<!DOCTYPE html>
<html ng-app="shorty">
<head>
    <title><?php $__env->startSection('title'); ?><?php echo e(env('APP_NAME')); ?><?php echo $__env->yieldSection(); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <meta name="generator" content="Shorty <?php echo e(env('SHORTY_VERSION')); ?>" />
    <?php echo $__env->yieldContent('meta'); ?>

    
    <?php if(env('APP_STYLESHEET')): ?>
    <link rel="stylesheet" href="<?php echo e(env('APP_STYLESHEET')); ?>">
    <?php else: ?>
    <link rel="stylesheet" href="/css/default-bootstrap.min.css">
    <?php endif; ?>

    <link href="/css/base.css" rel="stylesheet">
    <link href="/css/toastr.min.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="/favicon.ico">
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body>
    <?php echo $__env->make('snippets.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container">
        <div class="content-div <?php if(!isset($no_div_padding)): ?> content-div-padding <?php endif; ?> <?php if(isset($large)): ?> jumbotron large-content-div <?php endif; ?>">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    
    <script src="/js/constants.js"></script>
    <script src="/js/jquery-1.11.3.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/angular.min.js"></script>
    <script src="/js/toastr.min.js"></script>
    <script src="/js/base.js"></script>

    <script>
    <?php if(Session::has('info')): ?>
        toastr["info"](`<?php echo e(str_replace('`', '\`', session('info'))); ?>`, "Info")
    <?php endif; ?>
    <?php if(Session::has('error')): ?>
        toastr["error"](`<?php echo e(str_replace('`', '\`', session('error'))); ?>`, "Error")
    <?php endif; ?>
    <?php if(Session::has('warning')): ?>
        toastr["warning"](`<?php echo e(str_replace('`', '\`', session('warning'))); ?>`, "Warning")
    <?php endif; ?>
    <?php if(Session::has('success')): ?>
        toastr["success"](`<?php echo e(str_replace('`', '\`', session('success'))); ?>`, "Success")
    <?php endif; ?>

    <?php if(count($errors) > 0): ?>
        // Handle Lumen validation errors
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            toastr["error"](`<?php echo e(str_replace('`', '\`', $error)); ?>`, "Error")
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    </script>

    <?php echo $__env->yieldContent('js'); ?>
</body>
</html>
