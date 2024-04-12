<?php 
    session_start();
    include_once "config.php";
    $outgoing_id=$_SESSION['unique_id'];
    $output="";
    $searchTerm=mysqli_real_escape_string($connection, $_POST['searchText']);
    
    $sql=mysqli_query($connection,"SELECT * FROM users where not unique_id = {$outgoing_id} and (fname like '%{$searchTerm}%' or lname like '%{$searchTerm}%' )");
    if(mysqli_num_rows($sql)>0){
        include "data.php";
    }else{
        $output .="No user found with this name..";
    }
    echo $output;
?>