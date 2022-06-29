<?php 
# testowy uzytkownik - login: test 
#                      haslo: test123

require_once './baza-danych.php';
$error_msg="";
if(isset($_POST['wyloguj'])){
    setcookie('zalogowany', 0, time()-3600);
}

if (isset($_POST['login']) && isset($_POST['haslo'])) {
    $result = login($_POST['login'], $_POST['haslo']);
    if ($result) {
        header('location: index.php');
    } else {
        setcookie('zalogowany', 0, time() + (86400 * 30), "/");
        $error_msg = "Bledny login lub haslo";

    }
}

if(isset($_COOKIE['zalogowany']) && $_COOKIE['zalogowany']!=0){
    header('location: index.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex content-center justify-center h-screen">
    <form class="flex flex-col w-2/5 m-auto gap-5" action="./login.php" method="post">
        <h1 class="text-center font-extrabold text-transparent text-4xl lg:text-6xl bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600 h-14 lg:h-20">Logowanie</h1>
        <input class="border-2 rounded-md p-2" type="text" name="login" placeholder="Login">
        <input class="border-2 rounded-md p-2" type="password" name="haslo" placeholder="Haslo">
        <p class="m-auto text-red-500 font-bold"><?php echo $error_msg; ?></p>
        <input class="p-2 text-orange-800 font-bold transition-all hover:text-orange-50 bg-orange-400 rounded-lg cursor-pointer" type="submit" value="Zaloguj">
    </form>
</body>
</html>