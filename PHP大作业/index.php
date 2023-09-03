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
  <meta charset="utf-8">
  <title>登录页</title>
  <meta name="description" content="particles.js is a lightweight JavaScript library for creating particles.">
  <meta name="author" content="Vincent Garreau" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" media="screen" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/reset.css"/>
  <style>
	.login-center input
	{
		border:#ccc 1px solid;
	}
  </style>
</head>
<body>

<div id="particles-js">
		<div class="login">
			<div class="login-top">

				登录
			</div>

            <form action="login.php" method="post" id="myform">


                <div class="login-center clearfix">
				<div class="login-center-img"><img src="img/name.png"/></div>
				<div class="login-center-input">
					<input type="text" name="name" value="" placeholder="请输入您的用户名" onfocus="this.placeholder=''" onblur="this.placeholder='请输入您的用户名'"/>
					<div class="login-center-input-text">用户名</div>
				</div>
			</div>
			<div class="login-center clearfix">
				<div class="login-center-img"><img src="img/password.png"/></div>
				<div class="login-center-input">
					<input type="password" name="password"value="" placeholder="请输入您的密码" onfocus="this.placeholder=''" onblur="this.placeholder='请输入您的密码'"/>
					<div class="login-center-input-text">密码</div>
					<div class="login-showright" >
						<a href="forgetPassword.php">忘记密码？</a>
					</div>
				</div>
			</div>

			<div class="login-center clearfix">
				<div class="login-left-img"><img src="image_captcha.php"  onclick="this.src='image_captcha.php?'+new Date().getTime();" width="200" height="50"></div>
				<div class="login-left-input">
					<input type="text" name="captcha"value="" placeholder="请输入验证码" onfocus="this.placeholder=''" onblur="this.placeholder='请输入左边的验证码'"/>
					<div class="login-left-input-text">验证码</div>
				</div>
			</div>

			<div class="login-button">
				登陆
			</div>
			<div class="login-showright-guest" >
						<a href="guestInit.php">游客访问</a>
			</div>
			<div class="login-showcenter" >
				<a href="register.php">还没有账号？点击此处注册账号</a>
			</div>

            </form>

		</div>
		<div class="sk-rotating-plane"></div>
</div>

<!-- scripts -->

<script type="text/javascript">
	//下列是登录界面的特效
	function hasClass(elem, cls) {
	  cls = cls || '';
	  if (cls.replace(/\s/g, '').length == 0) return false; //当cls没有参数时，返回false
	  return new RegExp(' ' + cls + ' ').test(' ' + elem.className + ' ');
	}
	function addClass(ele, cls) {
	  if (!hasClass(ele, cls)) {
	    ele.className = ele.className == '' ? cls : ele.className + ' ' + cls;
	  }
	}
	function removeClass(ele, cls) {
	  if (hasClass(ele, cls)) {
	    var newClass = ' ' + ele.className.replace(/[\t\r\n]/g, '') + ' ';
	    while (newClass.indexOf(' ' + cls + ' ') >= 0) {
	      newClass = newClass.replace(' ' + cls + ' ', ' ');
	    }
	    ele.className = newClass.replace(/^\s+|\s+$/g, '');
	  }
	}
		//登录按钮点击响应事件
		document.querySelector(".login-button").onclick = function(){
				addClass(document.querySelector(".login"), "active")
				setTimeout(function(){
					addClass(document.querySelector(".sk-rotating-plane"), "active")
					document.querySelector(".login").style.display = "none"
				},100)
				//$(document).
				setTimeout(function(){
					removeClass(document.querySelector(".login"), "active")
					removeClass(document.querySelector(".sk-rotating-plane"), "active")
					document.querySelector(".login").style.display = "block"
                    document.getElementById("myform").submit();

					//window.location.href="showgood.html?backurl="+window.location.href;

				},160)
		}
</script>
</body>
</html>