<?php 

    session_start();
    if(isset($_SESSION['unique_id'])){
    header("location: user.php");
}
?>

<?php 
    include_once "header.php";
?>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Real Time Chat App</header>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="error"></div>
                    <div class="field input">
                        <label>Enter Your Email</label>
                        <input type="email" name="eMail" placeholder="Email Address">
                    </div>
                    <div class="field input">
                        <label>Enter Password</label>
                        <input type="password" name="Pass" placeholder="Password">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    
                    <div class="field button">
                        <input type="submit" value="Contine to Chat">
                    </div>
            </form>
            <div class="link">Already Signed Up ?<a href="index.php">Sign In Here</a></div>
        </section>
    </div>
</body>
<script src="js/login.js"></script>
<script src="js/pass.js"></script>
</html>