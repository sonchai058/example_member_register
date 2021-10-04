<?php
class my_general{
	public $ci;
	public function __construct(){
		$this->ci=&get_instance();
	}
	public function get_ci(){
		return $this->ci;
	}
}

function date2thai($datetime='') {
	$arr=explode(' ',$datetime);
	$date = $arr[0];
	$time = @$arr[1];
	return substr($date,8,2).'/'.substr($date,5,2).'/'.((substr($date,0,4)+543)).' '.substr($time,0,5);
}
function thai2date($date='') {
	return (substr($date,6,4)-543).'-'.substr($date,3,2).'-'.substr($date,0,2);
}

function debugArr($arr=''){
	echo '<pre>';
	die(print_r($arr));
	echo '</pre>';
}

function debugTxt($str=''){
	die('<h1>'.$str.'</h1>');
}

function get_session($name='') {
	return 'user';
}