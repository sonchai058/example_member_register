<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!class_exists('CI_Model')) { class CI_Model extends Model {} }

class Address_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database('default');
	}

	public function province_list() {
		return $this->common_model->custom_query("select address_code.* from address_code where length(ProvinceID)=2  group by ProvinceID");
	}

	public function district_list($ProvinceID='') {
		return $this->common_model->custom_query("select address_code.* from address_code where substr(DistrictID,1,2)='{$ProvinceID}' group by DistrictID");
	}

	public function tambon_list($DistrictID='') {
		return $this->common_model->custom_query("select address_code.* from address_code where substr(TambonID,1,4)='{$DistrictID}' group by TambonID");
	}

}
?>
