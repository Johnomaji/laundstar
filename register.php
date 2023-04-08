<?php
    session_start();
    include 'header.php';
    include 'conn.php';
    include 'functions.php';

    // make page unavailable to logged in members
    if (isset($_SESSION['email'])) {
        header('location: index.php');
      }

    if (isset($_POST['submitReg'])) {

        //checking if user already exists
        $emailTest = $_POST['inputEmail'];
        $sql = "SELECT * from tbl_user WHERE email='$emailTest'";
        $emailResult = mysqli_query($conn, $sql);

        if (mysqli_num_rows($emailResult) > 0) {
        $alert = "Sorry user already exist, use another email";
        } //end of email exist

        else {
            //   assign data to php vars
        $email = testInput($_POST['inputEmail']);
        $username = testInput($_POST['inputUsername']);
        $pwd = testInput($_POST['inputPassword']); 

        // query to insert info to db
        $sql = "INSERT INTO tbl_user (email, username, pwd) VALUES ('$email', '$username', '$pwd')";

        //upload info to database
        if (mysqli_query($conn, $sql)) {
            $msg = "Sign up successful";
        }

        // Making some data available till logout
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;

        //Redirect to homepage
        header('location: index.php');
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
                    <h1 class="m-2 h3 mb-3 font-weight-normal">Fill form to create account</h1>
                    <label for="inputEmail" class="m-2">Email address</label>
                    <input type="email" id="inputEmail" name="inputEmail" class="m-2 form-control" placeholder="Email address" 
                    value="<?php if (isset($_POST['inputEmail'])) { echo $_POST['inputEmail'];} ?>" required>

                    <label for="inputUsername" class="m-2">Username</label>
                    <input type="text" id="inputUsername" name="inputUsername" class="m-2 form-control" placeholder="Username"
                    value="<?php if (isset($_POST['inputUsername'])) { echo $_POST['inputUsername'];} ?>" required>

                    <label for="inputPassword" class="m-2">Password</label>
                    <input type="password" id="inputPassword" name="inputPassword" class="m-2 form-control" placeholder="Password"
                    value="<?php if (isset($_POST['inputPassword'])) { echo $_POST['inputPassword'];} ?>" required>

                    <div class="checkbox m-2">
                        <label>
                        <input type="checkbox" value="remember-me" checked> I agree to terms and conditions
                        </label>
                    </div>

                    <p class="m-2">Already have an accoount? <a href="login.php" class="text-decoration-none text-success">Log In</a> </p>

                    <button class="btn btn-outline-success btn-block m-2 w-100" type="submit" name="submitReg">Create Account</button>
                 </form>
            </div>
        </div>
    </div>
    
        

<?php
    include 'footer.php';
?>