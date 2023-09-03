<?php
/**
 * Created by PhpStorm.
 * User: Halo
 * Date: 2019/6/7
 * Time: 23:14
 */
/**
 * Created by PhpStorm.
 * User: Halo
 * Date: 2019/4/12
 * Time: 9:23
 */
//连接数据库
//判断连接成功
//选择数据库
//设置字符集
//准备sql语句
//发送sql语句
//处理数据
//关闭数据库连接
$page=0;
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

if(isset($_GET["page"]))
{
   $page=$_GET["page"];

}

if(!empty($_POST)) {
    $goodname=$_POST["goodname"];
    $buyer=$_POST["name"];
    $address=$_POST["address"];
    $goodid=$_POST["goodid"];
    $num=$_POST["num"];
    $money=$_POST["sum"];
    $phone=$_POST['phone'];
    $buyid=$_POST['buyid'];
    $finish=0;
//连接数据库
    $link = mysqli_connect("localhost", "root", "root");
//判断连接成功
    if (!$link) {
        echo '连接失败';
        //return;
    }
//选择数据库
    mysqli_select_db($link, "dscj");
//设置字符集
    mysqli_set_charset($link, 'utf8');
//准备sql语句
    if (!session_id()) session_start();
    $sql = "insert into userbill(name,buyer,address,goodid,num,money,finish,phone,goodname) values ('".$_SESSION["name"]."','$buyer','$address','$goodid','$num','$money','$finish','$phone','$goodname')";
//发送sql语句
    $result = mysqli_query($link, $sql);
//处理数据
    if ($result) {
        if($page==0)
        {
            if($buyid!=0)
            {
                header("location:deleteUsergood.php?buyid=$buyid&showSuccess=1");
                return;
            }
            header("location:buyer.php?message=BuySuccess!");
        }
        else
        {
            header("location:goodlist.php?message=BuySuccess!&page=$page");
        }

    }
    else
    {
        if($page==0) header("location:addType.php?message=BuyFault!");
        else
        {
            header("location:goodlist.php?message=BuyFault!&page=$page");
        }
    }
//关闭数据库连接
    mysqli_close($link);
}