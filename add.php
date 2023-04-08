<?php
    session_start();
    include 'header.php';
    include 'conn.php';
    include 'functions.php';

    if (!isset($_SESSION['email'])) {
        header('location: index.php');
    }

    //code for Cart
    if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        
        //code for adding product in cart
        case "add":
            if(!empty($_POST["quantity"])) {
                $pid=$_GET["pid"];
                $result=mysqli_query($conn,"SELECT * FROM tbl_pricing WHERE item_id='$pid'");
                  while($productByCode=mysqli_fetch_array($result)){
                $itemArray = array($productByCode["code"]=>array('name'=>$productByCode["item_name"], 'code'=>$productByCode["code"], 'quantity'=>$_POST["quantity"], 'price'=>$_POST["price"]));
                if(!empty($_SESSION["cart_item"])) {
                    if(in_array($productByCode["code"],array_keys($_SESSION["cart_item"]))) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                                if($productByCode["code"] == $k) {
                                    if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                        $_SESSION["cart_item"][$k]["quantity"] = 0;
                                    }
                                    $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                                }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                    }
                }  else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
        }
        break;
    
        // code for removing product from cart
        case "remove":
            if(!empty($_SESSION["cart_item"])) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                        if($_GET["code"] == $k)
                            unset($_SESSION["cart_item"][$k]);				
                        if(empty($_SESSION["cart_item"]))
                            unset($_SESSION["cart_item"]);
                }
            }
        break;

        // code for if cart is empty
        case "empty":
            unset($_SESSION["cart_item"]);
        break;	
    }
    }

?>
    <div class="mt-5 container">
        <div class="row g-5">
            <div class="col-lg-8 col-md-7">
                <p class="h2 mt-5 text-success">Category of Laundry Items</p>

                <div class="table-responsive">
                    <table class="table table-sm table-striped border">
                        <thead>
                            <tr>
                                <th scope="col">Item name</th>
                                <th scope="col">Wash (&#8358;) </th>
                                <th scope="col">Iron (&#8358;) </th>
                                <th scope="col">Wash &amp; Iron (&#8358;) </th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <?php
                            $query = "SELECT * FROM tbl_pricing ORDER BY item_id ASC";
                            $product= mysqli_query($conn, $query);
                            if (!empty($product)) {
                            while ($row=mysqli_fetch_array($product)) {
                            ?>
                        <tbody>
                            <form action="add.php?action=add&pid=<?php echo $row["item_id"]; ?>" method="post">
                                <tr>
                                    <td> <?php echo $row['item_name']; ?> </td>
                                    <td>
                                        <input type="radio" name="price" id="washPrice<?php echo $row["item_id"]; ?>" value="<?php echo $row['wash_price']; ?>">
                                        <label for="washPrice<?php echo $row["item_id"]; ?>"> <?php echo $row['wash_price']; ?> </label>
                                    </td>
                                    <td>
                                        <input type="radio" name="price" id="ironPrice<?php echo $row["item_id"]; ?>" value="<?php echo $row['iron_price']; ?>">
                                        <label for="ironPrice<?php echo $row["item_id"]; ?>"> <?php echo $row['iron_price']; ?> </lead>
                                    </td>
                                    <td>
                                        <input type="radio" name="price" id="fullPrice<?php echo $row["item_id"]; ?>" value="<?php echo $row['full_price']; ?>">
                                        <label for="fullPrice<?php echo $row["item_id"]; ?>"> <?php echo $row['full_price']; ?> </label>
                                    </td>
                                    <td style="width:15%"> <input type="number" class="product-quantity" name="quantity" value="1" size="2" style="width:55%"/> </td>
                                    <td> <input type="submit" value="Add" name="addToCart" class="btn btn-success"></td>
                                </tr>
                            </form>
                        </tbody>
                        <?php
                                }
                            } else {
                            echo "No Records.";
                            }
                        ?>
                    </table>
                </div>
            </div>

            <div class="col-lg-4 col-md-5 mt-5 pt-5">
               
                <?php
                if(isset($_SESSION["cart_item"])){
                    $total_quantity = 0;
                    $total_price = 0;
                ?>

                <h3 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-success">Your cart</span>
                </h3>

                <ul class="list-group mb-3">
                    <?php		
                    foreach ($_SESSION["cart_item"] as $item){
                    $item_price = $item["quantity"]*$item["price"];
                    ?>

                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0"><?php echo $item["name"]; ?></h6>
                            
                        </div>
                        <span class="text-muted"><?php echo number_format($item_price,2); ?></span>
                        <span class="text-muted"><a href="add.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction">
                        <img src="assets/img/icon-delete.png" alt="Remove Item" /></a></span>
                    </li>
            
                    <?php
                    $total_quantity += $item["quantity"];
                    $total_price += ($item["price"]*$item["quantity"]);
                    }
                    ?>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total</span>
                        <strong>&#8358;<?php echo number_format($total_price, 2); ?></strong>
                    </li>

                    <form action="" method="post">
                        <li class="list-group-item d-flex justify-content-between">
                            <a id="btnEmpty" href="add.php?action=empty" class="text-decoration-none text-danger">Empty Cart</a>
                            <input type="submit" class="btn btn-success btn-sm" role="button" name="checkout" value="Checkout">
                        </li>
                    </form>
                    
                </ul>

                

                <?php
                } else {
                ?>
                <div class="lead">Your Cart is Empty</div>
                <?php 
                }

                
                // code for checkout
                if (isset($_POST['checkout'])){

                    // adding cart data to php variables
                    $itemName = $item["name"];
                    $itemQty = $item["quantity"];
                    $itemPrice = $item["price"];
                    $totalPrice = $total_price;
                    $username = $_SESSION['username'];
        
                    // query to insert info to db
                    $sql = "INSERT INTO tbl_order (item_name, qty, item_price, total_price, username) VALUES ('$itemName', '$itemQty', '$itemPrice', '$totalPrice', '$username')";
        
                    //upload info to database
                    if (mysqli_query($conn, $sql)) {
                        $msg = "Sign up successful";
                    }
                }

                ?>

            </div>
            
        </div>
    
    </div>


<?php
    include 'footer.php';
?>