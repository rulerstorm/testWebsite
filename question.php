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
            padding-left: 100px;
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
            width: 80%;
        }

        .fuck-panel {
            width: 80%;
            margin-top: 10px;
            margin-left: 20%;
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
            <a class="navbar-brand" href="#">问答系统</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href='../index.php'>首页</a></li>
                <li><a href="../ask0.php">我要提问</a></li>
                <li><a href="#">我的提问</a></li>
                <li><a href="#">我的回答</a></li>
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


<h4 style=" margin-bottom: 5px;margin-top: 55px;">请输入您要搜索的内容：</h4>

<div class="input-group searchBar" style="margin-bottom:20px">
    <input type="text" class="form-control">
    <span class="input-group-btn">
        <button class="btn btn-primary" type="button" id="gogogo">搜索答案</button>
    </span>
</div>



<?php
	require_once 'mysql.php';
	$qid = $_GET["id"];
	// echo $qid;

    con_sql("ask_question");
    $sql = "select * from question where qid=".$qid;
	$res = mysql_query($sql);

    while($row = mysql_fetch_row($res)){

        echo '<div class="panel panel-primary answer-panel" style="height:193px;">
            <div class="panel-heading">
                <h3 class="panel-title" style="height: 18px; overflow: hidden; text-overflow: ellipsis; ">';
                    echo '<a href=question.php/?id='.$row[0].'>'.$row[2].'</a></h3>';
        echo '</div>
            <div class="panel-body" style="height: 108px; overflow: hidden; text-overflow: ellipsis; ">';
                echo '<p>'.$row[3].'</p>';
        echo '</div>
            <div class="panel-footer">
                <span>2014-09-19 </span>';
            echo '<span class="pull-right">提问者：'.$row[1].'&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;'.$row[4].'个回答</span></div>
        </div>';
    }

    $sql = "select * from answer where qid=".$qid;
	$res = mysql_query($sql);

    while($row = mysql_fetch_row($res)){

        echo '<div class="panel panel-info answer-panel" style="height:193px;">
            <div class="panel-heading">
                <h3 class="panel-title" style="height: 18px; overflow: hidden; text-overflow: ellipsis; ">';
                    echo $row[2].'的回答</h3>';
        echo '</div>
            <div class="panel-body" style="height: 108px; overflow: hidden; text-overflow: ellipsis; ">';
                echo '<p>'.$row[3].'</p>';
        echo '</div>
            <div class="panel-footer">
                <span>2014-09-19 </span>';
            echo '<span class="pull-right">者：'.$row[0].'&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;'.$row[4].'个回答</span></div>
        </div>';
    };


echo '<div style="margin-bottom: 30px;width: 80%">
    <h4 style="margin-bottom: 15px">我来回答：</h4>
    <form action="../answer.php" method="post">
        <div class="form-group">
            <textarea name="content" style="resize:none; height: 200px" class="form-control" rows="3"></textarea>
        </div>
        <input type="hidden" name="qid" value='.$qid.'>';
        echo '<input type="submit" name="submit" value="提交回答" class="btn btn-primary" style="margin-left: 90%">
    </form>
    </div>
</div>';


?>
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

</body>
</html>
