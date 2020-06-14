      <div class="modal fade" id="edfilm<?php echo $x['id_film']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Film <?php echo $x['judul']; ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body"><form method="post" action="filmeditor.php?gud=<?php echo $x['id_film']; ?>"><div class="form-group">
                <label for="nama" class="col-sm-12 control-label">Judul Film :</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="judul" value="<?php echo $x['judul']; ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-12 control-label">Tanggal Rilis :</label>
                <div class="col-sm-12">
                  <input class="form-control" type="date" name="rilis" value="<?php echo $x['tgl_rilis']; ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-12 control-label">Nama Pemain :</label>
                <div class="col-sm-12">
                  <input class="form-control" type="text" name="artis" value="<?php echo $x['artis']; ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-12 control-label">Durasi (Menit) :</label>
                <div class="col-sm-12">
                  <input type="number" class="form-control" value="<?php echo $x['durasi']; ?>" name="durasi" required>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-12 control-label">Sinopsis :</label>
                <div class="col-sm-12">
                  <textarea class="form-control" style="resize:vertical;" name="sinopsis" required><?php echo $x['sinopsis']; ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-12 control-label">Link Trailer :</label>
                <div class="col-sm-12">
                  <input class="form-control" type="url" name="link" value="<?php echo $x['trailer']; ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-12 control-label">Batasan Umur :</label>
                <div class="col-sm-12">
                    <select class="form-control" name="batas">
                        <option value="BO">Bimbingan Orang Tua</option>
                        <option value="R">Remaja</option>
                        <option value="D">Dewasa</option>
                        <option value="SU">Semua Umur</option>
                    </select>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-12 control-label">Produksi :</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="perusahaan" value="<?php echo $x['produksi']; ?>" required>
                </div>
              </div></div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">EDIT</button>
          </div>
          </form>
        </div>
      </div>
    </div>