<?= $this->extend('layouting/template') ?>

<?= $this->section('content') ?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-6">
      <h1>Detail User</h1>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Nama</th>
            <td scope="col">=</td>
            <td scope="col"><?= $user['name']; ?></td>
          </tr>
          <tr>
            <th scope="col">User</th>
            <td scope="col">=</td>
            <td scope="col"><?= $user['user']; ?></td>
          </tr>
          <tr>
            <th scope="col">Pass</th>
            <td scope="col">=</td>
            <td scope="col"><?= $user['pass']; ?></td>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row d-flex justify-content-between">
    <div class="col-3">
      <a href="/api/users/">
        << Back to users list</a>
    </div>
    <div class="col-3">
      <form action="/api/users/<?= $user['user_id']; ?>" method="POST" class="float-end">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="btn btn-danger badge">Hapus</button>
      </form>
      <button class="float-end btn btn-warning badge me-3">Ubah</button>
    </div>
  </div>
</div>
<?= $this->endSection() ?>