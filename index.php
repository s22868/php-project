<?php
require_once './baza-danych.php';
# testowy uzytkownik - login: test 
#                      haslo: test123

if ($_COOKIE['zalogowany'] == 0) {
    header('location: login.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<style type="text/tailwindcss">
    @layer base {
      ul {
        @apply flex flex-col items-center justify-center;
      }
      ul li::before {
        content: "--";
        color: green;
        left: 50%;
        position: relative;
        transform: translateX(-50%);
        display: inline-block;

    }
    ul li::after {
        content: "--";
        position: relative;
        color: green;
        left: 50%;
        transform: translateX(-50%);
        display: inline-block;
        
    }

      button[type="submit"]{
        @apply border-2 border-red-500 bg-red-300 cursor-pointer m-2 p-1 rounded-md;
      }
      input[type="submit"]{
        @apply border-2 border-green-500 bg-green-300 cursor-pointer m-2 p-1 rounded-md;
      }
      form{
        @apply flex flex-col justify-center items-center;

      }
      input{
        @apply my-2 p-2 rounded-md w-1/2;
      }
      select{
        @apply my-2 p-2 rounded-md w-1/2;
      }

      .fixed-form{
        @apply flex gap-3; 
      }
      .component{
          @apply w-1/2 border-4 border-sky-500 p-3 rounded-md;
      }
      .component h2 {
        @apply text-center text-2xl text-indigo-500;
      }
    }
</style>

<body class="flex flex-col items-center justify-center bg-red-50 gap-5 py-5">
    <div class="flex w-1/2 flex-wrap">
        <h1 class="flex-1 min-w-min text-center font-extrabold text-transparent text-4xl lg:text-8xl bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600">Dashboard</h1>
        <form class="md:ml-auto m-auto min-w-min" action="./login.php" method="POST">
            <input class=" w-auto" class="w-full" type="submit" name="wyloguj" value="Wyloguj" />
        </form>
    </div>
    <?php
    require_once './components/kategorie.php';
    require_once './components/typy.php';
    require_once './components/budzety.php';
    require_once './components/wydatki.php';
    require_once './components/summary.php';
    ?>
</body>

</html>