<?
    if(isset($_POST[TombolSimpan]))
    {

			$qSiswaCreate = "INSERT INTO siswa (siswa_nis, siswa_nama, siswa_password)
							VALUES (
								'".mysql_real_escape_string($_POST[NIS])."',
								'".mysql_real_escape_string($_POST[Nama])."',
								'".mysql_real_escape_string($_POST[Password])."')";
			$rSiswaCreate = mysql_query($qSiswaCreate, $conn) or die(mysql_error());

			header("location:?page=siswa");
    }

    if(isset($_POST[TombolRubah]))
    {
        $qPelanggan = "UPDATE siswa SET 
                        siswa_nis = '".mysql_real_escape_string($_POST['NIS'])."',
                        siswa_nama = '".mysql_real_escape_string($_POST['Nama'])."',
                        siswa_password = '".mysql_real_escape_string($_POST['Password'])."'
                    WHERE siswa_id = '".mysql_real_escape_string($_POST['ID'])."'";
        $rPelanggan = mysql_query($qPelanggan, $conn) or die(mysql_error());
        $aPelanggan = mysql_fetch_array($rPelanggan);

        header("location:?page=siswa");
    }

    if(!empty($_GET[siswad]))
    {
        $qPelangganDelete = "UPDATE siswa set
                                siswa_status  = '0'
                        WHERE
                            siswa_id = '".mysql_real_escape_string($_GET[siswad])."'";
        $rPelangganDelete = mysql_query($qPelangganDelete, $conn) or die(mysql_error());
        
        header("location:?page=siswa");
    }

?>
            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Siswa</h1>

                    <div class="modal fade" id="TambahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <form id="myForm" method="post">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label for="exampleInputName">NIS</label>
                                            <input class="form-control" name="NIS" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="NIS">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label for="exampleInputName">Nama</label>
                                            <input class="form-control" name="Nama" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Nama">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label for="exampleInputName">Password</label>
                                            <input class="form-control" name="Password" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                            <button class="btn btn-primary" name="TombolSimpan">Simpan</button>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a class='btn btn-primary btn-circle float-right' href='#' data-toggle='modal' data-target='#TambahData'  role='button'><i class='fa fa-plus-square'></i></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?
                                    $kolom_table = "<th width='30'>No</th>
                                    <th>Nomor Induk Siswa</th>
                                    <th>Nama Lengkap</th>
                                    <th>Password</th>
                                    <th width='100'>Aksi</th>";
                                ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <?=$kolom_table;?>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <?=$kolom_table;?>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?
                                            $qSiswa = "SELECT * FROM siswa
                                                        WHERE
                                                            siswa_status = '1'
                                                        ORDER BY siswa_nama ASC";
                                            $rSiswa = mysql_query($qSiswa, $conn) or die(mysql_error());
                                            
                                            $j = 0;
                        
                                            if(mysql_num_rows($rSiswa) != '0')
                                            {
                                                while($aSiswa = mysql_fetch_array($rSiswa))
                                                {
                                                    $j++;

                                                    echo'<div class="modal fade" id="Edit'.$aSiswa[siswa_id].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="myForm" method="post">
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                <div class="col-md-12">
                                                                    <label for="exampleInputName">NIS</label>
                                                                    <input class="form-control" name="ID" value="'.$aSiswa[siswa_id].'" id="exampleInputName" type="hidden" aria-describedby="nameHelp" placeholder="Nama" required>
                                                                    <input class="form-control" name="NIS" value="'.$aSiswa[siswa_nis].'" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="NIS" required>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                <div class="col-md-12">
                                                                    <label for="exampleInputName">Nama</label>
                                                                    <input class="form-control" name="Nama" value="'.$aSiswa[siswa_nama].'" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Nama" required>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                <div class="col-md-12">
                                                                    <label for="exampleInputName">Password</label>
                                                                    <input class="form-control" name="Password" value="'.$aSiswa[siswa_password].'" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Paasword" required>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                            <button class="btn btn-primary" name="TombolRubah">Simpan Perubahan</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>';

                                                    echo'<div class="modal fade" id="Hapus'.$aSiswa[siswa_id].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">Apakah Anda yakin akan menghapus daftar <b>Siswa '.$aSiswa[siswa_nama].'</b> ini.</div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                            <a class="btn btn-primary" href="?page=siswa&siswad='.$aSiswa[siswa_id].'">Oke</a>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>';
                                                    echo "<tr>
                                                    <td>$j</td>
                                                    <td>$aSiswa[siswa_nis]</td>
                                                    <td>$aSiswa[siswa_nama]</td>
                                                    <td>$aSiswa[siswa_password]</td>
                                                    <td>
                                                        <div class='btn-group' role='group' aria-label='Basic example'>
                                                        <a class='btn btn-primary btn-sm' href='#' data-toggle='modal' data-target='#Edit$aSiswa[siswa_id]' role='button'><i class='fa fa-edit'></i></a>&nbsp;
                                                        <a class='btn btn-primary btn-sm' href='#' data-toggle='modal' data-target='#Hapus$aSiswa[siswa_id]' role='button'><i class='fa fa-trash'></i></a>&nbsp;
                                                        </div>
                                                    </td>
                                                    </tr>";

                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->