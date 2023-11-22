<?php

require 'connect.php';

// (1) Mulai session
session_start();
//

// (2) Ambil nilai input dari form registrasi

    // a. Ambil nilai input email
    $email = $_POST['email'];
    // b. Ambil nilai input name
    $ama = $_POST['nama'];
    // c. Ambil nilai input username
    $usernama = $_POST['username'];
    // d. Ambil nilai input password
    // e. Ubah nilai input password menjadi hash menggunakan fungsi password_hash()
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

//
// (3) Buat dan lakukan query untuk mencari data dengan email yang sama dari nilai input email
    $quary1 = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($db, $quary1);
//

// (4) Buatlah perkondisian ketika tidak ada data email yang sama ( gunakan mysqli_num_rows == 0 )
    if(mysqli_num_rows($result) == 0) {
    // a. Buatlah query untuk melakukan insert data ke dalam database
        $query2 = "INSERT INTO users (name, email, username, password) VALUES ('$nama','$email','$username','$assword')";
        $result = mysqli_query($db, $query2);

    // b. Buat lagi perkondisian atau percabangan ketika query insert berhasil dilakukan
    //    Buat di dalamnya variabel session dengan key message untuk menampilkan pesan penadftaran berhasil
        if($result) {
            $_session['message'] = 'Pendaftaran sukses, silahkan login';
            $_session['color'] = 'succes';
            header('Location: ../views/login.php');
        }else{
            $_session['message'] = 'Pendaftaran Gagal';

        }
    }
// 

// (5) Buat juga kondisi else
//     Buat di dalamnya variabel session dengan key message untuk menampilkan pesan error karena data email sudah terdaftar
else {
    $_session['message'] = 'Email sudah terdaftar';
    header('Location: ../views/register.php');
}
//

?>