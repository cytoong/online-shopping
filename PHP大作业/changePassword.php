<?php
/**
 * Created by PhpStorm.
 * User: Halo
 * Date: 2019/6/7
 * Time: 16:06
 */
if(!empty($_GET)) {
    if (isset($_GET["message"])) {
        $message = $_GET["message"];
        echo "<script>alert('$message');</script>";

    }
}
$name=null;
$password=null;
$repassword=null;
if(!empty($_POST))
{

    $name=$_POST['name'];
    $password=$_POST["password"];
    $preg_password='/^[a-zA-Z0-9]{9,16}$/ims';
    if(!preg_match($preg_password,$password)){
        header("location:index.php?message=PsswordError!");
        return;
    }
    $repassword=$_POST["repassword"];
    if(!preg_match($preg_password,$repassword)){
        header("location:index.php?message=RepasswordError!");
        return;
    }
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
        header("location:index.php?message=NameError!");
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
            header("location:index.php?message=WrongUsername!");
        }
        else
        {
            if($password==$repassword)
            {
                $sql1="update user set password='$password' where name='$name'";
//发送sql语句
                $result1=mysqli_query($link,$sql1);
                if($result1)
                {
                    $attr1=mysqli_fetch_array($result1);
                    header("location:index.php?message=ChangePasswordSuccess!");

                }
                else{
                    header("location:index.php?message=ChangePasswordFault!");
                }
            }
            else{
                header("location:index.php?message=PasswordDontSame!");
            }

        }
    }
//关闭数据库连接
    mysqli_close($link);



}
else
{
    header("location:index.php");
    return;
}

