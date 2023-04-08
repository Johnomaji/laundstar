<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaundStar</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <sstyle>
        .contact {
            display: flex;
        }
    </sstyle>
</head>
<body>
    <!-- beginning of navbar -->
    <div>
            <header>
  <!-- Navbar -->

        <nav class="navbar navbar-expand-md navbar-dark bg-success fixed-top shadow">
            <div class="container">
                <a class="navbar-brand fw-bold" href="index.php">LaundStar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarID"
                    aria-controls="navbarID" aria-expanded="true" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarID">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                        <a class="nav-link"  aria-disabled="false" href="about.php">About</a>
                        <a class="nav-link"  aria-disabled="false" href="contact.php">Contact</a>

                        <?php if (isset($_SESSION['email'])) { ?>
                            <a class="btn btn-light text-success nav-link ms-3" href="add.php" role="button"> Place Order </a>
                            <a class="btn btn-outline-dark text-light nav-link ms-3" href="logout.php" role="button"> Log Out </a>
                        <?php } else {?>
                            <a class="btn btn-light text-success nav-link ms-3" href="register.php" role="button"> Get Started </a>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </nav>