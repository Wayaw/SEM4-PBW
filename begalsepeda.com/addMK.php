<?php
    include "connection/conn.php";

    // Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Inisialisasi variabel data dengan array kosong
    $data = array('namaM' => '', 'jurusan' => '', 'alamat' => '', 'npm' => '');

    // Cek apakah ada kiriman form dari method POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $kodemk = htmlspecialchars($_POST["kodemk"]);
        $nama = input($_POST["nama"]);
        $jumlah_sks = input($_POST["jumlah_sks"]);

        // Query insert data ke tabel mahasiswa
        $sql = "INSERT INTO matakuliah (kodemk, nama, jumlah_sks) VALUES ('$kodemk', '$nama', '$jumlah_sks')";

        // Mengeksekusi atau menjalankan query di atas
        $query = mysqli_query($db, $sql);

        // Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($query) {
            header("Location: matakuliah.php");
        } else {
            echo "<div class='alert alert-danger'>Data Gagal disimpan.</div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link rel="icon" href="https://www.gigaval.com/favicon.ico">
</head>

<style>
    body{
        background-color: #1c2733;
        color: #fff;
        }
    main {
        margin: 7% 20%;
    }
    h1 {
        border-bottom: 2px solid #e91e63;
    }

    .container {
        max-width: 500px;
        margin: 3% 20% auto;
        padding: 20px;
        background-color: #263545;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group input[type="text"],
    .form-group input[type="number"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        overflow: hidden;
        resize: none;
    }

    .form-group input[type="number"]::-webkit-inner-spin-button,
    .form-group input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
            


    .form-group input[type="submit"] {
        background-color: #e91e63;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-group input[type="submit"]:hover {
        background-color: #0056b3;
    }

    #alamat {
        width: 100%;
        max-width: 100%;
        min-height: 70px;
        height: 100px;
        max-height: 100px;
    }
    #jurusan {
        width: 100%;
        height: 40px;
    }
</style>

<body>
    <?php include "layout/nav.php" ?>
    <main>
        <div>
            <h1>Tambah Data Mata Kuliah</h1>
        </div>
        <br>
        <div class="mb-3">
            <div class="container">
                <h2>Isi Data dengan Benar</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="kodemk">Kode Mata Kuliah:</label>
                        <input type="text" id="kodemk" name="kodemk" placeholder="Masukkan Kode Mata Kuliah" required value="<?php echo isset($data['kodemk']) ? $data['kodemk'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Mata Kuliah:</label>
                        <input type="text" id="nama" name="nama" placeholder="Isi Nama Mata Kuliah" required value="<?php echo isset($data['nama']) ? $data['nama'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_sks">Jumlah SKS:</label>
                        <input type="number" id="jumlah_sks" name="jumlah_sks" placeholder="Isi Jumlah SKS">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
