<?php
    $con = mysqli_connect("localhost", "hoseobanking", "hoseo5bank!", "hoseobanking");
    mysqli_query($con,'SET NAMES utf8');

    $userURN = $_POST["userRN"];
    $userUUUID = $_POST["userUUID"];
    $userUID = $_POST["userID"];
    $userUPassword = $_POST["userPassword"];


    $statement = mysqli_prepare($con, "SELECT * FROM usertest WHERE userID = ? AND userPassword = ?");
    mysqli_stmt_bind_param($statement, "ss", $userUID, $userUPassword);
    mysqli_stmt_execute($statement);



    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $userID, $userPassword, $userName, $userAge, $userUUID, $userCP, $userRN);

    $response = array();
    $response["success"] = "false";


while(mysqli_stmt_fetch($statement)) {



if($userRN === $userURN) {

if($userUUID === $userUUUID) {

$key = (int)$userRN ^ $userUUID;						

$hash_sha256 = hash("sha256", $key);		

$hash_5 = substr($hash_sha256,rand(0,59),5);		

$hash_final = hexdec($hash_5);


     $response["success"] = "OK";
     $response["userCode"] = $hash_final;

  } 

}









}

    echo json_encode($response);
?>
