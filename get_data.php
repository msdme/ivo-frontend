<?php
require 'vendor/autoload.php';
$config = require 'config.php';
$curl= new \Curl\Curl();

$request = $curl->post($config['baseApi'].'members',$_POST);

$result=$request;

$result=[
	'draw'=>$_POST['draw'],
	'recordsTotal'=>$result->data->total,
	'recordsFiltered'=>$result->data->filtered,
	'data'=>$result->data->items
];

echo json_encode($result);