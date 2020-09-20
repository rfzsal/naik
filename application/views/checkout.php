<!-- checkout -->
<!-- main section -->
<main>
    <!-- checkout -->
    <div class="container center">
        <h4 style="margin-bottom: 23px">Checkout</h4>
        <div class="card card-sm card-med" style="margin: 0 auto; margin-top: 23px; margin-bottom: 35px">
            <form action="<?php echo base_url("order/process") ?>" method="post">
                <div class="card-content">
                    <span class="err"><?php echo $this->session->flashdata("msg") ?></span>
                    <div class="input-field">
                        <input type="text" name="name" id="name" value="<?php echo $this->session->nama ?>">
                        <label for="name">Name</label>
                    </div>
                    <div class="input-field">
                        <input type="text" name="phone" id="phone" value="<?php echo $this->session->telepon ?>">
                        <label for="phone">Phone Number</label>
                    </div>
                    <label class="left" style="margin-bottom: 5px; margin-top: -5px; font-size: 13px">Province</label>
                    <select name="province" id="province" class="browser-default" style="margin-bottom: 20px" value="<?php echo $this->session->provinsi ?>">
                        <?php 
                            $province = "<option value='' disabled selected>Select a province</option>";
                            foreach ($listProv as $data) {
                                $prov = explode("-",$this->session->provinsi);
                                if($data->id == end($prov)){
                                    $province .= "<option selected value='{$data->nama},{$data->id}'>$data->nama</option>";
                                }
                                else{
                                    $province .= "<option value='{$data->nama},{$data->id}'>$data->nama</option>";
                                }
                            }
                            echo $province;
                        ?>
                    </select>
                    <label class="left" style="margin-bottom: 5px; margin-top: -5px; font-size: 13px">City / District</label>
                    <select name="city" id="city" class="browser-default" style="margin-bottom: 30px" value="<?php echo $this->session->kota ?>">
                        <?php 
                            $city = "<option value='' disabled selected>Select a city / district</option>";
                            if(!empty($this->session->kota)){
                                $listCity = $this->data_m->getcity(end($prov));
                                $ucity = explode("-",$this->session->kota);
                                foreach ($listCity as $data ){
                                    if($data->id == end($ucity)){
                                        $city .= "<option selected value='{$data->tipe},{$data->nama},{$data->id}'>$data->tipe $data->nama</option>";
                                    }
                                    else{
                                        $city .= "<option value='{$data->tipe},{$data->nama},{$data->id}'>$data->tipe $data->nama</option>";
                                    }
                                }
                                echo $city;
                            }
                            else{
                                echo $city;
                            }
                        ?>
                    </select>
                    <div class="input-field">
                        <input type="text" name="address" id="address" placeholder="e.g street name" value="<?php echo $this->session->alamat ?>">
                        <label for="address">Address</label>
                    </div>
                    <div class="input-field">
                        <input type="text" name="postal" id="postal" value="<?php echo $this->session->kodepos ?>">
                        <label for="postal">Postal Code (optional)</label>
                    </div>
                    <div class="divider white" style="margin-top: 15px; margin-bottom: 25px"></div>
                    <div class="input-field">
                        <?php 
                            $result = $this->item_m->getcart();
                            $totalharga = 0;
                            foreach($result as $row){
                                $totalharga += $row->hargabarang*$row->jumlahbarang;
                            }
                            $totalharga += 50000;
                            $this->session->set_userdata("totalharga",$totalharga);
                        ?>
                        <input disabled type="text" name="total" id="total" value="Rp <?php echo number_format($this->session->totalharga, 0, ".", ".") ?>">
                        <label for="total">Total Payment</label>
                    </div>
                    <label class="left" style="margin-bottom: 5px; margin-top: -5px; font-size: 13px">Bank Transfer</label>
                    <select name="bank" id="bank" class="browser-default" style="margin-bottom: 20px">
                        <option selected disabled value="">Select a Bank</option>
                        <?php
                            $bank = $this->data_m->getbank();
                            foreach ($bank as $data ){
                                if($data->aktif == '0'){
                                    continue;
                                }
                                else{
                                    echo "<option value='{$data->namabank}'>$data->namabank</option>";
                                }
                            }
                        ?>
                    </select>
                    <a href="<?php echo base_url("user/cart") ?>" class="btn btn-outline hover-white btn-cap btn-wide pink-text waves-effect waves-dark z-depth-0" style="margin-top: 15px">Cancel</a>
                    <button type="submit" name="order" class="btn btn-cap btn-wide pink pink-darken-hover button-hover waves-effect waves-light z-depth-0" style="margin-top: 15px; margin-bottom: 5px">Order</button>
                </div>
            </form>
        </div>
    </div>
</main>