<?php
/**
 * Created by PhpStorm.
 * User: Halo
 * Date: 2019/6/8
 * Time: 9:07
 */
$page=1;
$name=null;
if(!empty($_GET)) {
    if(isset($_GET["message"]))
    {
        $message = $_GET["message"];
        echo "<script>alert('$message');</script>";

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
        else
        {
            $name=$_SESSION["name"];
        }

    }
    else
    {
        header("location:goodlist.php?message=NotRegister!&page=$page");
        return;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<style>
    <meta charset="UTF-8">
    <title>个人订单查看</title>
    <style
            .main
            {
            overflow: hidden;
            text-align: center;
            }
            .main td,th
            {
            border-top: 1px solid #F88020;
            margin-top: 10px;
            height:50px;
            font-size: 19px;
            line-height: 50px;
            font-weight: 200;
            border-radius:0 0 10px 10px ;
            }
            .price
            {
            border-top: 1px solid #F88020;
            margin-top: 10px;
            height:50px;
            font-size: 19px;
            line-height: 50px;
            font-weight: 200;
            border-radius:0 0 10px 10px ;

            }
            .name
            {
            margin-left:20px;
            font-size: 15px;
            color:black;
            font-family: 幼圆;
            text-decoration: none;



            }
            .box{



            }
            .son
            {
            height: 40px;
            background: #ccc;
            width:800px;
            position: absolute;
            left:50%;
            margin-left: -400px;
            }
            .buy
            {
            margin-left:700px;
            height:40px;
            width:100px;
            background:orange;
            border:0px;
            position: absolute;
            }
            .delete
            {
            border:0;
            width:50px;
            height:30px;
            margin-left:100px;
            border-radius:5px;
            }
            .buybutton
            {
            border:0;
            width:50px;
            height:30px;
            margin-left:10px;
            border-radius:5px;

            }
            .clear
            {
            margin-left:0px;
            height:40px;
            width:100px;
            background:orange;
            border:0px;
            position: absolute;
            }
            .to_top {
            width: 0;
            height: 0;
            border-bottom: 10px solid gray;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            margin-left:14px;
            }
</style>
</head>
<body style="text-align:center;">
<h1>个人订单查看</h1>
<br/>
<br/>
<table border='0px' cellspacing='0px' align='center' class="main" width="1000px">
    <tr height="50px">
        <th style="background:# ;">订单号</th>
        <th style="background:#DDDDDDFF;">收货人</th>
        <th style="background:#DDDDDDFF;">收货人地址</th>
        <th style="background:#DDDDDDFF;">商品id</th>
        <th style="background:#DDDDDDFF;">商品数量</th>
        <th style="background:#DDDDDDFF;">订单金额</th>
        <th style="background:#DDDDDDFF;">手机号</th>
        <th style="background:#DDDDDDFF;">商品名称</th>
        <th style="background:#DDDDDDFF;">是否完成</th>
    </tr>
    <?php
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
    if (!session_id()) session_start();
    if(!isset($_SESSION["name"]))
    {
        header("location:goodlist.php?message=NotRegister!&page=$page");
        return;
    }
    $sql="select * from userbill where name='".$_SESSION["name"]."'";
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
        while($attr=mysqli_fetch_array($result))
        {
            ?>
            <!--                                showType网页-->

            <tr>
                <td><?php echo $attr[0]; ?></td>
                <td><?php echo $attr[2]; ?></td>
                <td><?php echo $attr[3]; ?></td>
                <td><?php echo $attr[4]; ?></td>
                <td><?php echo $attr[5]; ?></td>
                <td><?php echo $attr[6]; ?></td>
                <td><?php echo $attr[8]; ?></td>
                <td><?php echo $attr[9]; ?></td>
                <td><?php if($attr[7]==1)echo '完成';else echo '未完成'; ?></td>
            </tr>

            <?php
        }
    }
    //关闭数据库连接
    mysqli_close($link);
    ?>


</table>
<br/>
<hr>

</body>
</html>
