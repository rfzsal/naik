<!-- order -->
<!-- main section -->
<main>
    <!-- order list -->
    <div class="container center">
        <h4 style="margin-bottom: 23px">Order List</h4>
        <?php 
            $hide = null;
            $num = 0;
            $result = $this->item_m->getorder("1");
            foreach ($result as $row){
                $num++;
            }
            if($num > 1){
                $num = $num . " orders";
            }
            elseif($num < 1){
                $hide = "hide";
            }
            else{
                $num = $num . " order";
            }
            if($this->input->get("filter")){
                $filter = $this->input->get("filter");
            }
            else{
                $filter = 0;
            }
        ?>
        <blockquote class="<?php echo $hide ?> pink lighten-5 left-align" style="padding: 5px">
            <?php echo "You have {$num} waiting for payment," ?> please complete the payment before due date.
        </blockquote>
        <select name="options" id="options" onchange="if (this.value) window.location.href=this.value" class="browser-default" style="margin-bottom: 20px">
            <option <?php if($filter == 0){echo "selected";} ?> value="?filter=0">All orders</option>
            <option <?php if($filter == 1){echo "selected";} ?> value="?filter=1">Waiting for payment</option>
            <option <?php if($filter == 2){echo "selected";} ?> value="?filter=2">Waiting for confirmation</option>
            <option <?php if($filter == 3){echo "selected";} ?> value="?filter=3">Packing</option>
            <option <?php if($filter == 4){echo "selected";} ?> value="?filter=4">On delivery</option>
            <option <?php if($filter == 5){echo "selected";} ?> value="?filter=5">Completed</option>
            <option <?php if($filter == 6){echo "selected";} ?> value="?filter=6">Canceled</option>
        </select>
        <?php $num = 0 ?>
        <?php foreach ($order as $row): ?>
        <?php 
            $num++;
            $tanggal3 = "";
            $tanggal = date("d F Y", strtotime($row->tanggal));
            $tanggal2 = date_create($row->tanggal);
            date_add($tanggal2, date_interval_create_from_date_string("3 days"));
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
                $tanggal3 = date("d F Y", strtotime($row->tanggalkirim));
            }
            elseif($row->status == "5"){
                $status = "Completed";
            }
            elseif($row->status == "6"){
                $status = "Canceled";
            }
        ?>
            <a href="<?php echo base_url("order/detail/").$row->kodepesanan ?>">
            <div class="card" style="padding: 5px; padding-bottom: 8px; margin-bottom: 30px">
                <table style="margin-top: -10px; margin-bottom: -10px">
                    <tr style="border: none">
                        <td class="flow-text grey-text text-darken-4"><?php echo $row->kodepesanan ?></td>
                        <td class="flow-text right pink-text">Rp <?php echo number_format($row->total, 0, ".", ".") ?></td>
                    </tr>
                </table>
                <div style="margin-left: 6px">
                    <span class="truncate grey-text text-darken-2 left-align"><?php echo "Status : {$status}" ?></span>
                    <span class="truncate grey-text text-darken-2 left-align"><?php echo "Order Date : {$tanggal}" ?></span>
                    <?php
                        if($row->status == "1"){
                            echo "<span class='truncate grey-text text-darken-2 left-align'>Due Date : {$tanggal2}</span>";
                        }
                        elseif($row->status == "4"){
                            echo "<span class='truncate grey-text text-darken-2 left-align'>Sent On : {$tanggal3}</span>";
                        }
                    ?>
                </div>
            </div>
            </a>
        <?php endforeach ?>
        <?php 
            if($num == 1){
                $mb = "385px";
            }
            elseif($num == 2){
                $mb = "257px";
            }
            elseif($num == 3){
                $mb = "129px";
            }
            else{
                $mb = "0px";
            }
        ?>
        <div class="divider white" style="margin-top: <?php echo $mb ?>"></div>
    </div>
</main>