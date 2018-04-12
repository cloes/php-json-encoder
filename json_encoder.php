<?php

function jsonEncoder($data){
	$output = "";
	$hasKeyItemFlag = 0;
	$allKeyRangeNumFlag = 0;
	$content = '';

	$keys = array_keys($data);
	if($keys == range(0,count($data)-1)){
		$allKeyRangeNumFlag = 1;
	}
	foreach($data as $key => $value){
		if(is_array($value)){
			$subArrayFlag = 1;
			$subArrayOutput = jsonEncoder($value);
			$output = "\"$key\":$subArrayOutput";
		}else if($allKeyRangeNumFlag){
			$value = addslashes($value);
			$output = $value;
		}else{
			$hasKeyItemFlag = 1;
			$key = addslashes($key);
			$value = addslashes($value);
			$output = "\"$key\":\"$value\"";
		}
		$content .= $output.',';
	}

	if($hasKeyItemFlag){
		$result = '{'.substr($content,0,strlen($content)-1).'}';
	}else if($allKeyRangeNumFlag){
		$result = '['.substr($content,0,strlen($content)-1).']';
	}

	return $result;
}

$result = jsonEncoder(array("id"=>1,"name"=>"你好","hollby"=>array('baseball','football')));
echo $result,"\n";

$result = jsonEncoder(array("id"=>1,"name"=>"你好","hollby"=>array(0=>'baseball',1=>'football')));
echo $result,"\n";

$result = jsonEncoder(array("id"=>1,"name"=>"你好","test"=>array("a"=>"A","b"=>"B","c"=>array("c1"=>"C1","c2"=>"C2"))));
var_dump($result);

$result = jsonEncoder(array("one","two","three"));
var_dump($result);

$result = jsonEncoder(array(0=>"one",1=>"two",2=>"three"));
var_dump($result);