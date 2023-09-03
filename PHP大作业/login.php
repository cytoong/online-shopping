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
if(!empty($_POST))
{
    if (!session_id()) session_start();
//1. 获取到用户提交的验证码
    $captcha = $_POST["captcha"];
//2. 将session中的验证码和用户提交的验证码进行核对,当成功时提示验证码正确，并销毁之前的session值,不成功则重新提交
    if(strtolower($_SESSION["captcha"]) == strtolower($captcha)){

        $_SESSION["captcha"] = "";
        $name=$_POST['name'];
        $password=$_POST['password'];
            //连接数据库
//判断连接成功
//选择数据库
//设置字符集
//准备sql语句
//发送sql语句
//处理数据
//关闭数据库连接

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
                    if($attr[1]==$password)
                    {
                        $_SESSION["name"]=$name;
                        $_SESSION["type"]=$attr[2];

                    }
                    else{
                        header("location:index.php?message=WrongPassword!");
                    }
                }

            }
            if(!$g_having)
            {
                header("location:index.php?message=WrongUsername!");
            }
        }

//关闭数据库连接
        mysqli_close($link);
    }else{
        header("location:index.php?message=CaptchaError!");
    }
}
else
{

    header("location:index.php");
}
