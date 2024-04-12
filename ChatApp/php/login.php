<?php 
    session_start();
    
    include_once "config.php";
    $email=mysqli_real_escape_string($connection,$_POST['eMail']);
    $pass=mysqli_real_escape_string($connection,$_POST['Pass']);

    if(!empty($email)&& !empty($pass)){
        
        $sql=mysqli_query($connection,"select * from users where email='{$email}' and password='{$pass}'");
        if(mysqli_num_rows($sql)>0){
            $row= mysqli_fetch_assoc($sql);
            $status="Active now";
            $sql2=mysqli_query($connection,"UPDATE users SET status='{$status}' where unique_id={$row['unique_id']}");

            if($sql2){
                $_SESSION['unique_id']=$row['unique_id'];
                echo "success";
            }
        }else{
            echo "Email or password incorrect";
        }
    }else{
        echo "all input field required";
    }
?>