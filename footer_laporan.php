<!-- Footer Laporan -->
<!-- <div> -->
		  <?php
		  function tanggal_laporan($tanggal)
				{
					$bulan = array (1 =>   'Januari',
								'Februari',
								'Maret',
								'April',
								'Mei',
								'Juni',
								'Juli',
								'Agustus',
								'September',
								'Oktober',
								'November',
								'Desember'
							);
					$split = explode('-', $tanggal);
					return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
				}
		  ?>
          <div class="print-show" align="right">
            <hr>
            <p>Jakarta, <?php echo tanggal_laporan(date("Y-m-d")) ?></p>
            <br><br><br>
            <p>Ir. Bambang Sutopo</p>
          </div>