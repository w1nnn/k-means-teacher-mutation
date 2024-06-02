<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin'])) {
?> <script>
        window.location = '../admin/403.php';
    </script>
<?php
}
?>


<?php


$id_login = @$_SESSION['admin'];


$sql = mysqli_query($con, "SELECT * FROM tb_admin
 WHERE id_admin = '$id_login'") or die(mysqli_error($con));
$data = mysqli_fetch_array($sql);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disdik | Dashboard</title>
    <link rel="shortcut icon" href="../assets/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
    <link rel="stylesheet" href="../assets/assets/compiled/css/app.css">
    <link rel="stylesheet" href="../assets/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="../assets/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../assets/assets/compiled/css/table-datatable-jquery.css">
    <link rel="stylesheet" href="../assets/assets/extensions/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" href="../assets/assets/extensions/choices.js/public/assets/styles/choices.css">
    <link rel="stylesheet" href="../assets/assets/compiled/css/iconly.css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css"> -->
    <style>
        .dataTables_wrapper .dt-buttons .buttons-csv {
            background-color: #007bff;
            color: white;
            border-color: transparent;
            border-radius: 5px;
        }

        .dataTables_wrapper .dt-buttons .buttons-excel {
            background-color: #28a745;
            color: white;
            border-color: transparent;
            border-radius: 5px;
        }

        .dataTables_wrapper .dt-buttons .buttons-pdf {
            background-color: #ffb703;
            color: white;
            border-color: transparent;
            border-radius: 5px;

        }

        .dataTables_wrapper .dt-buttons .buttons-print {
            background-color: #9e2a2b;
            color: white;
            border-color: transparent;
            border-radius: 5px;
        }

        .dataTables_wrapper .dt-buttons {
            font-size: 13px;
        }
    </style>
</head>

<body>
    <script src="../assets/assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="https://www.smkn2sinjai.sch.id/" target="_blank"><img src="../assets/source/logo.png" alt="Logo smk2 sinjai" style="width: 5rem; height: auto; margin-top: 15px;"></a>
                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2 me-5">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                </path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item">
                            <a href="dashboard.php" class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Dashboard</span>
                            </a>


                        </li>

                        <li class="sidebar-item">
                            <a href="?page=guru" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>Data Guru</span>
                            </a>

                        </li>
                        <!-- 
                        <li class="sidebar-item">
                            <a href="?page=kebutuhan" class='sidebar-link'>
                                <i class="bi bi-clipboard-plus-fill"></i>
                                <span>Analisis Kebutuhan</span>
                            </a>

                        </li> -->

                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Mutasi</span>
                            </a>

                            <ul class="submenu">

                                <li class="submenu-item">
                                    <a href="?page=kriteria" class="submenu-link">Kriteria</a>
                                </li>

                                <li class="submenu-item  ">
                                    <a href="?page=subkriteria" class="submenu-link">Sub Kriteria</a>
                                </li>
                                <!-- <li class="submenu-item  ">
                                    <a href="?page=alternatif" class="submenu-link">Alternatif</a>
                                </li> -->

                                <li class="submenu-item  ">
                                    <a href="?page=evaluasi" class="submenu-link">Evaluasi</a>
                                </li>

                                <li class="submenu-item  ">
                                    <a href="?page=kmeans" class="submenu-link">K-Means</a>
                                </li>

                                <li class="submenu-item  ">
                                    <a href="?page=laporan" class="submenu-link">Laporan</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-title"></li>


                        <li class="sidebar-item">
                            <a href="logout.php" class='sidebar-link'>
                                <i class="bi bi-arrow-left-circle-fill"></i>
                                <span>Logout</span>
                            </a>

                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div id="main" class='layout-navbar navbar-fixed'>
            <header>
                <nav class="navbar navbar-expand navbar-light navbar-top">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-lg-0">


                            </ul>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600"><?= $data['nama_lengkap']; ?></h6>
                                            <p class="mb-0 text-sm text-gray-600">Administrator</p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="../assets/img/user/<?= $data['foto'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                                    <li>
                                        <h6 class="dropdown-header">Hello, <?= $data['nama_lengkap']; ?>!</h6>
                                    </li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#profile" href="#"><i class="icon-mid bi bi-person me-2"></i> My
                                            Profile</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#settings" href="#"><i class="icon-mid bi bi-gear me-2"></i>
                                            Settings</a></li>
                                    <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="logout.php"><i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div id="main-content">

                <div class="page-heading">
                    <?php
                    error_reporting();
                    $page = @$_GET['page'];
                    $act = @$_GET['act'];

                    if ($page == 'master') {
                        // Guru
                    } elseif ($page == 'guru') {
                        if ($act == '') {
                            include 'modul/guru/data.php';
                        } elseif ($act == 'add') {
                            include 'modul/guru/add.php';
                        } elseif ($act == 'edit') {
                            include 'modul/guru/edit.php';
                        } elseif ($act == 'del') {
                            include 'modul/guru/del.php';
                        } elseif ($act == 'proses') {
                            include 'modul/guru/proses.php';
                        }
                        // Kriteria
                    } elseif ($page == 'kriteria') {
                        if ($act == '') {
                            include 'modul/kriteria/data.php';
                        } elseif ($act == 'add') {
                            include 'modul/kriteria/add.php';
                        } elseif ($act == 'edit') {
                            include 'modul/kriteria/edit.php';
                        } elseif ($act == 'del') {
                            include 'modul/kriteria/del.php';
                        } elseif ($act == 'proses') {
                            include 'modul/kriteria/proses.php';
                        }
                        // Sub Kriteria
                    } elseif ($page == 'subkriteria') {
                        if ($act == '') {
                            include 'modul/subkriteria/data.php';
                        } elseif ($act == 'add') {
                            include 'modul/subkriteria/add.php';
                        } elseif ($act == 'edit') {
                            include 'modul/subkriteria/edit.php';
                        } elseif ($act == 'del') {
                            include 'modul/subkriteria/del.php';
                        } elseif ($act == 'proses') {
                            include 'modul/subkriteria/proses.php';
                        }
                        // Evaluasi
                    } elseif ($page == 'kebutuhan') {
                        if ($act == '') {
                            include 'modul/kebutuhan/data.php';
                        } elseif ($act == 'add') {
                            include 'modul/kebutuhan/add.php';
                        } elseif ($act == 'edit') {
                            include 'modul/kebutuhan/edit.php';
                        } elseif ($act == 'del') {
                            include 'modul/kebutuhan/del.php';
                        } elseif ($act == 'proses') {
                            include 'modul/kebutuhan/proses.php';
                        }
                        // Algoritma
                    } elseif ($page == 'evaluasi') {
                        if ($act == '') {
                            include 'modul/evaluasi/data.php';
                        } elseif ($act == 'add') {
                            include 'modul/evaluasi/add.php';
                        } elseif ($act == 'edit') {
                            include 'modul/evaluasi/edit.php';
                        } elseif ($act == 'del') {
                            include 'modul/evaluasi/del.php';
                        } elseif ($act == 'proses') {
                            include 'modul/evaluasi/proses.php';
                        }
                        // Algoritma
                    } elseif ($page == 'kmeans') {
                        if ($act == '') {
                            include 'modul/algoritma/kmeans.php';
                        } elseif ($act == 'proses') {
                            include 'modul/algoritma/proses.php';
                        }
                        // Laporan
                    } elseif ($page == 'laporan') {
                        if ($act == '') {
                            include 'modul/laporan/data.php';
                        } elseif ($act == 'tahun') {
                            include 'modul/laporan/laporan.php';
                        }
                        // Dashboard
                    } elseif ($page == '') {
                        include 'modul/home.php';
                    } else {
                        echo "<script>window.location.href = '../404.php'</script>";
                    }


                    ?>
                </div>

            </div>

            <!-- Modal My Profle -->
            <div class="modal fade text-left" id="profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1">My Profile</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" value="<?= $data['nama_lengkap'] ?>">
                                    <input type="hidden" name="id" value="<?= $data['id_admin'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" value="<?= $data['username'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Foto Profile</label>
                                    <p>
                                        <img src="../assets/img/user/<?= $data['foto'] ?>" class="img-thumbnail" style="height: 50px;width: 50px;">
                                    </p>
                                    <input type="file" name="foto">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button name="update" type="submit" class="btn btn-primary ms-1">
                                    Update
                                </button>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['update'])) {

                            $gambar = @$_FILES['foto']['name'];
                            if (!empty($gambar)) {
                                move_uploaded_file($_FILES['foto']['tmp_name'], "../assets/img/user/$gambar");
                                $ganti = mysqli_query($con, "UPDATE tb_admin SET foto='$gambar' WHERE id_admin='$_POST[id]' ");
                            }

                            $sqlEdit = mysqli_query($con, "UPDATE tb_admin SET nama_lengkap='$_POST[nama]',username='$_POST[username]' WHERE id_admin='$_POST[id]' ") or die(mysqli_error($konek));

                            if ($sqlEdit) {
                                echo "<script>
                                alert('Sukses ! Data berhasil diperbarui');
                                window.location='dashboard.php';
                                </script>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Modal Settings -->
            <div class="modal fade text-left" id="settings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1">Change Password</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="control-label">Password Lama</label>
                                    <input name="pass" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Password Baru</label>
                                    <input name="pass1" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button name="update" type="submit" class="btn btn-primary ms-1">
                                    Update
                                </button>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['update'])) {
                            $passLama = $data['password'];
                            $pass = sha1($_POST['pass']);
                            $newPass = sha1($_POST['pass1']);

                            if ($passLama == $pass) {
                                $set = mysqli_query($con, "UPDATE tb_admin SET password='$newPass' WHERE id_admin='$data[id_admin]' ");
                                echo "<script type='text/javascript'>
                                    alert('Password Telah berubah')
                                    window.location.replace('dashboard.php'); 
                                    </script>";
                            } else {
                                echo "<script type='text/javascript'>
                                    alert('Password Lama Tidak cocok')
                                    window.location.replace('dashboard.php'); 
                                    </script>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2024 &copy; Win.Devs</p>
                    </div>
                    <div class="float-end">
                        <p>
                            Crafted with
                            <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                            by <a href="https://github.com/w1nnn">erwin</a>
                        </p>
                    </div>
                </div>
            </footer> -->

        </div>
    </div>
    <script src="../assets/assets/static/js/components/dark.js"></script>
    <script src="../assets/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/assets/compiled/js/app.js"></script>
    <script src="../assets/assets/extensions/jquery/jquery.min.js"></script>
    <script src="../assets/assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="../assets/assets/static/js/pages/datatables.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/assets/extensions/flatpickr/flatpickr.min.js"></script>
    <script src="../assets/assets/static/js/pages/date-picker.js"></script>
    <script src="../assets/assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="../assets/assets/static/js/pages/form-element-select.js"></script>
    <script src="../assets/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <!-- <script src="../assets/assets/static/js/pages/dashboard.js"></script> -->


    <!-- Data Tabel Export -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    <script>
        function prosesKMeans() {
            document.getElementById('prosesBtn').innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
            setTimeout(function() {
                document.getElementById('prosesBtn').innerHTML = '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Processing...';
            }, 5000);
        }

        $('#example').DataTable({
            dom: 'Bfrtip',
            pageLength: 5,
            buttons: [{
                    extend: 'csv',
                    text: 'CSV',
                    title: 'Data Guru',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    title: 'Data Guru',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    title: 'Data Guru',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    title: 'Data Guru',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                }
            ]
        });
        $('#layak').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'csv',
                    text: 'CSV',
                    title: 'Data Layak Mutasi',
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    title: 'Data Layak Mutasi',
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    title: 'Data Layak Mutasi',
                },
                {
                    extend: 'print',
                    text: 'Print',
                    title: 'Data Layak Mutasi',
                }
            ]
        });
        $('#tidak').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'csv',
                    text: 'CSV',
                    title: 'Data Tidak Layak Mutasi',
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    title: 'Data Tidak Layak Mutasi',
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    title: 'Data Tidak Layak Mutasi',
                },
                {
                    extend: 'print',
                    text: 'Print',
                    title: 'Data Tidak Layak Mutasi',
                }
            ]
        });

        $('#cluster').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'csv',
                    text: 'CSV',
                    title: 'Data Cluster',
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    title: 'Data Cluster',
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    title: 'Data Cluster',
                },
                {
                    extend: 'print',
                    text: 'Print',
                    title: 'Data Cluster',
                }
            ]
        });
        $('#hasil_cluster').DataTable({
            dom: 'Bfrtip',
            pageLength: 4,
            buttons: [{
                    extend: 'csv',
                    text: 'CSV',
                    title: 'Data Cluster',
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    title: 'Data Cluster',
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    title: 'Data Cluster',
                },
                {
                    extend: 'print',
                    text: 'Print',
                    title: 'Data Cluster',
                }
            ]
        });
        $('#laporan').DataTable({
            dom: 'Bfrtip',
            pageLength: 4,
            buttons: [{
                    extend: 'csv',
                    text: 'CSV',
                    title: 'Laporan Rekomendasi Mutasi Guru',
                },
                {
                    extend: 'excel',
                    text: 'Excel',
                    title: 'Laporan Rekomendasi Mutasi Guru',
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    title: 'Laporan Rekomendasi Mutasi Guru',
                },
                {
                    extend: 'print',
                    text: 'Print',
                    title: 'Laporan Rekomendasi Mutasi Guru',
                }
            ]
        });
        var optionsProfileVisit = {
            annotations: {
                position: "back",
            },
            dataLabels: {
                enabled: false,
            },
            chart: {
                type: "bar",
                height: 300,
            },
            fill: {
                opacity: 1,
            },
            plotOptions: {},
            series: [{
                name: "sales",
                data: [9, 20, 30, 20, 10, 20, 30, 20, 10, 20, 30, 20],
            }, ],
            colors: "#435ebe",
            xaxis: {
                categories: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
            },
        };
        let optionsVisitorsProfile = {
            series: [<?= $jumlah_layak ?>, <?= $jumlah_tidak_layak ?>],
            labels: ["Layak Mutasi", "Tidak Layak Mutasi"],
            colors: ["#435ebe", "#a3cef1"],
            chart: {
                type: "donut",
                width: "100%",
                height: "350px",
            },
            legend: {
                position: "bottom",
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: "30%",
                    },
                },
            },
        };

        var optionsEurope = {
            series: [{
                name: "series1",
                data: [310, 800, 600, 430, 540, 340, 605, 805, 430, 540, 340, 605],
            }, ],
            chart: {
                height: 80,
                type: "area",
                toolbar: {
                    show: false,
                },
            },
            colors: ["#5350e9"],
            stroke: {
                width: 2,
            },
            grid: {
                show: false,
            },
            dataLabels: {
                enabled: false,
            },
            xaxis: {
                type: "datetime",
                categories: [
                    "2018-09-19T00:00:00.000Z",
                    "2018-09-19T01:30:00.000Z",
                    "2018-09-19T02:30:00.000Z",
                    "2018-09-19T03:30:00.000Z",
                    "2018-09-19T04:30:00.000Z",
                    "2018-09-19T05:30:00.000Z",
                    "2018-09-19T06:30:00.000Z",
                    "2018-09-19T07:30:00.000Z",
                    "2018-09-19T08:30:00.000Z",
                    "2018-09-19T09:30:00.000Z",
                    "2018-09-19T10:30:00.000Z",
                    "2018-09-19T11:30:00.000Z",
                ],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                },
            },
            show: false,
            yaxis: {
                labels: {
                    show: false,
                },
            },
            tooltip: {
                x: {
                    format: "dd/MM/yy HH:mm",
                },
            },
        };

        let optionsAmerica = {
            ...optionsEurope,
            colors: ["#008b75"],
        };
        let optionsIndonesia = {
            ...optionsEurope,
            colors: ["#dc3545"],
        };

        var chartProfileVisit = new ApexCharts(
            document.querySelector("#chart-profile-visit"),
            optionsProfileVisit
        );
        var chartVisitorsProfile = new ApexCharts(
            document.getElementById("chart-visitors-profile"),
            optionsVisitorsProfile
        );
        var chartEurope = new ApexCharts(
            document.querySelector("#chart-europe"),
            optionsEurope
        );
        var chartAmerica = new ApexCharts(
            document.querySelector("#chart-america"),
            optionsAmerica
        );
        var chartIndonesia = new ApexCharts(
            document.querySelector("#chart-indonesia"),
            optionsIndonesia
        );

        chartIndonesia.render();
        chartAmerica.render();
        chartEurope.render();
        chartProfileVisit.render();
        chartVisitorsProfile.render();
    </script>

    <script src="../assets/source/index.umd.js"></script>
    <script>
        new TypeIt('#typedText span', {
                speed: 50,
                waitUntilVisible: true,
                loop: true
            })
            .type("SISTEM ")
            .exec(async () => {
                await new Promise((resolve, reject) => {
                    setTimeout(() => {
                        return resolve();
                    }, 1000);
                });
            })
            .type(" PENDUKUNG KEPUTUSAN")
            .go();
    </script>
</body>

</html>