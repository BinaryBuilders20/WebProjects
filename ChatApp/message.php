<?php 
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: login.php");
    }
    include_once "header.php";
?>
<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
            <?php
                include_once "php/config.php";
                $user_id = mysqli_real_escape_string($connection, $_GET['user_id']);
                $sql = "SELECT * FROM users WHERE unique_id = $user_id";
                $result = mysqli_query($connection, $sql);
                if($result && mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
                }
                ?>
                <a href="user.php" class="back-icon"><i class="fa fa-arrow-left"></i></a>
                <img src="php/images/<?php echo $row['img']?>" alt="">
                <div class="detail">
                    <span><?php echo $row['fname']." ".$row['lname']?></span>
                    <p><?php echo $row['status']?></p>
                </div>
            </header>
            <div class="chat-box">
                <!-- Chat messages will be displayed here -->
            </div>
            <form id="chat-form" class="typing-area" autocomplete="off">
                <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id'];?>" hidden>
                <input type="text" name="incoming_id" value="<?php echo $user_id;?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message...">
                <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
            </form>
        </section>
    </div>
    <script src="js/message.js"></script>
</body>
</html>
