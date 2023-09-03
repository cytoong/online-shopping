<?php
/**
 * Created by PhpStorm.
 * User: Halo
 * Date: 2019/6/8
 * Time: 9:07
 */

if(!empty($_GET)) {
    if(isset($_GET["message"]))
    {
        $message = $_GET["message"];
        echo "<script>alert('$message');</script>";

    }

}
if (!session_id()) session_start();
if(isset($_SESSION["type"]))
{
    if($_SESSION["type"]!=2)
    {
        header("location:goodlist.php?message=NotAdmin!");
        return;
    }

}
else
{
    header("location:goodlist.php?message=NotAdmin!");
    return;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>订单管理</title>
    <style>
        button
        {
            width: 80px;
            height:30px;
            border: 2px solid #f88020;
            background-color: white;
            color: #f88020;
            border-radius: 4px;
            font-weight: 600;
        }

        . td,th
        {
            border-top: 1px solid #F88020;
            margin-top: 10px;
            height:50px;
            font-size: 19px;
            line-height: 50px;
            font-weight: 200;
            border-radius:0 0 10px 10px ;
        }
    </style>
</head>
<body style="text-align:center;">
<h1>订单管理</h1>
<br/>
<br/>
<table align="center" border="" cellspacing="2" style="width:80%;">
    <tr>
        <th style="background:#DDDDDDFF;">订单号</th>
        <th style="background:#DDDDDDFF;">收货人</th>
        <th style="background:#DDDDDDFF;">用户</th>
        <th style="background:#DDDDDDFF;">收货人地址</th>
        <th style="background:#DDDDDDFF;">商品id</th>
        <th style="background:#DDDDDDFF;">商品数量</th>
        <th style="background:#DDDDDDFF;">订单金额</th>
        <th style="background:#DDDDDDFF;">手机号</th>
        <th style="background:#DDDDDDFF;">商品名称</th>
        <th style="background:#DDDDDDFF;">是否完成</th>
        <th style="background:#DDDDDDFF;">操作</th>
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
    $sql="select * from userbill";
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
                <td><?php echo $attr[1]; ?></td>
                <td><?php echo $attr[3]; ?></td>
                <td><?php echo $attr[4]; ?></td>
                <td><?php echo $attr[5]; ?></td>
                <td><?php echo $attr[6]; ?></td>
                <td><?php echo $attr[8]; ?></td>
                <td><?php echo $attr[9]; ?></td>
                <td><?php if($attr[7]==1)echo '完成';else echo '未完成'; ?></td>
                <td><a href="changeBillfinish.php?billid=<?php echo $attr[0]; ?>">修改状态</a>&nbsp;<a href="deleteBill.php?billid=<?php echo $attr[0]; ?>" onclick="return check();">删除</a></td>
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
<script>
    function check()
    {
        if(confirm("是否确定删除该订单?"))
        {
            return true;
        }
        return false;
    }
</script>
</body>
</html>
