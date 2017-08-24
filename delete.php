<?php
include("config.php");
$no = $_GET['no'];
if(isset($no));
{
	$result=hapus($no);
	header("location: listberobat.php");
}
	