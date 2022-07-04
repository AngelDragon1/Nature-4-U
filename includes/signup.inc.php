<?php

if (isset($_POST['signup-submit'])) {


    require 'connect-db.php';


    $username = $_POST['Userid'];
    $email= $_POST['mail'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['password-repeat'];

    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyfields&Userid=".$username."&mail=".$email);
        exit();
    }

    else if (!filter_var($email, FILTER_VAILIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/")) {
        header("Location: ../signup.php?error=invalidmail&Userid=".$username);
        exit();
    }

    else if (!filter_var($email, FILTER_VAILIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&Userid=".$username);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidUserid&mail=".$email);
        exit();
    }
    else if ($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordcheck&Userid==".$username. "&mail=".$email);
        exit();
    }

    else {
       $sql = "SELECT UserID FROM users WHERE UserID=?"; 
       $statement = mysqli_statement_init($conn);
       if (!mysqli_statement_prepare($statement, $sql)) {
        header("Location: ../signup.php?error=sqlerror");
        exit();
       }
    else {
        mysqli_statement_param($statement, "s", $username);
        mysqli_statement_execute($statement);
        mysqli_statement_store_result($statement);
        $resultCheck = mysqli_statement_num_rows($statement);
        if ($resultCheck > 0) {
            header("Location: ../signup.php?error=usertaken&mail=".$email);
            exit();
        }
        else {
            $sql = "INSERT INTO `user` (`UserID`, `UserNameID`, `EmailUsers`, `UserPassword`) VALUES ('$UserID',?,?,?)"; 
            $statement = mysqli_statement_init($conn);
            if (!mysqli_statement_prepare($statement, $sql)) {
                header("Location: ../signup.php?error=sqlerror");
                exit();
        }
        else {
            $hashpassword = password_hash($password, PASSWORD_DEFAULT);

        mysqli_statement_param($statement, "sss", $username, $email, $hashpassword );
        mysqli_statement_execute($statement);
        header("Location: ../signup.php?signup=success");
        exit();
        }
     }           
    }
 }
 mysqli_statement_close($statement);
 mysqli_clost($conn);

}
else {
    header("Location: ../signup.php?signup=success");
        exit();
}