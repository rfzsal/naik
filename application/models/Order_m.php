<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order_m extends CI_Model {
        // new code
        public function newcode($telepon)
        {
                $kode = $telepon . "N" . mt_rand(1111,9999);
                return $kode;
        }
        // add order
        public function new($kode,$email,$telepon,$total,$bank,$nama,$provinsi,$kota,$alamat,$kodepos)
        {
                $sql = "insert into pesanan values ('$kode','$email','$telepon','$total',now(),'$bank','1',now(),'$nama','0','$provinsi','$kota','$alamat','$kodepos',null,null,null)";
                return $this->db->query($sql);
        }
        // update order
        public function update($kode,$total)
        {
                $sql = "update pesanan set total = '{$total}' where kodepesanan = '{$kode}'";
                return $this->db->query($sql);
        }
        // cancel order
        public function cancel($kode)
        {
                $result = $this->db->select('*')->from('pesanan')->where('kodepesanan',$kode)->get()->result();
                foreach($result as $row){
                        $email = $row->email;
                        $telepon = $row->telepon;
                        $total = $row->total;
                        $bank = $row->bank;
                        $tanggalbatal = $row->tanggalbatal;
                        $status = 0;
                }
                $data = array(
                        "kodepesanan" => $kode,
                        "email" => $email,
                        "telepon" => $telepon,
                        "total" => $total,
                        "bank" => $bank,
                        "tanggalbatal" => $tanggalbatal,
                        "status" => $status
                );
                return $this->db->insert("pesananbatal",$data);
        }
        // add order detail
        public function newdetail($kode,$kodebarang,$jumlahbarang,$ukuran,$hargabarang,$namabarang,$kategori,$tipe)
        {
                $data = array(
                        "kodepesanan" => $kode,
                        "kodebarang" => $kodebarang,
                        "jumlahbarang" => $jumlahbarang,
                        "ukuran" => $ukuran,
                        "hargabarang" => $hargabarang,
                        "namabarang" => $namabarang,
                        "kategori" => $kategori,
                        "tipe" => $tipe
                );
                return $this->db->insert("pesanandetail",$data);
        }
}
