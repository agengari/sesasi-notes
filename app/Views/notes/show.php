<?= $this->extend('layouting/template') ?>

<?= $this->section('content') ?>
<div class="container">
  <div class="row">
    <div class="col">
      <h3 class="text-center">Detail Catatan</h3>
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?= $note['title']; ?></h5>
          <p class="card-text"><?= $note['note']; ?></p>
          <div>
            <div class="float-start">
              <a href="/api/notes/">
                << Kembali</a>
            </div>
            <div class="float-end">
              <a href="/notes/<?= $note['note_id']; ?>/edit" class="btn btn-warning badge">Ubah</a>
              <form method="POST" action="/api/notes/<?= $note['note_id']; ?>" class="d-inline">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger badge">Hapus</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<?= $this->endSection() ?>