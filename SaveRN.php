<?php
    $con = mysqli_connect("localhost", "hoseobanking", "hoseo5bank!", "hoseobanking");
    mysqli_query($con,'SET NAMES utf8');

    $userURN = $_POST["userRN"];
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



if($userID === $userUID) {

if($userPassword === $userUPassword) {

  if($userRN !== $userURN) {

$statement = mysqli_prepare($con, "UPDATE usertest SET userRN = ? WHERE userID = ? AND userPassword = ?");
    mysqli_stmt_bind_param($statement, "sss", $userURN, $userUID, $userUPassword);
    mysqli_stmt_execute($statement);

    $statement = mysqli_prepare($con, "SELECT * FROM usertest WHERE userID = ? AND userPassword = ?");
    mysqli_stmt_bind_param($statement, "ss", $userUID, $userUPassword);
    mysqli_stmt_execute($statement);

    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $userID, $userPassword, $userName, $userAge, $userUUID, $userCP, $userRN);

    mysqli_stmt_fetch($statement);

     $response["success"] = "RNSave";
     $response["userID"] = $userID;
     $response["userPassword"] = $userPassword;
     $response["userName"] = $userName;
     $response["userAge"] = $userAge;
     $response["userUUID"] = $userUUID;
     $response["userCP"] = $userCP;
     $response["userRN"] = $userRN;

  }



}

}











}

    echo json_encode($response);
?>
