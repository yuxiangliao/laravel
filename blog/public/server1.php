<?php

$name = isset($_POST['name'])? $_POST['name'] : '';  
$gender = isset($_POST['gender'])? $_POST['gender'] : '';
$number = isset($_POST['number'])? $_POST['number'] : '';  
$filename = time().substr($_FILES['photo']['name'], strrpos($_FILES['photo']['name'],'.'));  
$response = array();

if(move_uploaded_file($_FILES['photo']['tmp_name'], dirname(__FILE__)."\\".$filename)){  
    $response['isSuccess'] = true;  
    $response['name'] = $name;  
    $response['gender'] = $gender;
    $response['number'] = $number;  
    $response['photo'] = $filename;  
}else{  
    $response['isSuccess'] = false;  
    $response['number'] = dirname(__FILE__)."\\".$filename; 
    $response['name'] = $name;
}  
echo json_encode($response);

?>
