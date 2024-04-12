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
        <section class="form signup">
            <header>Real Time Chat App</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error"></div>
                <div class="name-details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" name="fName" placeholder="First Name" required>
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" name="lName" placeholder="Last Name" required>
                    </div>
                </div>
                    <div class="field input">
                        <label>Email</label>
                        <input type="email" name="eMail" placeholder="Enter Your Email" required>
                    </div>
                    <div class="field input">
                        <label>Password</label>
                        <input type="password" name="Pass" placeholder="Enter Password" required>
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <div class="field image">
                        <label>Set Pf Picture</label>
                        <input type="file" name="image" required>
                    </div>
                    <div class="field button">
                        <input type="submit" value="Create Account">
                    </div>
            </form>
            <div class="link">Already Signed Up?<a href="login.php">Login Here</a></div>
        </section>
    </div>
</body>
<script src="js/pass.js"></script>
<script src="js/signup.js"></script>
</html>