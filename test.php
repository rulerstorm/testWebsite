<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
</head>
<body>

<?php

$client = new SoapClient('http://app.nbinfo.cn/SSO/SSOService.svc?wsdl');
//    print_r ($client);

//	if(!$_REQUEST["IASID"]){
//		header("location:http://app.nbinfo.cn"); 
//	}else
if ($_REQUEST["IASID"] 
		&& $_REQUEST["TimeStamp"]
		&& $_REQUEST["AppUrl"]
		&& $_REQUEST["UserAccount"]
		&& $_REQUEST["Authenticator"]){

	$arrayName = array( "IASID" => $_REQUEST["IASID"],   
			"TimeStamp" => $_REQUEST["TimeStamp"], 
			"AppUrl" => $_REQUEST["AppUrl"], 
			"UserAccount" => $_REQUEST["UserAccount"],
			"EnterpriseId" => $_REQUEST["EnterpriseId"], 
			"Password" => $_REQUEST["Password"], 
			"Authenticator" => $_REQUEST["Authenticator"]
			);

	$res = $client->__soapCall('ValidateEACTokenByWCF', array($arrayName));



	if($res){
		//我这边的登录
		require_once 'mysql.php';
		$uid = $_REQUEST["UserAccount"];
		$eid = $_REQUEST["EnterpriseId"];

		con_sql("ask_question");

		$sql = "select * from account where uid='".$uid."'";

		//echo $sql;

		$res = mysql_query($sql);

		if(!($row = mysql_fetch_row($res))){

			$arrayName1 = array('enterpriseID' =>  intval($eid) , 
					'userID' =>  intval($uid) );

			$res1 = $client->__soapCall('getUser', array($arrayName1));

			//写入数据库
			$userInfo = $res1->getUserResult;

			//print_r($userInfo);

			$username = $userInfo->User_Name;
			$password = $userInfo->Password;
			$Enterprise_ID = $eid;
			
			if($userInfo->User_Email){
				$User_Email = $userInfo->User_Email;
			}else{
				$User_Email = '';
			}
			
			if ($userInfo->User_Photo) {
				$User_Photo = $userInfo->User_Photo;
			}else{
				$User_Photo = 0;
			}
			

			$sql = "insert into account values ($uid, '$username', '$password', $Enterprise_ID, '$User_Email', $User_Photo)";
			
			echo $sql;

			if(!mysql_query($sql)){
				header("location:http://app.nbinfo.cn"); 
			}

		}else{
			$uid = $row[0];
			$username = $row[1]; 
		}
		
		//写cookie
		setcookie("uid", $uid, time()+3600*24*30*12*10); 
		setcookie("username", $username, time()+3600*24*30*12*10); 
		
		header("location:index.php");

	}else{
//返回平台登录
header("location:http://app.nbinfo.cn"); 
       }

}else{
//返回平台登录
header("location:http://app.nbinfo.cn"); 
       }




?>

</body></html>







