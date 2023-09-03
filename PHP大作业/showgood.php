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
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title></title>
<style type="text/css">
#nav{height:40px; background-color: #ffffff;}
#nav *{margin:0;padding:0;}
#nav a{text-decoration:none;}
/*一级菜单*/
#nav ul{margin:0 auto; width: 800px; display:block;list-style-type:none;}
#nav ul li{display:block;width:150px;height:40px; line-height:40px; float:left;text-align:center;border-right:solid 1px rgb(255, 165, 0);}
#nav ul li{border:solid 1px rgb(255, 255, 255);}
#nav ul li ul li:last-child{border-right:none;border-bottom: none;}
#nav ul li:hover{background-color: rgba(64, 64, 63, 0.05);}
/*二级菜单*/
#nav ul li ul{display:none;}
#nav ul li ul li{width:150px; height:40px; line-height:40px;background-color: #dcd9d5 /*rgba(95, 181, 43, 0.50)*/;border-bottom:solid 1px #eeebe8;}
#nav ul li:hover ul{display:block;position:relative;width:150px;}
#nav ul li ul li:hover{background-color: #ffa500;}
/*三级菜单*/
#nav ul li:hover ul li ul{display:none;}
#nav ul li:hover ul li:hover ul{display:block; position: relative; left: 150px; top: -40px;}
#nav ul li:hover ul li:hover ul li{width:150px; height:40px; line-height: 40px;}
#nav ul li:hover ul li:hover ul li:hover{background-color: #dedada;}


 * {
            margin: 0;
            padding: 0;
   }

a:link {color: gray;}     /* 未访问的链接 */
		a:visited {color: gray}  /* 已访问的链接 */
		a:hover {color: gray}    /* 当有鼠标悬停在链接上 */
		a:active {color: gray}   /* 被选择的链接 */
		a{
			text-decoration : none;
			font-size: 20px;
			font-family: 幼圆;
		}
		.list{
			width:200px;
			height: 98%;
			position:absolute;
			background: lightblue;
			text-align: left;
			margin: 0 auto;
			height: 25px;
			border-bottom: solid lightblue 1px;
			
		}
</style>
</head>
<body>
<div id="nav">
    <ul>
        <li><a href="goodlist.php" target="scrWidget">商场首页</a></li>
       
        <li><a href="goodlist.php" target="scrWidget">商品中心</a>
            <ul>
                <li><a href="goodlist.php" target="scrWidget">电器</a>
                    <ul>





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
<!--                                showType网页-->
                                <li><a href="showType.php?typeid=<?php echo $attr[0]; ?>" target="scrWidget"><?php echo $attr[1]; ?></a></li>
                                <?php
                            }
                        }
                        //关闭数据库连接
                        mysqli_close($link);
                        ?>



                    </ul>
                </li>

                <li>
                	<a href="#">其他商品</a>
		 <ul>
                        		<li>
                        			<a href="#">无</a>
                        		</li>
                    	</ul>
                </li>
                <li><a href="searchBox.html" target="scrWidget">搜索电器</a></li>
            </ul>
        </li>
        
	 <li><a href="buyer.php" target="scrWidget">个人中心</a>
            <ul>
                <li><a href="buyer.php" target="scrWidget">查看购物车</a></li>
                <li><a href="showUserbill.php" target="scrWidget">查看个人订单</a></li>
            </ul>
        </li>

        <li><a href="showUserbill.php" target="scrWidget">后台服务</a>
            <ul>
               
                <li>
                	<a href="#">个人服务</a>
                	 <ul>
	                        <li><a href="forgetPassword.php" target="scrWidget">忘记密码</a></li>
	                        <li><a href="showUserbill.php" target="scrWidget">查看订单</a></li>
	                        <li><a href="buyer.php" target="scrWidget">个人购物车</a></li>
	               </ul>
                </li>
                 <li><a href="initAdmin.php" target="scrWidget">管理员管理</a></li>
            </ul>
        </li>

        <li>
        		<a href="showUserbill.php" target="scrWidget">账户</a>
        		<ul>
                    <?php if(isset($_SESSION["type"])) {
                        if ($_SESSION["type"] != 0) {
                            ?>
                            <!-- 游客的这一项可以设置为登录，注册账户 -->
                            <li><a href="outlogin.php">退出登录</a></li>
                            <?php
                        }
                        else {
                            ?>
                            <li><a href="register.php">注册</a></li>
                            <li><a href="index.php">登录</a></li>
                        <?php }
                    }
                    else {
                            ?>
                    <li><a href="register.php">注册</a></li>
                        <li><a href="index.php">登录</a></li>
                    <?php } ?>
	           </ul>
        </li>
    </ul>
</div >




<div>
	<iframe src="goodlist.php" frameborder="0" height="93%" width="100%" scrolling="auto" name="scrWidget" style="border-top:lightblue;">
	
	</iframe>
</div>

</body>
</html>