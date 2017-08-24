<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List Berobat</title>
	
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

	<h2>List Berobat</h2>
	<br />
	<button id="add" name="add" class="btn btn-success" onclick="locate()">Tambah Data</button>
	<br /><br />

  <table id="listberobat" class="table table-striped" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Notransaksi</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Usia</th>
                <th>Jenis Kelamin</th>
                <th>Nama Poli</th>
				<th>Nama Dokter</th>
				<th>Action</th>
            </tr>
   </thead>
   <tbody>
            <?php
			include("config.php");
			$q = listberobat();
			while($r = $q->fetch(PDO::FETCH_NUM))
			{
				echo "<tr >
						<td> $r[0]</td>
						<td> $r[1]</td>
						<td> $r[2]</td>
						<td> $r[3]</td>
						<td> $r[4]</td>
						<td> $r[5]</td>
						<td> $r[6]</td>
						<td>
						  <a href='edit.php?no=".$r[0]."'>
						  <button id='edit' name='edit' class='btn btn-info btn-sm'>Edit </button>
						  </a>
						  
						  <a onclick=\"return confirm('hapus data ini ?');\"  href='delete.php?no=".$r[0]."'>
						  <button id='delete' name='delete' class='btn btn-danger btn-sm'>Delete </button>
						  </a>
						  
						</td>
					 </tr>";	
            }
			?>
    </tbody>
    </table>
	
	
</div>

<script>
function locate()
{
     location.href = "addberobat.php";
}
$(document).ready(function() {
    $('#listberobat').DataTable();
} );
</script>
   </body>
</html>