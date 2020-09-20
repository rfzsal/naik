<!-- header -->
<!-- header section -->
<?php $base = base_url() ?>
<!-- test session -->
<!-- <?php echo '<pre>' . print_r($_SESSION, true) . '</pre>'; ?> -->
<header class="grey darken-4">
    <!-- top navigation -->
    <nav class="z-depth-0">
        <div class="nav-wrapper grey darken-4">
            <a href="#" data-target="mobile" class="sidenav-trigger"><i class="fas fa-bars"></i></a>
            <div class="container">
                <a href="<?php echo $base ?>" class="brand-logo"><i class="fas fa-check hide-on-small-only"></i> Naik Store</a>
                <?php
                    if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
                        echo "<ul class='right hide'>";
                    }
                    else{
                        echo "<ul class='right hide-on-med-and-down'>";
                    }
                ?>
                    <li class="pink-hover">
                        <a class="btn btn-cap grey darken-4 z-depth-0" href="<?php echo $base ?>user/login" style="margin-right: 2.5px">
                            Log In
                        </a>
                    </li>
                    <li class="pink-darken-hover">
                        <a class="btn btn-cap pink waves-effect waves-light z-depth-0" href="<?php echo $base ?>user/register" style="margin-left: 2.5px; margin-right: 0px">
                            Sign Up
                        </a>
                    </li>
                </ul>
                <?php
                    if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
                        echo "<div class='hide-on-med-and-down'>";
                    }
                    else{
                        echo "<div class='hide'>";
                    }
                ?>
                    <div class="pink-hover">
                        <a href="<?php echo $base ?>user/wishlist" class="right" style="margin-left: 32px"><i class="fas fa-heart fa-lg"></i></a>
                    </div>
                    <div class="pink-hover">
                        <a href="<?php echo $base ?>user/cart" class="right" style="margin-left: 32px"><i class="fas fa-shopping-cart fa-lg"></i></a>
                    </div>
                    <div class="pink-hover">
                        <a href="<?php echo $base ?>order/list" class="right" style="margin-left: 32px"><i class="fas fa-exchange-alt fa-lg"></i></a>
                    </div>
                    <div class="pink-hover">
                        <a href="#" class="right dropdown-trigger" data-target="drop" style="margin-left: 32px"><i class="fas fa-user fa-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- dropdown menu -->
    <ul class="dropdown-content" id="drop" style="min-width: 134px">
        <?php 
            if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
                echo "<li><a href='{$base}admin' class='grey-text text-darken-4 waves-effect waves-light'>Dashboard</a></li>";
            }
            else{
                echo "<li><a href='{$base}user' class='grey-text text-darken-4 waves-effect waves-light'>Account</a></li>";
            }
            echo "<li><a href='{$base}home/logout' class='grey-text text-darken-4 waves-effect waves-light'>Log Out</a></li>";
        ?>
    </ul>
    <!-- dropdown menu -->
    <ul class="dropdown-content" id="drop2" style="min-width: 134px">
        <li class="pink-hover"><a href="<?php echo $base ?>product/all" class="grey-text text-darken-4 waves-effect waves-light">All Collections</a></li>
        <?php $result = $this->item_m->getnamatipe() ?>
        <?php foreach($result as $row): ?>
            <?php
                $tipe = strtolower($row->namatipe);
                echo "<li class='pink-hover'><a href='{$base}product/all?type={$tipe}' class='grey-text text-darken-4 waves-effect waves-light'>$row->namatipe</a></li>";
            ?>
        <?php endforeach ?>
    </ul>
    <!-- tab navigation -->
    <div class="container row center hide-on-med-and-down" style="margin-top: -14px; margin-bottom: 0px">
        <ul class="li-horizontal" style="margin-bottom: 5px; margin-left: 12px">
            <li class="pink-hover">
                <a href="<?php echo $base ?>product/all/men" class="btn btn-cap grey pink-hover darken-4 z-depth-0" style="padding: 0px; margin-right: 35px; margin-left: 3px">Men</a>
            </li>
            <li class="pink-hover">
                <a href="<?php echo $base ?>product/all/women" class="btn btn-cap grey pink-hover darken-4 z-depth-0" style="padding: 0px; margin-right: 35px">Women</a>
            </li>
            <li class="pink-hover">
                <a href="<?php echo $base ?>product/all/boys" class="btn btn-cap grey pink-hover darken-4 z-depth-0" style="padding: 0px; margin-right: 35px">Boys</a>
            </li>
            <li class="pink-hover">
                <a href="<?php echo $base ?>product/all/girls" class="btn btn-cap grey pink-hover darken-4 z-depth-0" style="padding: 0px; margin-right: 35px">Girls</a>
            </li>
            <li class="pink-hover">
                <a href="#" class="btn btn-cap dropdown-trigger grey pink-hover darken-4 z-depth-0" data-target="drop2" style="padding: 0px">Collections</a>
            </li>
        </ul>
        <!-- search -->
        <form action="<?php echo base_url("product/all") ?>" method="get">
            <input type="search" name="search" class="search-block" placeholder="Search">
        </form>
    </div>
    <!-- side navigation -->
    <ul class="sidenav" id="mobile">
        <?php
            if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
                echo "<li><a href='{$base}user/login' class='waves-effect hide'>Log In</a></li>";
            }
            else{
                echo "<li><a href='{$base}user/login' class='waves-effect'>Log In</a></li>";
            }
        ?>
        <?php
            if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
                echo "<li><a href='{$base}user/register' class='waves-effect hide'>Sign Up</a></li>";
            }
            else{
                echo "<li><a href='{$base}user/register' class='waves-effect'>Sign Up</a></li>";
            }
        ?>
        <?php
            if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
                echo "
                <li>
                    <ul class='collapsible'>
                        <li><a class='collapsible-header waves-effect' style='padding-left: 32px'>{$this->session->nama}</a>
                            <div class='collapsible-body'>
                                <ul>";
                                    if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
                                        echo "<li><a style='padding-left: 48px' href='{$base}admin' class='waves-effect'>Dashboard</a></li>"; 
                                    }
                                    else{
                                        echo "<li><a style='padding-left: 48px' href='{$base}user' class='waves-effect'>Account</a></li>";
                                        echo "<li><a style='padding-left: 48px' href='{$base}order/list' class='waves-effect'>Order List</a></li>";
                                        echo "<li><a style='padding-left: 48px' href='{$base}user/cart' class='waves-effect'>Shopping Cart</a></li>";
                                        echo "<li><a style='padding-left: 48px' href='{$base}user/wishlist' class='waves-effect'>Wishlist</a></li>";
                                    }
                                    echo "<li><a style='padding-left: 48px' href='{$base}home/logout' class='waves-effect'>Log Out</a></li>";
                                echo "
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>";
            }
            else{
                echo "
                <li class='hide'>
                    <ul class='collapsible'>
                        <li><a class='collapsible-header waves-effect' style='padding-left: 32px'>{$this->session->nama}</a>
                            <div class='collapsible-body'>
                                <ul>";
                                    if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
                                        echo "<li><a style='padding-left: 48px' href='{$base}admin' class='waves-effect'>Dashboard</a></li>"; 
                                    }
                                    else{
                                        echo "<li><a style='padding-left: 48px' href='{$base}user' class='waves-effect'>Account</a></li>";
                                        echo "<li><a style='padding-left: 48px' href='{$base}user/cart' class='waves-effect'>Shopping Cart</a></li>";
                                        echo "<li><a style='padding-left: 48px' href='{$base}user/wishlist' class='waves-effect'>Wishlist</a></li>";
                                    }
                                    echo "<li><a style='padding-left: 48px' href='{$base}home/logout' class='waves-effect'>Log Out</a></li>";
                                echo "
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>";
            }
        ?>
        <div class="divider" style="margin: 0px"></div>
        <li><a href="<?php echo $base ?>product/all/men" class="waves-effect">Men</a></li>
        <li><a href="<?php echo $base ?>product/all/women" class="waves-effect">Women</a></li>
        <li><a href="<?php echo $base ?>product/all/boys" class="waves-effect">Boys</a></li>
        <li><a href="<?php echo $base ?>product/all/girls" class="waves-effect">Girls</a></li>
        <li>
            <ul class="collapsible">
                <li><a class="collapsible-header waves-effect" style="padding-left: 32px">Collections</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a style="padding-left: 48px" href="<?php echo $base ?>product/all" class="waves-effect">All Collections</a></li>
                            <?php $result = $this->item_m->getnamatipe() ?>
                            <?php foreach($result as $row): ?>
                            <?php
                                $tipe = strtolower($row->namatipe);
                                echo "<li><a style='padding-left: 48px' href='{$base}product/all?type={$tipe}' class='waves-effect'>$row->namatipe</a></li>";
                            ?>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</header>