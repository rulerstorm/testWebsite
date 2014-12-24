
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


<h2 style="margin-left:10%">我的提问</h2>



<?php

    require_once 'mysql.php';
    con_sql("ask_question");

    $uid = $_COOKIE["uid"];

    $sql = "select * from question where uid=$uid order by qid desc limit 50;";

    $res = mysql_query($sql);

    while($row = mysql_fetch_row($res)){

        echo '<div class="panel panel-';

        if($row[6]==1){
            echo "success";
        }else{
            echo "warning";
        }

        echo ' answer-panel" style=" overflow: auto;">
            <div class="panel-heading">
                <h3 class="panel-title" style="overflow: hidden; text-overflow: ellipsis; ">';
                    echo '<a href=question.php/?id='.$row[0].'>'.$row[2].'</a>
                    <input type="submit" value="删除问题" class="pull-right" 
                    data-toggle="modal" data-target="#'.$row[0].'">
                    <input type="hidden" name="qid" value='.$row[0].'>
                    </h3>';
                    
        echo '</div>
            <div class="panel-body" >';
                echo '<p style="width:100%">'.$row[3].'</p>';
         echo '</div>';
        //     <div class="panel-footer">
        //         <span>&nbsp</span>';
        //     echo '<span class="pull-right">'.$row[4].'&nbsp 个回答</span></div>
        echo '</div>';

      echo  ' <div class="modal fade" id="'.$row[0].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">删除问题</h4>
      </div>
      <div class="modal-body">
        确认要删除吗？
      </div>
      <form action="delete_question.php" method="get">
      <input type="hidden" name="qid" value='.$row[0].'>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <input type="submit" value="删除" class="btn btn-danger" >
      </div>
      </form>
    </div>
  </div>
</div>';



    }

?>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">删除问题</h4>
      </div>
      <div class="modal-body">
        确认要删除吗？
      </div>
      <form action="delete_question.php" method="get">
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button id="testss" type="button" class="btn btn-danger">删除</button>
      </div>
      </form>
    </div>
  </div>
</div>








</body>
</html>