<?php
    session_start();
    include_once "config.php";
    $fname=mysqli_real_escape_string($connection,$_POST['fName']);
    $lname=mysqli_real_escape_string($connection,$_POST['lName']);
    $email=mysqli_real_escape_string($connection,$_POST['eMail']);
    $pass=mysqli_real_escape_string($connection,$_POST['Pass']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($pass)){
        //check email valid or not
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $sql= mysqli_query( $connection,"select email from users where email= '{$email}'" );
            if(mysqli_num_rows($sql)>0){
                echo "$email already exists!";
            }else{
                //check image uploaded or not
                if(isset($_FILES['image'])){//if file uploaded
                    $img_name=$_FILES['image']['name'];//get image name 
                    $img_type=$_FILES['image']['type'];//get image type
                    $tmp_name=$_FILES['image']['tmp_name'];//this name is used to save file in folder
                    
                    //explode to get extension
                    $img_explode=explode(".",$img_name);
                    $img_ext=end($img_explode);

                    $extensions=['png', 'jpg', 'jpeg'];
                    if(in_array($img_ext,$extensions)===true){
                        $time=time();//return current time
                        //move the image to the folder
                        $new_img_name=$time.$img_name;
                        if(move_uploaded_file($tmp_name,"images/".$new_img_name)){
                            //once signed up , he's active now
                            $status="Active Now";
                            $random_id=rand(time(),100000000);//create random id for user
                            $sql2=mysqli_query($connection,"INSERT INTO users(unique_id , fname , lname , email , password , img , status) 
                                                            VALUES({$random_id},'{$fname}','{$lname}','{$email}','{$pass}','{$new_img_name}','{$status}')");
                            if($sql2){
                                $sql3=mysqli_query($connection,"SELECT * FROM users WHERE email= '{$email}'");
                                if(mysqli_num_rows($sql3)>0){
                                    $row=mysqli_fetch_assoc($sql3);
                                    $_SESSION['unique_id']=$row['unique_id'];
                                    echo"success";
                            }    
                    }
                    }else{
                        echo "Choose file like -jpeg png jpg";
                    }
                    
                }else{
                echo "Select an Image first!";
            }
        }

        }
    }
        else{
            echo " $email-This is not a valid email";
        }
    }else{
        echo "all input field required";
    }

?>
