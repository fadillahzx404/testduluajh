<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="images/favicon.png" rel="icon" />

    <title>Nilai Para Guru | SMK PURNAMA 1 JAKARTA</title>

    <!-- Web Fonts
======================= -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=EB+Garamond:100,200,300,400,500,600,700,800,900" type="text/css" />

    <!-- Stylesheet
======================= -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
</head>

<body>
    <!-- Container -->
    <div class="container-fluid invoice-container">
        <!-- Header -->
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-2 mb-3">
                        <img id="logo" src="login.png" style="width: 120px" />
                    </div>
                    <div class="col-9 text-center" style="margin-top: 40px;">
                        <p class="text-lg-center text-center fs-5" style="margin-bottom: -2px">
                            <b>
                                SMK PURNAMA 1 JAKARTA
                            </b>
                        </p>
                        <p style="font-size: 12px">
                            Jl. Tirtayasa V No.3, RT.3/RW.2, Melawai, Kec. Keb. Baru, Kota
                            Jakarta Selatan<br />
                            Telepon: (021) 27506553
                        </p>
                    </div>
                </div>
            </div>
            <hr style="margin-top: -5px" />
        </header>
        <!-- Main Content -->
        <main>
            <!-- Passenger Details -->
            <?php include 'functions.php'; ?>
            <h4 class="fs-4 mt-2">Nilai Bobot Alternatif</h4>
            <p style="color: grey;">Berikut masing-masing nama guru dan juga nilai bobot alternatif dari setiap guru :</p>
            <div class="table-responsive mt-4">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>

                            <th>Nama Alternatif</th>
                            <?php foreach ($KRITERIA as $key => $val) : ?>
                                <th style="font-size: 12px; text-align: center;">Rata-Rata <br><?= $val->nama_kriteria ?></th>
                            <?php endforeach; ?>


                        </tr>
                    </thead>
                    <?php
                    $q = esc_field($_GET['q']);
                    $result = $db->get_results("SELECT tb_kuisioner.kode_guru, tb_alternatif.nama_alternatif FROM tb_kuisioner INNER JOIN tb_alternatif ON tb_kuisioner.kode_guru=tb_alternatif.kode_alternatif GROUP BY kode_guru");

                    $nama_guru = $db->get_results("SELECT tb_kuisioner.kode_guru, tb_alternatif.nama_alternatif FROM tb_kuisioner INNER JOIN tb_alternatif ON tb_kuisioner.kode_guru=tb_alternatif.nama_alternatif ");
                    $siswa = $db->get_row("SELECT COUNT(DISTINCT nama) as j_s FROM tb_kuisioner");

                    $rel_alternatif = get_rel_alternatif();

                    foreach ($result as $row) : ?>

                        <tr>

                            <td><?= $row->nama_alternatif ?></td>


                            <?php
                            foreach ($KRITERIA as $k) : ?>

                                <td>

                                    <?php $total_nilai = $db->get_results("SELECT SUM(nilai_kriteria)/$siswa->j_s as tnn  FROM tb_kuisioner WHERE kode_guru='$row->kode_guru' AND kode_kriteria='$k->kode_kriteria'"); ?>


                                    <?php foreach ($total_nilai as $tn) : ?>

                                        <?php $db->query("UPDATE tb_rel_alternatif SET nilai='$tn->tnn' WHERE kode_alternatif='$row->kode_guru' AND kode_kriteria='$k->kode_kriteria'");

                                        ?>

                                    <?php endforeach; ?>

                                    <?php $nilai = $db->get_results("SELECT nilai FROM tb_rel_alternatif WHERE kode_alternatif='$row->kode_guru' AND kode_kriteria='$k->kode_kriteria'");

                                    ?>

                                    <?php foreach ($nilai as $n) : ?>

                                        <?= round($n->nilai, 2) ?>
                                    <?php endforeach; ?>

                                </td>
                            <?php endforeach; ?>




                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <!-- Passenger Details -->

            <!-- Fare Details -->
            <br />


            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-4"></div>
                    <div class="col-5" style="margin-top:5%">
                        <h6 class="mb-0">Jakarta, <?= date("d-m-Y.") ?><br />Kepala Sekolah SMK Purnama 1</h6>
                        <br /><br /><br />
                        <p class="mb-0"><b>HAYATIN S.PD</b></p>
                    </div>
                </div>
            </footer>
    </div>

    <script>
        window.print();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>

<!-- Mirrored from harnishdesign.net/demo/html/koice/index-invoice-trains.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Jan 2023 06:41:34 GMT -->

</html>