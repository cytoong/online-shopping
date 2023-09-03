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
    <title>商品管理</title>
    <style>


        . th
        {
            border-top: 1px solid #F88020;
            margin-top: 10px;
            height:50px;
            font-size: 19px;
            line-height: 50px;
            font-weight: 200;
            border-radius:0 0 10px 10px ;
        }
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
    </style>
</head>
<body style="text-align:center;">
<h1>商品管理</h1>
<br/>
<br/>
<table align="center" border="" cellspacing="2" style="width:80%;">
    <tr>
        <th style="background:#DDDDDDFF;">商品号</th>
        <th style="background:#DDDDDDFF;">图片位置</th>
        <th style="background:#DDDDDDFF;">商品信息</th>
        <th style="background:#DDDDDDFF;">商品价格</th>
        <th style="background:#DDDDDDFF;">商品所属类型</th>
        <th style="background:#DDDDDDFF;">商品名称</th>
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
    $sql="select * from good";
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
            $sql1="select * from goodtype where typeid='$attr[4]'";
            //发送sql语句
            $result1=mysqli_query($link,$sql1);
            //处理数据
            //fetch_row获取行的数据
            //mysqli_detch_assoc获取对应键值,$attr['linenum']可获取数据
            //获取字段数
            //echo mysqli_num_fields($result),"<br/>";
            //获取信息数
            //echo mysqli_num_rows($result),"<br/>";
            $attr1=mysqli_fetch_array($result1);
                ?>
                <!--            1类别                     showType网页-->
                <tr>
                    <td><?php echo $attr[0]; ?></td>
                    <td><?php echo $attr[1]; ?></td>
                    <td><?php echo $attr[2]; ?></td>
                    <td><?php echo $attr[3]; ?></td>
                    <td><?php echo $attr1[1]; ?></td>
                    <td><?php echo $attr[5]; ?></td>

                    <td><a href="changeGood.php?goodid=<?php echo $attr[0]; ?>">修改</a>&nbsp;<a href="deleteGood.php?goodid=<?php echo $attr[0]; ?>" onclick="return check();">删除</a></td>
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
        if(confirm("是否确定删除该商品？"))
        {
            return true;
        }
        return false;
    }
</script>
</body>
</html>
