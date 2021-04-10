
<?php
use app\core\Application;
?>

<?php

$success = Application::$app->session->getAuth('user');

?>

<h1>Hello home page!</h1>