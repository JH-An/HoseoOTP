<?php
    $con = mysqli_connect("localhost", "hoseobanking", "hoseo5bank!", "hoseobanking");
    mysqli_query($con,'SET NAMES utf8');

    $userUID = $_POST["userID"];
    $userUPassword = $_POST["userPassword"];
    $userUUUID = $_POST["userUUID"];
    $userUUUIDCheckNB = $_POST["userUUIDCheckNB"];


    $statement = mysqli_prepare($con, "SELECT * FROM usertest WHERE userID = ? AND userPassword = ? OR userUUID = ?");
    mysqli_stmt_bind_param($statement, "sss", $userUID, $userUPassword, $userUUUID);
    mysqli_stmt_execute($statement);



    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $userID, $userPassword, $userName, $userAge, $userUUID, $userCP, $userRN);

    $response = array();
    $response["success"] = "false";


while(mysqli_stmt_fetch($statement)) {

if(strcmp($userUUUIDCheckNB, "1")) {

if($userID === $userUID) {

if($userPassword === $userUPassword) {

  if(empty($userUUID) ) {

     $response["success"] = "UUIDnull";
     $response["userName"] = $userName;
     $response["userCP"] = $userCP;

  }

  else if($userUUID !== $userUUUID) {

     $response["success"] = "UUIDfalse";
     $response["userName"] = $userName;

  }

  else if($userUUID === $userUUUID) {
     $response["success"] = "true";
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



else if(strcmp($userUUUIDCheckNB, "2")) {

if($userID === $userUID) {

if($userPassword === $userUPassword) {

if(empty($userUUID)) {

    $statement = mysqli_prepare($con, "UPDATE usertest SET userUUID = ? WHERE userID = ? AND userPassword = ?");
    mysqli_stmt_bind_param($statement, "sss", $userUUUID, $userUID, $userUPassword);
    mysqli_stmt_execute($statement);

    $statement = mysqli_prepare($con, "SELECT * FROM usertest WHERE userID = ? AND userPassword = ?");
    mysqli_stmt_bind_param($statement, "ss", $userUID, $userUPassword);
    mysqli_stmt_execute($statement);

    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $userID, $userPassword, $userName, $userAge, $userUUID, $userCP, $userRN);

    mysqli_stmt_fetch($statement);

     $response["success"] = "true";
     $response["userID"] = $userID;
     $response["userPassword"] = $userPassword;
     $response["userName"] = $userName;
     $response["userAge"] = $userAge;
     $response["userUUID"] = $userUUID;
     $response["userCP"] = $userCP;
     $response["userRN"] = $userRN;




}

else if($userUUID !== $userUUUID) {

     $response["success"] = "UUIDfalse";
     $response["userName"] = $userName;

  }

  else if($userUUID === $userUUUID) {
     $response["success"] = "true";
     $response["userID"] = $userID;
     $response["userPassword"] = $userPassword;
     $response["userName"] = $userName;
     $response["userAge"] = $userAge;
     $response["userUUID"] = $userUUID;
     $response["userCP"] = $userCP;
     $response["userCP"] = $userRN;


   }

}
}

}






}

    echo json_encode($response);
?>
