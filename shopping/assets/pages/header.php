<header id="site-header" class="fixed-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light stroke py-lg-0">
            <h1><a class="navbar-brand pe-xl-5 pe-lg-4" href="index.php">
                    <span class="w3yellow">Paw</span>Snap
                </a></h1>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
                <span class="navbar-toggler-icon fa icon-close fa-times"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-lg-auto my-2 my-lg-0 navbar-nav-scroll">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <?php
                        $resDogMenu = mysqli_query($conn, "SELECT category_master.CategoryName, category_master.CT_Id FROM dog_category_menu JOIN category_master ON category_master.CT_Id = dog_category_menu.CategoryId WHERE dog_category_menu.Status =1 AND category_master.Status = 1");
                        if(mysqli_num_rows($resDogMenu)>0){
                            ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#Pages" id="dogDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dogs <span class="fa fa-angle-down ms-1"></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dogDropdown">
                                    <span class="mt-2"></span>
                                    <?php
                                        while($rowDogMenu = mysqli_fetch_assoc($resDogMenu)){

                                            echo "<li><a class='dropdown-item pt-2' href='products.php?pref=Dogs&source=$rowDogMenu[CT_Id]&sort=default&discount=0&page=1'>$rowDogMenu[CategoryName]</a></li>";
                                        }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>

                        <?php
                        $resCatMenu = mysqli_query($conn, "SELECT category_master.CategoryName, category_master.CT_Id FROM cat_category_menu JOIN category_master ON category_master.CT_Id = cat_category_menu.CategoryId WHERE cat_category_menu.Status =1 AND category_master.Status = 1");
                        if(mysqli_num_rows($resCatMenu)>0){
                            ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#Pages" id="catDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Cats <span class="fa fa-angle-down ms-1"></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="catDropdown">
                                    <span class="mt-2"></span>
                                    <?php
                                        while($rowCatMenu = mysqli_fetch_assoc($resCatMenu)){

                                            echo "<li><a class='dropdown-item pt-2' href='products.php?pref=Cats&source=$rowCatMenu[CT_Id]&sort=default&discount=0&page=1'>$rowCatMenu[CategoryName]</a></li>";
                                        }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>

                        <?php
                        $resBrandMenu = mysqli_query($conn, "SELECT brand_master.BrandName, brand_master.BR_Id FROM brand_menu JOIN brand_master ON brand_master.BR_Id = brand_menu.BrandId WHERE brand_menu.Status =1 AND brand_master.Status = 1");
                        if(mysqli_num_rows($resBrandMenu)>0){
                            ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#Pages" id="brandDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Brands <span class="fa fa-angle-down ms-1"></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="brandDropdown">
                                    <span class="mt-2"></span>
                                    <?php
                                        while($rowBrandMenu = mysqli_fetch_assoc($resBrandMenu)){

                                            echo "<li><a class='dropdown-item pt-2' href='brands.php?source=$rowBrandMenu[BR_Id]&sort=default&discount=0&page=1'>$rowBrandMenu[BrandName]</a></li>";
                                        }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>

                        <?php
                        $resPersonaliseMenu = mysqli_query($conn, "SELECT category_master.CategoryName, category_master.CT_Id FROM personalise_category_menu JOIN category_master ON category_master.CT_Id = personalise_category_menu.CategoryId WHERE personalise_category_menu.Status =1 AND category_master.Status = 1");
                        if(mysqli_num_rows($resPersonaliseMenu)>0){
                            ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#Pages" id="personalisedDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Personalised <span class="fa fa-angle-down ms-1"></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="personalisedDropdown">
                                    <span class="mt-2"></span>
                                    <?php
                                        while($rowPersonaliseMenu = mysqli_fetch_assoc($resPersonaliseMenu)){

                                            echo "<li><a class='dropdown-item pt-2' href='products.php?pref=Personalised&source=$rowPersonaliseMenu[CT_Id]&sort=default&discount=0&page=1'>$rowPersonaliseMenu[CategoryName]</a></li>";
                                        }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }

                        if(!empty($_SESSION['is_customer_login'])){
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="order.php">Orders</a>
                            </li>
                            <?php
                        }
                        ?>
                        
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#Pages" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Our Service <span class="fa fa-angle-down ms-1"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item pt-2" href="boarding.php">Boarding</a></li>
                            <li><a class="dropdown-item" href="grooming.php">Grooming</a></li>
                            <li><a class="dropdown-item" href="veterinary.php">Veterinary</a></li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog.php">Blog</a>
                    </li>
                    <li class="nav-item search-right">
                        <a href="#search" class="btn search-btn" title="search"><span class="fas fa-search me-2" aria-hidden="true"></span></a>
                        <div id="search" class="pop-overlay">
                            <div class="popup">
                                <h3 class="title-w3l two mb-4 text-left">Search Here</h3>
                                <form action="result.php" method="GET" class="search-box d-flex position-relative">
                                    <input type="search" placeholder="Enter Keyword here" name="searchitem" required="required" autofocus="">
                                    <button type="submit" class="btn"><span class="fas fa-search" aria-hidden="true"></span></button>
                                </form>
                            </div>
                            <a class="close" href="#close">×</a>
                        </div>
                    </li>
                </ul>
            </div>
            <ul class="header-search me-lg-4 d-flex">
                <li class="shopvcart galssescart2 cart cart box_1 get-btn">
                    <button class="top_shopv_cart" type="submit" name="submit" value="" >
                        <span class="fas fa-shopping-bag me-lg-2"></span> <span class="btn-texe-inf">Cart</span>
                    </button>
                </li>
            </ul>
            <div class="mobile-position">
                <nav class="navigation">
                    <div class="theme-switch-wrapper">
                        <label class="theme-switch" for="checkbox">
                            <input type="checkbox" id="checkbox">
                            <div class="mode-container">
                                <i class="gg-sun"></i>
                                <i class="gg-moon"></i>
                            </div>
                        </label>
                    </div>
                </nav>
            </div>
        </nav>
    </div>
</header>
<section class="w3mid-gap"></section>
