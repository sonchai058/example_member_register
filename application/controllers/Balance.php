<?php
defined('BASEPATH') OR exit('No direct script access allowed');


use chriskacerguis\RestServer\RestController;

class Balance extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        //$this->load->model('database');
        $this->load->database();
        $this->load->model('common_model');
        $this->load->helper('general_helper');
    }

    public function RfidCheck_post() {
        $rfid = $this->post( 'rfid' ); 
        if ( $rfid === null )
        {
            $this->response( [
                'status' => false,
                'message' => 'No balance were found'
            ], 404 );
        }else {

            //Check RQ RFID CODE 
            $rfid_row = $this->common_model->custom_query("select * from rfid_register where rfid='{$rfid}' and sts=1");// 1 check
            $rfid2 = dechex($rfid);
            $rfid2_tmp = "";
            for($i=0;$i<strlen($rfid2);$i+=2) {
                $rfid2_tmp = substr($rfid2,$i,2).$rfid2_tmp;
            }
            $rfid2 = hexdec($rfid2_tmp);
            $rfid_row2 = $this->common_model->custom_query("select * from rfid_register where rfid='{$rfid2}' and sts=1");
            if(isset($rfid_row2[0])) {
                $rfid = $rfid2;
                $$rfid_row = $rfid_row2;
            }
            if(!isset($rfid_row[0]) && !isset($rfid_row2[0])) {
                $this->response( [
                    'status' => false,
                    'message' => 'Could not find this rfid'
                ], 404 );
                exit();
            }else {
                $rs = array(
                    'status' => 'success',
                    'message' => '',
                    'regdate'=> $rfid_row[0]['regdate'],
                    //'type_id'=> $rfid_row[0]['type_id'],
                    //'pmn_fag'=> $rfid_row[0]['pmn_fag'],
                    'note'=> $rfid_row[0]['note'],
                    //'reg_user'=> $rfid_row[0]['reg_user'],
                    //'mod_user'=> $rfid_row[0]['mod_user'],
                    //'mod_date'=> $rfid_row[0]['mod_date'],
                    'sts'=> $rfid_row[0]['sts'],
                    'type_name'=> $rfid_row[0]['type_name'],
                );
                $this->response( $rs, 200 );
            }
        }
    }
    
    public function CreditCheck_post() {
        $rfid = $this->post( 'rfid' ); 
        if ( $rfid === null )
        {
            $this->response( [
                'status' => false,
                'message' => 'No balance were found'
            ], 404 );
        }else {
            
            //Check RQ RFID CODE 
            $rfid_row = $this->common_model->custom_query("select * from rfid_register where rfid='{$rfid}' and sts=1");// 1 check
            $rfid2 = dechex($rfid);
            $rfid2_tmp = "";
            for($i=0;$i<strlen($rfid2);$i+=2) {
                $rfid2_tmp = substr($rfid2,$i,2).$rfid2_tmp;
            }
            $rfid2 = hexdec($rfid2_tmp);
            $rfid_row2 = $this->common_model->custom_query("select * from rfid_register where rfid='{$rfid2}' and sts=1");
            if(isset($rfid_row2[0])) {
                $rfid = $rfid2;
                $$rfid_row = $rfid_row2;
            }
            if(!isset($rfid_row[0])) {
                $this->response( [
                    'status' => false,
                    'message' => 'Could not find this rfid'
                ], 404 );
                exit();
            }

            $row = $this->common_model->custom_query("select a.*,b.trans_code from rfid_daily as a left join event_log as b on a.trans_add_id=b.p_key where a.refid='{$rfid}' AND a.sts=1");
            if ( array_key_exists( 0, $row ) )
            {
                $rs = array(
                'status'=>'success',
                'message'=>'',
                'transectionid'=>$row[0]['trans_code'],
                'credit_balance'=>number_format($row[0]['credit_balance'],2),
                'timestamp'=>@$row[0]['mod_date'],
                'bringforward'=>''
                );
                $this->response( $rs, 200 );
            }
            else
            {
                $this->response( [
                    'status' => false,
                    'message' => 'No such balance found'
                ], 404 );
            }
        }
    }

    public function EventLog_post() {
        $datesort = $this->post( 'datesort' ); 
        $datedest = $this->post( 'datedest' ); 

        $refid = $this->post( 'refid' ); 
        $reader_id = $this->post( 'reader_id' ); 

        //die("select * from event_log where log_date BETWEEN  '{$datesort}' AND '{$datedest}' order by p_key DESC");
        if($datesort!='' && $datedest!='') {
            $sql_add = "";
            if($refid!='') {
                $sql_add = "AND refid='{$refid}' ";
            }
            //$sql_add = "";
            if($reader_id!='') {
                $sql_add = "AND reader_id='{$reader_id}' ";
            }

            $evrows = $this->common_model->custom_query("select * from event_log where log_date BETWEEN  '{$datesort}' AND '{$datedest}' {$sql_add} order by p_key DESC");
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
                );
                foreach($evrows as $key=>$data) {
                    $rs['data'][] = array(
                        'transectionid'=> $data['trans_code'],
                        'creditbalance'=> $data['balance'],
                        'timestamp'=> $data['timestamp'],
                        'bringforward'=> '',
                        'gate_name'=> '',
                        'processtype'=> $data['trans_type'],
                        'process_amount'=> $data['amount'],
                    );
                }
                $this->response( $rs, 200 );
            }
        }else {
            $evrow = $this->common_model->custom_query("select * from event_log order by p_key DESC limit 1");
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
                    'transectionid'=> $evrow[0]['trans_code'],
                    'creditbalance'=> $evrow[0]['balance'],
                    'timestamp'=> $evrow[0]['timestamp'],
                    'bringforward'=> '',
                    'gate_name'=> '',
                    'processtype'=> $evrow[0]['trans_type'],
                    'process_amount'=> $evrow[0]['amount'],
                );
                $this->response( $rs, 200 );
            }
        }

    }
    


}
