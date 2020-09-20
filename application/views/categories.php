<!-- categories -->
<div class="content-wrapper">
  <!-- title -->
  <section class="content-header">
    <h1>
      Category List
    </h1>
  </section>
  <!-- main content -->
  <section class="content container-fluid">
    <a class="btn btn-success" href="<?php echo base_url("admin/categories/add") ?>" role="button" style="margin-bottom: 20px; margin-top: 10px">Add Category</a>
    <form action="<?php echo base_url("admin/categories") ?>?search" method="get">
      <div class="form-group">
        <label for="search">Search Category</label>
        <input name="search" type="text" class="form-control" id="search" placeholder="Search by category name">
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
            <th style="border: 1px solid gray">Category</th>
            <th style="border: 1px solid gray; width: 200px; text-align: center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $num = 1 ?>
          <?php foreach($tipe as $row): ?>
          <tr>
            <td style="vertical-align:middle; border: 1px solid gray; text-align: center"><?php echo $num; $num++ ?></td>
            <td style="vertical-align:middle; border: 1px solid gray"><?php echo $row->namatipe ?></td>
            <td style="vertical-align:middle; border: 1px solid gray; text-align: center"><a href="<?php echo base_url("admin/categories/edit/").$row->kodetipe ?>" class="btn btn-info">Edit</a><span style="margin-left: 5px; margin-right: 5px"></span><a href="<?php echo base_url("category/delete/").$row->kodetipe ?>" class="btn btn-danger">Delete</a></td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </section>
</div>
