<?php include 'functions.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="images/favicon.png" rel="icon" />

    <title>Perangkingan Guru | SMK PURNAMA 1 JAKARTA</title>

    <!-- Web Fonts
======================= -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=EB+Garamond:100,200,300,400,500,600,700,800,900" type="text/css" />

    <!-- Stylesheet
======================= -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
</head>
<body onload="window.print()">

<?php

if(is_file($mod.'_cetak.php'))
    include $mod.'_cetak.php';
?>

    <footer>
        <div class="row">
<div class="col-3"></div><div class="col-4"></div>
            <div class="col-5" style="margin-top:5%">
                <h6 class="mb-0">Jakarta, <?= date("d-m-Y.") ?><br />Kepala Sekolah SMK Purnama 1</h6>
                <br /><br /><br />
                <p class="mb-0"><b>HAYATIN S.PD</b></p>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>