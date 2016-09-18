<?php
header('Content-Type:text/html;charset=utf-8');
function http_request($url,$data = null){
	
	if(function_exists('curl_init')){
		$curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, $url);
	   
	    if (!empty($data)){
	        curl_setopt($curl, CURLOPT_POST, 1);
	        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	    }
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    $output = curl_exec($curl);
	    curl_close($curl);
		
	
		$result=preg_split("/[,\r\n]/",$output);

		if($result[1]==0){
			  return "curl success";
		}else{
			  return "curl error".$result[1];
		}
	}elseif(function_exists('file_get_contents')){
		
		$output=file_get_contents($url.$data);
		$result=preg_split("/[,\r\n]/",$output);
	
		if($result[1]==0){
			  return "success";
		}else{
			  return "error".$result[1];
		}
		
		
	}else{
		return false;
	} 
	
}
$code = rand(100000,999999);
$data ="您好，您的验证码是" . $code ;
$_SESSION['code'] = $code;
$post_data = array();
$post_data['account'] ="jiekou-clcs-11";
$post_data['pswd'] = "Qwer147258";
$post_data['msg']="$data";$post_data['mobile'] ="18721755342";

$post_data['needstatus']='true';
$url='http://sapi.253.com/msg/HttpBatchSendSM'; 
$res=http_request($url,http_build_query($post_data));
var_dump($res);