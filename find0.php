

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



<div style="margin-left: 10%" >
<form action="find0.php" method="post">



<h3 style=" margin-bottom: 5px;margin-top: 5px;margin-left: 10%">请输入您要搜索的内容：</h3>

<div class="input-group searchBar" style="margin-bottom:20px;margin-left: 10%">
    <input type="text" name="search" class="form-control">
    <span class="input-group-btn">
        <input class="btn btn-primary" type="submit" value="搜索答案">
    </span>
</div>

<?php

if($que = $_POST["search"]){
    require_once 'mysql.php';
    con_sql("ask_question");


    exec("./fenci $que", $output);

    $sbsb = array();

    foreach ($output as $key => $value) {

        $sql = "select qid from question where title like '%$value%'";
        $res = mysql_query($sql);
        while($row = mysql_fetch_row($res)){
            array_push($sbsb, $row[0]);
        }

        $sql = "select qid from question where content like '%$value%'";
        $res = mysql_query($sql);
        while($row = mysql_fetch_row($res)){
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

        $count++; 

    }

    if(!$count){
        echo "没找到答案！";
    }


}
?>











</form>

</div>




<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

</body>
</html>