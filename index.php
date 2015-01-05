

            <?php

            require_once 'navi.php';

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

<!-- 

<h4 style=" margin-bottom: 5px;margin-top: 5px;margin-left: 10%">请输入您要搜索的内容：</h4>

<div class="input-group searchBar" style="margin-bottom:20px;margin-left: 10%">
    <input type="text" class="form-control">
    <span class="input-group-btn">
        <button class="btn btn-primary" type="button" id="gogogo">搜索答案</button>
    </span>
</div>
-->

<h2 style="margin-left:10%">最新问题</h2>

<?php


require_once 'mysql.php';


    if ($_POST["title"] &&
        $_POST["content"] &&
        $_COOKIE["uid"]){


        $title = $_POST["title"];
        $content = $_POST["content"] ;
        $uid = $_COOKIE["uid"];
        $type = $_POST["q_type"];

            switch ($type) {
                case '生产':
                    $q_type = 0;
                    break;
                case '市场':
                    $q_type = 1;
                    break;      
                case '其他':
                    $q_type = 2;
                    break;
            }

            con_sql("ask_question");

        //  $sql = "insert into question (uid, title, content, q_type) values (".$uid.
        //      ',"'.$title.'","'.$content.'")';

            
            $sql = "insert into question (uid, title, content, q_type) values ($uid ,
                '$title','$content','$q_type')";

            //echo $sql;

            $res = mysql_query($sql);

                    echo '<div style="margin-left:10%;color:red">提问成功!</div>';
                    echo '<br/>';

    }

//-------------------------------------------------------------------


    require_once 'mysql.php';
    con_sql("ask_question");

    $sql = "select * from question order by qid desc limit 10";

    $res = mysql_query($sql);

    while($row = mysql_fetch_row($res)){

        echo '<div class="panel panel-primary answer-panel" style="height:193px;">
            <div class="panel-heading">
                <h3 class="panel-title" style="height: 18px; overflow: hidden; text-overflow: ellipsis; ">';
                    echo '<a href=question.php/?id='.$row[0].'>'.$row[2].'</a></h3>';
        echo '</div>
            <div class="panel-body" style="height: 108px; overflow: scroll;">';
                echo '<p style="width:100%">'.$row[3].'</p>';
        echo '</div>
            <div class="panel-footer">
                <span>&nbsp</span>';
            echo '<span class="pull-right">'.$row[4].'&nbsp 个回答</span></div>
        </div>';
    }

?>


<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

</body>
</html>
