<!-- empty order -->
<!-- main section -->
<main>
    <!-- order -->
    <div class="container center">
        <h4>Order List</h4>
        <?php 
            $hide = null;
            $num = 0;
            $result = $this->item_m->getorder("1");
            foreach ($result as $row){
                $num++;
            }
            if($num > 1){
                $num = $num . " orders";
            }
            elseif($num < 1){
                $hide = "hide";
            }
            else{
                $num = $num . " order";
            }
            if($this->input->get("filter")){
                $filter = $this->input->get("filter");
            }
            else{
                $filter = 0;
            }
        ?>
        <blockquote class="<?php echo $hide ?> pink lighten-5 left-align" style="padding: 5px">
            <?php echo "You have {$num} waiting for payment," ?> please complete the payment before due date.
        </blockquote>
        <select name="options" id="options" onchange="if (this.value) window.location.href=this.value" class="browser-default" style="margin-bottom: 20px">
            <option <?php if($filter == 0){echo "selected";} ?> value="?filter=0">All orders</option>
            <option <?php if($filter == 1){echo "selected";} ?> value="?filter=1">Waiting for payment</option>
            <option <?php if($filter == 2){echo "selected";} ?> value="?filter=2">Waiting for confirmation</option>
            <option <?php if($filter == 3){echo "selected";} ?> value="?filter=3">Packing</option>
            <option <?php if($filter == 4){echo "selected";} ?> value="?filter=4">On delivery</option>
            <option <?php if($filter == 5){echo "selected";} ?> value="?filter=5">Completed</option>
            <option <?php if($filter == 6){echo "selected";} ?> value="?filter=6">Canceled</option>
        </select>
        <p style='margin-top: 75px; margin-bottom: 490px'>Empty</p>
    </div>
</main>