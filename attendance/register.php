<?php

    //getting db connection
    require_once 'DbConnect.php';

    //an array to display response
    $output=array();

    //getting the values
    $moodleId=$_POST['moodleId'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $dept=$_POST['dept'];   //the dept name is of the form (COMPUTER ENGINEERING - BE) but we have to store the DepartID only
    $password=md5($_POST['password']);  //md5 encrypts password and the encrypted password is 32bits long!!

    //checking if the user is already exist with this username or email
    //as the email and username should be unique for every user
    $stmt=$conn->prepare("SELECT * FROM registration WHERE MoodleID=?");
    $stmt->bind_param("i",$moodleId);
    $stmt->execute();
    $stmt->store_result();

    //extract departname and year from the string
    $dept_split=explode(" - ",$dept);
    $deptName=$dept_split[0];
    $year=$dept_split[1];

    //if the user already exist in the database
    if($stmt->num_rows!=0){
        $output['isSuccess']=0;
        $output['message']="MoodleId already exists! Please try again";
    }
    else{
        //get the deartmentID
        $stmt=$conn->prepare("SELECT DepartID from department where DepartName=? and year=?");
        $stmt->bind_param("ss",$deptName, $year);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($dept_id);
        $stmt->fetch();

        //insert into database
        $stmt=$conn->prepare("INSERT INTO registration (MoodleID,fname,lname,DepartID,password) VALUES (?,?,?,?,?)");
        $stmt->bind_param("issss",$moodleId,$fname,$lname,$dept_id,$password);
        
        if($stmt->execute()){
            $output['isSuccess']=1;
            $output['message']="Registration Successfull!";
            $output['user_details']=$moodleId;            
        }
        else{
            $output['isSuccess']=0;
            $output['message']="Registration failed, Please try again!";    
        }
    }

    echo json_encode($output);
?>