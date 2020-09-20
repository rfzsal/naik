<!-- items -->
<div class="content-wrapper">
  <!-- title -->
  <section class="content-header">
    <h1>
      Item List
    </h1>
  </section>
  <!-- main content -->
  <section class="content container-fluid">
    <a class="btn btn-success" href="<?php echo base_url("admin/items/add") ?>" role="button" style="margin-bottom: 20px; margin-top: 10px">Add Item</a>
    <form action="<?php echo base_url("admin/items") ?>?search" method="get">
      <div class="form-group">
        <label for="search">Search Item</label>
        <input name="search" type="text" class="form-control" id="search" placeholder="Search by item code or item name or category name">
      </div>
    </form>
    <div style="margin-bottom: 5px">
      <span class="err"><?php echo $this->session->flashdata("msg") ?></span>
      <span class="scs"><?php echo $this->session->flashdata("msgscs") ?></span>
    </div>
    <div class="table-responsive" style="border: none">
      <table class="table">
        <thead>
          <tr>
            <th style="border: 1px solid gray; width: 50px; text-align: center">#</th>
            <th style="border: 1px solid gray">Item</th>
            <th style="border: 1px solid gray">Category</th>
            <th style="border: 1px solid gray; width: 75px; text-align: center">Stock</th>
            <th style="border: 1px solid gray; width: 150px; text-align: center">Price</th>
            <th style="border: 1px solid gray; width: 200px; text-align: center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $num = 1 ?>
          <?php foreach($barang as $row): ?>
          <?php $result1 = $this->item_m->getkategori($row->kodebarang) ?>
          <?php $result2 = $this->item_m->gettipe($row->kodebarang) ?>
          <?php foreach($result1 as $row1): ?>
          <?php foreach($result2 as $row2): ?>
          <?php 
            if($row1->kodekategori == "m"){
              $kategori = "Men's {$row2->namatipe} Shoe";
            }
            elseif($row1->kodekategori == "w"){
                $kategori = "Women's {$row2->namatipe} Shoe";
            }
            elseif($row1->kodekategori == "b"){
                $kategori = "Boys' {$row2->namatipe} Shoe";
            }
            elseif($row1->kodekategori == "g"){
                $kategori = "Girls' {$row2->namatipe} Shoe";
            }
          ?>
          <tr>
            <td style="vertical-align:middle; border: 1px solid gray; text-align: center"><?php echo $num; $num++ ?></td>
            <td style="vertical-align:middle; border: 1px solid gray"><?php echo $row->namabarang ?></td>
            <td style="vertical-align:middle; border: 1px solid gray"><?php echo $kategori ?></td>
            <td style="vertical-align:middle; border: 1px solid gray; text-align: center"><?php echo $row->stokbarang ?></td>
            <td style="vertical-align:middle; border: 1px solid gray; text-align: center"><?php echo number_format($row->hargabarang, 0, ".", ".") ?></td>
            <td style="vertical-align:middle; border: 1px solid gray; text-align: center"><a href="<?php echo base_url("admin/items/edit/").$row->kodebarang ?>" class="btn btn-info">Edit</a><span style="margin-left: 5px; margin-right: 5px"></span><a href="<?php echo base_url("item/delete/").$row->kodebarang ?>" class="btn btn-danger">Delete</a></td>
          </tr>
          <?php endforeach ?>
          <?php endforeach ?>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </section>
</div>
