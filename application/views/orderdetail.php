<!-- order detail -->
<!-- main section -->
<main>
    <!-- detail -->
    <div class="container center">
        <ul class="bread">
            <li><a href="<?php echo base_url() ?>">Home</a></li>
            <li><a href="<?php echo base_url() ?>order/list">Order</a></li>
            <li class="active">Detail</li>
        </ul>
        <h4 style="margin-bottom: 23px; margin-top: 0px">Order Detail</h4>
        <div class="card" style="padding: 5px; margin-bottom: 35px">
            <div class="row">
                <?php foreach ($order as $row): ?>
                    <?php 
                        $kodepesanan = $row->kodepesanan;
                        $hargakirim = 50000;
                        $prov = explode("-",$row->provinsi);
                        $city = explode("-",$row->kota);
                        $tanggal = date("d F Y", strtotime($row->tanggal));
                        if($row->tanggalkirim != NULL){
                            $tanggal3 = date("d F Y", strtotime($row->tanggalkirim));
                        }
                        else{
                            $tanggal3 = "0";
                        }
                        $tanggal2 = date_create($row->tanggal);
                        if($row->tanggalselesai != NULL){
                            $tanggal2 = date_create($row->tanggalselesai);
                        }
                        elseif($row->tanggalbatal != NULL){
                            $tanggal2 = date_create($row->tanggalbatal);
                        }
                        else{
                            date_add($tanggal2, date_interval_create_from_date_string("3 days"));
                        }
                        $tanggal2 = date_format($tanggal2, "d F Y");
                        if($row->status == "1"){
                            $status = "Waiting for payment";
                        }
                        elseif($row->status == "2"){
                            $status = "Waiting for confirmation";
                        }
                        elseif($row->status == "3"){
                            $status = "Packing";
                        }
                        elseif($row->status == "4"){
                            $status = "On delivery";
                        }
                        elseif($row->status == "5"){
                            $status = "Completed";
                        }
                        elseif($row->status == "6"){
                            $status = "Canceled";
                        }
                        if($row->koderesi == "0"){
                            $hidden = "hide";
                        }
                        else{
                            $hidden = "left-align";
                        }
                    ?>
                    <div class="col m12">
                        <table style="width: 100%">
                            <tr style="border: 0px; padding: 0px">
                                <td width="135px" style="vertical-align:top; padding: 3px">Recipient's Name</td>
                                <td width="15px" style="vertical-align:top; padding: 3px">:</td>
                                <td width="55%" style="vertical-align:top; padding: 3px"><?php echo $row->namapenerima ?></td>
                                <td class="hide-on-med-and-down" style="vertical-align:top; padding: 3px; width: 135px">Order Code</td>
                                <td class="hide-on-med-and-down" style="vertical-align:top; padding: 3px; width: 15px">:</td>
                                <td class="hide-on-med-and-down" style="vertical-align:top; padding: 3px"><?php echo $row->kodepesanan ?></td>
                            </tr>
                            <tr style="border: 0px; padding: 0px">
                                <td style="vertical-align:top; padding: 3px">Email</td>
                                <td style="vertical-align:top; padding: 3px">:</td>
                                <td style="vertical-align:top; padding: 3px"><?php echo $this->session->email ?></td>
                                <td class="hide-on-med-and-down" style="vertical-align:top; padding: 3px">Status</td>
                                <td class="hide-on-med-and-down" style="vertical-align:top; padding: 3px">:</td>
                                <td class="hide-on-med-and-down" style="vertical-align:top; padding: 3px"><?php echo $status ?></td>
                            </tr>
                            <tr style="border: 0px; padding: 0px">
                                <td style="vertical-align:top; padding: 3px">Phone Number</td>
                                <td style="vertical-align:top; padding: 3px">:</td>
                                <td style="vertical-align:top; padding: 3px"><?php echo $row->telepon ?></td>
                                <td class="hide-on-med-and-down" style="vertical-align:top; padding: 3px">Order Date</td>
                                <td class="hide-on-med-and-down" style="vertical-align:top; padding: 3px; width: 15px">:</td>
                                <td class="hide-on-med-and-down" style="vertical-align:top; padding: 3px"><?php echo $tanggal ?></td>
                            </tr>
                            <tr style="border: 0px; padding: 0px">
                                <td style="vertical-align:top; padding: 3px">Province</td>
                                <td style="vertical-align:top; padding: 3px">:</td>
                                <td style="vertical-align:top; padding: 3px"><?php echo $prov["0"] ?></td>
                                <?php 
                                    $date = "Due Date";
                                    if($row->tanggalbatal != NULL){
                                        $date = "Canceled On";
                                    }
                                    elseif($row->tanggalselesai != NULL){
                                        $date = "Completed On";
                                    }
                                ?>
                                <td class="hide-on-med-and-down" style="vertical-align:top; padding: 3px"><?php echo $date ?></td>
                                <td class="hide-on-med-and-down" style="vertical-align:top; padding: 3px">:</td>
                                <td class="hide-on-med-and-down" style="vertical-align:top; padding: 3px"><?php echo $tanggal2 ?></td>
                            </tr>
                            <tr style="border: 0px; padding: 0px">
                                <td style="vertical-align:top; padding: 3px">City</td>
                                <td style="vertical-align:top; padding: 3px">:</td>
                                <td style="vertical-align:top; padding: 3px"><?php echo $city["0"] ?></td>
                                <td class="hide-on-med-and-down" style="vertical-align:top; padding: 3px">Bank Transfer</td>
                                <td class="hide-on-med-and-down" style="vertical-align:top; padding: 3px">:</td>
                                <td class="hide-on-med-and-down" style="vertical-align:top; padding: 3px"><?php echo $row->namabank ?></td>
                            </tr>
                            <tr style="border: 0px; padding: 0px">
                                <td style="vertical-align:top; padding: 3px">Address</td>
                                <td style="vertical-align:top; padding: 3px">:</td>
                                <td style="vertical-align:top; padding: 3px"><?php echo $row->alamat ?></td>
                                <td class="hide-on-med-and-down" style="vertical-align:top; padding: 3px">Transfer To</td>
                                <td class="hide-on-med-and-down" style="vertical-align:top; padding: 3px">:</td>
                                <td class="hide-on-med-and-down" style="vertical-align:top; padding: 3px"><?php echo "{$row->koderekening} / {$row->atasnama}" ?></td>
                                </div>
                            </tr>
                            <tr style="border: 0px; padding: 0px">
                                <td style="vertical-align:top; padding: 3px">Postal Code</td>
                                <td style="vertical-align:top; padding: 3px">:</td>
                                <td style="vertical-align:top; padding: 3px"><?php echo $row->kodepos ?></td>
                            </tr>
                            <tr class="<?php echo $hidden ?>" style="border: 0px; padding: 0px">
                                <td style="vertical-align:top; padding: 3px">Resi Number</td>
                                <td style="vertical-align:top; padding: 3px">:</td>
                                <td style="vertical-align:top; padding: 3px"><?php echo $row->koderesi ?></td>
                            </tr>
                            <tr class="<?php echo $hidden ?>" style="border: 0px; padding: 0px">
                                <td style="vertical-align:top; padding: 3px">Sent On</td>
                                <td style="vertical-align:top; padding: 3px">:</td>
                                <td style="vertical-align:top; padding: 3px"><?php echo $tanggal3 ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col m12 hide-on-large-only" style="margin-top: 50px">
                        <table style="width: 100%">
                            <tr style="border: 0px; padding: 0px">
                                <td width="135px" style="vertical-align:top; padding: 3px">Order Code</td>
                                <td width="15px" style="vertical-align:top; padding: 3px">:</td>
                                <td width="55%" style="vertical-align:top; padding: 3px"><?php echo $row->kodepesanan ?></td>
                            </tr>
                            <tr style="border: 0px; padding: 0px">
                                <td style="vertical-align:top; padding: 3px">Status</td>
                                <td style="vertical-align:top; padding: 3px">:</td>
                                <td style="vertical-align:top; padding: 3px"><?php echo $status ?></td>
                            </tr>
                            <tr style="border: 0px; padding: 0px">
                                <td style="vertical-align:top; padding: 3px">Order Date</td>
                                <td style="vertical-align:top; padding: 3px; width: 15px">:</td>
                                <td style="vertical-align:top; padding: 3px"><?php echo $tanggal ?></td>
                            </tr>
                            <tr style="border: 0px; padding: 0px">
                                <td style="vertical-align:top; padding: 3px">Due Date</td>
                                <td style="vertical-align:top; padding: 3px">:</td>
                                <td style="vertical-align:top; padding: 3px"><?php echo $tanggal2 ?></td>
                            </tr>
                            <tr style="border: 0px; padding: 0px">
                                <td style="vertical-align:top; padding: 3px">Bank Transfer</td>
                                <td style="vertical-align:top; padding: 3px">:</td>
                                <td style="vertical-align:top; padding: 3px"><?php echo $row->namabank ?></td>
                            </tr>
                            <tr style="border: 0px; padding: 0px">
                                <td style="vertical-align:top; padding: 3px">Transfer To</td>
                                <td style="vertical-align:top; padding: 3px">:</td>
                                <td style="vertical-align:top; padding: 3px"><?php echo "{$row->koderekening} / {$row->atasnama}" ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col s12" style="margin-top: 65px">
                        <table class="responsive-table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th width="5%" class="left-align">#</th>
                                    <th width="20%" class="left-align">Item</th>
                                    <th width="20%" class="left-align">Category</th>
                                    <th width="15%" class="center-align">Size</th>
                                    <th width="15%" class="center-align">Quantity</th>
                                    <th width="20%" class="center-align">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $result = $this->item_m->getorderdetailproduct($row->kodepesanan); $num = 1; $total = 0 ?>
                                <?php foreach($result as $row): ?>
                                <?php 
                                    if($row->kategori == "Men"){
                                        $kategori = "Men's {$row->tipe} Shoe";
                                    }
                                    elseif($row->kategori == "Women"){
                                        $kategori = "Women's {$row->tipe} Shoe";
                                    }
                                    elseif($row->kategori == "Boys"){
                                        $kategori = "Boys' {$row->tipe} Shoe";
                                    }
                                    elseif($row->kategori == "Girls"){
                                        $kategori = "Girls' {$row->tipe} Shoe";
                                    }
                                    $total += $row->hargabarang*$row->jumlahbarang;
                                ?>
                                    <tr>
                                        <td class="left-align"><?php echo $num; $num++ ?></td>
                                        <td class="left-align"><?php echo $row->namabarang ?></td>
                                        <td class="left-align"><?php echo $kategori ?></td>
                                        <td class="center-align"><?php echo $row->ukuran ?></td>
                                        <td class="center-align"><?php echo $row->jumlahbarang ?></td>
                                        <td style="width: 135px"><span class="left">Rp </span><span class="right"><?php echo number_format($row->hargabarang*$row->jumlahbarang, 0, ".", ".") ?></span></td>
                                    </tr>
                                <?php endforeach ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th class="left-align">Subtotal</th>
                                        <td style="width: 135px"><span class="left">Rp </span><span class="right"><?php echo number_format($total, 0, ".", ".") ?></span></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th class="left-align">Delivery Cost</th>
                                        <td style="width: 135px"><span class="left">Rp </span><span class="right"><?php echo number_format($hargakirim, 0, ".", ".") ?></span></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th class="left-align">Total</th>
                                        <td style="width: 135px"><span class="left">Rp </span><span class="right"><?php echo number_format($row->total, 0, ".", ".") ?></span></td>
                                    </tr>
                            </tbody>
                        </table>
                        <?php 
                            if($status == "Waiting for payment"){
                                $state1 = "";
                                $state2 = "hide";
                            }
                            elseif($status == "On delivery"){
                                $state2 = "";
                                $state1 = "hide";
                            }
                            else{
                                $state1 ="hide";
                                $state2 ="hide";
                            }
                        ?>
                        <div class="row" style="margin-top: 35px; margin-bottom: 0px">
                            <div class="col s12 m6">
                                <a href="<?php echo base_url("order/cancel/").$kodepesanan ?>" class="btn btn-outline hover-white btn-cap btn-wide pink-text waves-effect waves-dark z-depth-0 <?php echo $state1 ?>" style="margin-top: 15px">Cancel Order</a>
                            </div>
                            <div class="col s12 m6">
                                <div class="pink-darken-hover">
                                    <a href="<?php echo base_url("order/confirm/").$kodepesanan ?>" class="btn btn-cap btn-wide pink waves-effect waves-light z-depth-0 <?php echo $state1 ?>" style="margin-top: 15px">Confirm Payment</a>
                                </div>
                            </div>
                        </div>
                        <div class="pink-darken-hover">
                            <a href="<?php echo base_url("order/confirm/").$kodepesanan ?>" class="btn btn-cap btn-wide pink waves-effect waves-light z-depth-0 <?php echo $state2 ?>" style="margin-top: 15px">Confirm Item Received</a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</main>