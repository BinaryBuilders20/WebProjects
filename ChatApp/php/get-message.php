<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id=mysqli_real_escape_string($connection,$_POST['outgoing_id']);
        $incoming_id=mysqli_real_escape_string($connection,$_POST['incoming_id']);
        $output="";
        $sql= "select * from messages 
        left join users on users.unique_id = messages.outgoing_msg_id
        where (outgoing_msg_id = {$outgoing_id} and incoming_msg_id = {$incoming_id}) 
        or (outgoing_msg_id = {$incoming_id} and incoming_msg_id = {$outgoing_id}) 
        order by msg_id";

        $query=mysqli_query($connection, $sql);
        if(mysqli_num_rows($query)>0){
            while($row=mysqli_fetch_assoc($query)){                
                    if($row['outgoing_msg_id'] == $outgoing_id){//if equal , message sender
                    $output.='                
                    <div class="chat outgoing">
                        <div class="chat-mes">
                            <p>'.$row['msg'].'</p>
                        </div>
                    </div>';
                }else{//he is receiver
                    $output.='
                    <div class="chat incoming">
                        <img src="php/images/'.$row['img'].'" alt="">
                        <div class="chat-mes">
                            <p>'.$row['msg'].'</p>
                        </div>
                    </div>';
                }
            }
            echo $output;
        }
    }else{
        header('Location: login.php');
    }
?>
