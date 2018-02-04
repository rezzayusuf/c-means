<?php

# MEMBUAT KONEKSI KE DATABASE
mysql_connect('localhost',"root",'');
mysql_select_db('searching');

# MENGAMBIL DATA DARI DATABASE MYSQL
$siswa = mysql_query("SELECT * FROM data_tilang ORDER BY id ASC");


/** Include PHPExcel */
require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Mastrayasa")
							->setLastModifiedBy("Mastrayasa")
							->setTitle("Data Siswa")
							->setSubject("Siswa")
							->setDescription("Data siswa tahun ajaran 2015/2016")
							->setKeywords("sibangStudio PHPExcel php")
							->setCategory("Umum");
// mulai dari baris ke 2
$row = 2;

// Tulis judul tabel
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$row, 'id')
            ->setCellValue('B'.$row, 'nomor_registrasi')
            ->setCellValue('C'.$row, 'tgl_perkara')
            ->setCellValue('D'.$row, 'form')
            ->setCellValue('E'.$row, 'nama')
            ->setCellValue('F'.$row, 'pasal')
            ->setCellValue('G'.$row, 'barang_bukti')
            ->setCellValue('H'.$row, 'jenis_kendaraan')
            ->setCellValue('I'.$row, 'nomor_polisi')
            ->setCellValue('J'.$row, 'tanggal_sidang')
            ->setCellValue('K'.$row, 'denda')
            ->setCellValue('L'.$row, 'ongkos_perkara')
            ->setCellValue('M'.$row, 'tanggal_bayar');


$row++; // pindah ke row bawahnya. (ke row 2)

// lakukan perulangan untuk menuliskan data siswa
while( $data = mysql_fetch_array($siswa)){
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$row, $data['id']  )
            ->setCellValue('B'.$row, $data['nomor_registrasi'] )
            ->setCellValue('C'.$row, $data['tgl_perkara'] )
            ->setCellValue('D'.$row, $data['form'] )
            ->setCellValue('E'.$row, $data['nama'] )
            ->setCellValue('F'.$row, $data['pasal'] )
            ->setCellValue('G'.$row, $data['barang_bukti'] )
            ->setCellValue('H'.$row, $data['jenis_kendaraan'] )
            ->setCellValue('I'.$row, $data['nomor_polisi'] )
            ->setCellValue('J'.$row, $data['tanggal_sidang'] )
            ->setCellValue('K'.$row, $data['denda'] )
            ->setCellValue('L'.$row, $data['ongkos_perkara'] )
            ->setCellValue('M'.$row, $data['tanggal_bayar'] );             
			
	$row++; // pindah ke row bawahnya ($row + 1)
	
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('data_tilang');

// Set sheet yang aktif adalah index pertama, jadi saat dibuka akan langsung fokus ke sheet pertama
$objPHPExcel->setActiveSheetIndex(0);




// Simpan ke Excel 2007
/* $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('data.xlsx'); */

// Simpan ke Excel 2003
/* $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('data.xls'); */


// Download (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="data.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 

$objWriter->save('php://output');
exit;


/* 
// Download (Excel2003)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="data.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 

$objWriter->save('php://output');
exit;
 */
?>