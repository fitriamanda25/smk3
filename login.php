<?  
  error_reporting(0); 
  include"setting.php";

  if(!empty($_SESSION[SiswaID]))
  {
      include "index.php";
  }

  if(isset($_POST[TombolLogin]))
  {
    $siswa 	    = strip_tags($_POST[NIS]);
    $password 	= strip_tags($_POST[Password]);;
    
    $qSiswa = "SELECT * FROM siswa WHERE siswa_nis = '$siswa' and siswa_password = '$password'";

    $rSiswa = mysql_query($qSiswa, $conn) or die(mysql_error());

    if(mysql_num_rows($rSiswa) != '0')
    {
        $aSiswa = mysql_fetch_array($rSiswa);
    
        $_SESSION[SiswaID]     = $aSiswa[siswa_id];
        
        header("location:index.php");
    }
    else
    {
        header("location:?msg=psw");
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$aConfig[config_nama];?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="img/<?=$aConfig[config_logo];?>" width="467">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5"> 
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><?=$aConfig[config_nama];?></h1>
                                    </div>
                                    <form class="siswa" method="POST" onsubmit="return Login(this)">
                                        <div class="form-group">
                                            <input name="NIS" type="text" class="form-control form-control-siswa"
                                                id="exampleInputNIS" aria-describedby="emailHelp"
                                                placeholder="Masukan NIS...">
                                        </div>
                                        <div class="form-group">
                                            <input name="Password" type="password" class="form-control form-control-siswa"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-siswa btn-block" name="TombolLogin">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>