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
    $preg_name='/^[a-zA-Z0-9]{6,16}$/ims';
    if(!preg_match($preg_name,$name)){
        header("location:register.php?message=NameError!");
        return;
    }
    $password=$_POST["password"];
    $preg_password='/^[a-zA-Z0-9]{9,16}$/ims';
    if(!preg_match($preg_password,$password)){
        header("location:register.php?message=PsswordError!");
        return;
    }
    $repassword=$_POST["repassword"];
    if(!preg_match($preg_password,$repassword)){
        header("location:register.php?message=RepasswordError!");
        return;
    }
    $phone=$_POST["phone"];
    $preg_phone='/^1[34578]\d{9}$/ims';
    if(!preg_match($preg_phone,$phone)){
        header("location:register.php?message=PhoneError!");
        return;
    }
    $email=$_POST["email"];
    $preg_email='/^[a-zA-Z0-9]+([-_.][a-zA-Z0-9]+)*@([a-zA-Z0-9]+[-.])+([a-z]{2,5})$/ims';
    if(!preg_match($preg_email,$email)){
        header("location:register.php?message=EmailError!");
        return;
    }
    $question=$_POST["question"];
    $anwser=$_POST["anwser"];


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
$sql="select * from User";
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
    $g_having=false;
    while($attr=mysqli_fetch_array($result))
    {
        if($attr[0]==$name)
        {
            $g_having=true;
            break;
        }
    }
    if($g_having)
    {
          header("location:register.php?message=UsernameRepeat!");
    }
    else if($repassword==$password)
    {
        $sql1="insert into User(name,password,type,question,anwser,email,phone) values('$name','$password',1,'$question','$anwser','$email','$phone')";
        $result1=mysqli_query($link,$sql1);
        if($result1)
        {
            header("location:index.php?message=RegisterSuccess!");
        }
        else header("location:register.php?message=SqlFault!");
    }

}
//关闭数据库连接
mysqli_close($link);

}