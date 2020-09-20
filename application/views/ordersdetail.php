<!-- items -->
<div class="content-wrapper">
  <!-- title -->
  <section class="content-header">
    <h1>
      Order Detail
    </h1>
  </section>
  <!-- main content -->
  <section class="content container-fluid">
    <?php 
      $result = $this->item_m->getorderdetail($kode);
    ?>
    <?php foreach($result as $row): ?>
    <?php
      $prov = explode("-",$row->provinsi);
      $city = explode("-",$row->kota);
      if($row->status == "1"){
        $status = "Waiting for payment";
        $state1 = "disabled";
        $state2 = "disabled";
        $state3 = "disabled";
      }
      elseif($row->status == "2"){
        $status = "Waiting for confirmation";
        $state1 = "";
        $state2 = "disabled";
        $state3 = "";
      }
      elseif($row->status == "3"){
        $status = "Packing";
        $state1 = "disabled";
        $state2 = "";
        $state3 = "";
      }
      elseif($row->status == "4"){
        $status = "On delivery";
        $state1 = "disabled";
        $state2 = "disabled";
        $state3 = "disabled";
      }
      elseif($row->status == "5"){
        $status = "Completed";
        $state1 = "disabled";
        $state2 = "disabled";
        $state3 = "disabled";
      }
      elseif($row->status == "6"){
        $status = "Canceled";
        $state1 = "disabled";
        $state2 = "disabled";
        $state3 = "disabled";
      }
    ?>
    <p style="margin-top: 5px">Status : <?php echo $status ?></p>
    <a class="btn btn-success <?php echo $state1 ?>" href="<?php echo base_url("order/confirm/").$kode ?>" role="button" style="margin-bottom: 20px; margin-top: 0px; margin-right: 5px">Confirm</a>
    <a class="btn btn-info <?php echo $state2 ?>" href="<?php echo base_url("admin/orders/send/").$kode ?>" role="button" style="margin-bottom: 20px; margin-top: 0px; margin-right: 5px">Send</a>
    <a class="btn btn-danger <?php echo $state3 ?>" href="<?php echo base_url("order/cancel/").$kode ?>" role="button" style="margin-bottom: 20px; margin-top: 0px">Cancel</a>
    <?php endforeach ?>
    <div class="table-responsive" style="border: none">
      <?php foreach($order as $row): ?>
      <table class="table">
        <tbody>
        <tr style="border: none">
            <td style="vertical-align:middle; border: 0px solid gray; width: 150px; padding: 0px">Recipient's Name</td>
            <td style="vertical-align:middle; border: 0px solid gray; width: 10px; padding: 0px; padding-right: 10px">:</td>
            <td style="vertical-align:middle; border: 0px solid gray; padding: 0px"><?php echo $row->namapenerima ?></td>
          </tr>
          <tr>
            <td style="vertical-align:middle; border: 0px solid gray; padding: 0px">Email</td>
            <td style="vertical-align:middle; border: 0px solid gray; width: 10px; padding: 0px">:</td>
            <td style="vertical-align:middle; border: 0px solid gray; padding: 0px"><?php echo $row->email ?></td>
          </tr>
          <tr>
            <td style="vertical-align:middle; border: 0px solid gray; padding: 0px">Phone Number</td>
            <td style="vertical-align:middle; border: 0px solid gray; width: 10px; padding: 0px">:</td>
            <td style="vertical-align:middle; border: 0px solid gray; padding: 0px"><?php echo $row->telepon ?></td>
          </tr>
          <tr>
            <td style="vertical-align:middle; border: 0px solid gray; padding: 0px">Province</td>
            <td style="vertical-align:middle; border: 0px solid gray; width: 10px; padding: 0px">:</td>
            <td style="vertical-align:middle; border: 0px solid gray; padding: 0px"><?php echo $prov["0"] ?></td>
          </tr>
          <tr>
            <td style="vertical-align:middle; border: 0px solid gray; padding: 0px">City</td>
            <td style="vertical-align:middle; border: 0px solid gray; width: 10px; padding: 0px">:</td>
            <td style="vertical-align:middle; border: 0px solid gray; padding: 0px"><?php echo $city["0"] ?></td>
          </tr>
          <tr>
            <td style="vertical-align:middle; border: 0px solid gray; padding: 0px">Address</td>
            <td style="vertical-align:middle; border: 0px solid gray; width: 10px; padding: 0px">:</td>
            <td style="vertical-align:middle; border: 0px solid gray; padding: 0px"><?php echo $row->alamat ?></td>
          </tr>
          <tr>
            <td style="vertical-align:middle; border: 0px solid gray; padding: 0px">Postal Code</td>
            <td style="vertical-align:middle; border: 0px solid gray; width: 10px; padding: 0px">:</td>
            <td style="vertical-align:middle; border: 0px solid gray; padding: 0px"><?php echo $row->kodepos ?></td>
          </tr>
        </tbody>
      </table>
      <table class="table">
        <tbody>
          <tr>
            <td style="vertical-align:middle; border: 0px solid gray; width: 150px; padding: 0px">Order Code</td>
            <td style="vertical-align:middle; border: 0px solid gray; width: 10px; padding: 0px; padding-right: 10px">:</td>
            <td style="vertical-align:middle; border: 0px solid gray; padding: 0px"><?php echo $row->kodepesanan ?></td>
          </tr>
          <tr>
            <td style="vertical-align:middle; border: 0px solid gray; padding: 0px">Bank</td>
            <td style="vertical-align:middle; border: 0px solid gray; width: 10px; padding: 0px">:</td>
            <td style="vertical-align:middle; border: 0px solid gray; padding: 0px"><?php echo $row->bank ?></td>
          </tr>
          <tr>
            <td style="vertical-align:middle; border: 0px solid gray; padding: 0px">Total</td>
            <td style="vertical-align:middle; border: 0px solid gray; width: 10px; padding: 0px">:</td>
            <td style="vertical-align:middle; border: 0px solid gray; padding: 0px">Rp <?php echo number_format($row->total, 0, ".", ".") ?></td>
          </tr>
        </tbody>
      </table>
      <?php endforeach ?>
    </div>
    <div class="table-responsive" style="border: none">
      <table class="table">
        <thead>
          <tr>
            <th style="border: 1px solid gray; width: 50px; text-align: center">#</th>
            <th style="border: 1px solid gray; width: 100px">Item Code</th>
            <th style="border: 1px solid gray">Item Name</th>
            <th style="border: 1px solid gray; width: 100px; text-align: center">Size</th>
            <th style="border: 1px solid gray; width: 100px; text-align: center">Quantity</th>
          </tr>
        </thead>
        <tbody>
        <?php $num = 1; $total = 0 ?>
        <?php foreach($orderdetail as $row1): ?>
        <?php 
          $total += $row1->hargabarang*$row1->jumlahbarang;
        ?>
          <tr>
            <td style="vertical-align:middle; border: 1px solid gray; text-align: center"><?php echo $num; $num++ ?></td>
            <td style="vertical-align:middle; border: 1px solid gray"><?php echo $row1->kodebarang ?></td>
            <td style="vertical-align:middle; border: 1px solid gray"><?php echo $row1->namabarang ?></td>
            <td style="vertical-align:middle; border: 1px solid gray; text-align: center"><?php echo $row1->ukuran ?></td>
            <td style="vertical-align:middle; border: 1px solid gray; text-align: center"><?php echo $row1->jumlahbarang ?></td>
          </tr>
        <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </section>
</div>
