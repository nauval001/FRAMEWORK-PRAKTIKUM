{{-- File: resources/views/site/home.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RS Hewan</title>
    {{-- 
      Kita gunakan helper asset() untuk memanggil file CSS 
      yang sudah Anda pindah ke folder public/
    --}}
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <nav>
        <div class="wrapper">
            <div class="logo"><a href="{{ url('/') }}">RS HEWAN</a></div>
            <div class="menu">
                <ul>
                    {{-- 
                      Kita ubah link dari home.php menjadi url('/') 
                      atau route('site.home') jika Anda sudah menamakannya
                    --}}
                    <li><a href="{{ url('/') }}">Home</a></li>
                    
                    {{-- Asumsi file ini akan Anda pindah ke public/ juga --}}
                    <li><a href="{{ asset('struktur_org.html') }}">Struktur Organisasi</a></li>
                    
                    {{-- 
                      Ini akan kita arahkan ke rute login Laravel nanti.
                      Untuk sementara, bisa seperti ini.
                    --}}
                    <li><a href="{{ url('/login') }}" class="tbl-biru">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">
        <section id="home">
            {{-- 
              Kita gunakan helper asset() untuk memanggil gambar 
              dari folder public/pictures assets/
            --}}
            <img src="{{ asset('pictures assets/banner.webp') }}" width="700px" height="400px"/>
            <div class="kolom">
                <p class="deskripsi">Selamat Datang</p>
                <h2>RS HEWAN</h2>
                <p>Rumah Sakit Hewan adalah fasilitas medis yang menyediakan perawatan kesehatan untuk hewan, mirip dengan rumah sakit untuk manusia. RS Hewan dilengkapi dengan peralatan medis canggih dan staf profesional yang terlatih, termasuk dokter hewan, perawat, dan teknisi hewan, untuk mendiagnosis, mengobati, dan merawat berbagai kondisi medis pada hewan peliharaan dan ternak.</p>
            </div>
        </section>

        <section id="berita">
            <div class="tengah">
                <div class="kolom">
                    <p class="deskripsi">Berita</p>
                    <h2>BERITA</h2>
                    <p>Berikut adalah berita-berita terbaru tentang RS Hewan</p>
                </div>

                <div class="berita-list">
                    <div class="kartu-berita">
                        <img src="{{ asset('pictures assets/berita1.jpg') }}"/>
                        <p>Judul Berita 1</p>
                    </div>
                    <div class="kartu-berita">
                        <img src="{{ asset('pictures assets/berita2.png') }}"/>
                        <p>Judul Berita 2</p>
                    </div>
                    <div class="kartu-berita">
                        <img src="{{ asset('pictures assets/berita3.jpg') }}"/>
                        <p>Judul Berita 3</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>