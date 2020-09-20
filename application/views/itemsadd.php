<!-- add item -->
<div class="content-wrapper">
  <!-- main content -->
  <section class="content container-fluid">
    <form action="<?php echo base_url("item/add") ?>" method="post" enctype="multipart/form-data">
      <div class="panel panel-default card-sm2 card-med2" style="margin: 0 auto; margin-top: 10px">
        <div class="panel-heading">
          <h3 class="panel-title">Add Item</h3>
        </div>
        <div class="panel-body">
          <div style="text-align: center; margin-bottom: 10px">
            <span class="err"><?php echo $this->session->flashdata("msg") ?></span>
          </div>
          <div class="form-group">
            <label for="itemname">Item Name</label>
            <input type="text" class="form-control" id="itemname" name="itemname">
          </div>
          <div class="form-group">
            <label class="radio-inline">
            <input checked type="radio" name="gen" id="inlineRadio1" value="m"> Men
            </label>
            <label class="radio-inline">
            <input type="radio" name="gen" id="inlineRadio2" value="w"> Women
            </label>
            <label class="radio-inline">
            <input type="radio" name="gen" id="inlineRadio3" value="b"> Boys
            </label>
            <label class="radio-inline">
            <input type="radio" name="gen" id="inlineRadio3" value="g"> Girls
            </label>
          </div>
          <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category">
              <option disabled selected value="">Select a Category</option>
              <?php $result = $this->item_m->getnamatipe() ?>
              <?php foreach($result as $row): ?>
                <?php 
                  echo "<option value='{$row->kodetipe}'>$row->namatipe</option>";
                ?>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="size">Size</label>
            <select class="form-control" id="size" name="size">
              <option disabled selected value="0">Select Size</option>
              <?php $result = $this->item_m->getallsize() ?>
              <?php foreach($result as $row): ?>
                <?php 
                  echo "<option value='{$row->ukuran}'>$row->ukuran</option>";
                ?>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="itemstock">Base Stock</label>
            <input type="text" class="form-control" id="itemstock" name="itemstock">
          </div>
          <div class="form-group">
            <label for="itemprice">Item Price</label>
            <input type="text" class="form-control" id="itemprice" name="itemprice">
          </div>
          <div class="form-group" style="margin-bottom: 20px">
            <label for="itempict">Item Picture</label>
            <input type="file" id="itempict" name="itempict">
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea style="max-width : 100%" class="form-control" rows="3" id="description" name="description"></textarea>
          </div>
          <div style="margin-top: 20px">
              <button class="btn btn-success pull-right" style="margin-left: 15px">Add New</button>
              <a href="<?php echo base_url("admin/items") ?>" class="btn btn-default pull-right">Cancel</a>
          </div>
        </div>
      </div>
    </form>
  </section>
</div>
