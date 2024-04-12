<?php 
while($row=mysqli_fetch_assoc($sql)){
    $output.='
    <a href="#">
    <div class="content">
        <img src="php/images/'.$row['img'].'">
        <div class="detail">        
            <span>'. $row['fname']." ". $row['lname'].'</span>
            <p>This is testing message</p>
        </div>
    </div>
    <div class="status-dot"><i class="fa fa-circle"></i></div>
    </a>
    ';
}