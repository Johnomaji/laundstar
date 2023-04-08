
    <?php
    session_start();
    include 'header.php';
    include 'conn.php';
    include 'functions.php';

     // getting the items data from database
     $sql = "SELECT * from tbl_pricing";
     $result = mysqli_query($conn, $sql);
    ?>

        <!-- Hero -->
        <div class="container my-5">
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
            <h1 class="display-1 fw-bold lh-1">Masters of Laundry</h1>
            <p class="lead">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Numquam, itaque. Esse iusto harum ratione repellendus ipsa veritatis deleniti atque iure fugit necessitatibus cupiditate excepturi placeat</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
            <button type="button" class="btn btn-success btn-lg px-4 me-md-2 fw-bold">Get Started</button>
            </div>
        </div>
        <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
            <img class="rounded-lg-3" src="assets/img/hero.jpg" alt="" width="720">
        </div>
        </div>
    </div>
            <!-- Hero -->
        </header>
    </div>
    <!-- end of navbar -->

    <!-- wash section starts -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <img src="assets/img/washer.jpg" alt="Washing image" class="img-fluid">
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <h1 class="display-3 fw-bold text-center">Get Your clothes washed by professionals!</h1>
            </div>
            
        </div>
    </div>
    <!-- wash section ends -->

    <!-- iron section starts -->
    <div class="container my-5 pt-5">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center">
                <h1 class="display-3 fw-bold text-center">Get your clothes Ironed with elegance! </h1>
            </div>
            <div class="col-md-6">
                <img src="assets/img/iron.jpg" alt="Washing image" class="img-fluid">
            </div>
        </div>
    </div>
    <!-- iron section ends -->
    
    <!-- beginning of pricing tags -->
    <section class="pricelist my-5">
        <h1 class="display-2 text-success text-center fw-bold mb-5 mt-4">Price List</h1>

        <div class="container">
            <div class="row d-flex justify-content-center">

                <?php
                    while ($row = mysqli_fetch_assoc($result))
                            {
                ?>

                <div class="col-md-3 mb-5">
                    <div class="card shadow">
                        <img src="<?php echo $row['item_img']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $row['item_name']; ?></h5>
                            <div class="card-item">
                                <h5 class="card-subtitle mb-2 text-muted d-inline-block">Wash/Iron</h5>
                                <span class="badge btn-success rounded-pill ms-3">&#8358;<?php echo $row['full_price']; ?></span>
                            </div>
                        </div>    
                    </div>
                </div>
                
                <?php
                    }
                ?>
            </div>
        </div>
    </section>
        
    <!-- end of pricing tags -->

    <?php
      include 'testimonials.php';
      include 'newslater.php';
      include 'footer.php';
    ?>