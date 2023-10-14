<?= $this->extend('layouting/template') ?>

<?= $this->section('content') ?>
<div class="container">
  <div class="row">
    <div class="col">
      <h3 class="text-center">Edit Catatan</h3>
      <?php if (isset($validation)) : ?>
        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
      <?php endif; ?>

      <form id="edit-form" method="POST" action="/api/notes/<?= $note['note_id']; ?>">
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
          <label for="title">Judul:</label>
          <input type="text" name="title" class="form-control" value="<?= $note['title'] ?>" required>
        </div>

        <div class="form-group">
          <label for="note">Isi Catatan:</label>
          <textarea name="note" class="form-control" rows="4" required><?= $note['note'] ?></textarea>
        </div>

        <div class="mt-2">
          <div class="float-start">
            <a href="/api/notes/">
              << Batal</a>
          </div>
          <div class="float-end">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>
<?= $this->endSection() ?>