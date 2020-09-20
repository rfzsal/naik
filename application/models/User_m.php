<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_m extends CI_Model {
	// update user
	public function update($email,$telepon,$provinsi,$kota,$alamat,$kodepos)
	{
        $query = $this->db->select("*")->from("pengguna")->where("email",$email)->get();
        if($query->num_rows() > 0){
            $data = array(
                'email' => $email,
                'telepon'  => $telepon,
                'provinsi'  => $provinsi,
                'kota'  => $kota,
                'alamat'  => $alamat,
                'kodepos'  => $kodepos
            );
            return $this->db->where('email',$email)->update('pengguna',$data);
        }
        else{
            return false;
        }
	}
}
