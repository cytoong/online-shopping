<?php
/**
 * Created by PhpStorm.
 * User: Halo
 * Date: 2019/6/8
 * Time: 9:07
 */
$num=0;
$goodid=0;
$page=1;
if(!empty($_GET)) {
    if(isset($_GET["message"]))
    {
        $message = $_GET["message"];
        echo "<script>alert('$message');</script>";

    }



    if(isset($_GET["goodid"]))
    {
        $goodid=$_GET["goodid"];

    }
    else
    {
        header("location:goodlist.php?message=NoGoodInfo!&page=$page");
        return;
    }
    if(isset($_GET["num"]))
    {
        $num=$_GET["num"];
    }
    else{
        $num=1;
    }
    if(isset($_GET["page"]))
    {
        $page=$_GET["page"];
    }
    else
    {
        $page=1;
    }
    if (!session_id()) session_start();
    if(isset($_SESSION["type"]))
    {
        if($_SESSION["type"]==0)
        {
            header("location:goodlist.php?message=NotRegister!&page=$page");
            return;
        }

    }
    else
    {
        header("location:goodlist.php?message=NotRegister!&page=$page");
        return;
    }
}

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
}
//选择数据库
mysqli_select_db($link,"dscj");
//设置字符集
mysqli_set_charset($link,'utf8');
//准备sql语句
if (!session_id()) session_start();
$sql="insert into usergood(goodid,name,num) values('$goodid','".$_SESSION["name"]."','$num')";
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
//    while($attr=mysqli_fetch_array($result))
//    {
//        echo $attr[0],"<br/>";
//    }
    header("location:goodlist.php?message=AddGoodSuccess!&page=$page");
}
else header("location:goodlist.php?message=AddGoodFault!&page=$page");
//关闭数据库连接
mysqli_close($link);
