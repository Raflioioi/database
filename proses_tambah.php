<?php
include 'koneksi.php';

  $judul   = $_POST['judul'];
  $deskripsi     = $_POST['deskripsi'];
  $id_kategori    = $_POST['id_kategori'];
  $gambar = $_FILES['gambar_berita']['name'];


if($gambar != "") {
  $ekstensi_diperbolehkan = array('png','jpg');
  $x = explode('.', $gambar); 
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['gambar_berita']['tmp_name'];   
  $angka_acak     = rand(1,999);
  $nama_gambar_baru = $angka_acak.'-'.$gambar_berita; 
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {     
                move_uploaded_file($file_tmp, 'gambar/'.$nama_gambar_baru); 
                  $query = "INSERT INTO berita (judul, deskripsi, id_kategori, gambar_berita) VALUES ('$judul', '$deskripsi', '$id_kategori', '$nama_gambar_baru')";
                  $result = mysqli_query($koneksi, $query);
                 
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    echo "<script>alert('Data berhasil ditambah.');window.location='index.php';</script>";
                  }

            } else {     
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_produk.php';</script>";
            }
} else {
   $query = "INSERT INTO berita (judul, deskripsi, id_kategori) VALUES ('$judul', '$deskripsi', '$id_kategori')";
                  $result = mysqli_query($koneksi, $query);
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    echo "<script>alert('Data berhasil ditambah.');window.location='index.php';</script>";
                  }
}