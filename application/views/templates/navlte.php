<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<!-- Header -->
<header class="main-header">
<a href="<?php echo base_url() ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>N</b>S</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Naik Store</span>
    </a>
<!-- Navbar -->
<nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
    </a>
</nav>
</header>
<aside class="main-sidebar">
<!-- Sidebar -->
<section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">DASHBOARD</li>
        <li class=""><a href="<?php echo base_url("admin") ?>"><i class="fa fa-link"></i> <span>Home</span></a></li>
        <li class=""><a href="<?php echo base_url("home/logout") ?>"><i class="fa fa-link"></i> <span>Log Out</span></a></li>
        <li class="header">TRANSACTIONS</li>
        <li class=""><a href="<?php echo base_url("admin/orders") ?>"><i class="fa fa-link"></i> <span>Order List</span></a></li>
        <li class=""><a href="<?php echo base_url("admin/reports/daily") ?>"><i class="fa fa-link"></i> <span>Transaction Report</span></a></li>
        <li class=""><a href="<?php echo base_url("admin/orders/confirmed") ?>"><i class="fa fa-link"></i> <span>Confirmed Order</span></a></li>
        <li class=""><a href="<?php echo base_url("admin/refunds") ?>"><i class="fa fa-link"></i> <span>Refund</span></a></li>
        <li class="header">ITEM MANAGEMENT</li>
        <li class=""><a href="<?php echo base_url("admin/items") ?>"><i class="fa fa-link"></i> <span>Item List</span></a></li>
        <li class=""><a href="<?php echo base_url("admin/categories") ?>"><i class="fa fa-link"></i> <span>Item Categories</span></a></li>
        <li><a href="#"><i class="fa fa-link"></i> <span>Item Size</span></a></li>
        <li class="header">BANK ACCOUNT MANAGEMENT</li>
        <li class=""><a href="<?php echo base_url("admin/accounts") ?>"><i class="fa fa-link"></i> <span>Bank Account List</span></a></li>
        <li class="header">USER MANAGEMENT</li>
        <li class=""><a href="#"><i class="fa fa-link"></i> <span>User List</span></a></li>
    </ul>
</section>
</aside>