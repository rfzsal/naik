<!-- orders -->
<div class="content-wrapper">
  <!-- title -->
  <section class="content-header">
    <h1>
      Order List
    </h1>
  </section>
  <!-- main content -->
  <section class="content container-fluid">
    <form action="<?php echo base_url("admin/orders{$link}") ?>?search" method="get">
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
            <th style="border: 1px solid gray; width: 150px">Order Code</th>
            <th style="border: 1px solid gray; width: 115px">Bank</th>
            <th style="border: 1px solid gray">Status</th>
            <th style="border: 1px solid gray; width: 150px; text-align: center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $num = 1 ?>
          <?php foreach($pesanan as $row): ?>
          <?php 
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
          ?>
          <tr>
            <td style="vertical-align:middle; border: 1px solid gray; text-align: center"><?php echo $num; $num++ ?></td>
            <td style="vertical-align:middle; border: 1px solid gray"><?php echo $row->kodepesanan ?></td>
            <td style="vertical-align:middle; border: 1px solid gray"><?php echo $row->bank ?></td>
            <td style="vertical-align:middle; border: 1px solid gray"><?php echo $status ?></td>
            <td style="vertical-align:middle; border: 1px solid gray; text-align: center"><a href="<?php echo base_url("admin/orders/detail/").$row->kodepesanan ?>" target="_blank" class="btn btn-info">Detail</a></td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </section>
</div>
