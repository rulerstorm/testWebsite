
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




<h2 style="margin-left:10%">我的回答</h2>



<?php

    require_once 'mysql.php';
    con_sql("ask_question");

    $username = $_COOKIE["username"];

    $sql = "select * from answer where username='$username' order by aid desc limit 50;";

    $res = mysql_query($sql);

    while($row = mysql_fetch_row($res)){

        echo '<div class="panel panel-';

        if($row[4]==1){
            echo "success";
        }else{
            echo "warning";
        }

        echo ' answer-panel" style=" overflow: auto;">
            <div class="panel-heading">
                <h3 class="panel-title" style="height: 18px; overflow: hidden; text-overflow: ellipsis; ">';

        $sql1 = "select title from question where qid=$row[1];";
        $res1 = mysql_query($sql1);
        $que_name = mysql_fetch_row($res1);

                    echo '<a href=question.php/?id='.$row[1].'>'.$que_name[0].'</a></h3>';
        echo '</div>
            <div class="panel-body" >';
                echo '<p style="width:100%">'.$row[3].'</p>';
         echo '</div>';
        //     <div class="panel-footer">
        //         <span>&nbsp</span>';
        //     echo '<span class="pull-right">'.$row[4].'&nbsp 个回答</span></div>
        echo '</div>';
    }

?>







<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

</body>
</html>