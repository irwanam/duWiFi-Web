<?php
    require_once '../core/Radius.php';
    
    $radius = new Radius();
    
    if(isset($_POST['checkLeftTime'])){
        $totalsecond =  $radius->leftSessionTime($_POST['username']);
        echo json_encode($totalsecond);
    }
?>