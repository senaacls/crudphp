<?php
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "klinik");
define("DB_HOST", "localhost");

try {
    $conn = new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_DATABASE, DB_USER, DB_PASSWORD); 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
	
function listpasien()
{
	global $conn;
	
	$sql = "select * from pasien ";
	$stmt = $conn->prepare($sql);
	
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	return $result;
}

function listdokter()
{
	global $conn;
	
	$sql = "select * from dokter ";
	$stmt = $conn->prepare($sql);
	
	$stmt->execute();
	
	return $stmt;
}

function listberobat()
{
	global $conn;
	
	$sql = "select * from listberobat ";
	$stmt = $conn->prepare($sql);
	
	$stmt->execute();
	return $stmt;
}

function getdata($no)
{
	global $conn;
	
	$sql = "select *  from berobat WHERE notransaksi =  :no";
	$stmt = $conn->prepare($sql);
	$stmt->execute(array(":no"=>$no));
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
	return $result;
}

function simpan($no,$id,$date,$dokterid,$keluhan,$biaya)
{
	global $conn;
	
	$sql = "insert into berobat(notransaksi,pasienid,tanggal_berobat,dokterid,keluhan,biaya_administrasi) ";
	$sql .= " values(?,?,?,?,?,? )";
	
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(1, $no);
	$stmt->bindParam(2, $id);
	$stmt->bindParam(3, $date);
	$stmt->bindParam(4, $dokterid);
	$stmt->bindParam(5, $keluhan);
	$stmt->bindParam(6, $biaya);

	$stmt->execute();
	
	return true;
}

function hapus($no)
{
	global $conn;
	
	$sql = "delete from berobat where notransaksi =  :no";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':no', $no);   
	$stmt->execute();

	return true;
}

function changedata($no,$id,$date,$dokterid,$keluhan,$biaya)
{
	global $conn;
	
	$sql = " update berobat set pasienid =:id,tanggal_berobat =:tanggal, dokterid =:dokter, keluhan =:keluhan, biaya_administrasi =:biaya ";
	$sql .= " where notransaksi =:no ";
	
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":id", $id);
	$stmt->bindParam(":tanggal", $date);
	$stmt->bindParam(":dokter", $dokterid);
	$stmt->bindParam(":keluhan", $keluhan);
	$stmt->bindParam(":biaya", $biaya);
	$stmt->bindParam(":no", $no);
	
	$stmt->execute();
	
	return true;
}

?>