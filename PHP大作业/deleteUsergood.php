<?php
/**
 * Created by PhpStorm.
 * User: Halo
 * Date: 2019/6/8
 * Time: 9:07
 */

$buyid=0;
$all=0;
$showSuccess=0;
if(!empty($_GET)) {
    if(isset($_GET["message"]))
    {
        $message = $_GET["message"];
        echo "<script>alert('$message');</script>";

    }
    if(isset($_GET["showSuccess"]))
    {
        $showSuccess = $_GET["showSuccess"];

    }
    if(isset($_GET["all"]))
    {
        $all = $_GET["all"];

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


    if($all==0)
    {
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
                if (!session_id()) session_start();

                $attr=mysqli_fetch_array($result);
                if($attr[2]==$_SESSION['name'])
                {
                    $sql1="delete from usergood where buyid='$buyid'";
                    $result1=mysqli_query($link,$sql1);
                    if($result1)
                    {
                        if($showSuccess==0)
                            header("location:buyer.php");
                        else header("location:buyer.php?message=BuySuccess!");
                        return;
                    }
                    else{
                        header("location:buyer.php?message=DeleteUsergoodFault!");
                        return;
                    }
                }
                else{
                    header("location:buyer.php?message=NotYourGood!");
                    return;
                }
            }
            else{
                header("location:buyer.php?message=DeleteGoodFault!");
                return;
            }

            //关闭数据库连接
            mysqli_close($link);

        }
        else
        {
            header("location:buyer.php?message=NoInfo!");
            return;
        }
    }
    else
    {
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
        $sql="delete from usergood where name='".$_SESSION["name"]."'";
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
            header("location:buyer.php?message=DeleteAllgoodSuccess!");
            return;




        }
        //关闭数据库连接
        mysqli_close($link);
    }



}

