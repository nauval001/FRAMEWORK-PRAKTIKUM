<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RS Hewan Pendidikan</title>

    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="wrapper">
            <div class="logo">
                <a href="{{ url('/') }}">RS HEWAN</a>
            </div>
            <ul class="menu">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ asset('struktur_org.html') }}">Struktur Organisasi</a></li>
                <li><a href="{{ url('/login') }}" class="btn-login">Login</a></li>
            </ul>
        </div>
    </nav>

    <!-- HERO / HOME -->
    <section id="home" class="hero">
        <div class="wrapper hero-content">
            <div class="hero-text">
                <p class="deskripsi">Selamat Datang</p>
                <h1>Rumah Sakit Hewan</h1>
                <p>
                    Rumah Sakit Hewan adalah fasilitas medis yang menyediakan
                    perawatan kesehatan hewan dengan peralatan modern dan tenaga
                    profesional untuk diagnosis, pengobatan, dan perawatan.
                </p>
            </div>

            <div class="hero-image">
                <img src="{{ asset('pictures assets/banner.webp') }}" alt="RS Hewan">
            </div>
        </div>
    </section>

    <!-- BERITA -->
    <section id="berita">
        <div class="wrapper">
            <div class="section-title">
                <p class="deskripsi">Berita</p>
                <h2>Berita Terbaru</h2>
                <p>Informasi dan kegiatan terbaru RS Hewan</p>
            </div>

            <div class="berita-list">
                <div class="kartu-berita">
                    <img src="{{ asset('pictures assets/berita1.jpg') }}">
                    <h4>Judul Berita 1</h4>
                </div>

                <div class="kartu-berita">
                    <img src="{{ asset('pictures assets/berita2.png') }}">
                    <h4>Judul Berita 2</h4>
                </div>

                <div class="kartu-berita">
                    <img src="{{ asset('pictures assets/berita3.jpg') }}">
                    <h4>Judul Berita 3</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <p>© {{ date('Y') }} RS Hewan Pendidikan Universitas Airlangga</p>
    </footer>

</body>
</html>