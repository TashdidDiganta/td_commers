<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/4ac9a7d2dc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<header class="header d-flex align-items-center">
            <div class="d-flex">
                <a href="#" class="logo"><span>TD Blogs</span></a>
            </div>

            <div class="search-bar">
                <form action="" class=" search-form d-flex align-items-center">
                    <input  type="text" placeholder="Search">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <nav class="header-nav">
                <ul>
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#">
                    <i class="fa-solid fa-user"></i>
                    <span class="d-none d-md-block dropdown-toggle ps-2">Diganta</span>
                    </a><!-- End Profile Iamge Icon -->
                </ul>
            </nav>
        </header>
    <!-- Header Section End -->


    <!-- Sidebar Start -->
    <aside class="sidebar">
        <ul class="sidebar-nav">
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="fa-solid fa-bars"></i>
                <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="profile.php">
                <i class="fa-regular fa-address-book"></i>
                <span>Profile</span>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="logout.php">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>log Out</span>
                </a>
            </li>
        </ul>
    </aside>
    <!-- Sidebar End -->


    <?php
    $msg ="";
    $conn = mysqli_connect("localhost", "root", "", "td_commers");
    if(!$conn){
        $msg="Server Connnection Faield" . mysqli_connect_error();
    } 
    
    
    ?>


    <main id="main">
        <!-- Product Table Start -->

        <?php
        
        $sql = "SELECT * FROM `products`";
        $product_result = mysqli_query($conn, $sql);


        echo "<div class='card-box'>";
        while($fetch_product = mysqli_fetch_assoc($product_result)){
              $encode_product = htmlspecialchars(json_encode($fetch_product), ENT_QUOTES, 'UTF-8');
                echo  "<div class='card mt-3' style='width: 18rem;'>";
                    echo "<img src='https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8cHJvZHVjdHxlbnwwfHwwfHx8MA%3D%3D' class='card-img-top' >";
                    echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>"."<span>"."Title: "."</span>" .$fetch_product['product_title']. "</h5>";
                        echo "<p class='card-text'>"."<span>"."Description: "."</span>" .$fetch_product['product_description']."</p>";
                        echo "<h5 class='card-price'>"."<span>"."Price: "."</span>" .$fetch_product['product_price']. "</h5>";
                        echo "<button onclick='getProduct({$encode_product})' class='btn btn-primary'>"."Buy"."</button>";
                    echo "</div>";
                echo"</div>";
            }
            echo"</div>";
        ?>

        <!-- Product Table End -->
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="app.js"></script>
</body>
</html>