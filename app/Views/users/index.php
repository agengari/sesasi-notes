<?= $this->extend('layouting/template') ?>

<?= $this->section('content') ?>
<div class="container">
  <div class="row">
    <div class="col">
      <h1>Detail Pengguna</h1>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Act</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach ($users as $user) : ?>
            <tr>
              <th scope="row"><?= $i++; ?></th>
              <td><?= $user['name']; ?></td>
              <td><a href="/api/users/<?= $user['user_id']; ?>" class="btn btn-primary badge">Detail</a></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection() ?>