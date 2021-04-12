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

if(empty($userURN)) {


     $response["success"] = "EmptyRN";


  } 

else if($userRN !== $userURN) {


     $response["success"] = "RNfalse";


  } 

  else if($userRN === $userURN) {


     $response["success"] = "RNOk";
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
