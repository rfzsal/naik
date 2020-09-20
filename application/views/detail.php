<!-- detail -->
<!-- main section -->
<main>
    <?php foreach ($barang as $row): ?>
    <?php $wish = $this->item_m->checkwish($row->kodebarang) ?>
    <?php $result1 = $this->item_m->getkategori($row->kodebarang) ?>
    <?php $result2 = $this->item_m->gettipe($row->kodebarang) ?>
    <?php $result3 = $this->item_m->getsize($row->kodebarang) ?>
    <?php foreach ($result1 as $row1): ?>
    <?php foreach ($result2 as $row2): ?>
    <?php foreach ($result3 as $row3): ?>
    <?php
        $tipebarang = $row2->namatipe;
        $this->db->select('*');    
        $this->db->from('barang');
        $this->db->join('kategoribarang', 'barang.kodebarang = kategoribarang.kodebarang');
        $this->db->join('tipebarang', 'barang.kodebarang = tipebarang.kodebarang');
        $this->db->not_like('kategoribarang.kodekategori',$row1->kodekategori);
        $this->db->like('tipebarang.kodetipe',$row2->kodetipe);
        $this->db->order_by('tanggal','desc');
        $this->db->limit(3);
        $query = $this->db->get();
        $result = $query->result();
        if($row1->namakategori == "Men"){
            $kategori = "Men's";
            $nkategori = "Men";
        }
        elseif($row1->namakategori == "Women"){
            $kategori = "Women's";
            $nkategori = "Women";
        }
        elseif($row1->namakategori == "Boys"){
            $kategori = "Boys'";
            $nkategori = "Boys";
        }
        elseif($row1->namakategori == "Girls"){
            $kategori = "Girls'";
            $nkategori = "Girls";
        }
        $ukuran = explode(",",$row3->noukuran);
    ?>
    <!-- breadcrumb -->
    <div class="container center" style="margin-bottom: 25px">
        <ul class="bread">
            <li><a href="<?php echo base_url() ?>">Home</a></li>
            <li><a href="<?php echo base_url() ?>product/all">Product</a></li>
            <li><a class="txt-cap" href="<?php echo base_url() ?>product/all/<?php echo strtolower($nkategori) ?>"><?php echo $nkategori ?></a></li>
            <li class="active"><?php echo $row->namabarang ?></li>
        </ul>
    <!-- detail -->
        <div class="row">
            <div class="col s12 m4">
                <div class="card" style="padding: 5px; height: auto">
                    <img src="<?php echo base_url() ?>assets/img/<?php echo $row->fotobarang ?>" alt="" class="responsive-img materialboxed">
                </div>
            </div>
            <div class="col s12 m8">
                <div class="card" style="padding: 15px; height: auto">
                    <span class="truncate grey-text text-darken-2 left-align"><?php echo "{$kategori} {$row2->namatipe}" ?> Shoe</span>
                    <table style="margin-top: -10px; margin-bottom: 5px">
                        <tr style="border: none">
                            <td style="padding-left: 0px" class="flow-text left grey-text text-darken-4"><?php echo $row->namabarang ?></td>
                            <td style="padding-right: 0px" class="flow-text right pink-text">Rp <?php echo number_format($row->hargabarang, 0, ".", ".") ?></td>
                        </tr>
                    </table>
                    <div class="divider"></div>
                    <p class="left-align">
                        <?php echo $row->deskripsi ?>
                    </p>
                    <form action="<?php echo base_url("cart/add/").$row->kodebarang ?>" method="post">
                        <div class="row" style="margin-top: 35px; margin-bottom: 0px">
                            <div class="col s6">
                                <label class="left" for="options">Size</label>
                                <select name="options" id="options" class="browser-default" style="margin-bottom: 15px">
                                    <option disabled value="">Select Size</option>
                                    <?php foreach($ukuran as $noukuran): ?>
                                    <option value="<?php echo $noukuran ?>"><?php echo $noukuran ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="qty" id="qty" value="1">
                                <label for="qty">Quantity</label>
                            </div>
                        </div>
                        <div class="row">
                            <?php 
                                $linkadd = base_url("wishlist/add/").$row->kodebarang;
                                $linkremove = base_url("wishlist/remove/").$row->kodebarang;
                                if($wish == true){
                                    echo "<div class='col s3'>";
                                    echo "<a href='$linkremove' class='btn btn-outline hover-pink pink-text btn-wide waves-effect waves-dark z-depth-0'><i class='fas fa-heart' style='font-size: 22px'></i></a>";
                                }
                                elseif($wish == false){
                                    echo "<div class='col s3'>";
                                    echo "<a href='$linkadd' class='btn btn-outline hover-pink pink-text btn-wide waves-effect waves-dark z-depth-0'><i class='far fa-heart' style='font-size: 22px'></i></a>";
                                }
                            ?>
                            </div>
                            <div class="col s9">    
                                <button type="submit" name="addcart" class="btn btn-cap pink pink-darken-hover btn-wide button-hover waves-effect waves-light z-depth-0">Add to Cart</button>                            
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach ?>
    <?php endforeach ?>
    <?php endforeach ?>
    <?php endforeach ?>
    <?php 
        if(empty($result)){
            $state = "hide";
        }
        else{
            $state = "";
        }
    ?>
    <div class="container center <?php echo $state ?>">
    <div class="divider"></div>
        <!-- suggestion -->
        <h4><?php echo $tipebarang ?> Shoes</h4>
        <div class="row">
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
            <div class="col s12 m4">
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