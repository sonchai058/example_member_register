<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->database();
        $this->load->model('common_model');
        $this->load->model('address_model');
        $this->load->helper('general_helper');
		$this->load->library('session');

    }

    public function index() {
        redirect('register','refresh');
    }


	public function dashboard()
	{
		$data['title'] = "รายชื่อผู้สมัคร (Dashboard)";
		$data['content_file'] = "member";

		$data['link_head'] = $data['content_file']."/link_head";
		$data['link_foo'] = $data['content_file']."/link_foo";
		$data['script'] = $data['content_file']."/script";
		$data['content'] = $data['content_file']."/main";

		$data['dataList'] = $this->common_model->custom_query("select a.*,b.* from member as a left join address_code as b on a.tambon_id=b.TambonID  where a.status=1 order by a.mod_date DESC");
		
		$this->load->view('layout',$data);//
	}

	public function register()
	{
		$data['title'] = "ลงทะเบียน (Register)";
		$data['content_file'] = "member";

		$data['link_head'] = $data['content_file']."/link_head";
		$data['link_foo'] = $data['content_file']."/link_foo";
		$data['script'] = $data['content_file']."/script";
		$data['content'] = $data['content_file']."/register";

		$this->load->view('layout',$data);//
	}

    public function getDistrict_list() {
        header('Content-Type: application/json');
		$ProvinceID = $this->input->input_stream('ProvinceID', true);
        if($ProvinceID!='') {
			$rs = $this->address_model->district_list($ProvinceID);
            $response = array(
                'status' => 'success',
                'message'=> '',
                'rs'=>$rs
            );
        }else {
            $response = array(
                'status' => 'error',
                'message'=> 'พบข้อผิดพลาด!',
           );
        }
        echo json_encode($response);
    }
    public function getTambon_list() {
        header('Content-Type: application/json');
		$DistrictID = $this->input->input_stream('DistrictID', true);
        if($DistrictID!='') {
			$rs = $this->address_model->tambon_list($DistrictID);
            $response = array(
                'status' => 'success',
                'message'=> '',
                'rs'=>$rs
            );
        }else {
            $response = array(
                'status' => 'error',
                'message'=> 'พบข้อผิดพลาด!',
           );
        }
        echo json_encode($response);
    }

	function save() {
        //$this->load->helper('security');
        header('Content-Type: application/json');

        $title_name = $this->input->input_stream('title_name', true);
		$name = $this->input->input_stream('name', true);
        $lastname = $this->input->input_stream('lastname', true);
        $card_idnumber = $this->input->input_stream('card_idnumber', true);
		$date_ofbirth = $this->input->input_stream('date_ofbirth', true);
		$telno = $this->input->input_stream('telno', true);
		$idhouse = $this->input->input_stream('idhouse', true);
        $moo = $this->input->input_stream('moo', true);
        $road = $this->input->input_stream('road', true);
        $tambon_id = $this->input->input_stream('tambon_id', true);
        $district_id = $this->input->input_stream('district_id', true);
        $province_id = $this->input->input_stream('province_id', true);

		$as = $this->common_model->custom_query("select * from member where card_idnumber='{$card_idnumber}' and status=1 limit 1");

        if ($name=='' || $card_idnumber=='') {
             $response = array(
                 'status' => 'error',
                 'message'=> 'ข้อมูลไม่ครบถ้วน กรุณาใส่ข้อมูลให้ถูกต้อง!',
                 'id'=>''
            );
        } else if(!empty($as)) {
			$response = array(
				'status' => 'error',
				'message'=> 'เลขประจำตัว ประชาชน ซ้ำ!',
				'id'=>''
		   );
		}else {

            //$data_closed = (substr($data_closed,6,4)-543).'-'.substr($data_closed,3,2).'-'.substr($data_closed,0,2);
			$data_insert = array(
                'title_name'						  => trim($title_name),
				'name'							      => trim($name),
				'lastname'                            => trim($lastname),
				'card_idnumber'                       => trim($card_idnumber),
                'date_ofbirth'                        => thai2date(trim($date_ofbirth)),
				'telno'                               => trim($telno),
				'idhouse'                             => trim($idhouse),
				'moo'					              => trim($moo),
                'road'					              => trim($road),
                'tambon_id'					          => trim($tambon_id),
                'district_id'					      => trim($district_id),
                'province_id'					      => trim($province_id),
                'status'                               =>  '1',
				'add_user'							=>get_session('username'),
                'add_date'							=>date("Y-m-d H:i:s"),
				'mod_user'							=>get_session('username'),
				'mod_date'							=>date("Y-m-d H:i:s")
			);

            $id = $this->common_model->insert('member',$data_insert);
            $rs = $this->common_model->custom_query("select a.*,b.* from member as a left join address_code as b on a.tambon_id=b.TambonID  where a.id='{$id}' limit 1");
            //tb_member_wallet

            $response = array(
                'status' => 'success',
                'message'=> 'บันทึกเสร็จสิ้น',
                'rs'=>$rs
            );
        }
        echo json_encode($response);
    }
    /*
    function update() {
        //$this->load->helper('security');
        header('Content-Type: application/json');

		$status = $this->input->input_stream('status', true);
		$id = $this->input->input_stream('id', true);
        $title_name = $this->input->input_stream('title_name', true);
		$name = $this->input->input_stream('name', true);
        $lastname = $this->input->input_stream('lastname', true);
        $card_idnumber = $this->input->input_stream('card_idnumber', true);
		$date_ofbirth = $this->input->input_stream('date_ofbirth', true);
		$telno = $this->input->input_stream('telno', true);
		$idhouse = $this->input->input_stream('idhouse', true);
        $moo = $this->input->input_stream('moo', true);
        $road = $this->input->input_stream('road', true);
        $tambon_id = $this->input->input_stream('tambon_id', true);
        $district_id = $this->input->input_stream('district_id', true);
        $province_id = $this->input->input_stream('province_id', true);

        if ($name=='' || $card_idnumber=='') {
             $response = array(
                 'status' => 'error',
                 'message'=> 'ข้อมูลไม่ครบถ้วน กรุณาใส่ข้อมูลให้ถูกต้อง!',
                 'id'=>''
            );
        } else {
            //$data_closed = (substr($data_closed,6,4)-543).'-'.substr($data_closed,3,2).'-'.substr($data_closed,0,2);
            $data_update = array(
                    'title_name'						  => trim($title_name),
                    'name'							      => trim($name),
                    'lastname'                            => trim($lastname),
                    'date_ofbirth'                        => trim($date_ofbirth),
                    'telno'                               => trim($telno),
                    'idhouse'                             => trim($idhouse),
                    'moo'					              => trim($moo),
                    'road'					              => trim($road),
                    'tambon_id'					          => trim($tambon_id),
                    'district_id'					      => trim($district_id),
                    'province_id'					      => trim($province_id),
					'mod_user'							=>get_session('username'),
					'mod_date'							=>date("Y-m-d H:i:s")

            );
            $rs = $this->common_model->update('member',$data_update,array("id"=>$id));
            //$rs = $data_update;
            $response = array(
                'status' => 'success',
                'message'=> 'บันทึกเสร็จสิ้น',
                'id'=>$rs
            );
        }
        echo json_encode($response);
    }

	public function delete() {
        header('Content-Type: application/json');
		$id = $this->input->input_stream('id', true);
        if($id!='') {
			$rs = $this->common_model->update("member",array("status"=>0,'mod_user'=>get_session('username'),'mod_date'=>date("Y-m-d H:i:s")),array("id"=>$id));
            $response = array(
                'status' => 'success',
                'message'=> 'ลบเสร็จสิ้น',
            );
        }else {
            $response = array(
                'status' => 'error',
                'message'=> 'พบข้อผิดพลาด!',
           );
        }
        echo json_encode($response);
    }
    */
}
