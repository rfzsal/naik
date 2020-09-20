<!-- cart -->
<!-- main section -->
<main>
    <!-- cart -->
    <div class="container center">
        <h4 style="margin-bottom: 23px">Shopping Cart</h4>
        <?php $totalharga = 0; $hargakirim = 50000 ?>
        <?php $result = $this->item_m->getcart() ?>
        <?php foreach ($result as $row): ?>
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
                    <a href="<?php echo base_url("product/detail/").$row->kodebarang ?>">
                    <div class="card" style="padding: 5px; padding-bottom: 0px; margin-bottom: 65px">
                        <img src="<?php echo base_url() ?>assets/img/<?php echo $row->fotobarang ?>" alt="" class="responsive-img left hide-on-small-only" style="height: 85px; margin-bottom: 5px; margin-right: 5px">
                        <div class="row">
                            <div class="col s7" style="margin-left: -5px; margin-bottom: 7px">
                                <span style="margin-left: -1px" class="flow-text truncate grey-text text-darken-4 left-align"><?php echo $row->namabarang ?></span>
                                <span class="truncate grey-text text-darken-2 left-align"><?php echo "{$kategori} {$row2->namatipe}" ?> Shoe</span>
                                <span class="truncate grey-text text-darken-2 left-align"><?php echo "Size : {$row->ukuran} - Quantity : {$row->jumlahbarang}" ?></span>
                            </div>
                            <span class="flow-text truncate pink-text right" style="margin-right: 1px">Rp <?php echo number_format($row->hargabarang*$row->jumlahbarang, 0, ".", ".") ?></span>
                        </div>
                        <a href="<?php echo base_url("cart/remove/").$row->kodebarang."/".$row->ukuran ?>" class="grey-text text-darken-2 right" style="margin-top: -10px">Remove</a>
                        <a href="#" class="grey-text text-darken-2 right" style="margin-top: -10px; margin-right: 12px">Edit</a>
                    </div>
                    </a>
        <?php $totalharga += $row->hargabarang*$row->jumlahbarang ?>
        <?php endforeach ?>
        <?php endforeach ?>
        <?php endforeach ?>
        <?php 
            $subtotal = $totalharga; 
            $totalharga += $hargakirim; 
            $this->session->set_userdata("totalharga",$totalharga);
        ?>
        <h4 style="margin-bottom: 23px">Summary</h4>
        <div class="card" style="padding: 5px; padding-top: 15px; height: auto; margin-bottom: 35px">
            <div class="row">
                <div class="col s7">
                    <span class="flow-text truncate grey-text text-darken-4 left-align">Subtotal</span>
                </div>
                <div class="col s5">
                    <span class="flow-text truncate pink-text right-align">Rp <?php echo number_format($subtotal, 0, ".", ".") ?></span>
                </div>
                <div class="col s7">
                    <span class="flow-text truncate grey-text text-darken-4 left-align">Delivery Cost</span>
                </div>
                <div class="col s5">
                    <span class="flow-text truncate pink-text right-align">Rp <?php echo number_format($hargakirim, 0, ".", ".") ?></span>
                </div>
            </div>
            <div class="divider" style="margin-bottom: 10px"></div>
            <div class="row">
                <div class="col s7">
                    <span class="flow-text truncate grey-text text-darken-4 left-align">Total</span>
                </div>
                <div class="col s5">
                    <span class="flow-text truncate pink-text right-align">Rp <?php echo number_format($totalharga, 0, ".", ".") ?></span>
                </div>
            </div>
            <div class="row" style="margin-top: 20px; margin-bottom: 20px">
                <div class="col s12 m4" style="margin-top: 15px">
                    <a href="<?php echo base_url("cart/clear") ?>" class="btn btn-outline hover-white btn-cap btn-wide pink-text waves-effect waves-dark z-depth-0">Clear Cart</a>
                </div>
                <div class="col s12 m8" style="margin-top: 15px">
                    <div class="pink-darken-hover">
                        <a href="<?php echo base_url("cart/checkout") ?>" class="btn btn-cap btn-wide pink waves-effect waves-light z-depth-0">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>