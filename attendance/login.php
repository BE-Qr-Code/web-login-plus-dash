<?php

    //getting db connection
    require_once 'DbConnect.php';

    $moodleId=$_POST['moodleId'];
    $password=md5($_POST['password']);

    //an array to display response
    $output=array();

    $stmt=$conn->prepare("SELECT MoodleID,password FROM registration WHERE MoodleID=? AND password=?");
    $stmt->bind_param("is",$moodleId,$password);
    $stmt->execute();
    $stmt->store_result();
    
    if($stmt->num_rows==0){
        $output['isSuccess']=0;
        $output['message']="Incorrect MoodleId or Password";
    }
    else{
        $stmt->bind_result($moodleId,$password);
        $stmt->fetch();
        

        $user_details=array(
            'moodleId'=>$moodleId
        );

        $output['isSuccess']=1;
        $output['message']="Login Successfull!";
        $output['user_details']=$user_details;        
    }

    echo json_encode($output);
?>