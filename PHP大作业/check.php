<?php
/**
 * Created by PhpStorm.
 * User: Halo
 * Date: 2019/6/7
 * Time: 20:43
 */
if(!empty($_POST))
{
    header("Content-Type:text/html;charset=UTF-8");
    $name=$_POST["name"];

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
    $sql="select * from User where name='$name'";
//发送sql语句
    $result=mysqli_query($link,$sql);
//处理数据

        //fetch_row获取行的数据
        //mysqli_detch_assoc获取对应键值,$attr['linenum']可获取数据
        //获取字段数
        //echo mysqli_num_fields($result),"<br/>";
        //获取信息数
        //echo mysqli_num_rows($result),"<br/>";
        if(mysqli_num_rows($result)>0)
        {
            echo 1;
        }
        else{
            echo 0;
        }
//关闭数据库连接
    mysqli_close($link);

}