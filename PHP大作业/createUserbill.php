<?php
/**
 * Created by PhpStorm.
 * User: Halo
 * Date: 2019/6/8
 * Time: 9:07
 */

$buyid=0;
$num=0;
$goodid=0;
$goodname=null;
$price=0;
$page=1;

if(!empty($_GET)) {
    if(isset($_GET["message"]))
    {
        $message = $_GET["message"];
        echo "<script>alert('$message');</script>";

    }

    if (!session_id()) session_start();
    if(isset($_SESSION["type"]))
    {
        if($_SESSION["type"]==0)
        {
            header("location:buyer.php?message=NotRegister!");
            return;
        }

    }
    else
    {
        header("location:buyer.php?message=NotRegister!");
        return;
    }



    if(isset($_GET["buyid"]))
    {
        $buyid=$_GET["buyid"];
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
        mysqli_select_db($link,"goodlist");
        //设置字符集
        mysqli_set_charset($link,'utf8');
        //准备sql语句
        $sql="select * from usergood where buyid='$buyid'";
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
            $attr=mysqli_fetch_array($result);
            $goodid=$attr[1];
            $num=$attr[3];

            //准备sql语句
            $sql1="select * from good where goodid='$goodid'";
            //发送sql语句
            $result1=mysqli_query($link,$sql1);
            //处理数据
            if($result1)
            {
                //fetch_row获取行的数据
                //mysqli_detch_assoc获取对应键值,$attr['linenum']可获取数据
                //获取字段数
                //echo mysqli_num_fields($result),"<br/>";
                //获取信息数
                //echo mysqli_num_rows($result),"<br/>";
                $attr1=mysqli_fetch_array($result1);
                $goodname=$attr1[5];
                $price=$attr1[3];

            }
            else{
                header("location:buyer.php?message=GetGoodinfoFault!");
                return;
            }

        }
        else{
            header("location:buyer.php?message=GetUsergoodinfoFault!");
            return;
        }
        mysqli_close($link);

    }
    else
    {
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

        $sql1="select * from good where goodid='$goodid'";
        //发送sql语句
        $result1=mysqli_query($link,$sql1);
        //处理数据
        if($result1)
        {
            //fetch_row获取行的数据
            //mysqli_detch_assoc获取对应键值,$attr['linenum']可获取数据
            //获取字段数
            //echo mysqli_num_fields($result),"<br/>";
            //获取信息数
            //echo mysqli_num_rows($result),"<br/>";
            $attr1=mysqli_fetch_array($result1);
            $goodname=$attr1[5];
            $price=$attr1[3];

        }
        else{
            header("location:buyer.php?message=GetGoodinfoFault!");
            return;
        }
        mysqli_close($link);
    }
    //关闭数据库连接



}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>提交订单</title>
</head>
<body>
<form action="createUserbillHandle.php" method="post" onsubmit="return check()">

    <table align="center"  border="1" cellspacing="0">
        <tr>
            <th colspan="2" style="background:gray;">订单填写</th>
        </tr>
        <tr>
            <td style="text-align:right">
                商品名称：
            </td>
            <td>
                <?php echo $goodname; ?>
                <input type="text" value="<?php echo $goodid; ?>" name="goodid" hidden>
                <input type="text" value="<?php echo $buyid; ?>" name="buyid" hidden>
                <input type="text" value="<?php echo $goodname; ?>" name="goodname" hidden>
            </td>
        </tr>
        <tr>
            <td style="text-align:right">
                商品单价：
            </td>
            <td>
                <?php echo $price; ?>
                <input type="text" value="<?php echo $price; ?>" name="price" hidden>
            </td>
        </tr>
        <tr>
            <td style="text-align:right">
                商品数量：
            </td>
            <td>
                <?php echo $num; ?>
                <input type="text" value="<?php echo $num; ?>" name="num" hidden>
            </td>
        </tr>
        <tr>
            <td style="text-align:right">
                总价：
            </td>
            <td>
                <?php echo $num*$price; ?>
                <input type="text" value="<?php echo $num*$price; ?>" name="sum" hidden>
            </td>
        </tr>
        <tr>
            <td style="text-align:right">用户名：</td>
            <td>
                <?php
                if (!session_id()) session_start();
                echo $_SESSION["name"]; ?>
            </td>
        </tr>
        <tr>
            <td style="text-align:right">收货人：</td>
            <td>
                <input type="text" name="name" id="name" placeholder="请输入收货人姓名">
            </td>
        </tr>
        <tr>
            <td style="text-align:right">地址：</td>
            <td>
                <input type="text" name="address" id="address" placeholder="请输入收获地址">
            </td>
        </tr>
        <tr>
            <td style="text-align:right">手机号码：</td>
            <td>
                <input type="text" name="phone" id="phone" placeholder="请输入手机号码">
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center"><input type="submit" value="提交"> <input type="reset" value="重置"></td>
        </tr>
    </table>
</form>
<script>
    function check()
    {
        var name=document.getElementById("name");
        var address=document.getElementById("address");
        var phone=document.getElementById("phone");
        if(name.value=='')
        {
            alert("收货人姓名为空");
            name.focus();
            return false;
        }
        if(address.value=='')
        {
            alert("地址为空");
            address.focus();
            return false;
        }
        if(phone.value=='')
        {
            alert("手机号码为空");
            phone.focus();
            return false;
        }

        return true;
    }
</script>
</body>
</html>
