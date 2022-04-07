  <link href="files/assets/css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="files/bower_components/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="files/assets/pages/data-table/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="files/assets/icon/icofont/css/icofont.css">
  <link rel="stylesheet" type="text/css" href="files/assets/icon/feather/css/feather.css">
  <link rel="stylesheet" type="text/css" href="files/assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="files/assets/css/jquery.mCustomScrollbar.css">
  <link rel="stylesheet" href="popup_style.css">
</head>
<style>
  /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
<body>
  <div class="theme-loader">
    <div class="ball-scale">
      <div class='contain'>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
        <div class="ring">
          <div class="frame"></div>
        </div>
      </div>
    </div>
  </div>
  <div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
      <div class="pcoded-container navbar-wrapper">
        <nav class="navbar header-navbar pcoded-header">
          <div class="navbar-wrapper">
            <div class="navbar-logo">
              <a class="h4 text-dark text-center mt-2" href="home.php"><strong>PAWS FUR &<span class="text-danger"> TAIL</span></strong></a>
              <a class="mobile-options">
                <i class="feather icon-more-horizontal"></i>
              </a>
            </div>
            <div class="navbar-container container-fluid">
              <ul class="nav-left">
                <li>
                  <a href="#!" onclick="javascript:toggleFullScreen()">
                  <i class="feather icon-maximize full-screen"></i>
                  </a>
                </li>
              </ul>
              <ul class="nav-right">
                <li class="user-profile header-notification" >
                    <div class="dropdown">
                      <div class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">  
                        </a><span>Hi, <?php if(empty($_SESSION['user_name'])){echo $_SESSION['user_name'];}else{echo "User";}?><i class="feather icon-chevron-down"></i></span>
                      </div>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="changepassword.php" style="background: none;">Change Password</a></li>
                        <li><a class="dropdown-item" href="./pages/logout.php" style="background: none;">Logout</a></li>
                      </ul>
                    </div>
                </li>
                <li>&nbsp</li>
                <li>&nbsp</li>
    
              </ul>
            </div>
          </div>
        </nav>
      <div class="pcoded-main-container">
    <div class="pcoded-wrapper" >
      <nav class="pcoded-navbar">
        <div class="pcoded-inner-navbar main-menu">
            <ul class="pcoded-item pcoded-left-item mt-2">
              <li class="">
                <a href="home.php">
                  <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                  <span class="pcoded-mtext">Dashboard</span>
                </a>
              </li>
              <li class="">
                <a href="staff.php">
                  <span class="pcoded-micon"><i class="feather icon-user-plus"></i></span>
                  <span class="pcoded-mtext">Staff</span>
                </a>
              </li>
              <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                  <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                  <span class="pcoded-mtext">Customers</span>
                </a>
                <ul class="pcoded-submenu">
                  <li class="">
                    <a href="customer.php"><span class="pcoded-mtext">Manage Customer</span></a>
                  </li>
                  <li class="">
                    <a href="customer-report.php"><span class="pcoded-mtext">Customer Report</span></a>
                  </li>
                </ul>
              </li>
              <li class="">
                <a href="category.php">
                  <span class="pcoded-micon"><i class="feather icon-grid"></i></span>
                  <span class="pcoded-mtext">Categories</span>
                </a>
              </li>
              <li class="">
                <a href="brand.php">
                  <span class="pcoded-micon"><i class="feather icon-award"></i></span>
                  <span class="pcoded-mtext">Brands</span>
                </a>
              </li>
              <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                  <span class="pcoded-micon"><i class="feather icon-tag"></i></span>
                  <span class="pcoded-mtext">Vendors</span>
                </a>
                <ul class="pcoded-submenu">
                  <li class="">
                    <a href="vendor.php"><span class="pcoded-mtext">Manage Vendor</span></a>
                  </li>
                  <li class="">
                    <a href="vendor-report.php"><span class="pcoded-mtext">Vendor Report</span></a>
                  </li>
                </ul>
              </li>
              <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                  <span class="pcoded-micon"><i class="feather icon-inbox"></i></span>
                  <span class="pcoded-mtext">Products</span>
                </a>
                <ul class="pcoded-submenu">
                  <li class="">
                    <a href="product.php"><span class="pcoded-mtext">Manage Product</span></a>
                  </li>
                  <li class="">
                    <a href="product-report.php"><span class="pcoded-mtext">Product Report</span></a>
                  </li>
                </ul>
              </li>

              <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                  <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                  <span class="pcoded-mtext">Purchase</span>
                </a>
                <ul class="pcoded-submenu">
                  <li class="">
                    <a href="purchase.php"><span class="pcoded-mtext">Manage Purchase</span></a>
                  </li>
                  <li class="">
                    <a href="addpurchase.php"><span class="pcoded-mtext">Add Purchase</span></a>
                  </li>
                  <li class="">
                    <a href="add-barcode-purchase.php"><span class="pcoded-mtext">Add Purchase Barcode</span></a>
                  </li>
                  <li class="">
                    <a href="purchase-report.php"><span class="pcoded-mtext">Purchase Report</span></a>
                  </li>
                </ul>
              </li>

              <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                  <span class="pcoded-micon"><i class="feather icon-briefcase"></i></span>
                  <span class="pcoded-mtext">Stock</span>
                </a>
                <ul class="pcoded-submenu">
                  <li class="">
                    <a href="stock.php"><span class="pcoded-mtext">All Stock</span></a>
                  </li>
                  <li class="">
                    <a href="categorystock.php"><span class="pcoded-mtext">Filter By Category</span></a>
                  </li>
                  <li class="">
                    <a href="brandstock.php"><span class="pcoded-mtext">Filter By Brand</span></a>
                  </li>
                </ul>
              </li>

              <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                  <span class="pcoded-micon"><i class="feather icon-shopping-cart"></i></span>
                  <span class="pcoded-mtext">Sales</span>
                </a>
                <ul class="pcoded-submenu">
                  <li class="">
                    <a href="sales.php">
                    <span class="pcoded-mtext">Manage Sales</span>
                    </a>
                  </li>
                  <!-- <li class="">
                    <a href="addbilling.php">
                      <span class="pcoded-mtext">Add Sales</span>
                    </a>
                  </li> -->
                  <li class="">
                    <a href="add-billing-barcode.php">
                      <span class="pcoded-mtext">Add Sales Barcode</span>
                    </a>
                  </li>
                  <li class="">
                    <a href="sales-report.php">
                      <span class="pcoded-mtext">Sales Report</span>
                    </a>
                  </li>
                  <li class="">
                    <a href="credit-report.php">
                      <span class="pcoded-mtext">Credit Report</span>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="">
                <a href="./pages/logout.php">
                  <span class="pcoded-micon"><i class="feather icon-power"></i></span>
                  <span class="pcoded-mtext">Logout</span>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
