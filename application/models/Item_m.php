<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Item_m extends CI_Model {
	// add item
	public function add($kodebarang,$namabarang,$stokbarang,$hargabarang,$fotobarang,$kategori,$deskripsi)
	{
        $fotobarang .= "/" . $kodebarang . ".jpg";
        $this->itempict = $this->_uploadnewimg($kodebarang,$fotobarang);
        $data = array(
            "kodebarang" => $kodebarang,
            "namabarang" => $namabarang,
            "stokbarang" => $stokbarang,
            "hargabarang" => $hargabarang,
            "fotobarang" => $fotobarang,
            "deskripsi" => $deskripsi,
        );
        $this->db->set('tanggal', 'NOW()', FALSE);
        return $this->db->insert('barang',$data);
    }
	// edit item
	public function edit($kodebarang,$namabarang,$stokbarang,$hargabarang,$fotobarang,$kategori,$deskripsi)
	{
        $fotobarang .= "/" . $kodebarang . ".jpg";
        explode("/",$fotobarang);
        if(($_FILES["itempict"]["error"]) == 0){
            $this->_deleteimg($kodebarang);
            $this->itempict = $this->_uploadnewimg($kodebarang,$fotobarang);
        }
        else{
            $result = $this->get($kodebarang);
            foreach($result as $row){
                rename("assets/img/".$row->fotobarang, "assets/img/".$fotobarang);
            }
        }
        $data = array(
            "kodebarang" => $kodebarang,
            "namabarang" => $namabarang,
            "stokbarang" => $stokbarang,
            "hargabarang" => $hargabarang,
            "fotobarang" => $fotobarang,
            "deskripsi" => $deskripsi,
        );
        $this->db->set('tanggal', 'NOW()', FALSE);
        $this->db->where('kodebarang', $kodebarang);
        return $this->db->update('barang',$data);
    }
	// delete item
	public function delete($kodebarang)
	{
        $result = $this->db->select('*')->from('barang')->where('kodebarang',$kodebarang)->get();
        if($result->num_rows() == 0){
            return 0;
        }
        else{
            $this->_deleteimg($kodebarang);
            $this->db->where('kodebarang',$kodebarang);
            $this->db->delete('harapan');
            $this->db->where('kodebarang',$kodebarang);
            $this->db->delete('keranjang');
            $this->db->where('kodebarang',$kodebarang);
            $this->db->delete('ukuranbarang');
            $this->db->where('kodebarang',$kodebarang);
            $this->db->delete('tipebarang');
            $this->db->where('kodebarang',$kodebarang);
            $this->db->delete('kategoribarang');
            $this->db->where('kodebarang',$kodebarang);
            return $this->db->delete('barang');
        }
    }
	// set type
	public function settipe($kodebarang,$kodetipe)
	{
        $result = $this->db->select("*")->from("tipebarang")->where("kodebarang",$kodebarang)->get();
        if($result->num_rows() == 0){
            $data = array(
                "kodebarang" => $kodebarang,
                "kodetipe" => $kodetipe
            );
            return $this->db->insert('tipebarang',$data);
        }
        else{
            $data = array(
                "kodebarang" => $kodebarang,
                "kodetipe" => $kodetipe
            );
            $this->db->where("kodebarang",$kodebarang);
            return $this->db->update('tipebarang',$data);
        }
    }
	// set category
	public function setkategori($kodebarang,$kodekategori)
	{
        $result = $this->db->select("*")->from("kategoribarang")->where("kodebarang",$kodebarang)->get();
        if($result->num_rows() == 0){
            $data = array(
                "kodebarang" => $kodebarang,
                "kodekategori" => $kodekategori
            );
            return $this->db->insert('kategoribarang',$data);
        }
        else{
            $data = array(
                "kodebarang" => $kodebarang,
                "kodekategori" => $kodekategori
            );
            $this->db->where("kodebarang",$kodebarang);
            return $this->db->update('kategoribarang',$data);
        }
    }
	// upload image
	private function _uploadnewimg($kodebarang,$fotobarang)
	{
        explode("/",$fotobarang);
        $config['upload_path']          = './assets/img/' . $fotobarang[0];
        $config['allowed_types']        = 'jpg|JPG|jpeg|JPEG';
        $config['file_name']            = $kodebarang;
        $config['overwrite']			= true;
        $config['max_size']             = 1024;
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload("itempict")) {
            return $this->upload->data("file_name");
        }
        else{
            echo "error";
        }
    }
	// delete image
	private function _deleteimg($kodebarang)
	{
        $this->db->select("*");
        $this->db->from("barang");
        $this->db->where("kodebarang",$kodebarang);
        $query = $this->db->get();
        $result = $query->result();
        foreach($result as $row){
            return array_map('unlink', glob(FCPATH."assets/img/{$row->fotobarang}"));
        }
    }
	// get detail
	public function get($kodebarang)
	{
		$this->db->select('*');    
        $this->db->from('barang');
        $this->db->where('kodebarang',$kodebarang);
        $query = $this->db->get();
        return $result = $query->result();
    }
	// get bank
	public function getbank()
	{
		$this->db->select('*');    
        $this->db->from('bank');
        $query = $this->db->get();
        return $result = $query->result();
    }
	// get all
	public function getall($sort)
	{
        if($sort == "date-latest"){
            $sortby[0] = "tanggal";
            $sortby[1] = "desc";
        }
        elseif($sort == "date-oldest"){
            $sortby[0] = "tanggal";
            $sortby[1] = "asc";
        }
        elseif($sort == "price-lowest"){
            $sortby[0] = "hargabarang";
            $sortby[1] = "asc";
        }
        elseif($sort == "price-highest"){
            $sortby[0] = "hargabarang";
            $sortby[1] = "desc";
        }
		$this->db->select('*');    
        $this->db->from('barang');
        $this->db->order_by($sortby[0],$sortby[1]);
        $query = $this->db->get();
        return $result = $query->result();
    }
	// get all and type
	public function getalltipe($tipe,$sort)
	{
        if($sort == "date-latest"){
            $sortby[0] = "tanggal";
            $sortby[1] = "desc";
        }
        elseif($sort == "date-oldest"){
            $sortby[0] = "tanggal";
            $sortby[1] = "asc";
        }
        elseif($sort == "price-lowest"){
            $sortby[0] = "hargabarang";
            $sortby[1] = "asc";
        }
        elseif($sort == "price-highest"){
            $sortby[0] = "hargabarang";
            $sortby[1] = "desc";
        }
		$this->db->select('*');    
        $this->db->from('barang');
        $this->db->join('tipebarang', 'tipebarang.kodebarang = barang.kodebarang');
        $this->db->join('tipe', 'tipe.kodetipe = tipebarang.kodetipe');
        $this->db->where('tipe.namatipe',$tipe);
        $this->db->order_by($sortby[0],$sortby[1]);
        $query = $this->db->get();
        return $result = $query->result();
    }
    // add item size
	public function setsize($kodebarang,$ukuran)
	{
        $this->db->set('ukuran',$ukuran); 
        $result = $this->db->select('*')->from('ukuranbarang')->where('kodebarang',$kodebarang)->get();
        if($result->num_rows() == "0"){
            $this->db->set('kodebarang',$kodebarang);
            return $this->db->insert('ukuranbarang');
        }
        else{
            $this->db->where('kodebarang',$kodebarang);
            return $this->db->update('ukuranbarang');
        }
    }
    // get size list
	public function getallsize()
	{
		$this->db->select('*'); 
        $this->db->from('ukuran');
        $query = $this->db->get();
        return $result = $query->result();
    }
    // get size
	public function getsize($kodebarang)
	{
		$this->db->select('*'); 
        $this->db->from('barang');
        $this->db->join('ukuranbarang', 'ukuranbarang.kodebarang = barang.kodebarang');
        $this->db->join('ukuran', 'ukuran.ukuran = ukuranbarang.ukuran');
        $this->db->where('barang.kodebarang',$kodebarang);
        $query = $this->db->get();
        return $result = $query->result();
    }
    // get type
	public function gettipe($kodebarang)
	{
		$this->db->select('*'); 
        $this->db->from('barang');
        $this->db->join('tipebarang', 'tipebarang.kodebarang = barang.kodebarang');
        $this->db->join('tipe', 'tipe.kodetipe = tipebarang.kodetipe');
        $this->db->where('barang.kodebarang',$kodebarang);
        $query = $this->db->get();
        return $result = $query->result();
    }
    // get type detail
	public function getdetailtipe($kodetipe)
	{
		$this->db->select('*'); 
        $this->db->from('tipe');
        $this->db->where('kodetipe',$kodetipe);
        $query = $this->db->get();
        return $result = $query->result();
    }
    // get type name
	public function getnamatipe()
	{
		$this->db->select('*'); 
        $this->db->from('tipe');
        $query = $this->db->get();
        return $result = $query->result();
    }
    // edit type
	public function edittipe($kodetipe,$namatipe)
	{
		$this->db->set('namatipe', $namatipe);
        $this->db->where('kodetipe', $kodetipe);
        return $this->db->update('tipe');
    }
    // delete type
	public function deletetipe($kodetipe)
	{
        $result = $this->db->select('*')->from('tipebarang')->where('kodetipe',$kodetipe)->get();
        if($result->num_rows() == "0"){
            $this->db->where('kodetipe', $kodetipe);
            return $this->db->delete('tipe');
        }
        else{
            return false;
        }
    }
    // new type
	public function newtipe($namatipe)
	{
        $kodetipe = "N" . mt_rand(11,99);
		$this->db->set('kodetipe', $kodetipe);
		$this->db->set('namatipe', $namatipe);
        return $this->db->insert('tipe');
    }
    // get category
	public function getkategori($kodebarang)
	{
		$this->db->select('*'); 
        $this->db->from('barang');
        $this->db->join('kategoribarang', 'kategoribarang.kodebarang = barang.kodebarang');
        $this->db->join('kategori', 'kategori.kodekategori = kategoribarang.kodekategori');
        $this->db->where('barang.kodebarang',$kodebarang);
        $query = $this->db->get();
        return $result = $query->result();
    }
    // get by category and type
	public function getbykategoritipe($kategori,$tipe,$sort)
	{
        if($sort == "date-latest"){
            $sortby[0] = "tanggal";
            $sortby[1] = "desc";
        }
        elseif($sort == "date-oldest"){
            $sortby[0] = "tanggal";
            $sortby[1] = "asc";
        }
        elseif($sort == "price-lowest"){
            $sortby[0] = "hargabarang";
            $sortby[1] = "asc";
        }
        elseif($sort == "price-highest"){
            $sortby[0] = "hargabarang";
            $sortby[1] = "desc";
        }
		$this->db->select('*'); 
        $this->db->from('barang');
        $this->db->join('kategoribarang', 'kategoribarang.kodebarang = barang.kodebarang');
        $this->db->join('kategori', 'kategori.kodekategori = kategoribarang.kodekategori');
        $this->db->join('tipebarang', 'tipebarang.kodebarang = barang.kodebarang');
        $this->db->join('tipe', 'tipe.kodetipe = tipebarang.kodetipe');
        $this->db->where('kategori.namakategori',$kategori);
        $this->db->where('tipe.namatipe',$tipe);
        $this->db->order_by($sortby[0],$sortby[1]);
        $query = $this->db->get();
        return $result = $query->result();
    }
    // search by name, category and type
	public function getsearch($search,$sort)
	{
        if($sort == "date-latest"){
            $sortby[0] = "tanggal";
            $sortby[1] = "desc";
        }
        elseif($sort == "date-oldest"){
            $sortby[0] = "tanggal";
            $sortby[1] = "asc";
        }
        elseif($sort == "price-lowest"){
            $sortby[0] = "hargabarang";
            $sortby[1] = "asc";
        }
        elseif($sort == "price-highest"){
            $sortby[0] = "hargabarang";
            $sortby[1] = "desc";
        }
		$this->db->select('*'); 
        $this->db->from('barang');
        $this->db->join('kategoribarang', 'kategoribarang.kodebarang = barang.kodebarang');
        $this->db->join('kategori', 'kategori.kodekategori = kategoribarang.kodekategori');
        $this->db->join('tipebarang', 'tipebarang.kodebarang = barang.kodebarang');
        $this->db->join('tipe', 'tipe.kodetipe = tipebarang.kodetipe');
        $this->db->like('kategori.namakategori',$search,'after');
        $this->db->or_like('tipe.namatipe',$search);
        $this->db->or_like('barang.namabarang',$search);
        $this->db->order_by($sortby[0],$sortby[1]);
        $query = $this->db->get();
        return $result = $query->result();
    }
    // get by category
	public function getbykategori($kategori,$sort)
	{
        if($sort == "date-latest"){
            $sortby[0] = "tanggal";
            $sortby[1] = "desc";
        }
        elseif($sort == "date-oldest"){
            $sortby[0] = "tanggal";
            $sortby[1] = "asc";
        }
        elseif($sort == "price-lowest"){
            $sortby[0] = "hargabarang";
            $sortby[1] = "asc";
        }
        elseif($sort == "price-highest"){
            $sortby[0] = "hargabarang";
            $sortby[1] = "desc";
        }
		$this->db->select('*'); 
        $this->db->from('barang');
        $this->db->join('kategoribarang', 'kategoribarang.kodebarang = barang.kodebarang');
        $this->db->join('kategori', 'kategori.kodekategori = kategoribarang.kodekategori');
        $this->db->where('kategori.namakategori',$kategori);
        $this->db->order_by($sortby[0],$sortby[1]);
        $query = $this->db->get();
        return $result = $query->result();
    }
    // get new
	public function getnew($kategori)
	{
		$this->db->select('*');    
        $this->db->from('barang');
        $this->db->join('kategoribarang', 'kategoribarang.kodebarang = barang.kodebarang');
        $this->db->where('kodekategori',$kategori);
        $this->db->order_by('tanggal','desc');
        $this->db->limit(1);
        $query = $this->db->get();
        return $result = $query->result();
    }
    // check wishlist
	public function checkwish($kodebarang)
	{
        if($this->session->has_userdata("loginstate") && $this->session->loginstate == "true"){
            $email = $this->session->email;
            $this->db->select('*');    
            $this->db->from('harapan');
            $this->db->join('pengguna', 'harapan.email = pengguna.email');
            $this->db->where('kodebarang',$kodebarang);
            $this->db->where('harapan.email',$email);
            $query = $this->db->get();
            if($query->num_rows() == 0){
                return false;
            }
            else{
                return true;
            }
        }
        else{
            return false;
        }
    }
    // get wishlist
	public function getwish()
	{
        $email = $this->session->email;
        $this->db->select('*');    
        $this->db->from('barang');
        $this->db->join('harapan', 'harapan.kodebarang = barang.kodebarang');
        $this->db->join('pengguna', 'harapan.email = pengguna.email');
        $this->db->where('harapan.email',$email);
        $query = $this->db->get();
        return $result = $query->result();
    }
    // wishlist
	public function wishlist($email,$kodebarang)
	{
        $this->db->select('*');    
        $this->db->from('barang');
        $this->db->where('kodebarang',$kodebarang);
        $query = $this->db->get();
        $this->db->select('*');    
        $this->db->from('harapan');
        $this->db->where('kodebarang',$kodebarang);
        $this->db->where('email',$email);
        $query2 = $this->db->get();
        if($query->num_rows() == 0){
            return false;
        }
        else{
            if($query2->num_rows() == 0){
                $data = array(
                    "email" => $email,
                    "kodebarang" => $kodebarang
                );
                return $this->db->insert('harapan',$data);
            }
            else{
                $this->db->where('email',$email);
                $this->db->where('kodebarang',$kodebarang);
                return $this->db->delete('harapan');
            } 
        }
    }
    // add cart
	public function addcart($email,$kodebarang,$ukuran,$jumlahbarang)
	{
        $this->db->select('*');    
        $this->db->from('barang');
        $this->db->where('kodebarang',$kodebarang);
        $query = $this->db->get();
        $this->db->select('*');    
        $this->db->from('keranjang');
        $this->db->where('email',$email);
        $this->db->where('kodebarang',$kodebarang);
        $this->db->where('ukuran',$ukuran);
        $query2 = $this->db->get();
        if($query->num_rows() == 0){
            return false;
        }
        else{
            if($query2->num_rows() == 0){
                $data = array(
                    "email" => $email,
                    "kodebarang" => $kodebarang,
                    "ukuran" => $ukuran,
                    "jumlahbarang" => $jumlahbarang
                );
                return $this->db->insert('keranjang',$data);
            }
            elseif($query2->num_rows() > 0){
                $result = $query2->result();
                foreach($result as $row){
                    $jumlahbarang = $row->jumlahbarang + $jumlahbarang;
                }
                $data = array(
                    "email" => $email,
                    "kodebarang" => $kodebarang,
                    "jumlahbarang" => $jumlahbarang
                );
                $this->db->where('email',$email);
                $this->db->where('kodebarang',$kodebarang);
                $this->db->where('ukuran',$ukuran);
                return $this->db->update('keranjang',$data);
            } 
        }
    }
    // remove cart
	public function delcart($email,$kodebarang,$ukuran)
	{
        $this->db->select('*');    
        $this->db->from('keranjang');
        $this->db->where('email',$email);
        $this->db->where('kodebarang',$kodebarang);
        $query2 = $this->db->get();
        if($query2->num_rows() != 0){
            $this->db->where('kodebarang',$kodebarang);
            $this->db->where('email',$email);
            $this->db->where('ukuran',$ukuran);
            return $this->db->delete('keranjang');
        }
        else{
            return false;
        }
    }
    // clear cart
	public function clearcart($email)
	{
        $this->db->select('*');    
        $this->db->from('keranjang');
        $this->db->where('email',$email);
        $query2 = $this->db->get();
        if($query2->num_rows() != 0){
            $this->db->where('email',$email);
            return $this->db->delete('keranjang');
        }
        else{
            return false;
        }
    }
    // get cart
	public function getcart()
	{
        $email = $this->session->email;
        $this->db->select('*');    
        $this->db->from('barang');
        $this->db->join('keranjang', 'keranjang.kodebarang = barang.kodebarang');
        $this->db->join('pengguna', 'keranjang.email = pengguna.email');
        $this->db->where('keranjang.email',$email);
        $query = $this->db->get();
        return $result = $query->result();
    }
    // get user by email
    public function getuser($email)
    {
        $this->db->select('*');    
        $this->db->from('pengguna');
        $this->db->where('email',$email);
        $query = $this->db->get();
        return $result = $query->result();
    }
    // get order by id
    public function getorderid($kodepesanan)
    {
        $this->db->select('*');    
        $this->db->from('pesanan');
        $this->db->where('kodepesanan',$kodepesanan);
        $query = $this->db->get();
        return $result = $query->result();
    }
    // update resi
    public function updateresi($kodepesanan,$koderesi)
    {
        $this->db->set('koderesi',$koderesi); 
        $this->db->set('tanggalkirim', 'NOW()', FALSE);
        $this->db->where('kodepesanan',$kodepesanan);
        return $this->db->update('pesanan');
    }
    // update order
    public function updateorder($kodepesanan,$status)
    {
        $this->db->set('status',$status); 
        if($status == "5"){
            $this->db->set('tanggalselesai', 'NOW()', FALSE);
        }
        elseif($status == "6"){
            $this->db->set('tanggalbatal', 'NOW()', FALSE);
        }
        $this->db->where('kodepesanan',$kodepesanan); 
        return $this->db->update('pesanan');
    }
    // get canceled order
    public function getallcancel()
    {
        $this->db->select('*');    
        $this->db->from('pesananbatal');
        $this->db->order_by('tanggalbatal','DESC');
        $query = $this->db->get();
        return $result = $query->result();
    }
    // get order detail
    public function getorderdetail($kodepesanan)
    {
        $this->db->select('*');    
        $this->db->from('pesanan');
        $this->db->join('bank', 'bank.namabank = pesanan.bank');
        $this->db->where('kodepesanan',$kodepesanan);
        $query = $this->db->get();
        return $result = $query->result();
    }
    // get order detail product
    public function getorderdetailproduct($kodepesanan)
    {
        $this->db->select('*');    
        $this->db->from('pesanan');
        $this->db->join('pesanandetail', 'pesanandetail.kodepesanan = pesanan.kodepesanan');
        $this->db->where('pesanan.kodepesanan',$kodepesanan);
        $query = $this->db->get();
        return $result = $query->result();
    }
    // get order by email
	public function getorder($filter)
	{
        if($filter == "1"){
            $email = $this->session->email;
            $this->db->select('*');    
            $this->db->from('pesanan');
            $this->db->where('email',$email);
            $this->db->where('status','1');
            $this->db->order_by('tanggaldetail','DESC');
            $query = $this->db->get();
            return $result = $query->result();
        }
        elseif($filter == "2"){
            $email = $this->session->email;
            $this->db->select('*');    
            $this->db->from('pesanan');
            $this->db->where('email',$email);
            $this->db->where('status','2');
            $this->db->order_by('tanggaldetail','DESC');
            $query = $this->db->get();
            return $result = $query->result();
        }
        elseif($filter == "3"){
            $email = $this->session->email;
            $this->db->select('*');    
            $this->db->from('pesanan');
            $this->db->where('email',$email);
            $this->db->where('status','3');
            $this->db->order_by('tanggaldetail','DESC');
            $query = $this->db->get();
            return $result = $query->result();
        }
        elseif($filter == "4"){
            $email = $this->session->email;
            $this->db->select('*');    
            $this->db->from('pesanan');
            $this->db->where('email',$email);
            $this->db->where('status','4');
            $this->db->order_by('tanggaldetail','DESC');
            $query = $this->db->get();
            return $result = $query->result();
        }
        elseif($filter == "5"){
            $email = $this->session->email;
            $this->db->select('*');    
            $this->db->from('pesanan');
            $this->db->where('email',$email);
            $this->db->where('status','5');
            $this->db->order_by('tanggaldetail','DESC');
            $query = $this->db->get();
            return $result = $query->result();
        }
        elseif($filter == "6"){
            $email = $this->session->email;
            $this->db->select('*');    
            $this->db->from('pesanan');
            $this->db->where('email',$email);
            $this->db->where('status','6');
            $this->db->order_by('tanggaldetail','DESC');
            $query = $this->db->get();
            return $result = $query->result();
        }
        else{
            $email = $this->session->email;
            $this->db->select('*');    
            $this->db->from('pesanan');
            $this->db->where('email',$email);
            $this->db->order_by('tanggaldetail','DESC');
            $query = $this->db->get();
            return $result = $query->result();
        }
    }
    // get all order
	public function getallorder($filter)
	{
        if($filter == "1"){
            $this->db->select('*');    
            $this->db->from('pesanan');
            $this->db->where('status','1');
            $this->db->order_by('tanggaldetail','DESC');
            $query = $this->db->get();
            return $result = $query->result();
        }
        elseif($filter == "2"){
            $this->db->select('*');    
            $this->db->from('pesanan');
            $this->db->where('status','2');
            $this->db->order_by('tanggaldetail','DESC');
            $query = $this->db->get();
            return $result = $query->result();
        }
        elseif($filter == "3"){
            $this->db->select('*');    
            $this->db->from('pesanan');
            $this->db->where('status','3');
            $this->db->order_by('tanggaldetail','DESC');
            $query = $this->db->get();
            return $result = $query->result();
        }
        elseif($filter == "4"){
            $this->db->select('*');    
            $this->db->from('pesanan');
            $this->db->where('status','4');
            $this->db->order_by('tanggaldetail','DESC');
            $query = $this->db->get();
            return $result = $query->result();
        }
        elseif($filter == "5"){
            $this->db->select('*');    
            $this->db->from('pesanan');
            $this->db->where('status','5');
            $this->db->order_by('tanggaldetail','DESC');
            $query = $this->db->get();
            return $result = $query->result();
        }
        elseif($filter == "6"){
            $this->db->select('*');    
            $this->db->from('pesanan');
            $this->db->where('status','6');
            $this->db->order_by('tanggaldetail','DESC');
            $query = $this->db->get();
            return $result = $query->result();
        }
        else{
            $this->db->select('*');    
            $this->db->from('pesanan');
            $this->db->order_by('tanggaldetail','DESC');
            $query = $this->db->get();
            return $result = $query->result();
        }
    }
}
