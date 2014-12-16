<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
</head>

<?php	
setcookie("uid", '', time()-100); 
setcookie("username", '', time()-100); 

echo "注销成功！"
?>

<a href="index.php">返回首页</a>
