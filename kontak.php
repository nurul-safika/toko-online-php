<?php require "navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container-fluid banner-produk d-flex align-items-center">
    <div class="container text-center">
        <h1 class="text-white">Kontak Kami</h1>
    </div>
</div>

<div class="container py-5">
    <div class="row">

        <!-- Informasi Toko -->
        <div class="col-lg-4 mb-4">
            <h3 class="mb-3">Informasi Toko</h3>
            <p><i class="fas fa-map-marker-alt me-2"></i>Jl. Contoh No. 123, Jakarta</p>
            <p><i class="fas fa-phone me-2"></i>0812-3456-7890</p>
            <p><i class="fas fa-envelope me-2"></i>support@tokoonline.com</p>
            <p><i class="fas fa-clock me-2"></i>Senin - minggu (08.00 - 00.00)</p>

            <hr>

            <h4>Ikuti Kami</h4>
            <p>
                <a href="#" class="me-3"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="#" class="me-3"><i class="fab fa-instagram fa-2x"></i></a>
                <a href="#" class="me-3"><i class="fab fa-whatsapp fa-2x"></i></a>
            </p>
        </div>

        <!-- Form Kontak -->
        <div class="col-lg-8">
            <h3 class="mb-3">Kirim Pesan</h3>

            <form method="post" action="kirim-pesan.php">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pesan</label>
                    <textarea name="pesan" class="form-control" rows="5" required></textarea>
                </div>

                <button type="submit" class="btn warna2 text-white">Kirim Pesan</button>
            </form>
        </div>

    </div>

    <!-- Google Maps -->
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="mb-3 text-center">Lokasi Kami</h3>

            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126913.43892020844!2d106.68943170867475!3d-6.22972802857819!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e5b7c6e8c5%3A0x301576d14feb3f0!2sJakarta!5e0!3m2!1sen!2sid!4v00000000000" 
                width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>

</div>

<?php require "footer.php"; ?>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="fontawesome/js/all.min.js"></script>
</body>
</html>
