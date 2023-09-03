<?php
/**
 * Created by PhpStorm.
 * User: Halo
 * Date: 2019/6/8
 * Time: 9:07
 */


if(isset($_GET["message"]))
{
    $message = $_GET["message"];
    echo "<script>alert('$message');</script>";

}
$typeid=0;
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

if(!empty($_GET)) {



    if(isset($_GET["typeid"]))
    {
        $typeid=$_GET["typeid"];
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
        $sql1="delete from good where typeid='$typeid'";
        $result1=mysqli_query($link,$sql1);
        if($result1)
        {
            $sql="delete from goodtype where typeid='$typeid'";
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
                header("location:ManageType.php?message=DeleteGoodTypeSuccess!");
                return;
            }
            else{
                header("location:ManageType.php?message=DeleteGoodTypeFault!");
                return;
            }
        }
        else
        {
            header("location:ManageType.php?message=DeleteGoodTypeFaultAndErrorToDeleteGood!");
            return;
        }


        //关闭数据库连接
        mysqli_close($link);

    }
    else
    {
        header("location:ManageType.php?message=NoInfo!");
        return;
    }


}
else{
    header("location:ManageType.php?message=NoInfo!");
    return;
}

