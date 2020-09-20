<!-- refunds -->
<div class="content-wrapper">
  <!-- title -->
  <section class="content-header">
    <h1>
      Refund
    </h1>
  </section>
  <!-- main content -->
  <section class="content container-fluid">
    <form action="<?php echo base_url("admin/refunds") ?>?search" method="get">
      <div class="form-group" style="margin-top: 5px">
        <label for="search">Search Order</label>
        <input name="search" type="text" class="form-control" id="search" placeholder="Search by order code">
      </div>
    </form>
    <div class="table-responsive" style="border: none">
      <table class="table">
        <thead>
          <tr>
            <th style="border: 1px solid gray; width: 50px; text-align: center">#</th>
            <th style="border: 1px solid gray">Order Code</th>
            <th style="border: 1px solid gray; text-align: center; width: 150px">Total</th>
            <th style="border: 1px solid gray; width: 200px; text-align: center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $num = 1 ?>
          <?php foreach($order as $row): ?>
          <?php 
            if($row->status == "0"){
              $state = "";
            }
            elseif($row->status == "1"){
              $state = "disabled";
            }
          ?>
          <tr>
            <td style="vertical-align:middle; border: 1px solid gray; text-align: center"><?php echo $num; $num++ ?></td>
            <td style="vertical-align:middle; border: 1px solid gray"><?php echo $row->kodepesanan ?></td>
            <td style="vertical-align:middle; border: 1px solid gray; text-align: center"><?php echo number_format($row->total, 0, ".", ".") ?></td>
            <td style="vertical-align:middle; border: 1px solid gray; text-align: center"><a href="<?php echo base_url("admin/orders/detail/").$row->kodepesanan ?>" target="_blank" class="btn btn-info">Detail</a><span style="margin-left: 5px; margin-right: 5px"></span><a href="<?php echo base_url("admin/refunds/confirm/").$row->kodepesanan ?>" class="<?php echo $state ?> btn btn-danger">Refund</a></td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </section>
</div>
