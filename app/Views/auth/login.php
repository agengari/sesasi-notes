<?= $this->extend('auth/template') ?>

<?= $this->section('content') ?>
<div class="container">
  <div class="row justify-content-center align-items-center vh-100">
    <div class="col-6 text-center">
      <h1 class="text-center">Masuk</h1>
      <?php if (session()->getFlashdata('msg')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
      <?php endif; ?>

      <div class="card">
        <div class="card-body">
          <form action="/api/login" method="post">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="mb-3">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>

      <div class="text-center">
        <a href="/register">Daftar</a>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection() ?>