<?php require_once("config.php"); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Berobat</title>
	
    <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="plugins/datatables/jquery.dataTables.min.css" rel="stylesheet">
	<link href="plugins/bootstrap/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
	
	<script src="plugins/jquery/jquery-3.2.1.min.js"></script>
	<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="plugins/bootstrap/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  </head>
  <body>
<div class="container">
<br /> <br />
      
	
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-info">
      <div class="panel-heading">Form Berobat</div>
      <div class="panel-body">
		<form class="form-horizontal" name="form-berobat" method="post" action="simpan.php">
		<div class="form-group">
			<label class="col-sm-4 control-label" for="notransaksi">Notransaksi</label>
			<div class="col-sm-6">
				<input id="notransaksi" type="text" class="form-control" name="notransaksi" placeholder="notransaksi">
			</div>
		</div>
		<div class="form-group">
		<label class="col-sm-4 control-label"for="tanggal">Tanggal</label>
		<div class ="col-xs-2">
			<select name="tanggal" id="tanggal" class="form-control">
					<?php
					for ($i = 1; $i < 31; $i++) 
					{
						echo "<option value='$i'>$i</option>";
					}
					?>
			</select>
		</div>
		<label class="col-sm-1 control-label"for="bulan">Bulan</label>
		<div class ="col-xs-2">
		<select name="bulan" id="bulan" class="form-control">
					<?php
					for ($i = 0; $i < 12; $i++) 
					{
						$time = strtotime(sprintf('%d months', $i)); 
						$label = date('F', $time);   
						$value = date('n', $time);
						echo "<option value='$value'>$label</option>";
					}
					?>
				</select>
		</div>
		<label class="col-sm-1 control-label"for="tahun">Tahun</label>
		<div class ="col-xs-2">
			<?php
			$year = date('Y');
			echo '<input type="text" name="tahun" id="tahun" class="form-control"  value= '.$year.'>';
			?>
		</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="pasien">Nama Pasien</label>
			<div class="col-sm-6">
				<select name="pasien" id="pasien" class="form-control">
					<?php
						$a=listpasien("");
						foreach ($a as $row) 
						{
						echo "<option value=".$row['pasienid'].">".$row['namapasien']."</option>";
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
								$a=listdokter("");
								while($row = $a->fetch(PDO::FETCH_NUM)) 
								{
								 echo "<option value=$row[0]>$row[1]</option>";
								}
							?>
						</select>
					</div>
		</div>
		
				<div class="form-group">
					<label class="col-sm-4 control-label" for="keluhan">Keluhan</label>
					<div class="col-sm-6">
						<textarea id="keluhan" type="text" class="form-control" name="keluhan" placeholder="keluhan"></textarea>
					</div>
				</div>
				
		<div class="form-group">
			<label class="col-sm-4 control-label" for="biaya">Biaya Administrasi</label>
			<div class="col-sm-6">
				<input id="biaya" type="text" class="form-control" name="biaya" placeholder="biaya">
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
</div>
</div>
<script type="text/javascript">
 $(document).on("click","#clear",function(){ 
    $('[type="text"]').val('');
 });
 $("#tahun").prop('readonly',true);
</script>
</body>
</html>