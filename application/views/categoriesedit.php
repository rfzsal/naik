<!-- edit category -->
<div class="content-wrapper">
  <!-- main content -->
  <section class="content container-fluid">
    <form action="<?php echo base_url("category/edit") ?>" method="post" enctype="multipart/form-data">
    <?php foreach($tipe as $row): ?>
      <div class="panel panel-default card-sm2 card-med2" style="margin: 0 auto; margin-top: 10px">
        <div class="panel-heading">
          <h3 class="panel-title">Edit Category</h3>
        </div>
        <div class="panel-body">
          <div style="text-align: center; margin-bottom: 10px">
            <span class="err"><?php echo $this->session->flashdata("msg") ?></span>
          </div>
          <div class="form-group">
            <label for="itemname">Category Name</label>
            <input type="text" class="form-control" id="catname" name="catname" value="<?php echo $row->namatipe ?>">
            <input type="hidden" class="form-control" id="hidid" name="hidid" value="<?php echo $row->kodetipe ?>">
          </div>
          <div style="margin-top: 20px">
              <button class="btn btn-success pull-right" style="margin-left: 15px">Save Changes</button>
              <a href="<?php echo base_url("admin/categories") ?>" class="btn btn-default pull-right">Cancel</a>
          </div>
        </div>
      </div>
    <?php endforeach ?>
    </form>
  </section>
</div>
