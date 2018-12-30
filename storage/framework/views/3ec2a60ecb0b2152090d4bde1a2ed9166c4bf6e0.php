<div class="container-fluid">
    <nav role="navigation" class="navbar navbar-default navbar-fixed-top">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Output sign in/sign out buttons appropriately -->
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo e(route('index')); ?>"><?php echo e(env('APP_NAME')); ?></a>
        </div>

        <ul id="navbar" class="nav navbar-collapse collapse navbar-nav" id="nbc">
		    <li><a href="<?php echo e(route('about')); ?>">About</a></li>

            <?php if(empty(session('username'))): ?>
                <li class="visible-xs"><a href="<?php echo e(route('login')); ?>">Sign In</a></li>
                <?php if(env('SHORTY_ALLOW_ACCT_CREATION')): ?>
                    <li class="visible-xs"><a href="<?php echo e(route('signup')); ?>">Sign Up</a></li>
                <?php endif; ?>
            <?php else: ?>
                <li class="visible-xs"><a href="<?php echo e(route('admin')); ?>">Dashboard</a></li>
                <li class="visible-xs"><a href="<?php echo e(route('admin')); ?>#settings">Settings</a></li>
                <li class="visible-xs"><a href="<?php echo e(route('logout')); ?>">Logout</a></li>
            <?php endif; ?>
        </ul>

        <ul id="navbar" class="nav pull-right navbar-nav hidden-xs">
            <li class="divider-vertical"></li>

            <?php if(empty(session('username'))): ?>
                <?php if(env('SHORTY_ALLOW_ACCT_CREATION')): ?>
                    <li><a href="<?php echo e(route('signup')); ?>">Sign Up</a></li>
                <?php endif; ?>

                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>
                    <div class="dropdown-menu pull-right login-dropdown-menu" id="dropdown">
                        <h2>Login</h2>
                        <form action="login" method="POST" accept-charset="UTF-8">
                            <input type="text" name="username" placeholder='Username' size="30" class="form-control login-form-field" />
                            <input type="password" name="password" placeholder='Password' size="30" class="form-control login-form-field" />
                            <input type="hidden" name='_token' value='<?php echo e(csrf_token()); ?>' />
                            <input class="btn btn-success form-control login-form-submit" type="submit" name="login" value="Sign In" />
                        </form>
                    </div>
                </li>
            <?php else: ?>
                <div class='nav pull-right navbar-nav'>
                    <li class='dropdown'>
                    <a class="dropdown-toggle login-name" href="#" data-toggle="dropdown"><?php echo e(session('username')); ?> <strong class="caret"></strong></a>
                        <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu">
                            <li><a tabindex="-1" href="<?php echo e(route('admin')); ?>">Dashboard</a></li>
                            <li><a tabindex="-1" href="<?php echo e(route('admin')); ?>#settings">Settings</a></li>
                            <li><a tabindex="-1" href="<?php echo e(route('logout')); ?>">Logout</a></li>
                        </ul>
                    </li>
                </div>
            <?php endif; ?>
        </ul>
    </nav>
</div>
