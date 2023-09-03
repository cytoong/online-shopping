<?php
/**
 * Created by PhpStorm.
 * User: Halo
 * Date: 2019/6/7
 * Time: 16:06
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
        header("location:ManageGood.php?message=NotAdmin!");
        return;
    }

}
else
{
    header("location:ManageGood.php?message=NotAdmin!");
    return;
}
$goodid=0;
if(isset($_GET["goodid"]))
{
    $goodid=$_GET["goodid"];
}
else{
    header("location:ManageGood.php?message=NotAdmin!");
    return;
}
$picture=null;
$info=null;
$price=null;
$typeid=null;
$name=null;
$link=mysqli_connect("localhost","root","password");
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
$sql="select * from good where goodid='$goodid'";
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
        $picture=$attr[1];
        $info=$attr[2];
        $price=$attr[3];
        $typeid=$attr[4];
        $name=$attr[5];
    }
}
//关闭数据库连接
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改商品</title>
</head>

<body>
<form action="changeGoodHandle.php" method="post" onsubmit="return check()">


    <table align="center"  border="1" cellspacing="0" style="margin-top:100px;">
        <tr>
            <th colspan="2" style="background:gray;">修改商品</th>
        </tr>
        <tr>
            <td style="text-align:right" onchange="">
                商品名称：
            </td>
            <td>
                <input type="text" name="goodid" value="<?php echo $goodid; ?>" hidden>
                <input type="text" name="name" id="name" placeholder="输入商品名称" value="<?php echo $name; ?>">
            </td>
        </tr>
        <tr>
            <td style="text-align:right">
                商品图片：
            </td>
            <td>
                <input type="url" name="picture" id="picture" placeholder="请输入图片的地址或网址" value="<?php echo $picture; ?>">
            </td>
        </tr>
        <tr>
            <td style="text-align:right">
                商品信息：
            </td>
            <td>
                <textarea name="info" id="info" style="resize:none;width:168px;" cols="30" rows="10" placeholder="请输入商品的详细介绍和详细信息"><?php echo $info; ?></textarea>
            </td>
        </tr>
        <tr>
            <td style="text-align:right">
                商品类别：
            </td>
            <td>
                <!--                这里写商品的类别-->
                <select name="typeid" id="typeid">
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
                            <option value="<?php echo $attr[0]; ?>" <?php if($typeid==$attr[0]) echo 'selected'; ?>><?php echo $attr[1]; ?></option>
                            <?php
                        }


                    }
                    //关闭数据库连接
                    mysqli_close($link);


                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td style="text-align:right">商品价格：</td>
            <td>
                <input type="number" name="price" id="price" value="<?php echo $price; ?>" placeholder="请输入商品的价格">
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
        var picture=document.getElementById("picture");
        var info=document.getElementById("info");
        var price=document.getElementById("price");

        if(name.value=='')
        {
            alert("商品名称为空");
            name.focus();
            return false;
        }
        if(picture.value=='')
        {
            alert("图片地址为空");
            picture.focus();
            return false;
        }
        if(info.value=='')
        {
            alert("商品信息为空");
            info.focus();
            return false;
        }
        if(price.value=='')
        {
            alert("商品价格为空");
            price.focus();
            return false;
        }


        return true;
    }
</script>
</body>
</html>
