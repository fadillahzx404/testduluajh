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
    <?php if ($_POST) {
        include 'aksi.php';
    } ?>

    <div class="container" style="margin-top: 30px">
        <?php require_once 'aksi.php'; ?>
        <input type="hidden" id="namaku" value="<?= $_SESSION['nama'] ?>" />
        <button type="button" style="display: none" class="btn btn-primary" data-toggle="modal" id="Modal22"
            data-target=".bs-example-modal-lg">Large modal</button>
    </div>
    <!-- Modal2 -->
    <div class="modal fade bs-example-modal-lg" id="Modal2" tabindex="-1" data-keyboard="true"
        data-backdrop="static" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="close" href="login.php">
                        <span aria-hidden="true">&times;</span>
                    </a>
                    <h4 class="modal-title" id="myModalLabel">ISI KUISIONER</h4>
                </div>
                <form action="?act=tambah_kuisioner" method="POST">
                    <div class="modal-body">

                        <h5>Silakan isi kuisioner berikut ini untuk memberikan nilai terhadap guru.</h5>
                        <div class="mb-3">
                            <label for="nama_siswa" class="form-label"> Nama Pengisi</label>
                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" readonly>

                        </div>


                        <?php
                            
                            
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

                                    <input type="hidden" class="form-control" name="kode_guru[]"
                                        value="<?= $g->kode_alternatif ?>" />
                                    <input type="number" onKeyPress="if(this.value.length==2) return false;"
                                        class="form-control" name="nilai_kriteria[]" />
                                    <input type="hidden" name="kode_kriteria[]" class="form-control"
                                        value="<?= $k->kode_kriteria ?>" />

                                </div>
                            </div>

                            <?php endforeach; ?>
                        </div>



                        <?php endforeach; ?>
                    </div>
                    <div class="modal-footer">
                        {{-- <a href="login.php" class="btn btn-default">
                            Close
                        </a> --}}
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="kuisioner" class="btn btn-primary">Kirim Kuisioner</button>
                    </div>
                </form>

            </div>
        </div>

    </div>



    <script>
        $("#MyModal").on("shown.bs.modal", function() {
            $("#myInput").focus();



        });
    </script>
    <script>
        $("#Modal22").trigger("click");
    </script>

    <script type="text/javascript">
        var namakuu = document.getElementById("namaku").value;
        document.getElementById("nama_siswa").value = namakuu
    </script>


    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>




    <style>
        .nilai_kriteria {
            margin-bottom: 15px;
        }
    </style>

</body>

</html>
