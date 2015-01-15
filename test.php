<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
</head>
<body>

<?php
    
	$client = new SoapClient('http://app.nbinfo.cn/SSO/SSOService.svc?wsdl');
    print_r ($client);

	if(!$_REQUEST["IASID"]){
		header("location:http://app.nbinfo.cn"); 
	}else if ($_REQUEST["IASID"] 
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
            }

            //写cookie
            header()

         }else{
            //返回平台登录
          header("location:http://app.nbinfo.cn"); 
         }
}


	


?>

</body></html>







