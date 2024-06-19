<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="./assets/source/logo.png" type="image/png" sizes="32x32">
    <link href=" https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/source/styles.css" />
    <link rel="stylesheet" href="./assets/assets/compiled/css/app.css">
    <!-- <link rel="stylesheet" href="./assets/assets/compiled/css/app-dark.css"> -->
    <style>
        .container__left a {
            margin: 10px 0;
        }

        .container__left .sekolah {
            width: 312px;
            background-image: linear-gradient(90deg, #636363 0%, #a2ab58 100%);
            color: #fff;
            transition: background-image 0.3s ease;
        }

        .container__left .sekolah:hover {
            background-image: linear-gradient(109.5deg, rgba(229, 233, 177, 0.8) 11.2%, rgba(223, 205, 187, 0.8) 100.2%);
            color: #000;
        }
    </style>
    <title>SPK Mutasi Guru</title>
</head>

<body>
    <nav>
        <div class="nav__header">
            <div class="nav__logo">
                <a href="#">
                    <img src="./assets/source/log.png" alt="" style="width: 120px;">
                </a>
            </div>
            <div class="nav__menu__btn" id="menu-btn">
                <i class="ri-menu-line"></i>
            </div>
        </div>
        <ul class="nav__links" id="nav-links">
            <li><a href="#">HOME</a></li>
            <li><a href="/spk_mutasi_guru_disdik_sinjai/about.php">ABOUT US</a></li>
        </ul>
        <div class="nav__btns">
            <!-- <button class="btn"><i class="bi bi-geo-alt-fill"></i></button> -->
        </div>
    </nav>
    <div class="container">
        <div class="container__left">
            <h1>SPK Mutasi Guru</h1>
            <div class="container__btn">
                <a type="button" href="/mutasi/guru.php" class="btn btn-sm guru">Guru</a>
                <a type="button" href="/mutasi/admin/" class="btn btn-sm admin">Dinas Pendidikan</a>
                <a type="button" href="/mutasi/sekolah.php" class="btn btn-sm sekolah">Sekolah</a>
            </div>
        </div>
        <div class="container__right">
            <div class="images">
                <img src="./assets/source/fotokadis.png" alt="tent-1" class="tent-1" />
                <img src="./assets/source/3.jpg" alt="tent-2" class="tent-2" />
            </div>
            <div class="content">
                <h3>Pasal 1 No. 5 Tahun 2019</h3>
                <h3 style="font-style: italic;">Peraturan Badan Kepegawaian (BKN-RI)
                </h3>
                <!-- <h4>No. 5 Tahun 2019</h4> -->
                <p>
                    Mutasi adalah pemindahan tugas dan/atau lokasi yang terjadi di dalam satu instansi, antar-instansi di tingkat lokal, instansi daerah, antar-instansi di tingkat daerah, antara instansi pusat dan instansi daerah, serta ke perwakilan Negara Indonesia di luar negeri, dan juga bisa dilakukan atas permintaan sendiri.
                </p>
            </div>
        </div>
        <div class="socials">

        </div>
        <div class="socials">
            <span>
                <a href="https://web.facebook.com/disdiksinjaimacca/"><i class="ri-facebook-fill"></i></a>
            </span>
            <span>
                <a href="https://instagram.com/disdik_sinjai"><i class="ri-instagram-line"></i></a>
            </span>
            <span>
                <a href="https://x.com/sinjaikab/status/1732541279400263777"><i class="ri-twitter-fill"></i></a>
            </span>
        </div>
    </div>

    <!-- <script src="https://unpkg.com/scrollreveal"></script> -->
    <script src="./assets/source/scrollreveal.js"></script>
    <script src="./assets/source/main.js"></script>
    <script src="./assets/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="./assets/assets/static/js/components/dark.js"></script>
    <script src="./assets/assets/compiled/js/app.js"></script>
</body>

</html>