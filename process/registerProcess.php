<?php
// untuk ngecek tombol yang namenya 'register' sudah di pencet atau belum
// $_POST itu method di formnya
if(isset($_POST['register'])){
// untuk mengoneksikan dengan database dengan memanggil file db.php
include('../db.php');
// tampung nilai yang ada di from ke variabel
// sesuaikan variabel name yang ada di registerPage.php disetiap input
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$name = $_POST['name'];
$phonenum = $_POST['phonenum'];
$membership = $_POST['membership'];

$isEmailAlready = "SELECT email from users WHERE email='$email'";
$checkEmail = mysqli_query($con, $isEmailAlready);

if($checkEmail){
    echo
    '<script>
    alert("Register Failed, Email Already Taken");
    window.location = "../index.php"
    </script>';

    return;
}

// Melakukan insert ke databse dengan query dibawah ini
$query = mysqli_query($con,
"INSERT INTO users(email, password, name, phonenum, membership)
VALUES
('$email', '$password', '$name', '$phonenum', '$membership')")
or die(mysqli_error($con)); // perintah mysql yang gagal dijalankan ditangani oleh perintah “or die”
if(mysqli_num_rows($res_u) > 0){
    echo
    '<script>
    alert("Register Failed");
    </script>';
}else if($query){
echo
'<script>
alert("Register Success");
window.location = "../index.php"
</script>';
}else{
echo
'<script>
alert("Register Failed");
</script>';
}
}else{
echo
'<script>
window.history.back()
</script>';
}
?>