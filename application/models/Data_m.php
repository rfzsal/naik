<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Data_m extends CI_Model {
    // rajaongkir api key
    private $apikey = "YOUR API KEY";
    private function getToken()
    {
        return $this->apikey;
    }
	// get province
	public function getprov()
	{
        $apikey = $this->getToken();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "key: {$apikey}"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $listProv = array();
        if ($err) {
            return false;
        } else {
            $arrayResponse = json_decode($response, true);
            $templistProv = $arrayResponse['rajaongkir']['results'];
            foreach ($templistProv as $value) {
                $prov = new stdClass();
                $prov->id = $value['province_id'];
                $prov->nama = $value['province'];
                array_push($listProv, $prov);
            }
            return $listProv;
        }
	}
	// get city
	public function getcity($id)
	{
        $apikey = $this->getToken();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province={$id}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "key: {$apikey}"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $listCity = array();
        if ($err) {
            return false;
        } else {
            $arrayResponse = json_decode($response, true);
            $templistCity = $arrayResponse['rajaongkir']['results'];
            foreach ($templistCity as $value) {
                $city = new stdClass();
                $city->id = $value['city_id'];
                $city->nama = $value['city_name'];
                $city->tipe = $value['type'];
                array_push($listCity, $city);
            }
            return $listCity;
        }
    }
    // get all bank
    public function getbank()
    {
        $this->db->select('*');    
        $this->db->from('bank');
        $this->db->order_by('namabank','ASC');
        $query = $this->db->get();
        return $result = $query->result();
    }
    // get bank by name
    public function getbankdetail($namabank)
    {
        $this->db->select('*');    
        $this->db->from('bank');
        $this->db->where('namabank',$namabank);
        $query = $this->db->get();
        return $result = $query->result();
    }
    // new bank
	public function addbank($koderekening,$namabank,$atasnama)
	{
		$this->db->set('koderekening', $koderekening);
		$this->db->set('namabank', $namabank);
		$this->db->set('atasnama', $atasnama);
        return $this->db->insert('bank');
    }
    // delete bank
	public function deletebank($namabank)
	{
		$this->db->where('namabank', $namabank);
        return $this->db->delete('bank');
    }
    // toggle bank
	public function togglebank($namabanklama,$status)
	{
		$this->db->set('aktif', $status);
        $this->db->where('namabank', $namabanklama);
        return $this->db->update('bank');
    }
    // edit bank
	public function editbank($namabanklama,$koderekening,$namabank,$atasnama)
	{
		$this->db->set('namabank', $namabank);
		$this->db->set('koderekening', $koderekening);
		$this->db->set('atasnama', $atasnama);
        $this->db->where('namabank', $namabanklama);
        return $this->db->update('bank');
    }
}
