<?php
include 'koneksi.php';

  $id = $_POST['id'];
  $judul   = $_POST['judul'];
  $deskripsi     = $_POST['deskripsi'];
  $id_kategori    = $_POST['id_kategori'];
  $gambar_berita = $_FILES['gambar_berita']['name'];
  
  if($gambar_berita != "") {
    $ekstensi_diperbolehkan = array('png','jpg');  
    $x = explode('.', $gambar_berita); 
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar_berita']['tmp_name'];   
    $angka_acak     = rand(1,999);
    $nama_gambar_baru = $angka_acak.'-'.$gambar_berita; 
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
                  move_uploaded_file($file_tmp, 'gambar/'.$nama_gambar_baru); 
                      
                   $query  = "UPDATE berita SET judul = '$judul', deskripsi = '$deskripsi', id_kategori = '$id_kategori', gambar_berita = '$nama_gambar_baru'";
                    $query .= "WHERE id = '$id'";
                    $result = mysqli_query($koneksi, $query);
                   
                    if(!$result){
                        die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
                    } else {
                      echo "<script>alert('Data berhasil diubah.');window.location='index.php';</script>";
                    }
              } else {     
                  echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='edit_berita.php';</script>";
              }
    } else {
      $query  = "UPDATE berita SET judul = '$judul', deskripsi = '$deskripsi', id_kategori = '$id_kategori'";
      $query .= "WHERE id = '$id'";
      $result = mysqli_query($koneksi, $query);
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
      } else {
          echo "<script>alert('Data berhasil diubah.');window.location='index.php';</script>";
      }
    }