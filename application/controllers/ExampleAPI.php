<?php
defined('BASEPATH') OR exit('No direct script access allowed');


use chriskacerguis\RestServer\RestController;

class ExampleAPI extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        //$this->load->model('database');
        $this->load->database();
        $this->load->model('common_model');
        $this->load->helper('general_helper');
    }

    public function GetMemberLog_post() {
        $datesort = $this->post( 'datesort' ); 
        $datedest = $this->post( 'datedest' ); 

        $id = $this->post( 'id' ); 

        //die("select * from event_log where log_date BETWEEN  '{$datesort}' AND '{$datedest}' order by p_key DESC");
        if($datesort!='' && $datedest!='') {
            $sql_add = "";
            if($id!='') {
                $sql_add = "AND id='{$id}' ";
            }

            $evrows = $this->common_model->custom_query("select a.*,b.* from member as a left join address_code as b on a.tambon_id=b.TambonID  where status=1 and add_date BETWEEN  '{$datesort}' AND '{$datedest}' {$sql_add} order by id DESC");
            if(empty($evrows)) {
                $this->response( [
                    'status' => false,
                    'message' => 'Could not find this data'
                ], 404 );
                exit();
            }else {
                $rs = array(
                    'status' => 'success',
                    'message' => '',
                    'dataList' =>$evrows
                );
                $this->response( $rs, 200 );
            }
        }else {
            $evrow = $this->common_model->custom_query("select a.*,b.* from member as a left join address_code as b on a.tambon_id=b.TambonID  where status=1 order by id DESC");
            if(!isset($evrow[0])) {
                $this->response( [
                    'status' => false,
                    'message' => 'Could not find this data'
                ], 404 );
                exit();
            }else {
                $rs = array(
                    'status' => 'success',
                    'message' => '',
                    'dataList'=>$evrow
                );
                $this->response( $rs, 200 );
            }
        }

    }
    


}
