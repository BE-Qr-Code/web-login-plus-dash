<?php

    //getting db connection
    require_once 'DbConnect.php';

    //an array to display response
    $output=array();

    $stmt=$conn->prepare("SELECT * from department");
    $stmt->execute();
    //$stmt->store_result();
    $result = $stmt->get_result();

    if ($result->num_rows>0) {
        # Save in $row_data[] all columns of query
        
        while($row_data = $result->fetch_assoc()) {
            $output['data'][] = $row_data;
        }
        $output['isSuccess']=1;
    }
    else{
        $output['isSuccess']=0;
        $output['message']="No data found!";
    }
    $stmt->close();

    echo json_encode($output);
?>