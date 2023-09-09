<?php 
require 'functions.php';

// Ambil data di URL
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];


// Cek apakah submit button sudah diklik atau belum
if( isset($_POST["submit"]) ) {
    // cek apakah data berhasil di edit atau tidak
    if ( ubah($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    }else{
        echo "            
            <script>
                alert('Data gagal diubah!');
                document.location.href = 'edit.php';
            </script>
        ";
    };
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <h1>Ubah data mahasiswa</h1>

    <div class="container">
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
            <div class="mb-3">
                <label for="nama">Nama : </label>
                <input type="text" name="nama" class="form-control" id="nama" required
                value="<?= $mhs["nama"]; ?>">
            </div>
            <div class="mb-3">
                <label for="matkul">Matkul : </label>
                <input type="text" name="matkul" class="form-control" id="matkul" required
                value="<?= $mhs["matkul"]; ?>">             
            </div>
            <div class="grade">
                <label for="grade"><b>Grade:</b></label><br>
                <select name="grade" id="grade" required>
                    <option value="<?= $mhs["grade"]; ?>">Pilih Grade</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                </select>
            </div>
            <div>
                <input type="hidden" name="nilai" value="<?= $mhs["nilai"]; ?>">
            </div>
            <div>
                <button type="button" name="back" class="back">Kembali ke Daftar Mahasiswa</button>
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </div>

    <script>
        const gradeValues = { 
            A: 4, 
            B: 3, 
            C: 2, 
            D: 1, 
            E: 0
        };

        // Ambil elemen dropdown "Grade" dan input "nilai"
        const gradeSelect = document.getElementById("grade");
        const nilaiInput = document.querySelector('input[name="nilai"]');

        // Tambahkan event listener untuk mendengarkan perubahan pada "grade"
        gradeSelect.addEventListener('change', function() {
            // Ambil value yang dipilih dalam "grade"
            const selectedGrade = gradeSelect.value;

            // Jika value yang dipilih adalah salah satu dari gradeValues
            if (gradeValues[selectedGrade] !== undefined) {
                // Set atribut "value" pada elemen input "nilai" dengan nilai yang sesuai
                nilaiInput.setAttribute('value', gradeValues[selectedGrade]);
            } else {
                // Jika grade tidak ada dalam gradeValues, hapus atribut "value" pada elemen input "nilai"
                nilaiInput.removeAttribute('value');
            }
        });
        
        document.querySelector(".back").addEventListener("click", function() {
            window.location.href = "index.php";
        });
    </script>  
</body>
</html>