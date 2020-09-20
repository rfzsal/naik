<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Register_m extends CI_Model {
	// register
	public function add($nama,$email,$pass,$status)
	{
        $query = $this->db->select("*")->from("pengguna")->where("email",$email)->get();
        if($query->num_rows() == 0){
            $hash = md5(mt_rand(0,5000));
            $data = array(
                "email" => $email,
                "sandi" => password_hash($pass,PASSWORD_BCRYPT),
                "hash" => $hash,
                "nama" => $nama,
                "telepon" => "",
                "alamat" => "",
                "status" => $status,
                "provinsi" => "",
                "kota" => "",
                "kodepos" => "",
            );
            $this->db->insert("pengguna",$data);
            return true;
        }
        else{
            return false;
        }
	}
}
