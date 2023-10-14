<?= $this->extend('layouting/template') ?>

<?= $this->section('content') ?>
<div class="container">
  <div class="row">
    <div class="col">
      <h3 class="text-center">Daftar Catatan</h3>
      <div class="row">
        <?php foreach ($notes as $note) : ?>
          <div class="col-lg-3 col-md-4 col-sm-6  mb-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"><?= $note['title']; ?></h5>
                <?php if (session()->get('group_id') === "1") : ?>
                  <p class="card-subtitle mb-2 text-muted"> <b>By : <?= $note['creator']; ?></b> </p>
                <?php endif; ?>
                <p class="card-text"><?= $note['note']; ?></p>
                <a href="/api/notes/<?= $note['note_id']; ?>" class="btn btn-success badge">Lihat</a>
                <a href="/notes/<?= $note['note_id']; ?>/edit" class="btn btn-warning badge">Ubah</a>
                <form method="POST" action="/api/notes/<?= $note['note_id']; ?>" class="d-inline">
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="btn btn-danger badge">Hapus</button>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
      <a href="/notes/create" class="btn btn-primary float-end">Buat Catatan Baru</a>
    </div>
  </div>
</div>
<?= $this->endSection() ?>