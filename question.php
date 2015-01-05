<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>问答系统</title>
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <style>
        body {
            padding-top: 5px;
            padding-left: 50px;
            padding-bottom: 20px;
        }

        .gourpbtn {
            padding-left: 15px;
            padding-right: 15px;
            padding-bottom: 15px;
        }

        .progress {
            margin-top: 10px;
        }

        .sidebar {
            background-color: #f5f5f5;
            position: fixed;
            left: 0px;
            bottom: 0px;
            top: 51px;
            padding: 20px 0 0 0;
        }

        .nav-sidebar > .active > a,
        .nav-sidebar > .active > a:hover,
        .nav-sidebar > .active > a:focus {
            color: #fff;
            background-color: #428bca;
        }


        #searchAns {
            font-weight: bold;
        }

        #sb {
            text-align: left;
        }

        .searchBar {
            width: 60%;
        }

        .answer-panel {
            margin-right: 5%;
        }

        .fuck-panel {
            margin-right: 5%;
            margin-top: 10px;
            margin-left: 10%;
        }



    </style>
</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href='../index.php'>问答系统</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href='../index.php'>首页</a></li>
                <li><a href="../ask0.php">我要提问</a></li>
                <li><a href="../find0.php">找答案</a></li>
                <li><a href="../my_question.php">我的提问</a></li>
                <li><a href="../my_answer.php">我的回答</a></li>
                <li><a href="#">帮助</a></li>
            </ul>

            <?php

            if(!$_COOKIE["username"]){
                echo '<a href="login.html" class="btn btn-primary pull-right" style="margin: 7px 5px 5px 5px;">登录</a>';
            }else{
                echo '<a href="logout.php" class="btn btn-default pull-right" style="margin: 7px 5px 5px 15px;">注销</a>';
                echo '<div class="pull-right" style="color:white; font-size:22px; margin-top:8px">你好,'.$_COOKIE["username"].'</div>';
            }


            ?>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<h2 style=" margin-bottom: 25px ; margin-top: 65px;"> 问题解答 </h2>

<!--
<h4 style=" margin-bottom: 5px;margin-top: 55px;">请输入您要搜索的内容：</h4>

<div class="input-group searchBar" style="margin-bottom:20px">
    <input type="text" class="form-control">
    <span class="input-group-btn">
        <button class="btn btn-primary" type="button" id="gogogo">搜索答案</button>
    </span>
</div>

-->


<div class="row">
<div class="col-sm-10 col-md-8">

<?php
    require_once 'mysql.php';

    if($_POST["qid"]&&$_POST["content"]&&$_COOKIE["username"]){


    $qid = $_POST["qid"];
    $content = $_POST["content"];
    $username = $_COOKIE["username"];

    con_sql("ask_question");

    $sql = "insert into answer (qid, content, username) values (".$qid.
        ',"'.$content.'","'.$username.'")';

    $res = mysql_query($sql);

    $sql = "update question set count=count+1 where qid=$qid";

    $res = mysql_query($sql);


            echo '回答成功';
            echo '<br/>';
            echo '<br/>';
}

?>


<?php
    require_once 'mysql.php';

    if($_POST["qid"] && $_POST["aid"]){
    $qid = $_POST["qid"];
    $aid = $_POST["aid"];

    $sql1 = "update answer set best=1 where aid=$aid";

    $sql2 = "update question set best=1 where qid=$qid";


    con_sql("ask_question");

    $res1 = mysql_query($sql1);
    $res2 = mysql_query($sql2);

            echo '已采纳该答案';
            echo '<br/>';
            echo '<br/>';


}


?>


<?php
	require_once 'mysql.php';
	$qid = $_REQUEST["id"];
	// echo $qid;
$qu_id = $qid;
    con_sql("ask_question");
    $sql = "select * from question where qid=".$qid;
	$res = mysql_query($sql);

    while($row = mysql_fetch_row($res)){

        $qu_title = $row[2];
        $qu_contetn = $row[3];
        $qu_uid = $row[1];

        echo '<div class="panel panel-primary answer-panel" style="height:193px;">
            <div class="panel-heading">
                <h3 class="panel-title" style="height: 18px; overflow: hidden; text-overflow: ellipsis; ">';
                    echo $row[2].'</h3>';
        echo '</div>
            <div class="panel-body" style="height: 108px; overflow: auto">';
                echo '<p>'.$row[3].'</p>';
        echo '</div>
            <div class="panel-footer">
                <span>&nbsp</span>';

    $sql2 = "select username from account where uid=".$row[1];
    $usname = mysql_query($sql2); $name = mysql_fetch_row($usname);


    $best = $row[6];

            echo '<span class="pull-right">提问者：'.$name[0].'</span></div>
        </div>';
    }


    echo '<hr>';

//采纳答案
    if($best == 1){
        $sql_best = "select * from answer where qid=$qid && best=1";
        $res_best = mysql_query($sql_best);


        while($row = mysql_fetch_row($res_best)){

$qu_usname = $row[2];

            echo '<div class="panel panel-danger answer-panel" style="height:193px;">
                <div class="panel-heading">
                    <h3 class="panel-title" style="height: 18px;">';
                        echo $row[2].'的回答<span class="pull-right">采纳答案</span></h3>';
            echo '</div>
                <div class="panel-body" style="height: 108px; overflow: auto;">';
                    echo '<p>'.$row[3].'</p>';
            echo '</div>';
            echo '</div>';};

    }




