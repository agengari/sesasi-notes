<?= $this->extend('auth/template') ?>

<?= $this->section('content') ?>
<div class="container">
  <div class="row justify-content-center align-items-center vh-100">
    <div class="col-6 text-center">
      <h1>Daftar Akun</h1>
      <?php if (isset($validation)) : ?>
        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
      <?php endif; ?>

      <div class="card">
        <div class="card-body">
          <?= form_open('api/register') ?>
          <div class="mb-3">
            <label for="name">Nama:</label>
            <input type="text" name="name" class="form-control" id="name" required>
          </div>
          <div class="mb-3">
            <label for="username">Nama Pengguna:</label>
            <input type="text" name="username" class="form-control" id="username" required>
          </div>
          <div class="mb-3">
            <label for="password">Kata Sandi:</label>
            <input type="password" name="password" class="form-control" id="password" required>
          </div>
          <button type="submit" class="btn btn-primary">Daftar</button>
          <?= form_close() ?>
        </div>
      </div>

      <div class="text-center">
        <a href="/login">Masuk</a>
      </div>
    </div>

    <?= $this->endSection() ?>