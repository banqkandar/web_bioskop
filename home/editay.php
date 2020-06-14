
      <div class="modal fade" id="deltay<?php echo $datanya['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Yakin Mau Menghapus <?php echo $datanya['judul']; ?> Dari Jadwal Tayangan ?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
          	<form action="filmeditor.php?deltay=<?php echo $datanya['id'];?>" method="post">
          	<input type="hidden" name="ozora">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Ya</button>
            </form>
          </div>
        </div>
      </div>
    </div>