<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_m extends CI_Model {
	// login user
	public function check($email,$pass)
	{
		$query = $this->db->select("*")->from("pengguna")->where("email",$email)->get();
        if($query->num_rows() > 0){
            $row = $query->row();
            if(password_verify($pass,$row->sandi)){
                $this->session->set_userdata("loginstate","true");
                if($row->status == "1"){
                    $this->session->set_userdata("email",$row->email);
                    $this->session->set_userdata("nama",$row->nama);
                    $this->session->set_userdata("telepon",$row->telepon);
                    $this->session->set_userdata("provinsi",$row->provinsi);
                    $this->session->set_userdata("kota",$row->kota);
                    $this->session->set_userdata("alamat",$row->alamat);
                    $this->session->set_userdata("kodepos",$row->kodepos);
                    return true;
                }
                elseif($row->status == "2"){
                    $this->session->set_userdata("email",$row->email);
                    $this->session->set_userdata("nama",$row->nama);
                    $this->session->set_userdata("telepon",$row->telepon);
                    $this->session->set_userdata("provinsi",$row->provinsi);
                    $this->session->set_userdata("kota",$row->kota);
                    $this->session->set_userdata("alamat",$row->alamat);
                    $this->session->set_userdata("kodepos",$row->kodepos);
                    $this->session->set_userdata("adminmode","true");
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
	}
}
