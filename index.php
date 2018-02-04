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
            <a class="nav-link js-scroll-trigger" href="#about">Sequential Searching</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="is.php">Interpolation Searching</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid p-0">

      <section class="resume-section p-3 p-lg-5 d-flex d-column" id="about">
        <div class="my-auto">
          <h1 class="mb-0">Data
            <span class="text-primary">Tilang</span>
          </h1>
          <div class="subheading mb-5">Silahkan Cari Data Anda Pada Form di Bawah ini !
            <a href="#">SEQUENTIAL SEARCHING</a>
          </div>
          <form enctype="multipart/form-data" method="post" action="" >
                                            <div class="form-group">

                                        <?php 
                                        $time = microtime();
                                        $time = explode(' ', $time);
                                        $time = $time[1] + $time[0];
                                        $start = $time;
                                         ?> 
                                            <?php                                             
                                              include "koneksi.php";
                                              
                                              $sql= "SELECT * FROM data_tilang order by id ASC";
                                              $result = mysql_query($sql);

                                              echo "<label>Nama</label>
                                                  <div class='col-lg-13'>
                                                      <select class='form-control' type='text' name='id'>";
                                            while ($record = mysql_fetch_array($result)) {
                                              $id   = $record['id'];
                                              $nama   = $record['nama'];

                                              echo "<option value='$id'>$nama</option>";                         
                                           }
                                             ?>  
                                             </select> 
                                             </div>                                                         
                                            </div>    
                                            <div class="form-group">
                                                <a href=""></a>
                                                <button class="btn btn-success">SEQUENTIAL SEARCHING</button></a>                                            
                                            </div>
                                            </form> 
                                            <div class="form-group">                                            
                                            <a href="dt-tilang.php">
                                                <button class="btn btn-success">LIHAT DATA TILANG</button></a>    
                                            </div>

                                            <?php                                              
                                            if (isset($_POST['id'])) {
                                            
                                            $id=$_POST['id'];  
                                            $sql5 = "SELECT * from data_tilang where id='$id' ";
                                        


                                            
                                        ?>                                  
                                        <?php
                                        // $sql5 = "SELECT * from data_tilang where id='$id' ";
                                        $hasil5 = mysql_query($sql5);
                            
                                                                   
                                        $arr = array($hasil5);
                                        $x = $_POST['id'];
                                        $arr[] = $x;
                                        $index = 0;

                                        while ($arr[$index++] != $x) {
                                          if ($index &&  count($arr)) {
                                            echo "Data Pencarian dengan id = $x  ! </br>";
                                            
                                          }else{
                                            echo "The Value $x not found";
                                          }
                                        }
                                   

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
                                 <th><i class=''></i>ACTION</th>                                                      
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
                                <td>
                                  <div class='btn-group'>                                      
                                      <a class='btn btn-success' data-toggle='modal' href='#'><i class='icon_check_alt2'>Detail</i></a>                                     
                                  </div>
                                </td>                       
                            </tr>
                            ";
                            $no++;

                        }

                        
                                        
                        echo "
                        </table>
                        </tbody>";  
                        $time = microtime();
                                            $time = explode(' ', $time);
                                            $time = $time[1] + $time[0];
                                            $finish = $time;
                                            $total_time = round(($finish - $start), 4);
                                            echo "Proses Pencarian Selesai Dalam ".$total_time." detik";                         
                                      }else{
                                        echo "Data Belum di Pilih";
                                      }
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
