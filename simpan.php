<?php
include("config.php");
if(isset($_POST['simpan']))
{
	$no 		= htmlentities($_POST['notransaksi']);
	$pasien 	= htmlentities($_POST['pasien']);
	$date		= htmlentities($_POST['tahun']."-".$_POST['bulan']."-".$_POST['tanggal']);
	$dokter 	= htmlentities($_POST['dokter']);
	$keluhan	= htmlentities($_POST['keluhan']);
	$biaya 		= htmlentities($_POST['biaya']);
	
	$result = simpan($no,$pasien,$date,$dokter,$keluhan,$biaya);
	header("location: listberobat.php");
}