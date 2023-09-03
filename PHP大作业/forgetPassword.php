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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户注册</title>
    <style>
        p{
            text-align: center;
        }

    </style>
</head>

<body>
<form action="checkUser.php" method="post" onsubmit="return check()">


    <table align="center"  border="0" cellspacing="1" style="margin-top:120px;">
        <tr>
            <th colspan="2" style="background:#DDDDDDFF;">忘记密码</th>
        </tr>
        <tr>
            <td style="text-align:right" onchange="">
                用户名：
            </td>
            <td>
                <input type="text" name="name" id="name" placeholder="请输入你忘记密码的用户名">
            </td>
        </tr>

        <tr>
            <td colspan="2" style="text-align:center"><input type="submit" value="确定"> </td>
        </tr>
    </table>
</form>
<script>
    function check()
    {
        var name=document.getElementById("name");

        if(name.value=='')
        {
            alert("姓名为空");
            name.focus();
            return false;
        }

        return true;
    }


</script>
</body>
</html>
