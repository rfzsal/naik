<!-- edit item -->
<div class="content-wrapper">
  <!-- main content -->
  <section class="content container-fluid">
    <form action="<?php echo base_url("item/edit") ?>" method="post" enctype="multipart/form-data">
      <?php foreach($barang as $row): ?>
      <?php $result1 = $this->item_m->getkategori($row->kodebarang) ?>
      <?php $result2 = $this->item_m->gettipe($row->kodebarang) ?>
      <?php foreach($result1 as $row1): ?>
      <?php foreach($result2 as $row2): ?>
      <div class="panel panel-default card-sm2 card-med2" style="margin: 0 auto; margin-top: 10px">
        <div class="panel-heading">
          <h3 class="panel-title">Edit Item</h3>
        </div>
        <div class="panel-body">
          <div style="text-align: center; margin-bottom: 10px">
            <span class="err"><?php echo $this->session->flashdata("msg") ?></span>
          </div>
          <div class="form-group">
            <label for="itemname">Item Name</label>
            <input type="hidden" id="hiddenid" name="hiddenid" value="<?php echo $row->kodebarang ?>">
            <input type="text" class="form-control" id="itemname" name="itemname" value="<?php echo $row->namabarang ?>">
          </div>
          <div class="form-group">
            <label class="radio-inline">
            <input <?php if($row1->kodekategori == "m"){echo "checked";} ?> type="radio" name="gen" id="inlineRadio1" value="m"> Men
            </label>
            <label class="radio-inline">
            <input <?php if($row1->kodekategori == "w"){echo "checked";} ?> type="radio" name="gen" id="inlineRadio2" value="w"> Women
            </label>
            <label class="radio-inline">
            <input <?php if($row1->kodekategori == "b"){echo "checked";} ?> type="radio" name="gen" id="inlineRadio3" value="b"> Boys
            </label>
            <label class="radio-inline">
            <input <?php if($row1->kodekategori == "g"){echo "checked";} ?> type="radio" name="gen" id="inlineRadio3" value="g"> Girls
            </label>
          </div>
          <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category">
              <option disabled value="">Select a Category</option>
              <?php $result3 = $this->item_m->getnamatipe() ?>
              <?php foreach($result3 as $row3): ?>
                <?php 
                  if($row2->kodetipe == $row3->kodetipe){
                    echo "<option selected value='{$row3->kodetipe}'>$row3->namatipe</option>";
                  }
                  else{
                    echo "<option value='{$row3->kodetipe}'>$row3->namatipe</option>";
                  }
                ?>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="size">Size</label>
            <select class="form-control" id="size" name="size">
              <option disabled value="0">Select Size</option>
              <?php $result4 = $this->item_m->getallsize() ?>
              <?php foreach($result4 as $row4): ?>
                <?php 
                  $result5 = $this->item_m->getsize($row->kodebarang);
                  foreach($result5 as $row5){
                    if($row5->ukuran == $row4->ukuran){
                      echo "<option selected value='{$row4->ukuran}'>$row4->ukuran</option>";
                    }
                    else{
                      echo "<option value='{$row4->ukuran}'>$row4->ukuran</option>";
                    }
                  }
                ?>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="itemstock">Base Stock</label>
            <input type="text" class="form-control" id="itemstock" name="itemstock" value="<?php echo $row->stokbarang ?>">
          </div>
          <div class="form-group">
            <label for="itemprice">Item Price</label>
            <input type="text" class="form-control" id="itemprice" name="itemprice" value="<?php echo $row->hargabarang ?>">
          </div>
          <div class="form-group" style="margin-bottom: 20px">
            <label for="itempict">Item Picture</label>
            <input type="hidden" id="hiddenpict" name="hiddenpict" value="<?php echo $row->fotobarang ?>">
            <input type="file" id="itempict" name="itempict">
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea style="max-width : 100%" class="form-control" rows="5" id="description" name="description"><?php echo $row->deskripsi ?></textarea>
          </div>
          <div style="margin-top: 20px">
              <button class="btn btn-success pull-right" style="margin-left: 15px">Save Changes</button>
              <a href="<?php echo base_url("admin/items") ?>" class="btn btn-default pull-right">Cancel</a>
          </div>
        </div>
      </div>
      <?php endforeach ?>
      <?php endforeach ?>
      <?php endforeach ?>
    </form>
  </section>
</div>
