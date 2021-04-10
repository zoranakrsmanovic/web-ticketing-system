<?php
use app\core\Application;

/** @var $params \app\models\TicketingModel
 */


$errors = Application::$app->session->getFlash('errors');

if ($errors !== false)
{
    $params->errors = $errors;
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Edit ticket</h3>
            </div>
            <?php echo  \app\core\Form::beginForm("editProcess", "post")?>
            <?php echo "<div class='card-body'>" ?>
                <div class="form-check">
                    <?php
                    if ($params->status_id == 1){
                        echo "<input type='checkbox' name='status_id'  id='status_id' class='form-check-input' value='1'>";
                    }else {
                        echo "<input type='checkbox' name='status_id'  id='status_id' checked='checked' class='form-check-input' value='2'>";
                    }
                    ?>
                    <label for="status_id">Close ticket</label>
                </div>
                <div class="form-check">
                    <?php
                    if ($params->priority_id == 1){
                        echo "<input type='checkbox' name='priority_id'  id='priority_id' class='form-check-input' value='1'>";
                    }else {
                        echo "<input type='checkbox' name='priority_id'  id='priority_id' checked='checked' class='form-check-input' value='2'>";
                    }
                    ?>
                    <label for="status_id">High priority?</label>
                </div>
            <?php echo  \app\core\Form::field($params, 'solution', 'text')?>
            <br>
            <?php
                echo "<label for='category'> Select category: </label>";
                echo "<br>";
                echo " <select id='category' name='category'>";
                    echo " <option value='$params->category_id' selected>-- $params->category_id --</option> ";
                    $db = $params->dbConnection->conn();
                    $records = mysqli_query($db, "SELECT `category_id`, `name` From categories");
                    while($data = mysqli_fetch_array($records))
                    {
                        echo "<option value='". $data['category_id'] ."'>" .$data['name'] ."</option>";
                    }
                echo " </select> ";
            ?>
            <?php echo "</div>" ?>
            <?php echo "<div class='card-footer'>" ?>
            <?php echo sprintf("<a href='/ticketing' style='text-decoration: none; color: white;' class='btn btn-info'>Go back to list</a>")?>
            <?php echo sprintf("<input type='hidden' name='ticket_id' value='$params->ticket_id'>")?>
            <?php echo sprintf("<button type='submit' class='btn btn-primary'>Submit</button>")?>
            <?php echo "</div>" ?>
            <?php echo  \app\core\Form::endForm()?>
        </div>
    </div>
    <div class="col-md-6">
    </div>
</div>

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
