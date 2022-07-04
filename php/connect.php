<?php
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$number = $_POST['number'];

    $servername = "localhost";
    $userName = "root";
    $Password = "Anime101!";
    $dbName = "test";

   $con = mysqli_connect($servername,$userName,$Password,$dbName);

   
   if(mysqli_connect_errono()){
    echo "fail to connect";
    exit();
   }
   echo "connection success";
   $mysql = "INSERT INTO `registration` (`firstName`, `lastName`, `email`, `password`, `number`) VALUES ('$firstName', '$lastName','$email','$password',$number')";

   ?>