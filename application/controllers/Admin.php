<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
	// dashboard
	public function index()
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
				$this->load->view("templates/headlte");
				$this->load->view("templates/navlte");
				$this->load->view("dashboard");
				$this->load->view("templates/footlte");
			}
			else{
				redirect(base_url(),"refresh");
				die();
			}
		}
		else{
			redirect(base_url(),"refresh");
			die();
		}
	}
	// refunds
	public function refunds($action = null,$kodepesanan = null)
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
				$data["order"] = $this->item_m->getallcancel();
				if($action == "confirm"){
					if(!empty($kodepesanan)){
						if(empty($data["order"])){
							redirect(base_url("admin/refunds"),"refresh");
							die();
						}
						else{
							$sql = "update pesananbatal set status = '1' where kodepesanan = '{$kodepesanan}'";
							$this->db->query($sql);
							$this->load->view("confirm");
						}
					}
					else{
						redirect(base_url("admin/refunds"),"refresh");
						die();
					}
				}
				else{
					if(!empty($this->input->get("search"))){
						$sql = "select * from pesananbatal where kodepesanan like '%{$this->input->get("search")}%' order by tanggal desc";
						$data["order"] = $this->db->query($sql)->result();
					}
					$this->load->view("templates/headlte");
					$this->load->view("templates/navlte");
					$this->load->view("refunds",$data);
					$this->load->view("templates/footlte");
				}
			}
			else{
				redirect(base_url(),"refresh");
				die();
			}
		}
		else{
			redirect(base_url(),"refresh");
			die();
		}
	}
	// items
	public function items($action = null,$kodebarang = null)
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
				if($action == "add"){
					$this->load->view("templates/headlte");
					$this->load->view("templates/navlte");
					$this->load->view("itemsadd");
					$this->load->view("templates/footlte");
				}
				elseif($action == "edit"){
					if(!empty($kodebarang)){
						$result = $this->item_m->get($kodebarang);
						if($result == false){
							redirect(base_url("admin/items"),"refresh");
							die();
						}
						else{
							$data["barang"] = $result;
							$this->load->view("templates/headlte");
							$this->load->view("templates/navlte");
							$this->load->view("itemsedit",$data);
							$this->load->view("templates/footlte");
						}
					}
					else{
						redirect(base_url("admin/items"),"refresh");
						die();
					}
				}
				else{
					$data["barang"] = $this->item_m->getall("date-latest");
					if(!empty($this->input->get("search"))){
						$sql = "select * from barang join tipebarang on tipebarang.kodebarang = barang.kodebarang join tipe on tipe.kodetipe = tipebarang.kodetipe join kategoribarang on kategoribarang.kodebarang = barang.kodebarang join kategori on kategori.kodekategori = kategoribarang.kodekategori where namabarang like '%{$this->input->get("search")}%' or barang.kodebarang like '%{$this->input->get("search")}%' or namatipe like '%{$this->input->get("search")}%' or namakategori like '{$this->input->get("search")}%' order by tanggal desc";
						$data["barang"] = $this->db->query($sql)->result();
					}
					$this->load->view("templates/headlte");
					$this->load->view("templates/navlte");
					$this->load->view("items",$data);
					$this->load->view("templates/footlte");
				}
			}
			else{
				redirect(base_url(),"refresh");
				die();
			}
		}
		else{
			redirect(base_url(),"refresh");
			die();
		}
	}
	// categories
	public function categories($action = null,$kodetipe = null)
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
				if($action == "add"){
					$this->load->view("templates/headlte");
					$this->load->view("templates/navlte");
					$this->load->view("categoriesadd");
					$this->load->view("templates/footlte");
				}
				elseif($action == "edit"){
					if(!empty($kodetipe)){
						$result = $this->item_m->getdetailtipe($kodetipe);
						if($result == false){
							redirect(base_url("admin/categories"),"refresh");
							die();
						}
						else{
							$data["tipe"] = $result;
							$this->load->view("templates/headlte");
							$this->load->view("templates/navlte");
							$this->load->view("categoriesedit",$data);
							$this->load->view("templates/footlte");
						}
					}
					else{
						redirect(base_url("admin/categories"),"refresh");
						die();
					}
				}
				else{
					$data["tipe"] = $this->item_m->getnamatipe();
					if(!empty($this->input->get("search"))){
						$sql = "select * from tipe where namatipe like '%{$this->input->get("search")}%'";
						$data["tipe"] = $this->db->query($sql)->result();
					}
					$this->load->view("templates/headlte");
					$this->load->view("templates/navlte");
					$this->load->view("categories",$data);
					$this->load->view("templates/footlte");
				}
			}
			else{
				redirect(base_url(),"refresh");
				die();
			}
		}
		else{
			redirect(base_url(),"refresh");
			die();
		}
	}
	// accounts
	public function accounts($action = null,$namabank = null)
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
				$this->load->model("data_m");
				if($action == "add"){
					$this->load->view("templates/headlte");
					$this->load->view("templates/navlte");
					$this->load->view("accountsadd");
					$this->load->view("templates/footlte");
				}
				elseif($action == "edit"){
					if(!empty($namabank)){
						$result = $this->data_m->getbankdetail($namabank);
						if($result == false){
							redirect(base_url("admin/accounts"),"refresh");
							die();
						}
						else{
							$data["bank"] = $result;
							$this->load->view("templates/headlte");
							$this->load->view("templates/navlte");
							$this->load->view("accountsedit",$data);
							$this->load->view("templates/footlte");
						}
					}
					else{
						redirect(base_url("admin/accounts"),"refresh");
						die();
					}
				}
				else{
					$data["bank"] = $this->data_m->getbank();
					if(!empty($this->input->get("search"))){
						$sql = "select * from bank where namabank like '%{$this->input->get("search")}%'";
						$data["bank"] = $this->db->query($sql)->result();
					}
					$this->load->view("templates/headlte");
					$this->load->view("templates/navlte");
					$this->load->view("accounts",$data);
					$this->load->view("templates/footlte");
				}
			}
			else{
				redirect(base_url(),"refresh");
				die();
			}
		}
		else{
			redirect(base_url(),"refresh");
			die();
		}
	}
	// orders
	public function orders($action = null,$kodepesanan = null)
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
				$data["link"] = "";
				if($action == "send"){
					if(!empty($kodepesanan)){
						$result = $this->item_m->getorderid($kodepesanan);
						if(!empty($result)){
							foreach($result as $row){
								if($row->status == "3"){
									$data["kode"] = $kodepesanan;
									$this->load->view("templates/headlte");
									$this->load->view("templates/navlte");
									$this->load->view("orderssend",$data);
									$this->load->view("templates/footlte");
								}
								else{
									redirect(base_url("admin/orders/detail/$kodepesanan"),"refresh");
									die();
								}
							}
						}
						else{
							redirect(base_url("admin/orders"),"refresh");
							die();
						}
					}
					else{
						redirect(base_url("admin/orders"),"refresh");
						die();
					}
				}
				elseif($action == "detail"){
					if(!empty($kodepesanan)){
						$data["order"] = $this->item_m->getorderdetail($kodepesanan);
						$data["orderdetail"] = $this->item_m->getorderdetailproduct($kodepesanan);
						$data["kode"] = $kodepesanan;
						if(!empty($data["order"])){
							$this->load->view("templates/headlte");
							$this->load->view("templates/navlte");
							$this->load->view("ordersdetail",$data);
							$this->load->view("templates/footlte");
						}
						else{
							redirect(base_url("admin/orders"),"refresh");
							die();
						}
					}
					else{
						redirect(base_url("admin/orders"),"refresh");
						die();
					}
				}
				elseif($action == "confirmed"){
					$data["link"] = "/confirmed";
					$data["pesanan"] = $this->item_m->getallorder("3");
					if(!empty($this->input->get("search"))){
						$sql = "select * from pesanan where kodepesanan like '%{$this->input->get("search")}%' and status = '3' order by tanggal desc";
						$data["pesanan"] = $this->db->query($sql)->result();
					}
					$this->load->view("templates/headlte");
					$this->load->view("templates/navlte");
					$this->load->view("orders",$data);
					$this->load->view("templates/footlte");
				}
				else{
					$data["pesanan"] = $this->item_m->getallorder("0");
					if(!empty($this->input->get("search"))){
						$sql = "select * from pesanan where kodepesanan like '%{$this->input->get("search")}%' order by tanggal desc";
						$data["pesanan"] = $this->db->query($sql)->result();
					}
					$this->load->view("templates/headlte");
					$this->load->view("templates/navlte");
					$this->load->view("orders",$data);
					$this->load->view("templates/footlte");
				}
			}
			else{
				redirect(base_url(),"refresh");
				die();
			}
		}
		else{
			redirect(base_url(),"refresh");
			die();
		}
	}
	// reports
	public function reports($action = null)
	{
		if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
			if($this->session->has_userdata("adminmode") && $this->session->adminmode == "true"){
				if($action == "daily"){
					$data["filter"] = "daily";
					$sql = "select * from pesanan order by tanggalselesai asc";
					$data["pesanan"] = $this->db->query($sql)->result();
$data["js"] = 
'<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script>
jQuery(\'#startDate\').datepicker({
format: \'yyyy-mm-dd\',
endDate: \'0d\',
autoclose: true,
todayBtn: "linked",
maxViewMode: 2,
orientation: "bottom left"
}).on("changeDate",function (e) {
$(\'#endDate\').val($(\'#startDate\').val());
var a = "?from=";
var b = "&to=";
var date1 = a.concat($(\'#startDate\').val().replace(/-/g, \'\'),b,$(\'#endDate\').val().replace(/-/g, \'\'));
window.location.href=date1;
});
jQuery(\'#endDate\').datepicker({
format: \'yyyy-mm-dd\',
endDate: \'0d\',
autoclose: true,
todayBtn: "linked",
maxViewMode: 2,
orientation: "bottom left"
}).on("changeDate",function (e) {
$(\'#startDate\').val($(\'#endDate\').val());
var a = "?from=";
var b = "&to=";
var date1 = a.concat($(\'#startDate\').val().replace(/-/g, \'\'),b,$(\'#endDate\').val().replace(/-/g, \'\'));
window.location.href=date1;
});
$("#click").click(function(){
var a = "?from=";
var b = "&to=";
var date1 = a.concat($(\'#startDate\').val().replace(/-/g, \'\'),b,$(\'#endDate\').val().replace(/-/g, \'\'));
window.location.href=date1;
});
</script>
';
$data["css"] = 
'<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.css" rel="stylesheet"/>
';
					if(!empty($this->input->get("from"))){
						if(!empty($this->input->get("to"))){
							$from = $this->input->get("from");
							$to = $this->input->get("to");
							$sql = "select * from pesanan where tanggalselesai between '{$from}' and '{$to}'";
							$data["pesanan"] = $this->db->query($sql)->result();
						}
					}
				}
				elseif($action == "weekly"){
					$data["filter"] = "weekly";
					$sql = "select status,sum(total) as total,tanggalselesai,kodepesanan from pesanan group by day(tanggalselesai) order by tanggalselesai asc";
					$data["pesanan"] = $this->db->query($sql)->result();
$data["js"] = 
'<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
<script>
var sd = $(\'#startDate\').val();
jQuery(\'#startDate\').datepicker({
format: \'yyyy-mm-dd\',
endDate: \'0d\',
autoclose: true,
todayBtn: "linked",
maxViewMode: 2,
orientation: "bottom left"
}).on("changeDate",function (e) {
jQuery(\'#endDate\').datepicker("setStartDate", e.date);
var value = $(\'#startDate\').val();
var firstDate = moment(value, "YYYY-MM-DD").format("YYYY-MM-DD");
var lastDate =  moment(value, "YYYY-MM-DD").add(6,"d").format("YYYY-MM-DD");
if(moment(lastDate).isAfter(moment())){
lastDate = moment().format("YYYY-MM-DD");
};
$(\'#startDate\').val(firstDate);
$(\'#endDate\').val(lastDate);
var a = "?from=";
var b = "&to=";
var date1 = a.concat($(\'#startDate\').val().replace(/-/g, \'\'),b,$(\'#endDate\').val().replace(/-/g, \'\'));
window.location.href=date1;
});
jQuery(\'#endDate\').datepicker({
format: \'yyyy-mm-dd\',
startDate: sd,
endDate: \'0d\',
autoclose: true,
todayBtn: "linked",
maxViewMode: 2,
orientation: "bottom left"
}).on("changeDate",function (e) {
jQuery(\'#startDate\').datepicker("setEndDate", e.date);
var value = $(\'#endDate\').val();
var firstDate = moment(value, "YYYY-MM-DD").subtract(6,"d").format("YYYY-MM-DD");
var lastDate =  moment(value, "YYYY-MM-DD").format("YYYY-MM-DD");
$(\'#startDate\').val(firstDate);
$(\'#endDate\').val(lastDate);
var a = "?from=";
var b = "&to=";
var date1 = a.concat($(\'#startDate\').val().replace(/-/g, \'\'),b,$(\'#endDate\').val().replace(/-/g, \'\'));
window.location.href=date1;
});
</script>
';
$data["css"] = 
'<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.css" rel="stylesheet"/>
';
					if(!empty($this->input->get("from"))){
						if(!empty($this->input->get("to"))){
							$from = $this->input->get("from");
							$to = $this->input->get("to");
							$sql = "select status,sum(total) as total,tanggalselesai,kodepesanan from pesanan where tanggalselesai between '{$from}' and '{$to}' group by day(tanggalselesai) order by tanggalselesai asc";
							$data["pesanan"] = $this->db->query($sql)->result();
						}
					}
				}
				elseif($action == "monthly"){
					$data["filter"] = "monthly";
					$sql = "select status,sum(total) as total,tanggalselesai,kodepesanan from pesanan group by month(tanggalselesai) order by tanggalselesai asc";
					$data["pesanan"] = $this->db->query($sql)->result();
$data["js"] = 
'<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
<script>
var sd = $(\'#startDate\').val();
jQuery(\'#startDate\').datepicker({
format: \'yyyy-mm-dd\',
endDate: \'0d\',
autoclose: true,
todayBtn: "linked",
minViewMode: 1,
maxViewMode: 2,
orientation: "bottom left"
}).on("changeDate",function (e) {
jQuery(\'#endDate\').datepicker("setStartDate", e.date);
var value = $(\'#startDate\').val();
var firstDate = moment(value, "YYYY-MM-DD").startOf("month").format("YYYY-MM-DD");
var lastDate =  moment(value, "YYYY-MM-DD").endOf("month").format("YYYY-MM-DD");
$(\'#startDate\').val(firstDate);
$(\'#endDate\').val(lastDate);
var a = "?from=";
var b = "&to=";
var date1 = a.concat($(\'#startDate\').val().replace(/-/g, \'\'),b,$(\'#endDate\').val().replace(/-/g, \'\'));
window.location.href=date1;
});
jQuery(\'#endDate\').datepicker({
format: \'yyyy-mm-dd\',
startDate: sd,
endDate: \'0d\',
autoclose: true,
todayBtn: "linked",
minViewMode: 1,
maxViewMode: 2,
orientation: "bottom left"
}).on("changeDate",function (e) {
jQuery(\'#startDate\').datepicker("setEndDate", e.date);
var value = $(\'#endDate\').val();
var firstDate = moment(value, "YYYY-MM-DD").startOf("month").format("YYYY-MM-DD");
var lastDate =  moment(value, "YYYY-MM-DD").endOf("month").format("YYYY-MM-DD");
$(\'#startDate\').val(firstDate);
$(\'#endDate\').val(lastDate);
var a = "?from=";
var b = "&to=";
var date1 = a.concat($(\'#startDate\').val().replace(/-/g, \'\'),b,$(\'#endDate\').val().replace(/-/g, \'\'));
window.location.href=date1;
});
</script>
';
$data["css"] = 
'<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.css" rel="stylesheet"/>
';
					if(!empty($this->input->get("from"))){
						if(!empty($this->input->get("to"))){
							$from = $this->input->get("from");
							$to = $this->input->get("to");
							$sql = "select status,sum(total) as total,tanggalselesai,kodepesanan from pesanan where tanggalselesai between '{$from}' and '{$to}' group by month(tanggalselesai) order by tanggalselesai asc";
							$data["pesanan"] = $this->db->query($sql)->result();
						}
					}
				}
				elseif($action == "yearly"){
					$data["filter"] = "yearly";
					$sql = "select status,sum(total) as total,tanggalselesai,kodepesanan from pesanan group by year(tanggalselesai) order by tanggalselesai asc";
					$data["pesanan"] = $this->db->query($sql)->result();
$data["js"] = 
'<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" integrity="sha256-4iQZ6BVL4qNKlQ27TExEhBN1HFPvAvAMbFavKKosSWQ=" crossorigin="anonymous"></script>
<script>
var sd = $(\'#startDate\').val();
jQuery(\'#startDate\').datepicker({
format: \'yyyy-mm-dd\',
endDate: \'0d\',
autoclose: true,
todayBtn: "linked",
minViewMode: 2,
maxViewMode: 3,
orientation: "bottom left"
}).on("changeDate",function (e) {
jQuery(\'#endDate\').datepicker("setStartDate", e.date);
var value = $(\'#startDate\').val();
var firstDate = moment(value, "YYYY-MM-DD").startOf("year").format("YYYY-MM-DD");
var lastDate =  moment(value, "YYYY-MM-DD").endOf("year").format("YYYY-MM-DD");
$(\'#startDate\').val(firstDate);
$(\'#endDate\').val(lastDate);
var a = "?from=";
var b = "&to=";
var date1 = a.concat($(\'#startDate\').val().replace(/-/g, \'\'),b,$(\'#endDate\').val().replace(/-/g, \'\'));
window.location.href=date1;
});
jQuery(\'#endDate\').datepicker({
format: \'yyyy-mm-dd\',
startDate: sd,
endDate: \'0d\',
autoclose: true,
todayBtn: "linked",
minViewMode: 2,
maxViewMode: 3,
orientation: "bottom left"
}).on("changeDate",function (e) {
jQuery(\'#startDate\').datepicker("setEndDate", e.date);
var value = $(\'#endDate\').val();
var firstDate = moment(value, "YYYY-MM-DD").startOf("year").format("YYYY-MM-DD");
var lastDate =  moment(value, "YYYY-MM-DD").endOf("year").format("YYYY-MM-DD");
$(\'#startDate\').val(firstDate);
$(\'#endDate\').val(lastDate);
var a = "?from=";
var b = "&to=";
var date1 = a.concat($(\'#startDate\').val().replace(/-/g, \'\'),b,$(\'#endDate\').val().replace(/-/g, \'\'));
window.location.href=date1;
});
</script>
';
$data["css"] = 
'<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.css" rel="stylesheet"/>
';
					if(!empty($this->input->get("from"))){
						if(!empty($this->input->get("to"))){
							$from = $this->input->get("from");
							$to = $this->input->get("to");
							$sql = "select status,sum(total) as total,tanggalselesai,kodepesanan from pesanan where tanggalselesai between '{$from}' and '{$to}' group by year(tanggalselesai) order by tanggalselesai asc";
							$data["pesanan"] = $this->db->query($sql)->result();
						}
					}
				}
				elseif($action == "custom"){
					$data["filter"] = "custom";
					$sql = "select * from pesanan order by tanggalselesai asc";
					$data["pesanan"] = $this->db->query($sql)->result();
$data["js"] = 
'<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
<script>
var sd = $(\'#startDate\').val();
var ed = $(\'#endDate\').val();
if(ed == ""){
ed = \'0d\';
};
jQuery(\'#startDate\').datepicker({
format: \'yyyy-mm-dd\',
endDate: ed,
autoclose: true,
todayBtn: "linked",
maxViewMode: 2,
orientation: "bottom left"
}).on("changeDate",function (e) {
if($(\'#endDate\').val() == ""){
$(\'#endDate\').val($(\'#startDate\').val());
};
var a = "?from=";
var b = "&to=";
var date1 = a.concat($(\'#startDate\').val().replace(/-/g, \'\'),b,$(\'#endDate\').val().replace(/-/g, \'\'));
window.location.href=date1;
sd = e.date;
});
jQuery(\'#endDate\').datepicker({
format: \'yyyy-mm-dd\',
endDate: \'0d\',
startDate: sd,
autoclose: true,
todayBtn: "linked",
maxViewMode: 2,
orientation: "bottom left"
}).on("changeDate",function (e) {
if($(\'#startDate\').val() == ""){
$(\'#startDate\').val($(\'#endDate\').val());
};var a = "?from=";
var b = "&to=";
var date1 = a.concat($(\'#startDate\').val().replace(/-/g, \'\'),b,$(\'#endDate\').val().replace(/-/g, \'\'));
window.location.href=date1;
ed = e.date;
});
</script>
';
$data["css"] = 
'<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.css" rel="stylesheet"/>
';
					if(!empty($this->input->get("from"))){
						if(!empty($this->input->get("to"))){
							$from = $this->input->get("from");
							$to = $this->input->get("to");
							$sql = "select status,sum(total) as total,tanggalselesai,kodepesanan from pesanan where tanggalselesai between '{$from}' and '{$to}' group by day(tanggalselesai) order by tanggalselesai asc";
							$data["pesanan"] = $this->db->query($sql)->result();
						}
					}
				}
				else{
					redirect(base_url("admin/reports/daily"),"refresh");
					die();
				}
				$this->load->view("templates/headlte",$data);
				$this->load->view("templates/navlte");
				$this->load->view("reports");
				$this->load->view("templates/footlte");
			}
			else{
				redirect(base_url(),"refresh");
				die();
			}
		}
		else{
			redirect(base_url(),"refresh");
			die();
		}
	}
}