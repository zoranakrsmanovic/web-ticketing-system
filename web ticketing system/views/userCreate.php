<?php
use app\core\Application;

/** @var $params \app\models\UserModel
 */

?>

<p class="login-box-msg">Create a new user</p>
<?php echo \app\core\Form::beginForm('userCreateProcess', 'post') ?>
<div class="form-group">
    <?php echo \app\core\Form::field($params, 'user_name', 'user_name')?>
</div>
<div class="form-group">
    <?php echo \app\core\Form::field($params, 'email', 'email')?>
</div>
<div class="form-group">
    <?php echo \app\core\Form::field($params, 'password', 'password')?>
</div>
<div class="form-group">
    <?php echo \app\core\Form::field($params, 'confirmPassword', 'password')?>
</div>
<div class="form-group">
    <?php echo "<button class='btn btn-lg btn-primary btn-block' type='submit'>Create user</button>"?>
</div>
<?php echo \app\core\Form::endForm() ?>

<?php

$errors = Application::$app->session->getFlash('errors');

if ($errors  !== null) {
    echo "
        <script>
            $(document).ready(function (){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });


                Toast.fire({
                    icon: 'errors',
                    title: '$errors'
                })
            });
        </script>
        ";
}
?>

<?php

$success = Application::$app->session->getFlash('success');

if ($success  !== false) {
    echo "
        <script>
            $(document).ready(function (){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });


                Toast.fire({
                    icon: 'success',
                    title: '$success'
                })
            });
        </script>
        ";
}
?>



