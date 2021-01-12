<div class="modal" id="daftar_pasien_baru">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content" style="border: 0;">

      <div class="modal-header bg-primary text-white">
        <h2 class="modal-title">Form Daftar Periksa Pasien Baru</h2>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
              
      <div class="modal-body">
        <h4>Identitas Diri Pasien</h4>
        <br/>
        <form role="form" action="#" method="POST">
          <div class="form-row">
              <!-- hidden -->
              <input type="hidden" name="id_pasien" value="<?php echo $Pasien->getNewId(); ?>">
              <div class="form-group col-md-6">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control bg-light" name="nama" placeholder="Nama Lengkap">
              </div>
              <div class="form-group col-md-6">
                <label>NIK</label>
                <input type="text" class="form-control bg-light" name="nik" placeholder="NIK">
              </div>
              <div class="form-group col-md-6">
                <label>Tempat Tanggal Lahir</label>
                <input type="text" class="form-control bg-light" name="tempat_tanggal_lahir" placeholder="Tempat Tanggal Lahir">
              </div>
              <div class="form-group col-md-6">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control bg-light">
                  <option value="laki">Laki - Laki</option>
                  <option value="perempuan">Perempuan</option>
                </select>
              </div>
              <div class="form-group col-md-12">
                <label>Alamat</label>
                <textarea class="form-control bg-light" name="alamat" rows="3" placeholder="Alamat"></textarea>
              </div>
              <div class="form-group col-md-6">
                <label>Nomor Telepon</label>
                <input type="text" class="form-control bg-light" name="no_telpon" placeholder="Nomor Telepon">
              </div>
              <div class="form-group col-md-6">
                <label>Golongan Darah</label>
                <select name="gol_darah" class="form-control bg-light">
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="AB">AB</option>
                  <option value="O">O</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label>Kepala Keluarga</label>
                <input type="text" class="form-control bg-light" name="kepala_keluarga" placeholder="Nama Kepala Keluarga">
              </div>
              <div class="form-group col-md-12">
                <h4>Periksa Poli</h4>
              </div>
              <!-- hidden form -->
              <input type="hidden" name="id_jadwal_periksa" value="<?php echo $Jadwal_Periksa->getNewId(); ?>">
              <div class="form-group col-md-6">
                <label>No Antrian</label>
                <input type="text" class="form-control bg-light" name="nomor_antrian" value="<?php echo $Jadwal_Periksa->getNewAntrian(); ?>">
              </div>
              <div class="form-group col-md-6">
                <label>Tanggal Periksa</label>
                <input type="text" class="form-control bg-light" name="tgl_periksa" value="<?php echo date("Y-m-d"); ?>">
              </div>
              <div class="form-group col-md-6">
                <label>Nama Poli</label>
                <select name="id_poli" class="form-control bg-light">
                  <option selected disabled>Choose...</option>
									<?php $no=1; $polis = $Poli->readAll(); while ($row = $polis->fetch(PDO::FETCH_ASSOC)) : ?>
										<option value="<?=$row['id_poli']?>"><?=$row['nama_poli']?></option>
									<?php endwhile; ?>
                </select>
              </div>
              <div class="form-group col-md-12">
                <label>Gejala Penyakit</label>
                <textarea class="form-control bg-light" name="gejala_penyakit" rows="3" placeholder="Gejala Penyakit"></textarea>
              </div>
              <div class="form-group col-md-6">
                <label>Berat Badan (KG)</label>
                <input type="number" class="form-control bg-light" name="berat_badan" placeholder="Berat Badan">
              </div>
              <div class="form-group col-md-6">
                <label>Tinggi Badan (CM)</label>
                <input type="number" class="form-control bg-light" name="tinggi_badan" placeholder="Tinggi Badan">
              </div>
          </div>
          <button type="submit" class="btn btn-primary float-right" data="modal">Daftar</button>
        </form>
      </div>

    </div>
  </div>
</div>