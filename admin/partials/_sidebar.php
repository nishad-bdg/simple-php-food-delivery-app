<?php 
  function redirect_page($url){
    echo $baseUrl = "/food/admin/".$url;

  }
?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href='<?php redirect_page("index.php");?>'>
              <i class="ti-shield menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <!-- Menu Item -->
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#menu-item" aria-expanded="false" aria-controls="menu-item">
              <i class="ti-palette menu-icon"></i>
              <span class="menu-title"> Menu Item</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="menu-item">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href='<?php redirect_page("menu_item/create.php");?>'>Create</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php redirect_page("menu_item/index.php");?>">Manage</a></li>
              </ul>
            </div>
          </li>
          <!-- Menu Item -->

          <!-- Customer Orders -->
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#customer-order" aria-expanded="false" aria-controls="customer-order">
              <i class="ti-palette menu-icon"></i>
              <span class="menu-title">Customer Orders</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="customer-order">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php redirect_page("orders/index.php");?>">Manage</a></li>
              </ul>
            </div>
          </li>

          <!-- Customer Order -->

          
        </ul>
      </nav>