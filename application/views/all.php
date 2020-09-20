<!-- all -->
<!-- main section -->
<main>
    <!-- collections -->
    <div class="container center">
        <h4 style="margin-bottom: 23px">Naik Collections</h4>
        <?php
            if($this->input->get("sort") == "price-lowest" || $this->input->get("sort") == "price-highest" || $this->input->get("sort") == "date-latest" || $this->input->get("sort") == "date-oldest"){
                $sort = $this->input->get("sort");
            }
            else{
                $sort = "none";
            }
            if(!empty($this->input->get("type"))){
                $tipe = "?type={$this->input->get("type")}&";
            }
            else{
                $tipe ="?";
            }
            if(!empty($this->input->get("search"))){
                $search = "&search={$this->input->get("search")}";
            }
            else{
                $search ="";
            }
        ?>
        <div class="center" style="padding-left: 10px; padding-right: 10px">
        <select name="options" id="options" onchange="if(this.value) window.location.href=this.value" class="browser-default" style="margin-bottom: 20px">
            <option disabled <?php if($sort == "none"){echo "selected";} ?> value="none">Sort by</option>
            <option <?php if($sort == "price-lowest"){echo "selected";} ?> value="<?php echo $tipe ?>sort=price-lowest<?php echo $search ?>">Lowest price</option>
            <option <?php if($sort == "price-highest"){echo "selected";} ?> value="<?php echo $tipe ?>sort=price-highest<?php echo $search ?>">Highest price</option>
            <option <?php if($sort == "date-oldest"){echo "selected";} ?> value="<?php echo $tipe ?>sort=date-oldest<?php echo $search ?>">Oldest</option>
            <option <?php if($sort == "date-latest"){echo "selected";} ?> value="<?php echo $tipe ?>sort=date-latest<?php echo $search ?>">Latest</option>
        </select>
        </div>
        <div class="row">
            <?php foreach ($barang as $row): ?>
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
                <div class="col s12 m6 l4">
                    <div class="card">
                        <div class="card-image">
                            <a href="<?php echo base_url("product/detail/").$row->kodebarang ?>">
                                <img class="hover-fade" src="<?php echo base_url() ?>assets/img/<?php echo $row->fotobarang ?>" alt="">
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