<?php
/**
 * Created by PhpStorm.
 * User: Halo
 * Date: 2019/6/7
 * Time: 22:38
 */
if (!session_id()) session_start();
$_SESSION["name"]="";
$_SESSION["type"]=0;
header("location:index.php?message=OutloginSuccess!");