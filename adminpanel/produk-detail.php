<?php
require "session.php";
require "../koneksi.php";

$id = isset($_GET['p']) ? $_GET['p'] : '';

if ($id == '') {
    echo '<div class="alert alert-danger mt-3">ID produk tidak ditemukan</div>';
    exit;
}

$query = mysqli_query($conn, "
    SELECT a.*, b.nama_kategori 
    FROM produk a 
    JOIN kategori b ON a.kategori_id = b.id 
    WHERE a.id = '$id'
");

$data = mysqli_fetch_array($query);

if (!$data) {
    echo '<div class="alert alert-danger mt-3">Produk dengan ID tersebut tidak ditemukan</div>';
    exit;
}

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id != '{$data['kategori_id']}'");

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characterslength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $characterslength - 1)];
    }
    return $randomString;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Produk Detail</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../adminpanel/style-admin.css">
    <style>form div { margin-bottom: 10px; }</style>
</head>
<body>
<?php require "navbar.php"; ?>

<div class="container mt-5">
    <h2>Detail Produk</h2>
    <div class="col-12 col-md-5">
        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="<?= $data['nama']; ?>" class="form-control" required>
            </div>

            <div>
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control">
                    <option value="<?= $data['kategori_id']; ?>"><?= $data['nama_kategori']; ?></option>
                    <?php while($dataKategori = mysqli_fetch_array($queryKategori)){ ?>
                        <option value="<?= $dataKategori['id']; ?>"><?= $dataKategori['nama_kategori']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div>
                <label for="harga">Harga</label>
                <input type="number" class="form-control" value="<?= $data['harga']; ?>" name="harga" id="harga">
            </div>

            <div>
                <label>Foto Produk Sekarang</label><br>
                <img src="../image/<?= $data['foto']; ?>" width="300px">
            </div>

            <div>
                <label for="foto">Ganti Foto (Opsional)</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>

            <div>
                <label for="detail">Detail</label>
                <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"><?= $data['detail']; ?></textarea>
            </div>

            <div>
                <label for="ketersediaan_stok">Ketersediaan Stok</label>
                <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                    <option value="<?= $data['ketersediaan_stok']; ?>"><?= $data['ketersediaan_stok']; ?></option>
                    <?php if($data['ketersediaan_stok'] == 'tersedia'){ ?>
                        <option value="habis">habis</option>
                    <?php } else { ?>
                        <option value="tersedia">tersedia</option>
                    <?php } ?>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-simpan" name="simpan">Simpan</button>
                <button type="submit" class="btn btn-hapus" name="hapus">Hapus</button>
            </div>
        </form>

        <?php
        if (isset($_POST['simpan'])) {
            $nama = htmlspecialchars($_POST['nama']);
            $kategori = htmlspecialchars($_POST['kategori']);
            $harga = htmlspecialchars($_POST['harga']);
            $detail = htmlspecialchars($_POST['detail']);
            $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

            $target_dir = "../image/";
            $nama_file = basename($_FILES["foto"]["name"]);
            $target_file = $target_dir . $nama_file;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $image_size = $_FILES["foto"]["size"];
            $random_name = generateRandomString(20);
            $new_name = $random_name . "." . $imageFileType;

            if ($nama == '' || $kategori == '' || $harga == '') {
                echo '<div class="alert alert-warning mt-3">Nama, Kategori, dan Harga wajib diisi</div>';
            } else {
                mysqli_query($conn, "UPDATE produk SET kategori_id='$kategori', nama='$nama', harga='$harga', detail='$detail', ketersediaan_stok='$ketersediaan_stok' WHERE id='$id'");

                if ($nama_file != '') {
                    if ($image_size > 500000) {
                        echo '<div class="alert alert-warning mt-3">File tidak boleh lebih dari 500 KB</div>';
                    } elseif (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                        echo '<div class="alert alert-warning mt-3">File wajib jpg, jpeg, png atau gif</div>';
                    } else {
                        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                        mysqli_query($conn, "UPDATE produk SET foto='$new_name' WHERE id='$id'");
                    }
                }

                echo '<div class="alert alert-primary mt-3">Produk Berhasil Diupdate</div>';
                echo '<meta http-equiv="refresh" content="2; url=produk.php" />';
            }
        }

        if (isset($_POST['hapus'])) {
            $queryHapus = mysqli_query($conn, "DELETE FROM produk WHERE id='$id'");
            if ($queryHapus) {
                echo '<div class="alert alert-warning mt-3">Produk Berhasil Dihapus</div>';
                echo '<meta http-equiv="refresh" content="2; url=produk.php" />';
            }
        }
        ?>
    </div>
</div>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>