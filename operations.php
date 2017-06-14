<?php

require 'vendor/autoload.php';
$config=require 'config.php';

$curl = new \Curl\Curl();
$member_id=empty($_GET['id'])?'':$_GET['id'];
$result=['status'=>'failed','message'=>'unknown operation type'];
switch($_GET['type']){
	case 'update':

		$result=$curl->patch($config['baseApi'].'members/'.$member_id);
		break;
		
	case 'edit':

		$result=$curl->get($config['baseApi'].'members/'.$member_id);
		break;
		
	case 'delete':

		$result=$curl->delete($config['baseApi'].'members/'.$member_id);
		break;
		
	case 'create':

		$result=$curl->put($config['baseApi'].'members',$_POST);
		break;
		
	default:

		break;
}
echo json_encode($result);