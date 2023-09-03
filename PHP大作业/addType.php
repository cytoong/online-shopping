<?php
/**
 * Created by PhpStorm.
 * User: Halo
 * Date: 2019/6/7
 * Time: 23:06
 */
if(!empty($_GET)) {
    if(isset($_GET["message"]))
    {
        $message = $_GET["message"];
        echo "<script>alert('$message');</script>";

    }

}

if (!session_id()) session_start();
if(isset($_SESSION["type"]))
{
    if($_SESSION["type"]!=2)
    {
        header("location:goodlist.php?message=NotAdmin!");
        return;
    }

}
else{
    header("location:goodlist.php?message=NotAdmin!");
    return;
}

?>
<h3 style="color:green;text-align:center">添加商品类别</h3>
<form action="addTypeHandle.php" method="post">
    <table align="center" border="1" cellspacing="0">
        <tr>
            <th>商品类别名称：</th>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
            <td align="center" colspan="2"><input type="submit" value="提交">&nbsp;<input type="reset" value="重写"></td>
        </tr>
    </table>
</form>
