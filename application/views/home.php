<!-- home -->
<!-- main section -->
<main>
    <!-- collections -->
    <div class="container center">
        <!-- zoom collections -->
        <h4>New Collections</h4>
        <div class="row">
            <?php $result = $this->item_m->getnew("m") ?>
            <?php foreach ($result as $row): ?>
            <?php $wish = $this->item_m->checkwish($row->kodebarang) ?>
            <?php $result1 = $this->item_m->getkategori($row->kodebarang) ?>
            <?php $result2 = $this->item_m->gettipe($row->kodebarang) ?>
            <?php foreach ($result1 as $row1): ?>
            <?php foreach ($result2 as $row2): ?>
            <?php 
                if($row1->namakategori == "Men"){
                    $kategori = "Men's";
                }
                elseif($row1->namakategori == "Women"){
                    $kategori = "Women's";
                }
                elseif($row1->namakategori == "Boys"){
                    $kategori = "Boys'";
                }
                elseif($row1->namakategori == "Girls"){
                    $kategori = "Girls'";
                }
            ?>
            <div class="col s12 m6">
                <div class="card">
                        <div class="card-image">
                            <a href="<?php echo base_url("product/detail/").$row->kodebarang ?>">
                                <img class="hover-fade" src="assets/img/<?php echo $row->fotobarang ?>" alt="">
                            </a>
                            <?php
                                $linkadd = base_url("wishlist/add/").$row->kodebarang;
                                $linkremove = base_url("wishlist/remove/").$row->kodebarang;
                                if($wish == true){
                                    echo "<a href='$linkremove' class='btn-floating halfway-fab hover-pink waves-effect waves-light pink z-depth-0'><i class='fas fa-heart'></i></a>";
                                }
                                elseif($wish == false){
                                    echo "<a href='$linkadd' class='btn-floating halfway-fab hover-pink waves-effect waves-light grey lighten-1 z-depth-0'><i class='fas fa-heart'></i></a>";
                                }
                            ?>
                        </div>
                        <a href="<?php echo base_url("product/detail/").$row->kodebarang ?>">
                            <div class="card-content">
                                <span class="flow-text truncate grey-text text-darken-4"><?php echo $row->namabarang ?></span>
                                <span class="truncate grey-text text-darken-2"><?php echo "{$kategori} {$row2->namatipe}" ?> Shoe</span><br>
                                <span class="truncate pink-text flow-text">Rp <?php echo number_format($row->hargabarang, 0, ".", ".") ?></span>
                            </div>
                        </a>
                </div>
            </div>
            <?php endforeach ?>
            <?php endforeach ?>
            <?php endforeach ?>
            <?php $result = $this->item_m->getnew("w") ?>
            <?php foreach ($result as $row): ?>
            <?php $wish = $this->item_m->checkwish($row->kodebarang) ?>
            <?php $result1 = $this->item_m->getkategori($row->kodebarang) ?>
            <?php $result2 = $this->item_m->gettipe($row->kodebarang) ?>
            <?php foreach ($result1 as $row1): ?>
            <?php foreach ($result2 as $row2): ?>
            <?php 
                if($row1->namakategori == "Men"){
                    $kategori = "Men's";
                }
                elseif($row1->namakategori == "Women"){
                    $kategori = "Women's";
                }
                elseif($row1->namakategori == "Boys"){
                    $kategori = "Boys'";
                }
                elseif($row1->namakategori == "Girls"){
                    $kategori = "Girls'";
                }
            ?>
            <div class="col s12 m6">
                <div class="card">
                        <div class="card-image">
                            <a href="<?php echo base_url("product/detail/").$row->kodebarang ?>">
                                <img class="hover-fade" src="assets/img/<?php echo $row->fotobarang ?>" alt="">
                            </a>
                            <?php
                                $linkadd = base_url("wishlist/add/").$row->kodebarang;
                                $linkremove = base_url("wishlist/remove/").$row->kodebarang;
                                if($wish == true){
                                    echo "<a href='$linkremove' class='btn-floating halfway-fab hover-pink waves-effect waves-light pink z-depth-0'><i class='fas fa-heart'></i></a>";
                                }
                                elseif($wish == false){
                                    echo "<a href='$linkadd' class='btn-floating halfway-fab hover-pink waves-effect waves-light grey lighten-1 z-depth-0'><i class='fas fa-heart'></i></a>";
                                }
                            ?>
                        </div>
                        <a href="<?php echo base_url("product/detail/").$row->kodebarang ?>">
                            <div class="card-content">
                                <span class="flow-text truncate grey-text text-darken-4"><?php echo $row->namabarang ?></span>
                                <span class="truncate grey-text text-darken-2"><?php echo "{$kategori} {$row2->namatipe}" ?> Shoe</span><br>
                                <span class="truncate pink-text flow-text">Rp <?php echo number_format($row->hargabarang, 0, ".", ".") ?></span>
                            </div>
                        </a>
                </div>
            </div>
            <?php endforeach ?>
            <?php endforeach ?>
            <?php endforeach ?>
            <?php $result = $this->item_m->getnew("b") ?>
            <?php foreach ($result as $row): ?>
            <?php $wish = $this->item_m->checkwish($row->kodebarang) ?>
            <?php $result1 = $this->item_m->getkategori($row->kodebarang) ?>
            <?php $result2 = $this->item_m->gettipe($row->kodebarang) ?>
            <?php foreach ($result1 as $row1): ?>
            <?php foreach ($result2 as $row2): ?>
            <?php 
                if($row1->namakategori == "Men"){
                    $kategori = "Men's";
                }
                elseif($row1->namakategori == "Women"){
                    $kategori = "Women's";
                }
                elseif($row1->namakategori == "Boys"){
                    $kategori = "Boys'";
                }
                elseif($row1->namakategori == "Girls"){
                    $kategori = "Girls'";
                }
            ?>
            <div class="col s12 m6">
                <div class="card">
                        <div class="card-image">
                            <a href="<?php echo base_url("product/detail/").$row->kodebarang ?>">
                                <img class="hover-fade" src="assets/img/<?php echo $row->fotobarang ?>" alt="">
                            </a>
                            <?php
                                $linkadd = base_url("wishlist/add/").$row->kodebarang;
                                $linkremove = base_url("wishlist/remove/").$row->kodebarang;
                                if($wish == true){
                                    echo "<a href='$linkremove' class='btn-floating halfway-fab hover-pink waves-effect waves-light pink z-depth-0'><i class='fas fa-heart'></i></a>";
                                }
                                elseif($wish == false){
                                    echo "<a href='$linkadd' class='btn-floating halfway-fab hover-pink waves-effect waves-light grey lighten-1 z-depth-0'><i class='fas fa-heart'></i></a>";
                                }
                            ?>
                        </div>
                        <a href="<?php echo base_url("product/detail/").$row->kodebarang ?>">
                            <div class="card-content">
                                <span class="flow-text truncate grey-text text-darken-4"><?php echo $row->namabarang ?></span>
                                <span class="truncate grey-text text-darken-2"><?php echo "{$kategori} {$row2->namatipe}" ?> Shoe</span><br>
                                <span class="truncate pink-text flow-text">Rp <?php echo number_format($row->hargabarang, 0, ".", ".") ?></span>
                            </div>
                        </a>
                </div>
            </div>
            <?php endforeach ?>
            <?php endforeach ?>
            <?php endforeach ?>
            <?php $result = $this->item_m->getnew("g") ?>
            <?php foreach ($result as $row): ?>
            <?php $wish = $this->item_m->checkwish($row->kodebarang) ?>
            <?php $result1 = $this->item_m->getkategori($row->kodebarang) ?>
            <?php $result2 = $this->item_m->gettipe($row->kodebarang) ?>
            <?php foreach ($result1 as $row1): ?>
            <?php foreach ($result2 as $row2): ?>
            <?php 
                if($row1->namakategori == "Men"){
                    $kategori = "Men's";
                }
                elseif($row1->namakategori == "Women"){
                    $kategori = "Women's";
                }
                elseif($row1->namakategori == "Boys"){
                    $kategori = "Boys'";
                }
                elseif($row1->namakategori == "Girls"){
                    $kategori = "Girls'";
                }
            ?>
            <div class="col s12 m6">
                <div class="card">
                        <div class="card-image">
                            <a href="<?php echo base_url("product/detail/").$row->kodebarang ?>">
                                <img class="hover-fade" src="assets/img/<?php echo $row->fotobarang ?>" alt="">
                            </a>
                            <?php
                                $linkadd = base_url("wishlist/add/").$row->kodebarang;
                                $linkremove = base_url("wishlist/remove/").$row->kodebarang;
                                if($wish == true){
                                    echo "<a href='$linkremove' class='btn-floating halfway-fab hover-pink waves-effect waves-light pink z-depth-0'><i class='fas fa-heart'></i></a>";
                                }
                                elseif($wish == false){
                                    echo "<a href='$linkadd' class='btn-floating halfway-fab hover-pink waves-effect waves-light grey lighten-1 z-depth-0'><i class='fas fa-heart'></i></a>";
                                }
                            ?>
                        </div>
                        <a href="<?php echo base_url("product/detail/").$row->kodebarang ?>">
                            <div class="card-content">
                                <span class="flow-text truncate grey-text text-darken-4"><?php echo $row->namabarang ?></span>
                                <span class="truncate grey-text text-darken-2"><?php echo "{$kategori} {$row2->namatipe}" ?> Shoe</span><br>
                                <span class="truncate pink-text flow-text">Rp <?php echo number_format($row->hargabarang, 0, ".", ".") ?></span>
                            </div>
                        </a>
                </div>
            </div>
            <?php endforeach ?>
            <?php endforeach ?>
            <?php endforeach ?>
        </div>
    </div>
</main>