<?php

require 'vendor/autoload.php';
$config=require 'config.php';

$curl = new \Curl\Curl();
$member_id=empty($_POST['_id'])?'':$_POST['_id'];
$result=['status'=>'failed','message'=>'unknown operation type'];
$type=$_GET['type'];
if('save'==$type){
	$type=empty($_POST['_id'])?'create':'update';
}
switch($type){
	case 'update':

		$result=$curl->patch($config['baseApi'].'members/'.$member_id,$_POST);
		break;
		
	case 'edit':

		$result=$curl->get($config['baseApi'].'members/'.$member_id,$_POST);
		break;
		
	case 'delete':

		$result=$curl->delete($config['baseApi'].'members/'.$member_id,$_POST);
		break;
		
	case 'create':

		$result=$curl->put($config['baseApi'].'members',$_POST);
		break;
		
	default:

		break;
}
echo json_encode($result);