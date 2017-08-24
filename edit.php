<?php
include("config.php");
if(isset($_GET['no']))
{
	$no = $_GET['no'];
	$data = getdata($no);
	var_dump($data);
	
	if($data)
	{
		$kode = $data['notransaksi'];
		$id = $data['pasienid'];
		$tanggal = $data['tanggal_berobat'];
		$dokter = $data['dokterid'];
		$keluhan = $data['keluhan'];
		$biaya = $data['biaya_administrasi'];
	}
}
if(isset($_POST['simpan']))
{
	$no 		= htmlentities($_POST['notransaksi']);
	$pasien 	= htmlentities($_POST['pasien']);
	$date		= htmlentities($_POST['tanggal']);
	$dokter 	= htmlentities($_POST['dokter']);
	$keluhan	= htmlentities($_POST['keluhan']);
	$biaya 		= htmlentities($_POST['biaya']);
	
	$result = changedata($no,$pasien,$date,$dokter,$keluhan,$biaya);
	header("location: listberobat.php");
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Berobat</title>
	
    <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="plugins/datatables/jquery.dataTables.min.css" rel="stylesheet">
	<link href="plugins/bootstrap/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
	
	<script src="plugins/jquery/jquery-3.2.1.min.js"></script>
	<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="plugins/bootstrap/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  </head>
  <body>
 <body>
<div class="container">
<br /> <br />

<div class="row">
  <div class="col-md-8">
    <div class="panel panel-info">
      <div class="panel-heading">Update Form</div>
      <div class="panel-body">
		<form class="form-horizontal" name="form-berobat" method="post" action="">
		<div class="form-group">
			<label class="col-sm-4 control-label" for="notransaksi">Notransaksi</label>
			<div class="col-sm-6">
				<input id="notransaksi" type="text" class="form-control" name="notransaksi" placeholder="notransaksi" value="<?php echo $kode; ?>">
			</div>
		</div>
		<div class="form-group has-feedback">
			<label class="col-sm-4 control-label" for="tanggal">Tanggal</label>
			<div class="col-sm-4">
				<input id="tanggal" type="text" class="form-control" name="tanggal" value="<?php echo $tanggal; ?>">
				<i class="glyphicon glyphicon-calendar form-control-feedback"></i>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="pasien">Nama Pasien</label>
			<div class="col-sm-6">
				<select name="pasien" id="pasien" class="form-control">
					<?php
						$stmt = listpasien();
						foreach ($stmt as $row) 
						{
							$selected = ($row['pasienid'] == $id ) ? ' selected' : '';
							echo "<option value='" . $row['pasienid'] . "'" . $selected . ">" . $row['namapasien'] . "</option>";
						}
					?>
      
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-4 control-label" for="dokter">Nama Dokter</label>
			<div class="col-sm-6">
				<select name="dokter" id="dokter" class="form-control">
					<?php
						$stmt = listdokter();
						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
						{
							$selected = ($row['dokterid'] == $dokter ) ? ' selected' : '';
							echo "<option value='" . $row['dokterid'] . "'" . $selected . ">" . $row['namadokter'] . "</option>";
						}
					?>
      
				</select>
			</div>
		</div>
		
		<div class="form-group">
					<label class="col-sm-4 control-label" for="keluhan">Keluhan</label>
					<div class="col-sm-6">
						<textarea id="keluhan" type="text" class="form-control" name="keluhan" placeholder="keluhan"><?php echo $keluhan; ?></textarea>
					</div>
				</div>
				
		<div class="form-group">
			<label class="col-sm-4 control-label" for="biaya">Biaya Administrasi</label>
			<div class="col-sm-6">
				<input id="biaya" type="text" class="form-control" name="biaya" placeholder="biaya" value="<?php echo $biaya; ?>">
			</div>
		</div>
		<div class="col-md-12 text-center"> 
			<button id="simpan" name="simpan" class="btn btn-success">Submit</button> 
			<input type="button" id="clear" name="clear" class="btn btn-primary" value="Clear">
		</div>
		</form>
		</div>
	</div>
</div>
<div>
</div>
<script type="text/javascript">
$('#tanggal').datepicker({
    format: 'yyyy-mm-dd',
	autoclose: true
});
$(document).on("click","#clear",function(){ 
    $('[type="text"]').val('');
 });
</script>
  </body>
</html>