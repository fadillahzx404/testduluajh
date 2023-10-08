<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="noindex, nofollow" />
    <title>LOGIN</title>
    <link href="assets/css/superhero-bootstrap.min.css" rel="stylesheet" />
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/css/bootstrap.min.css"></script>


</head>

<body>
    <div class="container" style="margin-top: 30px">
        <div class="col-md-4 col-md-offset-4">



            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Silahkan masuk</h3>


                </div>
                <?php if ($_POST) include 'aksi.php'; ?>
                <div class="panel-body">
                    <form class="form-signin" action="?act=login" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" name="user" autofocus autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="pass" autocomplete="off" />
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">
                            Masuk
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-md-offset-4" style="margin-top: 50px">
            <div class="panel-body-kuisioner-button">
                <p class="text-center">
                    Bagi Siswa yang ingin menambahkan kuisioner tekan tombol di bawah
                    ini.
                </p>


                <button type="button" class="btn btn-success btn-lg btn-block" id="#Modal1" data-toggle="modal" data-target="#Modal1">
                    Isi Kuisioner
                </button>


                <button type="button" class="btn btn-success btn-lg btn-block " style="display: none;" name="Modal2" id="Modal22" data-toggle="modal" data-target="#Modal2">
                    Haloo
                </button>

            </div>
        </div>






        <!-- Modal1 -->
        <div class="modal fade bs-example-modal-md" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Isi Nama Anda</h4>

                    </div>


                    <form action="?act=valid_nama" method="POST" id="valid_nama">

                        <div class="modal-body">
                            <h5>Silakan isi nama anda terlebih dahulu untuk melanjutkan pengisiin kuisioner.</h5>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Anda</label>
                                <input type="text" class="form-control" id="nama" name="nama" />

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" name="valid_button" id="valid_button" class="btn btn-primary">Submit</button>
                        </div>



                    </form>


                </div>
            </div>

        </div>



        <!-- Modal2 -->
        <div class="modal fade bs-example-modal-lg" id="Modal2" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">ISI KUISIONER</h4>

                    </div>
                    <form action="?act=tambah_kuisioner" method="post">
                        <div class="modal-body">

                            <h5>Silakan isi kuisioner berikut ini untuk memberikan nilai terhadap guru.</h5>


                            <?php
                            include 'includes/db.php';
                            include 'config.php';
                            $db = new DB($config['server'], $config['username'], $config['password'], $config['database_name']);
                            $guru = $db->get_results("SELECT kode_alternatif, nama_alternatif FROM tb_alternatif ORDER BY kode_alternatif");
                            $kriteria = $db->get_results("SELECT kode_kriteria, nama_kriteria FROM tb_kriteria ORDER BY kode_kriteria");
                            foreach ($guru as $g) :
                            ?>

                                <div class="form-group" style="margin-top: 10px;">
                                    <label for="nama_guru" style="margin-top: 10px">
                                        <h4><span class="label label-success"><?= $g->nama_alternatif ?></span></h4>
                                    </label>

                                </div>



                                <div class="form-row mb-2" style="display: flex;">
                                    <?php foreach ($kriteria as $k) : ?>
                                        <div class="form-group" style="margin-left: 10px;">

                                            <label for="kriteria" class="mb-3"><?= $k->nama_kriteria ?></label>
                                            <div class="input-group">

                                                <input type="hidden" class="form-control" name="kode_guru[]" value="<?= $g->kode_alternatif; ?>" />
                                                <input type="number" onKeyPress="if(this.value.length==2) return false;" class="form-control" name="nilai_kriteria[]" />
                                                <input type="hidden" name="kode_kriteria[]" class="form-control" value="<?= $k->kode_kriteria ?>" />

                                            </div>
                                        </div>

                                    <?php endforeach; ?>
                                </div>



                            <?php endforeach; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" name="kuisioner" class="btn btn-primary">Kirim Kuisioner</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>


    </div>
    <script>
        $("#MyModal").on("shown.bs.modal", function() {
            $("#myInput").focus();
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>




    <style>
        .nilai_kriteria {
            margin-bottom: 15px;
        }
    </style>

</body>

</html>