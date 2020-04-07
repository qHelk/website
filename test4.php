<?php
    $uploadFile = '/save_img/' . basename($_FILES["fhoto"]["name"]);
    $uploadF = $_SERVER['DOCUMENT_ROOT'] . $uploadFile;
    if (move_uploaded_file($_FILES['fhoto']['tmp_name'], $uploadF)){
        $mysqli = new mysqli("127.0.0.1:3306", "root", "", "users");
        if ($mysqli->connect_errno){
            echo $mysqli->connect_errno;
            exit;
        }
        $query = "INSERT INTO `users`(`path`) VALUES ('$uploadFile')";
        $mysqli->query($query);

        if ($mysqli->errno){
            echo $mysqli->errno;
            exit;
        }

        echo "ok";
    } else{
        echo "ne_ok";
    }

?>