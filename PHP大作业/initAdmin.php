<?php
/**
 * Created by PhpStorm.
 * User: Halo
 * Date: 2019/6/8
 * Time: 1:17
 */
if (!session_id()) session_start();
if(isset($_SESSION["type"]))
{
    if($_SESSION["type"]!=2)
    {
        header("location:goodlist.php?message=NotAdmin!");
    }
    else header("location:manager.html");

}
else header("location:goodlist.php?message=NotAdmin!");
?>