<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>问答系统</title>
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body {
            padding-top: 70px;
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
            margin: auto;
        }

        .answer-panel {
            height: 180px;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
            visibility: hidden;
        }

        .cao-panel {
            height: 180px;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
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
                <li class="active"><a href='./index.php'>首页</a></li>
                <li><a href="#">我要提问</a></li>
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



<div style="margin-left: 10%" >
<form action="ask.php" method="post">



    <div class="tab-pane">


            <div class="input-group searchBar">
                <h4 style="margin-bottom: 15px">一句话描述您的疑问：</h4>
                <input type="text" name="title" class="form-control" placeholder="在这里输入问题的描述...">

                <div class="pull-left">
                    <div class="form-group">
                        <select class="form-control">
                            <option>机械</option>
                            <option>冶金</option>
                            <option>化工</option>
                        </select>
                    </div>
                </div>

                <div class="pull-left">
                    <div class="form-group">
                        <select class="form-control">
                            <option>生产</option>
                            <option>销售</option>
                            <option>乱搞</option>
                        </select>
                    </div>
                </div>


                <div style="margin-top: 105px">
                    <h4 style="margin-bottom: 15px">问题补充：（选填）</h4>

                        <div class="form-group">
                            <textarea name="content" style="resize:none; height: 200px" class="form-control" rows="3"></textarea>
                        </div>

                    <div class="row" style="margin-top: 225px">
                        <div class="col-sm-10">
                            <p class="pull-left" >悬赏积分：</p>

                            <div class="pull-left">
                                <div class="form-group">
                                    <select class="form-control">
                                        <option>5分</option>
                                        <option>10分</option>
                                        <option>15分</option>
                                        <option>20分</option>
                                        <option>30分</option>
                                    </select>
                                </div>
                            </div>
                        </div>

            <!--            <div class="col-sm-5">
                            <input type="checkbox" class="pull-right">
                        <p class="pull-right">匿名</p>
                        </div>
            -->
                        <div class="col-sm-2">
                            <input type="submit" name="submit" value="提交问题" class="btn btn-primary pull-right">
                        </div>
                    </div>
                </div>
            </div>

            </div>

</form>

</div>




<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

</body>
</html>