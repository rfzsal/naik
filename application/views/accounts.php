<!-- accounts -->
<div class="content-wrapper">
  <!-- title -->
  <section class="content-header">
    <h1>
      Bank Account List
    </h1>
  </section>
  <!-- main content -->
  <section class="content container-fluid">
    <a class="btn btn-success" href="<?php echo base_url("admin/accounts/add") ?>" role="button" style="margin-bottom: 20px; margin-top: 10px">Add Bank Account</a>
    <form action="<?php echo base_url("admin/accounts") ?>?search" method="get">
      <div class="form-group">
        <label for="search">Search Bank Account</label>
        <input name="search" type="text" class="form-control" id="search" placeholder="Search by bank name">
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
            <th style="border: 1px solid gray">Bank</th>
            <th style="border: 1px solid gray; width: 150px; text-align: center">Account Number</th>
            <th style="border: 1px solid gray; width: 65px; text-align: center">Status</th>
            <th style="border: 1px solid gray; width: 200px; text-align: center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $num = 1 ?>
          <?php foreach($bank as $row): ?>
          <?php 
            if($row->aktif == '0'){
              $state1 = "";
              $capt = "Enable";
              $link = "enable";
            }
            else{
              $state1 = "disabled";
              $capt = "Disable";
              $link = "disable";
            }
          ?>
          <tr>
            <td style="vertical-align:middle; border: 1px solid gray; text-align: center"><?php echo $num; $num++ ?></td>
            <td style="vertical-align:middle; border: 1px solid gray"><?php echo $row->namabank." / ".$row->atasnama ?></td>
            <td style="vertical-align:middle; border: 1px solid gray; text-align: center"><?php echo $row->koderekening ?></td>
            <td style="vertical-align:middle; border: 1px solid gray; text-align: center"><?php echo $row->aktif ?></td>
            <td style="vertical-align:middle; border: 1px solid gray; text-align: center"><a href="<?php echo base_url("admin/accounts/edit/").strtolower($row->namabank) ?>" class="btn btn-info <?php echo $state1 ?>">Edit</a><span style="margin-left: 5px; margin-right: 5px"></span><a href="<?php echo base_url("bank/{$link}/").strtolower($row->namabank) ?>" class="btn btn-danger" style="width: 70px"><?php echo $capt ?></a></td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </section>
</div>
