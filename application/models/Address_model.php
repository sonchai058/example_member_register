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
		return $this->common_model->custom_query("select address_code.* from address_code where length(ProvinceID)=2   group by ProvinceID");
	}

}
?>
