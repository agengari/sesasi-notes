<?= $this->extend('layouting/template') ?>

<?= $this->section('content') ?>
<div class="container">
  <div class="row">
    <div class="col">
      <h3 class="text-center">Buat Catatan Baru</h3>
      <?php if (isset($validation)) : ?>
        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
      <?php endif; ?>

      <?= form_open('api/notes/') ?>
      <input type="hidden" name="user_id" value="<?= session()->get('user_id') ?>">
      <div class="form-group">
        <label for="title">Judul:</label>
        <input type="text" name="title" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="note">Isi Catatan:</label>
        <textarea name="note" class="form-control" rows="4" required></textarea>
      </div>


      <div class="mt-2">
        <div class="float-start">
          <a href="/api/notes/">
            << Batal</a>
        </div>
        <div class="float-end">
          <button type="submit" class="btn btn-primary">Simpan Catatan</button>
        </div>
      </div>

      <?= form_close() ?>
    </div>
  </div>
</div>
<?= $this->endSection() ?>