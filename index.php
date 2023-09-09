<?php 
require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");

//tombol cari ditekan
if( isset($_POST["cari"]) ) {
    $mahasiswa = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Daftar Mahasiswa</h1>
<div class="topsec">
    <div class="lside">
        <a href="insert.php">Tambah data mahasiswa</a>
    </div>  
    <div class="rside">
        <form action="" method="post">
            <input type="text" name="keyword" size="30" autofocus 
            placeholder="Masukkan keyword pencarian..." autocomplete="off">
            <button type="submit" name="cari">Cari</button>
        </form>
    </div>
</div>

<table border="1" cellpadding="10" cellspacing="0">
    
    <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Mata Kuliah</th>
        <th>Grade</th>
        <th>Nilai Rata-Rata</th>
        <th>Aksi</th>
    </tr>

    <?php $i = 1; ?>
    <?php foreach( $mahasiswa as $mhs ) : ?>
    <tr>
        <td><?= $i; ?></td>
        <td><?= $mhs["nama"]; ?></td>
        <td><?= $mhs["matkul"]; ?></td>
        <td><?= $mhs["grade"]; ?></td>
        <td><?= $mhs["nilai"]; ?></td>
        <td>
            <div class="buttonBox">
                <div class ="editbutton">
                    <a href="edit.php?id=<?= $mhs["id"]; ?>">Ubah</a> 
                </div>
                <div class ="deletebutton">
                    <a href="delete.php?id=<?= $mhs["id"]; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">Hapus</a>
                </div>
            </div>
        </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
</table>

</body>
</html>