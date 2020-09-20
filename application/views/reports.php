<!-- reports -->
<div class="content-wrapper">
  <!-- title -->
  <section class="content-header">
    <h1>
      Transaction Report
    </h1>
  </section>
  <!-- main content -->
  <section class="content container-fluid">
    <label for="options" class="hidden-print" style="margin-top: 5px">Range</label>
    <div class="row hidden-print">
      <div class="col-sm-4">
        <select name="options" id="options" onchange="if(this.value) window.location.href=this.value" class="form-control">
          <option <?php if($filter == "daily"){echo "selected";} ?> value="<?php echo base_url("admin/reports/daily") ?>">Daily</option>
          <option <?php if($filter == "weekly"){echo "selected";} ?> value="<?php echo base_url("admin/reports/weekly") ?>">Weekly</option>
          <option <?php if($filter == "monthly"){echo "selected";} ?> value="<?php echo base_url("admin/reports/monthly") ?>">Monthly</option>
          <option <?php if($filter == "yearly"){echo "selected";} ?> value="<?php echo base_url("admin/reports/yearly") ?>">Yearly</option>
          <option <?php if($filter == "custom"){echo "selected";} ?> value="<?php echo base_url("admin/reports/custom") ?>">Custom</option>
        </select>
      </div>
      <div class="col-sm-8 mtop-5">
        <div class="form-group">
          <div class='input-group input-daterange'>
              <?php 
                if(!empty($this->input->get("from"))){
                  $d1 = date_create_from_format('Ymd', $this->input->get("from"));
                  if(is_a($d1, 'DateTime')){
                    $date1 = $d1->format('Y-m-d');
                    $from = $d1->format('d M Y');
                  }
                  else{
                    $date1 = "";
                    $from = "";
                  }
                }else{
                  $date1 = "";
                  $from = "";
                }
                if(!empty($this->input->get("to"))){
                  $d2 = date_create_from_format('Ymd', $this->input->get("to"));
                  if(is_a($d2, 'DateTime')){
                    $date2 = $d2->format('Y-m-d');
                    $to = $d2->format('d M Y');
                  }
                  else{
                    $date2 = $date1;
                    $to = $date1;
                  }
                }else{
                  $date2 = "";
                  $to = "";
                }
              ?>
              <input type='text' class="form-control" name="startDate" id='startDate' value="<?php echo $date1 ?>" placeholder="yyyy-mm-dd">
              <span class="input-group-addon">to</span>
              <input type='text' class="form-control" name="endDate" id='endDate' value="<?php echo $date2 ?>" placeholder="yyyy-mm-dd">
          </div>
        </div>
      </div>
    </div>
    <?php 
      if($filter == "yearly"){
        $period = "Year : ";
        if(isset($d1)){
          $period = "Year : ".$d1->format('Y');
        }
      }
      elseif($filter == "monthly"){
        $period = "Month : ";
        if(isset($d1)){
          $period = "Month : ".$d1->format('F Y');
        }    
      }
      elseif($filter == "weekly"){
        $period = "Date Range : ";
        if(!empty($from)){
          $period = "Date Range : {$from} - {$to}";
        }
      }
      elseif($filter == "daily"){
        $period = "Date : ";
        if(!empty($from)){
          $period = "Date : ".$from;
        }
      }
      elseif($filter == "custom"){
        $period = "Date Range : ";
        if(!empty($from)){
          $period = "Date Range : {$from} - {$to}";
        }
      }
    ?>
    <h3 class="text-center visible-print ">Transaction Report</h3>
    <p style="margin-top: 25px" class="text-left visible-print"><?php echo $period ?></p>
    <div class="table-responsive" style="border: none">
      <table class="table">
        <thead>
          <tr>
            <th style="border: 1px solid gray; width: 50px; text-align: center">#</th>
            <th style="border: 1px solid gray">Date Completed</th>
            <th style="border: 1px solid gray; width: 175px; text-align: center">Total Payment</th>
          </tr>
        </thead>
        <tbody>
          <?php $num = 1; $total = 0 ?>
          <?php foreach($pesanan as $row): ?>
          <?php 
            if($row->status != "5"){
              continue;
            }
            else{
              if($filter == "daily"){
                $tanggal = date_create($row->tanggalselesai);
                $tanggal = date_format($tanggal, "d F Y");
              }
              elseif($filter == "weekly"){
                $tanggal = date_create($row->tanggalselesai);
                $tanggal = date_format($tanggal, "d F Y");
              }
              elseif($filter == "monthly"){
                $tanggal = date_create($row->tanggalselesai);
                $tanggal = date_format($tanggal, "F Y");
              }
              elseif($filter == "yearly"){
                $tanggal = date_create($row->tanggalselesai);
                $tanggal = date_format($tanggal, "Y");
              }
              elseif($filter == "custom"){
                $tanggal = date_create($row->tanggalselesai);
                $tanggal = date_format($tanggal, "d F Y");
              }
            }
            $total += $row->total;
          ?>
          <tr>
            <td style="border: 1px solid gray; text-align: center"><?php echo $num; $num++ ?></td>
            <td style="border: 1px solid gray"><?php echo $tanggal ?></td>
            <td style="border: 1px solid gray; text-align: center"><span class="pull-left">Rp</span> <span class="pull-right"><?php echo number_format($row->total, 0, ".", ".") ?></span></td>
          </tr>
          <?php endforeach ?>
          <tr>
            <th style="border: 1px solid gray; text-align: center" colspan="2">Total</th>
            <td style="border: 1px solid gray; text-align: center"><span class="pull-left">Rp</span> <span class="pull-right"><?php echo number_format($total, 0, ".", ".") ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</div>
