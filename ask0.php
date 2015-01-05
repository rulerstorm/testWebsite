

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
<form action="index.php" method="post">



    <div class="tab-pane">


            <div class="input-group searchBar">
                <h4 style="margin-bottom: 15px">一句话描述您的疑问：</h4>
                <input type="text" name="title" class="form-control" placeholder="在这里输入问题的描述...">

      <!--          <div class="pull-left">
                    <div class="form-group">
                        <select class="form-control">
                            <option>机械</option>
                            <option>冶金</option>
                            <option>化工</option>
                        </select>
                    </div>
                </div>  -->

                <div class="pull-left">
                    <div class="form-group">
                        <select class="form-control" name="q_type">
                            <option>生产</option>
                            <option>市场</option>
                            <option>其他</option>
                        </select>
                    </div>
                </div>


                <div style="margin-top: 105px">
                    <h4 style="margin-bottom: 15px">问题补充：（选填）</h4>

                        <div class="form-group">
                            <textarea name="content" style="resize:none; height: 200px" class="form-control" rows="3"></textarea>
                        </div>

                    <div class="row" style="margin-top: 225px">
                        <div class="col-sm-5">
             <!--                <p class="pull-left" >悬赏积分：</p>

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

                       <div class="col-sm-5">
                            <input type="checkbox" class="pull-right">
                        <p class="pull-right">匿名</p>
                        </div>
            --></div>
                        <div class="col-sm-2">
                            <input type="submit" name="submit" value="提交问题" class="btn btn-primary pull-right">
                        </div>
                        <div class="col-sm-5">
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