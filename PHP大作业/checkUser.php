<?php
/**
 * Created by PhpStorm.
 * User: Halo
 * Date: 2019/6/7
 * Time: 22:00
 */
/**
 * 接受用户登陆时提交的验证码
 */
$question=null;
$anwser=null;
if(!empty($_POST))
{

    $name=$_POST['name'];
    //连接数据库
//判断连接成功
//选择数据库
//设置字符集
//准备sql语句
//发送sql语句
//处理数据
//关闭数据库连接
    $preg_name='/^[a-zA-Z0-9]{6,16}$/ims';
    if(!preg_match($preg_name,$name)){
        header("location:forgetPassword.php?message=NameError!");
        return;
    }
//连接数据库
    $link=mysqli_connect("localhost","root","root");
//判断连接成功
    if(!$link)
    {
        echo '连接失败';
        //return;
    }
//选择数据库
    mysqli_select_db($link,"dscj");
//设置字符集
    mysqli_set_charset($link,'utf8');
//准备sql语句
    $sql="select * from User";
//发送sql语句
    $result=mysqli_query($link,$sql);
//处理数据
    if($result)
    {
        //fetch_row获取行的数据
        //mysqli_detch_assoc获取对应键值,$attr['linenum']可获取数据
        //获取字段数
        //echo mysqli_num_fields($result),"<br/>";
        //获取信息数
        //echo mysqli_num_rows($result),"<br/>";
        $g_having=false;
        while($attr=mysqli_fetch_array($result))
        {
            if($attr[0]==$name)
            {
                $g_having=true;
                break;
            }

        }
        if(!$g_having)
        {
            header("location:forgetPassword.php?message=WrongUsername!");
        }
        else
        {
            $sql1="select * from User where name='$name'";
//发送sql语句
            $result1=mysqli_query($link,$sql1);
            if($result1)
            {
                $attr1=mysqli_fetch_array($result1);
                $question=$attr1[3];
                $anwser=$attr1[4];
            }
        }
    }
//关闭数据库连接
    mysqli_close($link);



}
else
{
    header("location:forgetPassword.php");
    return;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        p{
            text-align: center;
        }
    </style>
</head>
<body>
<form action="AnwserQuestion.php" method="post">

    <input type="text" value="<?php echo $name;?>" name="name" hidden>
    <p>密保问题:<?php echo $question;?></p>
    <p><input type="text" name="anwser"></p>
    <p><input type="submit" value="提交"></p>

</form>
</body>
</html>

