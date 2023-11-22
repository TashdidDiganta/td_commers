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
                <a class="nav-link collapsed" href="content.php">
                <i class="fa-regular fa-address-book"></i>
                <span>View Content</span>
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


    <main id="main">
        <!-- Product Table Start -->
        <div class="col-lg-12">
            <div class="card product-table overflow-auto">
                <div class="filter">
                    <a href="" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add</a>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Top Seling<span>| Today</span></h5>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Preview</th>
                                <th>Product title</th>
                                <th>Description</th>
                                <th>price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><img src="profile-img.jpg" alt=""></th>
                                <td>Lorem ipsum dolor, </td>
                                <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit amet voluptatem molestiae illum atque nostrum error unde. </td>
                                <td>$70</td>
                                <td>
                                    <a href="" class="btn btn-primary">Edit</a>
                                    <a href="" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Product Table End -->


    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>