<?php
    session_start();
    include 'header.php';
    include 'conn.php';
    include 'functions.php';

    // make page unavailable to logged in members
    if (isset($_SESSION['email'])) {
        header('location: index.php');
    }
  
    //checking and getting signed in data
    if (isset($_POST['submitLogin'])) {
        $email = testInput($_POST['loginEmail']);
        $pwd = testInput($_POST['loginPwd']);
        $sql = "SELECT * from tbl_user WHERE email='$email' AND pwd='$pwd'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)){
            $_SESSION['email'] = $row["email"];
            $_SESSION['username'] = $row["username"];
            header('location: index.php'); //Redirect to homepage
            }
        } else {
        $alert = "Wrong Email or password";
        }
        
    }
    ?>

    <div class="container p-5 m-5">
        <div class="row justify-content-center">
            <div class="col-md-4 shadow p-4">

            <?php
            // Code to display error messages
            if (isset($alert)){
              echo '<div class="alert alert-danger"><p>';
              echo $alert;
              echo "</p> </div>";
            }

            // Code to display success messages
            elseif (isset($msg)) {
              echo '<div class="alert alert-success"><p>';
              echo $msg;
              echo "</p></div>";
            }
            ?>

                <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
                    <h1 class="m-2 h3 mb-3 font-weight-normal">Fill form to Log In</h1>
                    <label for="loginEmail" class="m-2">Email address</label>
                    <input type="email" id="loginEmail" name="loginEmail" class="m-2 form-control" placeholder="Email address" 
                    value="<?php if (isset($_POST['loginEmail'])) { echo $_POST['loginEmail'];} ?>" required>

                    <label for="loginPwd" class="m-2">Password</label>
                    <input type="password" id="loginPwd" name="loginPwd" class="m-2 form-control" placeholder="Password"
                    value="<?php if (isset($_POST['loginPwd'])) { echo $_POST['loginPwd'];} ?>" required>

                    <p class="m-2">Don't have an accoount? <a href="login.php" class="text-decoration-none text-success">Create Account</a> </p>

                    <button class="btn btn-success btn-block m-2 w-100" type="submit" name="submitLogin">Log In</button>
                 </form>
            </div>
        </div>
    </div>
    
        

<?php
    include 'footer.php';
?>