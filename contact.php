
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
            <h1 class="display-1 fw-bold lh-1">Contact Us</h1>
            <div style='display: flex; gap: 20px'>
                <form style='flex: 1; width: 50%'>
                    <label>Subject</label><br></br>
                    <input type='text'><br></br>
                    <label>Email</label><br></br>
                    <input type style='flex: 1'='email'><br></br>
                    <label>Message</label><br></br>
                    <textarea></textarea><br></br>
                    <button>Submit</button>
                </form>
                <img style='flex: 1;' class="rounded-lg-3" src="assets/img/hero.jpg" alt="" width="720">
            </div>
            </div>
        </div>
        <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg contact ">
       
           
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