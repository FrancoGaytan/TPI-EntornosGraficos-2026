<?php
require_once __DIR__ . '/../includes/bootstrap.php';
    require_app('includes/isSessionStarted.php');

    require_app('includes/destroySession.php');
    
    require __DIR__ . '/../index.php';

?>
