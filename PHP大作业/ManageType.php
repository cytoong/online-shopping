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
if(session)
{

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品类别管理</title>
</head>
<body style="text-align:center;">
<h1>商品类别管理</h1>
<br/>
<br/>
<table align="center" border="1" cellspacing="0" style="width:50%;">
    <tr>
        <th style="background:yellow;">商品分类号</th>
        <th style="background:yellow;">商品类型名称</th>
        <th style="background:yellow;">操作</th>
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
    $sql="select * from goodtype";
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
                <td><?php echo $attr[1]; ?></td>
                <td><!--<a href="changeBill.jsp?billid=<?php// echo $attr[0]; ?>">修改</a>-->&nbsp;<a href="deleteGoodtype.php?typeid=<?php echo $attr[0]; ?>" onclick="return check();">删除</a></td>
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
        if(confirm("是否确定删除该类别?注意：删除该类别将导致这个类别的所有商品都被删除！！！"))
        {
            return true;
        }
        return false;
    }
</script>
</body>
</html>
