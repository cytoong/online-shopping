<?php
/**
 * Created by PhpStorm.
 * User: Halo
 * Date: 2019/6/7
 * Time: 23:14
 */
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
if(!empty($_POST)) {
    $name=$_POST["name"];
    $picture=$_POST["picture"];
    $info=$_POST["info"];
    $price=$_POST["price"];
    $typeid=$_POST["typeid"];
//连接数据库
    $link = mysqli_connect("localhost", "root", "root");
//判断连接成功
    if (!$link) {
        echo '连接失败';
        //return;
    }
//选择数据库
    mysqli_select_db($link, "dscj");
//设置字符集
    mysqli_set_charset($link, 'utf8');
//准备sql语句
    $sql = "insert into good(name,picture,info,price,typeid) values ('$name','$picture','$info','$price','$typeid')";
//发送sql语句
    $result = mysqli_query($link, $sql);
//处理数据
    if ($result) {
        header("location:addGood.php?message=InsertGoodSuccess!");

    }
    else header("location:addGood.php?message=InsertGoodError!");
//关闭数据库连接
    mysqli_close($link);
}