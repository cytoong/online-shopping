<?php
/**
 * Created by PhpStorm.
 * User: Halo
 * Date: 2019/6/8
 * Time: 9:07
 */
$page=1;
$name=null;
if(!empty($_GET)) {
    if(isset($_GET["message"]))
    {
        $message = $_GET["message"];
        echo "<script>alert('$message');</script>";

    }



    if(isset($_GET["page"]))
    {
        $page=$_GET["page"];
    }
    else
    {
        $page=1;
    }

    if (!session_id()) session_start();
    if(isset($_SESSION["type"]))
    {
        if($_SESSION["type"]==0)
        {
            header("location:goodlist.php?message=NotRegister!&page=$page");
            return;
        }
        else
        {
            $name=$_SESSION["name"];
        }

    }
    else
    {
        header("location:goodlist.php?message=NotRegister!&page=$page");
        return;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>购物车</title>
	<style>
	.main
	{
        overflow: hidden;
        text-align: center;
	}
	.main td,th
	{
        border-top: 1px solid #F88020;
        margin-top: 10px;
        height:50px;
        font-size: 19px;
        line-height: 50px;
        font-weight: 200;
        border-radius:0 0 10px 10px ;
	}
	 .price
		{
         border-top: 1px solid #F88020;
         margin-top: 10px;
         height:50px;
         font-size: 19px;
         line-height: 50px;
         font-weight: 200;
         border-radius:0 0 10px 10px ;

		}
		 .name
		{
			margin-left:20px;
			font-size: 15px;
			color:black;
			font-family: 幼圆;
			text-decoration: none;



		}
		.box{



	    }
	    .son
	    {
	    	height: 40px;
	    	background: #ccc;
	    	width:800px;
	    	position: absolute;
	    	left:50%;
	    	margin-left: -400px;
	    }
	    .buy
	    {
	    	margin-left:700px;
	    	height:40px;
	    	width:100px;
	    	background:orange;
	    	border:0px;
	    	position: absolute;
	    }
	    .delete
	    {
	    	border:0;
	    	width:50px;
	    	height:30px;
	    	margin-left:100px;
	    	border-radius:5px;
	    }
        .buybutton
        {
            border:0;
            width:50px;
            height:30px;
            margin-left:10px;
            border-radius:5px;

        }
        .clear
        {
            margin-left:0px;
            height:40px;
            width:100px;
            background:orange;
            border:0px;
            position: absolute;
        }

    /* 向下箭头 */

    .to_bottom {
        width: 0;
        height: 0;
        border-top: 10px solid gray;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        margin-left:14px;
    }

    /* 向上箭头 */

    .to_top {
        width: 0;
        height: 0;
        border-bottom: 10px solid gray;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        margin-left:14px;
    }


	</style>
</head>
<body>
	<table border='0' cellspacing='0px' align='center' class="main" width="800px">
		<tr height="60px">
<!--			<th>选择</th>-->
            <th>商品图片</th>
			<th>商品信息</th>
			<th>单价</th>
			<th>数量</th>
			<th>金额</th>
			<th>操作</th>
		</tr>

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
        if (!session_id()) session_start();
        if(!isset($_SESSION["name"]))
        {
            header("location:goodlist.php?message=NotRegister!&page=$page");
            return;
        }
        $sql="select * from usergood where name='".$_SESSION["name"]."'";
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
            $max=mysqli_num_rows($result);
            $sum=0;
            while($attr=mysqli_fetch_array($result))
            {



                $sql1="select * from good where goodid='$attr[1]'";
                //发送sql语句
                $result1=mysqli_query($link,$sql1);
                //处理数据
                //fetch_row获取行的数据
                //mysqli_detch_assoc获取对应键值,$attr['linenum']可获取数据
                //获取字段数
                //echo mysqli_num_fields($result),"<br/>";
                //获取信息数
                //echo mysqli_num_rows($result),"<br/>";
                $attr1=mysqli_fetch_array($result1);


                    ?>
                    <!--                                showType网页-->

                <tr height="130px">
                    <td width="150px" >
<!--                        <div style="position:absolute;margin-top:30px;margin-left:10px;">-->
<!--                            <input type="checkbox">-->
<!---->
<!---->
<!--                        </div>-->
                        <a href="" style="margin-left:50px;"><img width="70px" height="70px" src="<?php echo $attr1[1]; ?>" alt="商品详细信息">
                        </a>


                    </td>
                    <td>
                        <a  href="#" class="name"><?php echo $attr1[5]; ?>
                        </a>
                    </td>

                    <td>
                        <span>￥<?php echo $attr1[3]; ?></span>
                    </td>
                    <td>
                        <p class="to_top" onclick="changeNum('changeNum.php?buyid=<?php echo $attr[0]; ?>&num=<?php echo $attr[3]+1; ?>');"></p><span class="name" onselectstart="return false;" style="font-weight:bold;"><?php echo $attr[3]; ?></span><p class="to_bottom" <?php if($attr[3]>1){?>onclick="changeNum('changeNum.php?buyid=<?php echo $attr[0]; ?>&num=<?php echo $attr[3]-1; ?>');" <?php }else { ?> style="border-top: 10px solid #ccc;" <?php } ?>></p>
                    </td>
                    <td>
                        <span class="price" onselectstart="return false;"><?php echo $attr1[3]*$attr[3]; $sum+=$attr1[3]*$attr[3];?></span>
                    </td>
                    <td>
                        <button onclick="return check('deleteUsergood.php?buyid=<?php echo $attr[0]; ?>');"  class="delete">
                            删除
                        </button>
                        <button onclick="window.location.href ='createUserbill.php?buyid=<?php echo $attr[0]; ?>'"  class="buybutton">
                            购买
                        </button>
                    </td>
                </tr>



                    <?php

            }
        }
        //关闭数据库连接
        mysqli_close($link);
        ?>





	</table>
	<div class="box" >
		<div class="son">
            <button class="clear" onclick="return checkall('deleteUsergood.php?all=1')">清空购物车</button>
			<span style="position:absolute;font-size:25px;font-weight:bold;font-family:幼圆;margin-left:550px;margin-top:5px;">合计￥<span style="color:red;"> <?php echo $sum; ?></span> </span>
            <button class="buy" onclick="window.location.href ='goodlist.php'">继续购物</button>
		</div>
	</div>
    <script type="text/javascript" language="javascript">
        function check(x)
        {
            if(confirm("确定要删除吗?"))
            {
                window.location.href = x;
                return true;
            }
            return false;

        }
        function checkall(x)
        {
            if(confirm("确定要删除购物车中全部的东西吗?"))
            {
                window.location.href = x;
                return true;
            }
            return false;
        }
        function changeNum(x)
        {

            window.location.href = x;
        }
    </script>
</body>
</html>