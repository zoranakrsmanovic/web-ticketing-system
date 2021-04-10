<?php
use app\core\Application;

/** @var $params \app\models\PostModel
 */

?>



<div class="row">
    <div class="col-md-12">
        <div class="callout callout-info">
            <?php echo sprintf("<h3><b>Title: </b>%s</h3>", $params->title)?>
            <?php echo sprintf("<h3><b>Content: </b>%s</h3>", $params->content)?>
            <?php echo sprintf("<h3><b>Solution: </b>%s</h3>", $params->solution)?>
            <?php echo sprintf("<a href='/myTickets' style='text-decoration: none; color: white;' class='btn btn-info'>Go back to list</a>")?>
        </div>
    </div>
</div>
