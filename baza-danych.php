<?php
    $dbUser = 'root';
    $dbPass = 'toor123';
    $db = new PDO('mysql:host=localhost;dbname=php_projekt2', $dbUser, $dbPass);

    function login($login, $haslo) {
        global $db;
        $statement = $db->prepare("SELECT * FROM uzytkownicy where login = :login and haslo = :haslo");
        $statement->bindParam(':login', $login);
        $statement->bindParam(':haslo', $haslo);
        $statement->execute();
        $result = $statement->fetch();
        if($result) {
            setcookie('zalogowany', $result['id'], time() + (86400 * 30), "/");
            return true;
        } else {
            return false;
        }
    }

    function getCategories() {
        global $db;
        $statement = $db->prepare("SELECT * FROM kategorie");
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    function getTypes(){
        global $db;
        $statement = $db->prepare("SELECT * FROM typy INNER JOIN kategorie ON typy.id_kategoria = kategorie.id");
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    function getBudgets(){
        global $db;
        $statement = $db->prepare("SELECT * FROM budzety INNER JOIN uzytkownicy ON budzety.user_id = uzytkownicy.id where uzytkownicy.id = budzety.user_id");
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    function getOutgoings(){
        global $db;
        $statement = $db->prepare("SELECT * FROM wydatki INNER JOIN typy ON wydatki.id_typu = typy.id INNER JOIN kategorie ON typy.id_kategoria = kategorie.id INNER JOIN budzety ON wydatki.id_budzet = budzety.id where budzety.user_id = :user_id order by budzety.miesiac");
        $statement->bindParam(':user_id', $_COOKIE['zalogowany']);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    function summary(){
        global $db;
        $statement = $db->prepare("select *, sum(kwota) as sumKwota from budzety, wydatki where budzety.user_id = :user_id and wydatki.id_budzet = budzety.id group by miesiac" ) ;
        $statement->bindParam(':user_id', $_COOKIE['zalogowany']);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }


?>