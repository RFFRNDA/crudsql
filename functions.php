<?php 
// Koneksi ke database
$conn = mysqli_connect("localhost","root","","crud_sib");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {
    global $conn;
    //ambil data dari tiap elemen dalam form
    //htmlspecialchars untuk mengconvert <,>,&," agar tidak diproses oleh web browser
    //Hal itu untuk menghindadri penyusupan element HTML pada sebuah inputan
    $nama = htmlspecialchars($data["nama"]);
    $matkul = htmlspecialchars($data["matkul"]);
    $grade = htmlspecialchars($data["grade"]);
    $nilai = htmlspecialchars($data["nilai"]);

    //query insert data
    $query = "INSERT INTO mahasiswa
                VALUES ('','$nama','$matkul','$grade','$nilai')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    
    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $matkul = htmlspecialchars($data["matkul"]);
    $grade = htmlspecialchars($data["grade"]);
    $nilai = htmlspecialchars($data["nilai"]);

    $query = "UPDATE mahasiswa SET 
                nama = '$nama',
                matkul = '$matkul',
                grade = '$grade',
                nilai = '$nilai'
                WHERE id = $id
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword) {
    $query = "SELECT * FROM mahasiswa
                WHERE nama LIKE '%$keyword%' OR
                matkul LIKE '%$keyword%' OR
                grade LIKE '%$keyword%' OR
                nilai LIKE '%$keyword%'
            ";
    // Menggunakan wildcard dengan LIKE %-% agar pencarian fleksibel
    return query($query);
}


?>