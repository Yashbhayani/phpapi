<?php	
$con = mysqli_connect("localhost","root");
    if($con){
    }else{
        echo " no connection";
    }
    mysqli_select_db($con, 'react_crud');
?>