//普通答案
    $sql = "select * from answer where qid=".$qid;
	$res = mysql_query($sql);

    while($row = mysql_fetch_row($res)){

        if($row[4]==1){
            continue;
        }

        echo '<div class="panel panel-info answer-panel" style="height:193px;">
            <div class="panel-heading">
                <h3 class="panel-title" style="height: 18px; overflow: hidden; text-overflow: ellipsis; ">';
                    echo $row[2].'的回答</h3>';
        echo '</div>
            <div class="panel-body" style="height: 108px; overflow: auto;">';
                echo '<p>'.$row[3].'</p>';
        echo '</div>';

            if($best==0 && $name[0]==$_COOKIE["username"]){

            echo '<div class="panel-footer">
                <span> &nbsp </span>';
            echo '<span class="pull-right">';
                echo '<form action="question.php" method="post">';
                echo "<input type='hidden' name='qid' value=$qid>";
                echo "<input type='hidden' name='id' value=$qid>";
                echo "<input type='hidden' name='aid' value=$row[0] >";
                echo '<input type="submit" name="submit" value="采纳回答">';
                echo "</form>";
                echo '</span></div>';
            }

            echo '</div>';
    };

echo '</div>';


        //右侧边栏
        echo '<div class="col-sm-12 col-md-4">';
?>

<h4>相似问题</h4>

<?php
    
    $qu_title = $qu_title.' '.$qu_contetn;

    exec("./fenci $qu_title", $output);

    // echo $qu_title;

    // print_r($output);

    $sbsb = array();

    foreach ($output as $key => $value) {

        $sql = "select qid from question where title like '%$value%'";
        $res = mysql_query($sql);
        while($row = mysql_fetch_row($res)){

            // if($q_type!=99 && $q_type==$row[5]){
            //     continue;
            // }

            array_push($sbsb, $row[0]);
        }

        $sql = "select qid from question where content like '%$value%'";
        $res = mysql_query($sql);
        while($row = mysql_fetch_row($res)){

            // if($q_type!=99 && $q_type==$row[5]){
            //     continue;
            // }
            
            array_push($sbsb, $row[0]);
        }
    }

    $sql = "select * from question where 0 ";

    foreach ($sbsb as $i => $j) {
        $sql = $sql.'or qid='.$j.' ';
    }
    $sql = $sql.';';

    // echo $sql;

    $res = mysql_query($sql);

    while($row = mysql_fetch_row($res)){

        // echo '<div class="panel panel-primary answer-panel" style="height:193px;">
        //     <div class="panel-heading">
        //         <h3 class="panel-title" style="height: 18px; overflow: hidden; text-overflow: ellipsis; ">';
            // echo $row[0];
            // echo "<br>";
            // echo $qu_id;
            if($row[0]==$qu_id){
   
                continue;
            }
            if ($count > 10) {
                break;
            }

                    echo '<a href=../question.php/?id='.$row[0].'>'.$row[2].'</a>';

                    echo '</br>';
        // echo '</div>
        //     <div class="panel-body" style="height: 108px; overflow: scroll;">';
        //         echo '<p style="width:100%">'.$row[3].'</p>';
        // echo '</div>
        //     <div class="panel-footer">
        //         <span>&nbsp</span>';
        //     echo '<span class="pull-right">'.$row[4].'&nbsp 个回答</span></div>
        // </div>';

        $count++; 

    }

    if(!$count){
        echo "</br>没有相关问题";
    }

?>
</br>
</br>
<hr>
<h4>提问者的其他问题</h4>

<?php
    require_once 'mysql.php';
    con_sql("ask_question");

    $uid = $qu_uid;

    $sql = "select * from question where uid=$uid order by qid desc limit 5;";

    $res = mysql_query($sql);

    while($row = mysql_fetch_row($res)){

        echo '<a href=../question.php/?id='.$row[0].'>'.$row[2].'</a></br>';



}

?>


<?php
    if($best == 1){
        echo '</br></br><hr><h4>Ta还回答过：</h4>';

require_once 'mysql.php';
    con_sql("ask_question");

    $username = $qu_usname;

    // echo "$username";

    $sql = "select * from answer where username='$username' order by aid desc limit 20;";

    $res = mysql_query($sql);

    while($row = mysql_fetch_row($res)){

        $sql1 = "select title from question where qid=$row[1];";
        $res1 = mysql_query($sql1);
        $que_name = mysql_fetch_row($res1);

        if ($que_name[0]!=$last) {
            echo '<a href=../question.php/?id='.$row[1].'>'.$que_name[0].'</a></br>';
            $last = $que_name[0];
                    $ccc ++;
        }

        if($ccc > 5){
            break;
        }



}
}
?>

<?php
        echo '</div>';
echo '</div>';



echo '<div style="margin-bottom: 30px;width: 62.5%">
    <h4 style="margin-bottom: 15px">我来回答：</h4>
    <form action="question.php" method="post">
        <div class="form-group">
            <textarea name="content" style="resize:none; height: 200px" class="form-control" rows="3"></textarea>
        </div>
        <input type="hidden" name="qid" value='.$qid.'>
        <input type="hidden" name="id" value='.$qid.'>';
        echo '<input type="submit" name="submit" value="提交回答" class="btn btn-primary" style="margin-left: 90%">
    </form>
    </div>
</div>';


?>
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

</body>
</html>
