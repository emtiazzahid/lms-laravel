<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E- Learning</title>

    <!-- Bootstrap -->
    <link href="<?php echo e(asset('admin/vendors/bootstrap/dist/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo e(asset('admin/vendors/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo e(asset('admin/vendors/nprogress/nprogress.css')); ?>" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo e(asset('admin/vendors/animate.css/animate.min.css')); ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo e(asset('admin/build/css/custom.min.css')); ?>" rel="stylesheet">
  </head>

  <body class="login">
  
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="<?php echo e(route('postLogin')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

              <h1>Login Form</h1>
               <?php if(isset($errors)): ?>
                <?php if( count($errors) > 0): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>
                <?php endif; ?>
                <?php if(Session::has('success')): ?>
                    <div class='alert alert-success'>
                        <?php echo e(Session::get('success')); ?>

                    </div>
                <?php endif; ?>
                <?php if(Session::has('unsuccess')): ?>
                    <div class='alert alert-danger'>
                        <?php echo e(Session::get('unsuccess')); ?>

                    </div>
                <?php endif; ?>
              <div>
                <input type="text" name="email" class="form-control" placeholder="Emal" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
                <div class="left">
                   <input type="checkbox" name="remember" />  <label for="" > Remember me</label>
                </div>
               <div>
                <button type="submit" class="btn btn-default submit">Login</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form action="<?php echo e(route('postUserInfo')); ?>" method="post">
             <?php echo e(csrf_field()); ?>

              <h1>Create Account</h1>
              <label for="">I am a </label>
              <div>
                <select name="user_type" id="" class="form-control">
                  <option value="<?php echo e(\App\Libraries\Enumerations\UserTypes::$STUDENT); ?>">Student</option>
                  <option value="<?php echo e(\App\Libraries\Enumerations\UserTypes::$TEACHER); ?>">Teacher</option>
                </select>
              </div>
              <br>
              <div>
                <input type="text" class="form-control" placeholder="Name" name="name" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" name="email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-default submit">Submit</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
