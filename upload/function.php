<?php
// Koneksikan ke Database

$koneksi = mysqli_connect("localhost", "root", "", "pkk");

function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($sws = mysqli_fetch_assoc($result)) {
        $rows[] = $sws;
    }
    return $rows;
}

function tambah($data)
{
    global $koneksi;

    //ambil dari data dari tiap elemen form
    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambar = htmlspecialchars($data["gambar"]);

   // upload gambar 
   $gambar = upload();
   if (!$gambar){
       return false;
   }

    // query insert data
    $query = " INSERT INTO siswa 
    VALUES (id, '$nim', '$nama', '$email', '$jurusan', '$gambar')";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function upload()
{
   $namafile = $_FILES['gambar']['name'];
   $ukuranfile = $_FILES['gambar']['size'];
   $eror = $_FILES['gambar']['eror'];
   $tmpName = $_FILES['gambar']['tmp_name'];

   // cek apakah tidak ada gambar yang diupload 
   if ($eror === 4){
       echo  "<script>
       alert('pilih gambar terlebih dahulu');
            </scrip>";
        return false;

   }
   
   //cek apakah yang diupload itu gambar
   $ekstensiGambarValid =['JPG','Jpeg','png','jpg','PNG','JPEG',];
   $ektensiGambar = explode('.',$namafile);
   //fungsi explode itu string array , kalau nama
   // filenya yurike.jpg itu menjadi['yurike','jpg']
   $ekstensiGambar = strtolower(end($ekstensiGambar));
   if (!in_array($ekstensiGambar, $ekstensiGambarValid)){
       echo  "<script>
       alert('yang anda upload bukan gambar');
            </scrip>";
   }
}

function ubah($data)
{
    global $conn;
    //ambil dari data tiap elemn form
    $id =$data["id"];
    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambar = htmlspecialchars($data["gambar"]);

    //cek apakah user pilih gambar baru atau tidak
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    if ($_FILES['gambar']['error'] === 4) {
    } else{

     $gambar = upload();
}

//query insert data
$query ="UPDATE maha siswa SET
         nim =  '$nim' 
         nama ='$nama'
         email ='$email' 
         jurusan = '$jurusan'
         gambar = 'gambar'

         WHERE id = $id
         ";
    mysqli_query($conn,$query);
    
    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM siswa WHERE id = $id");
    return mysqli_affected_rows($koneksi);
}

    function cari($keyword){
        $query = "SELECT * FROM siswa
                     WHERE
                    nim LIKE '%$keyword%' OR
                    nama LIKE '%$keyword%' OR
                    email LIKE '%$keyword%' OR
                    jurusan LIKE '%$keyword%' OR
                    ";
        return query($query);
    }