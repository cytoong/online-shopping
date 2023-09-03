<?php
/**
 * Created by PhpStorm.
 * User: Halo
 * Date: 2019/6/7
 * Time: 16:06
 */
$page=1;
$max=0;
$typeid=0;
if(!empty($_GET)) {
    if(isset($_GET["message"]))
    {
        $message = $_GET["message"];
        echo "<script>alert('$message');</script>";

    }
    if(isset($_GET["page"]))
    {
        $page = $_GET["page"];
    }

}
if(isset($_GET["typeid"]))
{
    $typeid = $_GET["typeid"];
}
else
{
    header("location:goodlist.php?message=NoTypeidInfo!");
    return;
}
if (!session_id()) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品列表页面</title>
    <style>
        body
        {
            background: white;
        }
        .good
        {
            border:#DDDDDD solid 1px;
            width: 250px;
            height:400px;

        }
        .good:hover
        {
            border:red solid 1px;
        }
        .good .goodPicture
        {
            width: 280px;
        }
        .good .price
        {
            color:red;
            margin-left:10px;
            font-weight:bold;
            font-size: 20px;
            cursor:default;
        }
        .good .type
        {
            cursor:default;
        }
        .good .type span
        {
            margin-left: 90px;
            color:gray;
            font-size: 10px;
        }
        .good .type a
        {
            text-decoration: none;
        }
        .good .name
        {
            margin-left:20px;
            font-size: 15px;
            color:black;
            font-family: 幼圆;
            text-decoration: none;

        }
        .good .name:hover
        {
            color:red;
        }
        .good .addGood
        {
            margin-left: 10px;
            color:gray;
            text-decoration: none;
        }
        .good .addGood:hover
        {
            color:orange;
        }
        .good .buyNow
        {

        }

        .btn2:hover{
            width: 80px;
            height:30px;
            border: 2px solid #FF0000;
            background-color: white;
            color: #FF0000;
            border-radius: 4px;
            font-weight: 600;
        }

    </style>
</head>
<body>



<table boder="0" cellspacing="30px" align="center">




    <tr>
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
        $sql="select * from good where typeid='$typeid'";
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
            $max=mysqli_num_rows($result);
            $num=0;
            while($attr=mysqli_fetch_array($result))
            {
                $num++;


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
                if($num>($page-1)*12&&$num<=$page*12)
                {
                    if($num%4==1)
                        echo "<tr>";
                    ?>
                    <!--                                showType网页-->

                    <td>
                        <table border='0' cellspacing="0" class="good">
                            <tr>
                                <td colspan="2">
                                    <a href="showGoodBy.php?goodid=<?php echo $attr[0]; ?>">
                                        <img class="goodPicture" src="<?php echo $attr[1]; ?>" alt="查看商品详细信息">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan>
                                    <span class="price" onselectstart="return false;"><?php echo $attr[3]; ?>元</span>
                                </td>
                                <td  class="type">
                                    <a href="showType.php?typeid=<?php echo $attr[4]; ?>"><span onselectstart="return false;"><?php echo $attr1[1]; ?></span></a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'>
                                    <a  href="showGoodBy.php?goodid=<?php echo $attr[0]; ?>" class="name">
                                        <?php echo $attr[5]; ?>
                                    </a>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <a href="addUserGood.php?goodid=<?php echo $attr[0]; ?>&num=1&page=<?php echo $page; ?>" class="addGood">加入购物车</a>
                                </td>
                                <td style="text-align:right;" class="buyNow">
                                    <a href="createUserbill.php?goodid=<?php echo $attr[0]; ?>&page=<?php echo $page; ?>" ></a>
                                <td width=50%><button class="btn2">确认购买</button></td>
                                </td>
                            </tr>
                        </table>
                    </td>



                    <?php
                    if($num%4==0)
                        echo "</tr>";
                }
            }
            if($num%4!=0)
                echo "</tr>";
        }
        //关闭数据库连接
        mysqli_close($link);
        ?>
    </tr>


</table>
<div align="center">
    <?php if($page>=2){?>
        <button style="border:0;background:lightblue;width:200px;height:40px;position:absolute;margin-left:-500px;"><a style="text-decoration: none;" href="goodlist.php?page=<?php echo $page-1; ?>">上一页</a></button>
    <?php }
    if($max-$page*12>0)
    {?>
        <button style="border:0;background:lightblue;width:200px;height:40px;position:absolute;margin-left:300px;"><a style="text-decoration: none;" href="goodlist.php?page=<?php echo $page+1; ?>">下一页</a></button>
    <?php }?>
</div>
</body>
</html>