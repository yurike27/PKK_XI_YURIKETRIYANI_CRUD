<?php
require 'function.php';
$siswa = query("SELECT * FROM siswa");

//tombol cari ditekan

if (isset($_POST["cari"])) {
    $siswa = cari($_POST["keyword"]);
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Halaman Admin</title>
  </head>
<body>
    <h1>Daftar Siswa</h1>
    <a href="tambah.php">Tambah data siswa</a>
    <br>
    <from action="" method="post">
        <input type="text" name="keyword" id="" size="50" autofocus
        placeholder="Masukan keyword pencarian!" autocompalete="off">
        <button type="submit" name="cari!"> Cari! </button>
    </from>
    <br>   

        <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <td>No.</td>
            <td>Aksi</td>
            <td>Gambar</td>
            <td>NIM</td>
            <td>Nama</td>
            <td>Email</td>
            <td>Jurusan</td>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($siswa as $sws) : ?>
            <tr>
                <td><?= $i ?></td>
                <td>
                    <a href="ubah.php">ubah</a>
                    <a href="hapus.php?id=<?= $sws["id"] ?>" onclick="return confirm('yakin mau dihapus?');">hapus</a>
                </td>
                <td><img src="img/<?= $sws["gambar"] ?>" alt="" width="100"></td>
                <td><?= $sws["nim"] ?></td>
                <td><?= $sws["nama"] ?></td>
                <td><?= $sws["email"] ?></td>
                <td><?= $sws["jurusan"] ?></td>
            </tr>
            <?php $i++ ?>
        <?php endforeach; ?>
    </table>

</body>

</html>