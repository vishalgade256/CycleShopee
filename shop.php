<?php
    $pricef=false;
    $sizef=false;
    $typef=false;
    $minprice = "";
    $maxprice = "";
    include "_ses/_dbconn.php";
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        $pricef=true;
        $minprice=$_POST["minprice"];
        $maxprice=$_POST["maxprice"];
        $size=$_POST["size"];
        $type=$_POST["type"];
        if($minprice!='' || $maxprice!=''){
            $pricef=true;
            $sizef=false;
            $typef= false;
        }elseif($size!="Choose..."){
            $pricef=false;
            $sizef=true;
            $typef= false;
        }elseif($type!='Choose...'){
            $pricef=false;
            $sizef=false;
            $typef= true;
        }else{
            $pricef=false;
            $sizef=false;
            $typef=false;
        }
    }
?>

<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
        <link rel="icon" type="image/x-icon" href="img/web_ico.jpg">
        <title>Cycle Shopee</title>
    </head>
    
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Cycle Shopee</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="shop.php">Shop</a>
                        </li>
                      
                    </ul>
                    <?php
                        if(isset($_SESSION['loggedin'])){
                            echo '<div class-"nav-item d-flex">Hello, '.$_SESSION["name"].'</div>';
                        }
                    ?>
                    <div class="nav-item dropdown">                  
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                            <img src="img/user.png" alt="">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if (isset($_SESSION['loggedin'])) {
                                echo'
                                <li><a class="dropdown-item" href="orderht.php">Your orders</a></li>
                                <li><a class="dropdown-item" href="wishlistt.php">Your wishlist</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="_ses/logout.php">LogOut</a></li>';
                                }else echo'<li><a class="dropdown-item" href="_ses/login.php">Login</a></li>';
                            ?>
                        </ul>
                    </div>
                    <a href="cartt.php"><img src="img/shopping-cart.png" alt="" class="d-flex"></a>
                </div>
            </div>
        </nav>
        <?php
            $ins_atc=false;
            if(isset($_GET['atc'])){
                if (!isset($_SESSION['loggedin'])){
                    echo '<div class="alert alert-warning mt-3 alert-dismissible fade show mt-3;" role="alert">
                     Please <a href="_ses/login.php">login</a> to continue
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                 
                }else{
                    
                 echo '<div class="alert alert-success mt-3 alert-dismissible fade show mt-3;" role="alert">
                         <strong>Success!!</strong> One item added to cart successfullty 
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                     $ins_atc=true;

                }
        
            }
            $ins_atw=false;
            if(isset($_GET['atw'])){
                if (!isset($_SESSION['loggedin'])){
                    echo '
                    <div class="alert alert-warning mt-3 alert-dismissible fade show mt-3;" role="alert">
                        Please <a href="_ses/login.php">login</a> to continue
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                 
                }else{
                    
                 echo '<div class="alert alert-success mt-3 alert-dismissible fade show mt-3;" role="alert">
                         <strong>Success!!</strong> One item added to wishlist successfullty 
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                     $ins_atw=true;

                }
        
            }
        ?>
        <div class="container border">
            <form action="shop.php" method="post">
                <div class="row">
                    <div class="col">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="row">
                            <div class="col"> <input type="text" name="minprice" placeholder="Enter Minimum Price"  id="minprice" class="m-1 form-control " <?php 
                                if($minprice!='') echo'value="'.$minprice.'"';
                            ?>></div>
                            <div class="col"> <input type="text" name="maxprice" placeholder="Enter Maximum Price"  id="maxprice" class="m-1 form-control " <?php
                                if($maxprice!='') echo'value="'.$maxprice.'"';
                            ?>></div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 m-1">Filter by price</button>
                        </div><div class="col">
                        <div class="input-group m-1">
                            <label class="input-group-text"  for="inputGroupSelect01">Select Size</label>
                            <select class="form-select"  name="size" id="size">
                                <option selected>Choose...</option>
                                <option value="Small">Small</option>
                                <option value="Large">Large</option>
                                <option value="Medium">Medium</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 m-1">Filter by size</button>
                    </div><div class="col">
                        <div class="input-group  m-1">
                            <label class="input-group-text"  for="inputGroupSelect01">Select Type</label>
                            <select class="form-select" name="type" id="type">
                                <option selected>Choose...</option>
                                <option value="BMX">BMX</option>
                                <option value="MTB">MTB</option>
                                <option value="Hybrid">Hybrid</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 m-1">Filter by type</button>
                    </div>
                </div>
            </form>                             
        </div>
        
        <div class="container my-3">
        <div class="row">

            <?php
            if($pricef==true){
                if($minprice=="") $sql = "SELECT * FROM products where price < $maxprice";
                elseif($maxprice=="") $sql="SELECT * FROM products where price > $minprice";
                else $sql="SELECT * FROM products where price < $maxprice and price > $minprice";
            }elseif($sizef==true){
                $sql="SELECT * FROM products where size = '$size'";
            }elseif($typef==true){
                $sql="SELECT * FROM products where type = '$type'";
            }else{
                $sql="SELECT * FROM products";
            }
            $res=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_assoc($res)){
                echo '
                <div class="col-md-3 mb-3">
                <div class="card" style="width: 18rem;">
                <img src="'.$row['image'].'" class="card-img-top" width="286px" height="214px" alt="...">
                <div class="card-body">
                <h5 class="card-title">'.$row['title'].'</h5>
                <p class="card-text">Size: '.$row['size'].', Type:'.$row['type'].'</p>
                <p class="card-text">Rs. '.$row['price'].'</p>
                <a href="shop.php?atc='.$row["id"].'" class="btn btn-primary addtocart" id='.$row["id"].'>Add to cart</a>
                <a href="shop.php?atw='.$row["id"].'" class="btn btn-info addtowish ms-4" id='.$row["id"].'><img src="img/wishlist-icon.png" width=20> Wishlist</a>
                </div>
                </div>
                </div>';
            }
            
            ?>
            </div>  
        </div>
           
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ"
        crossorigin="anonymous"></script>

        
    </body>
</html>
<?php
    if($ins_atc){
        $tblnm = $_SESSION['username'];
        $prno=$_GET['atc'];
        $insatc = "INSERT INTO `cycleshopee`.`$tblnm` (`prNo`, `Target`, `ordertime`) VALUES ($prno, 'c', 'current_timestamp()')";
        $exct=mysqli_query($conn,$insatc);
        echo $tblnm;
    }
    if($ins_atw){
        $tblnm = $_SESSION['username'];
        $prno=$_GET['atw'];
        $insatc = "INSERT INTO `cycleshopee`.`$tblnm` (`prNo`, `Target`, `ordertime`) VALUES ($prno, 'w', 'current_timestamp()')";
        $exct=mysqli_query($conn,$insatc);
        echo $tblnm;
    }
?>