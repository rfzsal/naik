<!-- send order -->
<div class="content-wrapper">
  <!-- main content -->
  <section class="content container-fluid">
    <form action="<?php echo base_url("order/confirm/{$kode}") ?>" method="post" enctype="multipart/form-data">
      <div class="panel panel-default card-sm2 card-med2" style="margin: 0 auto; margin-top: 10px">
        <div class="panel-heading">
          <h3 class="panel-title">Input Resi Number</h3>
        </div>
        <div class="panel-body">
          <div style="text-align: center; margin-bottom: 10px">
            <span class="err"><?php echo $this->session->flashdata("msg") ?></span>
          </div>
          <div class="form-group">
            <label for="resi">Resi Number</label>
            <input type="text" class="form-control" id="resi" name="resi">
          </div>
          <div style="margin-top: 20px">
              <button class="btn btn-success pull-right" style="margin-left: 15px">Send Order</button>
              <a href="<?php echo base_url("admin/orders") ?>" class="btn btn-default pull-right">Cancel</a>
          </div>
        </div>
      </div>
    </form>
  </section>
</div>
