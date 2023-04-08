
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

   
    

    <?php
     
      include 'footer.php';
    ?>