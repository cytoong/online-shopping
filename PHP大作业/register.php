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
    <style type="text/css">
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
            font: 16px/20px microsft yahei;
        }
        .wrap {
            width: 100%;
            height: 100%;
            padding: 10% 0;
            position: fixed;
            opacity: 0.8;
            background: linear-gradient(to bottom right,#d3d3d3, #778899);
            background: -webkit-linear-gradient(to bottom right,#50a3a2,#53e3a6);
        }
        .container {
            width: 60%;
            margin: 0 auto;
        }
        .container h1 {
            text-align: center;
            color: #FFFFFF;
            font-weight: 500;
        }
        .container input {
            width: 320px;
            display: block;
            height: 30px;
            border: 0;
            outline: 0;
            padding: 6px 10px;
            line-height: 20px;
            margin: 32px auto;
            -webkit-transition: all 0s ease-in 0.1ms;
            -moz-transition: all 0s ease-in 0.1ms;
            transition: all 0s ease-in 0.1ms;
        }
        .container input[type="text"] , .container input[type="password"]  {
            background-color: #FFFFFF;
            font-size: 15px;
            color: #50a3a2;
        }
        .container input[type='submit'] {
            font-size: 15px;
            letter-spacing: 2px;
            color: #666666;
            background-color: #FFFFFF;
        }
        .container input:focus {
            width: 400px;
        }
        .container input[type='submit']:hover {
            cursor: pointer;
            width: 400px;
        }
        .to_login{
            color: #a7c4c9;
        }
        .text{
            color: #e2dfe4;
        }
        .wrap ul {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -20;
        }
        .wrap ul li {
            list-style-type: none;
            display: block;
            position: absolute;
            bottom: -120px;
            width: 15px;
            height: 15px;
            z-index: -8;
            border-radius: 50%;
            background-color:rgba(255, 255, 255, 0.15);
            animotion: square 25s infinite;
            -webkit-animation: square 25s infinite;
        }
        .wrap ul li:nth-child(1) {
            left: 0;
            animation-duration: 10s;
            -moz-animation-duration: 10s;
            -o-animation-duration: 10s;
            -webkit-animation-duration: 10s;
        }
        .wrap ul li:nth-child(2) {
            width: 40px;
            height: 40px;
            left: 10%;
            animation-duration: 15s;
            -moz-animation-duration: 15s;
            -o-animation-duration: 15s;
            -webkit-animation-duration: 11s;
        }
        .wrap ul li:nth-child(3) {
            left: 20%;
            width: 25px;
            height: 25px;
            animation-duration: 12s;
            -moz-animation-duration: 12s;
            -o-animation-duration: 12s;
            -webkit-animation-duration: 12s;
        }
        .wrap ul li:nth-child(4) {
            width: 50px;
            height: 50px;
            left: 30%;
            -webkit-animation-delay: 3s;
            -moz-animation-delay: 3s;
            -o-animation-delay: 3s;
            animation-delay: 3s;
            animation-duration: 12s;
            -moz-animation-duration: 12s;
            -o-animation-duration: 12s;
            -webkit-animation-duration: 12s;
        }
        .wrap ul li:nth-child(5) {
            width: 60px;
            height: 60px;
            left: 40%;
            animation-duration: 10s;
            -moz-animation-duration: 10s;
            -o-animation-duration: 10s;
            -webkit-animation-duration: 10s;
        }
        .wrap ul li:nth-child(6) {
            width: 75px;
            height: 75px;
            left: 50%;
            -webkit-animation-delay: 7s;
            -moz-animation-delay: 7s;
            -o-animation-delay: 7s;
            animation-delay: 7s;
        }
        .wrap ul li:nth-child(7) {
            left: 60%;
            width: 30px;
            height: 30px;
            animation-duration: 8s;
            -moz-animation-duration: 8s;
            -o-animation-duration: 8s;
            -webkit-animation-duration: 8s;
        }
        .wrap ul li:nth-child(8) {
            width: 90px;
            height: 90px;
            left: 70%;
            -webkit-animation-delay: 4s;
            -moz-animation-delay: 4s;
            -o-animation-delay: 4s;
            animation-delay: 4s;
        }
        .wrap ul li:nth-child(9) {
            width: 50px;
            height: 50px;
            left: 80%;
            animation-duration: 20s;
            -moz-animation-duration: 20s;
            -o-animation-duration: 20s;
            -webkit-animation-duration: 20s;
        }
        .wrap ul li:nth-child(10) {
            width: 75px;
            height: 75px;
            left: 90%;
            -webkit-animation-delay: 6s;
            -moz-animation-delay: 6s;
            -o-animation-delay: 6s;
            animation-delay: 6s;
            animation-duration: 30s;
            -moz-animation-duration: 30s;
            -o-animation-duration: 30s;
            -webkit-animation-duration: 30s;
        }
        @keyframes square {
            0% {
                -webkit-transform: translateY(0);
                transform: translateY(0)
            }
            100% {
                bottom: 400px;
                -webkit-transform: translateY(-500);
                transform: translateY(-500)
            }
        }
        @-webkit-keyframes square {
            0% {
                -webkit-transform: translateY(0);
                transform: translateY(0)
            }
            100% {
                bottom: 400px;
                -webkit-transform: translateY(-500);
                transform: translateY(-500)
            }
        }
    </style>

</head>

<body>
<div class="wrap">
    <form action="registerHandle.php" method="post" onsubmit="return check()">
        <div class="container">
            <h1 style="color: white; margin: 0; text-align: center">Sign up</h1>
            <form>
                <label><input type="text" name="name" id="name" placeholder="用户名"/></label>
                <label><input type="password" name="password" id="password" placeholder="密码" /></label>
                <label><input type="password" name="repassword" id="repassword" placeholder="确认密码" /></label>
                <label><input type="text"  name="phone" id="phone" placeholder="手机号码"/></label>
                <label><input type="text"  name="email" id="email" placeholder="电子邮箱"/></label>
                <label><input type="text"  name="question" id="question" placeholder="密保问题"/></label>
                <label><input type="text"  name="answer" id="answer" placeholder="问题答案"/></label>

                <input type="submit" value="Sign up"/>
                <p class="change_link" style="text-align: center">
                    <span class="text">Already a member ?</span>
                    <a href="index.php" class="to_login"> Go and log in </a>
                </p>
            </form>
        </div>
        <ul>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
</div>
</body>
<script>
    function check()
    {
        var name=document.getElementById("name");
        var password=document.getElementById("password");
        var repassword=document.getElementById("repassword");
        var phone=document.getElementById("phone");
        var email=document.getElementById("email");
        var question=document.getElementById("question");
        var anwser=document.getElementById("anwser");
        if(name.value=='')
        {
            alert("姓名为空");
            name.focus();
            return false;
        }
        if(password.value=='')
        {
            alert("密码为空");
            password.focus();
            return false;
        }
        if(repassword.value=='')
        {
            alert("重复密码为空");
            repassword.focus();
            return false;
        }
        if(phone.value=='')
        {
            alert("手机号码为空");
            phone.focus();
            return false;
        }
        if(email.value=='')
        {
            alert("电子邮箱为空");
            email.focus();
            return false;
        }
        if(question.value=='')
        {
            alert("密保问题为空");
            question.focus();
            return false;
        }
        if(anwser.value=='')
        {
            alert("答案为空");
            anwser.focus();
            return false;
        }
        return true;
    }

    var user = document.getElementById('name');  //获取用户控件
    user.onblur = function () {  //当用户离开当前文本框的时行验证
        //1.创建Ajax对象
        var xhr = new XMLHttpRequest();
        //2.创建请求事件的监听
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                if (xhr.responseText == 1) {  //当前用户存在
                    var warning = document.getElementById('warning');
                    warning.style='color:red';
                    warning.innerHTML = '您的用户名不可用';
                    document.getElementById('submit').disabled = true;
                }else
                {
                    if(user.length>=6&&user.length<=16)
                    {
                        var warning = document.getElementById('warning');
                        warning.style='color:green';
                        warning.innerHTML = '您输入的用户名可用';

                    }
                    else
                    {
                        var warning = document.getElementById('warning');
                        warning.style='color:red';
                        warning.innerHTML = '您的用户名长度不符合要求';
                    }

                }
            }
        }

        //3.初始化一个url请求
        var user = document.getElementById('name').value;
        var data = 'name='+user; //生成post请求数据
        var url = 'check.php';
        xhr.open('post',url,true); //请求类型为post，交互方式为异步

        //4.设置请求头
        xhr.setRequestHeader('content-type','application/x-www-form-urlencoded');

        //5.发送url请求,需要传入参数
        xhr.send(data);

        var submit = document.getElementById('submit');
        submit.onclick = function () {
            var tips = document.getElementById('tips');
            tips.innerHTML = '当前用户名可用';
            return false;
        }
    }

</script>
</body>
</html>
