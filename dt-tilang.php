<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Data Tilang - Searching Your Data</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendor/devicons/css/devicons.min.css" rel="stylesheet">
    <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/resume.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-block d-lg-none">Searching</span>
        <span class="d-none d-lg-block">
          <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="img/profile1.png" alt="">
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="index.php">Sequential Searching</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="is.php">Interpolation Searching</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid p-0">

      <section class="resume-section p-3 p-lg-5 d-flex d-column" id="#">
        <div class="my-auto">
          <h1 class="mb-0">Data
            <span class="text-primary">Tilang</span>
          </h1>
          <div class="subheading mb-5">Silahkan Cari Data Anda Pada Form di Bawah ini !
            <a href="#">SEQUENTIAL SEARCHING</a>            
          </div>         
          <header class="panel-heading">
                              Silahkan Ambil Data Tilang dari folder anda (format .xls 2003)
                                  </header>
                            <section class="panel">
                              <div class="panel-body">
                                  <?php
                                //koneksi ke database, username,password  dan namadatabase menyesuaikan 
                                mysql_connect('localhost', 'root', '');
                                mysql_select_db('searching');
                                 
                                //memanggil file excel_reader
                                require "excel_reader.php";
                                 
                                //jika tombol import ditekan
                                if(isset($_POST['submit'])){
                                 
                                    $target = basename($_FILES['status']['name']) ;
                                    move_uploaded_file($_FILES['status']['tmp_name'], $target);
                                 
                                // tambahkan baris berikut untuk mencegah error is not readable
                                    chmod($_FILES['status']['name'],0777);
                                    
                                    $data = new Spreadsheet_Excel_Reader($_FILES['status']['name'],false);
                                    
                                //    menghitung jumlah baris file xls
                                    $baris = $data->rowcount($sheet_index=0);
                                    
                                //    jika kosongkan data dicentang jalankan kode berikut
                                    $drop = isset( $_POST["drop"] ) ? $_POST["drop"] : 0 ;
                                    if($drop == 1){
                                //             kosongkan tabel pegawai
                                             $truncate ="TRUNCATE TABLE data_tilang";
                                             mysql_query($truncate);
                                    };
                                    
                                //    import data excel mulai baris ke-2 (karena tabel xls ada header pada baris 1)
                                    for ($i=3; $i<=$baris; $i++)
                                    {
                                //       membaca data (kolom ke-1 sd terakhir)
                                      $nomor_registrasi           = $data->val($i, 1);
                                      $tgl_perkara   = $data->val($i, 2);
                                      $form  = $data->val($i, 3);
                                      $nama  = $data->val($i, 4);
                                      $pasal  = $data->val($i, 5);
                                      $barang_bukti  = $data->val($i, 6);
                                      $jenis_kendaraan  = $data->val($i, 7);
                                      $nomor_polisi  = $data->val($i, 8);
                                      $tanggal_sidang  = $data->val($i, 9);
                                      $denda  = $data->val($i, 10);
                                      $ongkos_perkara  = $data->val($i, 11);
                                      $tanggal_bayar  = $data->val($i, 12);
                                 
                                //      setelah data dibaca, masukkan ke tabel pegawai sql
                                      $query = "INSERT into data_tilang(nomor_registrasi, tgl_perkara, form, nama, pasal, barang_bukti, jenis_kendaraan, nomor_polisi, tanggal_sidang, denda, ongkos_perkara, tanggal_bayar) values('$nomor_registrasi', '$tgl_perkara', '$form', '$nama', '$pasal', '$barang_bukti', '$jenis_kendaraan', '$nomor_polisi', '$tanggal_sidang', '$denda', '$ongkos_perkara', '$tanggal_bayar')";
                                      $hasil = mysql_query($query);
                                    }
                                    
                                    if(!$hasil){
                                //          jika import gagal
                                          die(mysql_error());
                                      }else{
                                //          jika impor berhasil
                                          echo "Data berhasil diimpor.";
                                    }
                                    
                                //    hapus file xls yang udah dibaca
                                    unlink($_FILES['status']['name']);
                                }
                                 
                                ?>
                                 
                                <form name="myForm" id="myForm" onSubmit="return validateForm()" action="dt-tilang.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">              
                                        <input type="file" id="status" name="status" />                                    
                                    </div>
                                    <div class="form-group">                                    
                                        <input class="btn btn-xs btn-success" type="submit" name="submit" value="Import">
                                    </div>
                                        <label><input type="checkbox" name="drop" value="1" /> <u>Kosongkan tabel sql terlebih dahulu.</u> </label>
                                </form>
                                <p>                                                                    
                                  <a href="truncate.php" class="btn btn-xs btn-success">
                                      reset
                                  </a>                                                                     
                                  <a href="export.php" target="_blank" class="btn btn-xs btn-success">Download</a>
                                  
                                 
                                <script type="text/javascript">
                                //    validasi form (hanya file .xls yang diijinkan)
                                    function validateForm()
                                    {
                                        function hasExtension(inputID, exts) {
                                            var fileName = document.getElementById(inputID).value;
                                            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
                                        }
                                 
                                        if(!hasExtension('status', ['.xls'])){
                                            alert("Hanya file XLS (Excel 2003) yang diijinkan.");
                                            return false;
                                        }
                                    }
                                </script>                                                           

                                                                   
                              </div>
                          </section>
                                            <?php  
                                            include "koneksi.php";                                           
                                             
                                            $sql5 = "SELECT * from data_tilang";
                                            $sql1 = "SELECT nama, denda, count(denda) as jumlah from data_tilang group by denda order by jumlah DESC";
                                            $sql2 = "SELECT nama, denda, tanggal_sidang, count(tanggal_sidang) as jumlah from data_tilang group by tanggal_sidang order by jumlah DESC";


                                            
                                        ?>                                  
                                        <?php
                                        // $sql5 = "SELECT * from data_tilang where id='$id' ";
                                        $hasil5 = mysql_query($sql5);
                                        $hasil6 = mysql_query($sql1);
                                        $hasil7 = mysql_query($sql2);
                                                                                                          
                                        $result6 = mysql_fetch_array($hasil6);
                                        echo "Denda Yang Paling banyak di langgar adalah : Rp "; echo $result6['denda'];
                                        echo "<p>";
                                        echo "Jumlah Orang : "; echo $result6['jumlah'];
                                        echo "<p>";
                                        $result7 = mysql_fetch_array($hasil7);
                                        echo "Tanggal Sidang : "; echo $result7['tanggal_sidang'];                                        

                        echo "<table class='table table-striped table-advance table-hover'>
                            <tbody>
                              <tr>                         
                                 <th><i class=''></i>ID</th>                                                              
                                 <th><i class=''></i>NO REG</th>                                
                                 <th><i class=''></i>TGL PERKARA</th>                                                      
                                 <th><i class=''></i>FORM</th>                                                      
                                 <th><i class=''></i>NAMA</th>                                  
                                 <th><i class=''></i>PASAL</th>                                  
                                 <th><i class=''></i>BARANG BUKTI</th>                                                      
                                 <th><i class=''></i>JENIS KENDARAAN</th>            
                                 <th><i class=''></i>NOMOR POL</th>                                                      
                                 <th><i class=''></i>DENDA</th>                                                      
                                 <th><i class=''></i>TANGGAL SIDANG</th>                                                      
                              </tr>";
                              $no=1;
                        while($result5 = mysql_fetch_array($hasil5)){
                            $id     = $result5['id'];
                            $nomor_registrasi    = $result5['nomor_registrasi'];
                            $tgl_perkara  = $result5['tgl_perkara'];
                            $form  = $result5['form'];
                            $nama  = $result5['nama'];
                            $pasal  = $result5['pasal'];
                            $barang_bukti  = $result5['barang_bukti'];                            
                            $jenis_kendaraan  = $result5['jenis_kendaraan'];
                            $nomor_polisi  = $result5['nomor_polisi'];
                            $tanggal_sidang  = $result5['tanggal_sidang'];
                            $denda  = $result5['denda'];
                            $ongkos_perkara  = $result5['ongkos_perkara'];
                            $tanggal_bayar  = $result5['tanggal_bayar'];

                        echo
                            "<tr>
                                <td>$id</td>
                                <td>$nomor_registrasi</td>
                                <td>$tgl_perkara</td>                         
                                <td>$form</td>                         
                                <td>$nama</td>                                                
                                <td>$pasal</td>                                                
                                <td>$barang_bukti</td>                         
                                <td>$jenis_kendaraan</td>                         
                                <td>$nomor_polisi</td>                                   
                                <td>$denda</td>                                                                                       
                                <td>$tanggal_sidang</td>                                                                                       
                            </tr>
                            ";
                            $no++;

                        }

                        
                                        
                        echo "
                        </table>
                        </tbody>";  
                       
                                      
                      ?>
                                         
        </div>
      </section>


    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/resume.min.js"></script>

  </body>

</html>
