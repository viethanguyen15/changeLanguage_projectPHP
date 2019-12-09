<?php
    //hung du lieu tu url
    $file_get = $_GET['fie_upload'];
    //mo file
    $file_path = 'upload/'.$file_get;
    //thong bao download file
    //header("Content-disposition: attachment; filename=$file_get"); //tai xuong
    //trinh duyet tra ve dinh dang file
    header("Content-Type: application/pdf");
    readfile($file_path);
?>