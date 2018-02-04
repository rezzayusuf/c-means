<?php
include 'koneksi.php';

$sql = 'truncate table data_tilang';
$hapusdb = mysql_query($sql);
if(! $hapusdb )
{
  die('Gagal hapus tabel  ' . mysql_error());
}
echo "Tabel berhasil dihapus\n";
mysql_close($koneksi);
?>