<?php
 //fitur update kamar aplicare ini adalah penyempurnaan dari kontribusi Mas Tirta dari RSUK Ciracas Jakarta Timur
 session_start();
 require_once('conf/conf.php');
  require_once('updateaplicare.php');
 header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
 header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT"); 
 header("Cache-Control: no-store, no-cache, must-revalidate"); 
 header("Cache-Control: post-check=0, pre-check=0", false);
 header("Pragma: no-cache"); // HTTP/1.0
 date_default_timezone_set("Asia/Bangkok");
 $tanggal= mktime(date("m"),date("d"),date("Y"));
 $jam=date("H:i");
?>


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/default.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="conf/validator.js"></script>
    <meta http-equiv="refresh" content="100"/>


    <!-- Bootstrap Core CSS -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="asset/css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="asset/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    




    

            
               
                    
               
                
           
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                
         
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                  <div class="col-lg-12">
                        <h1 align="middle" class="page-header">
                          
                        </h1>
						<?php $dates = Date("d-m-Y ");  echo date('d F Y', strtotime($dates));?>
						
						<div class "row">
						
						
							<div class="col-lg-12">
							<div id="kunjungan" >
							<?php 
						$hari=getOne("select DAYNAME(current_date())");
                        $namahari="";
                        if($hari=="Sunday"){
                        $namahari="AKHAD";
                      }else if($hari=="Monday"){
                        $namahari="SENIN";
                      }else if($hari=="Tuesday"){
                        $namahari="SELASA";
                      }else if($hari=="Wednesday"){
                        $namahari="RABU";
                      }else if($hari=="Thursday"){
                        $namahari="KAMIS";
                      }else if($hari=="Friday"){
                        $namahari="JUMAT";
                      }else if($hari=="Saturday"){
                        $namahari="SABTU";
                      }
						
						$jumlah=array();
						$poli=array();
						$date = Date("Y-m-d "); 
						$sql = "select poliklinik.nm_poli, count(*) as jumlah from reg_periksa INNER JOIN poliklinik on reg_periksa.kd_poli=poliklinik.kd_poli WHERE reg_periksa.tgl_registrasi='$date' group by reg_periksa.kd_poli  order by count(*) desc ";
						$hasil=bukaquery($sql);

						while ($data = mysqli_fetch_array ($hasil)){
                        
                            $jumlah[]=intval($data['jumlah']);
                            $poli[]= $data['nm_poli'];
                        }
							updateAplicare();				
						?>
						
							<script src="js/highcharts.js"></script>
                            <script src="modules/exporting.js"></script>
							<script type="text/javascript">
							Highcharts.chart('kunjungan', {
								chart: {
									type: 'area'
									},
								title: {
									text: 'Grafik Kunjungan Pasien Hari Ini'
								},
								subtitle: {
									text: <?=json_encode($dates);?>
								},
								xAxis: {
								categories: <?=json_encode($poli);?> ,
								
								title: {
									enabled: false
									}
								},
								yAxis: {
									title: {
									text: 'Jumlah Pasien'
									},
									labels: {
										formatter: function () {
											return this.value;
										}
									}
								},
								tooltip: {
									split: true,
									valueSuffix: ''
								},
								plotOptions: {
									area: {
								stacking: 'normal',
									lineColor: '#FFFFFF',
									lineWidth: 1,
								marker: {
									lineWidth: 1,
									lineColor: '#FFFFFF'
									}
								}
							},
							series: [{
								name: 'Poliklinik',
								data: <?=json_encode($jumlah);?>
								}]
							});		
							</script>
							
							
							</div>
								
						
							
							
							</div>
						</div>
                    
                <!-- /.row -->

           

   

   
    

   



