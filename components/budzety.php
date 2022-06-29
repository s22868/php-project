<?php

#dodawanie budzetu
if (isset($_POST['budzet']) && isset($_POST['gotowka']) && isset($_POST['konto_bankowe'])) {
    $statement = $db->prepare("INSERT INTO budzety (miesiac, gotowka, konto_bankowe, user_id) VALUES (:miesiac, :gotowka, :konto_bankowe, :user_id)");
    $statement->bindParam(':miesiac', $_POST['miesiac']);
    $statement->bindParam(':gotowka', $_POST['gotowka']);
    $statement->bindParam(':konto_bankowe', $_POST['konto_bankowe']);
    $statement->bindParam(':user_id', $_COOKIE['zalogowany']);
    $statement->execute();
}

#usuwanie budzetu
if (isset($_POST['deleteBudget'])) {
    $statement = $db->prepare("DELETE FROM budzety WHERE id = :id");
    $statement->bindParam(':id', $_POST['id']);
    $statement->execute();
}

$budgets = getBudgets();

?>

<?php if($types): ?>
<div class="component">
    <h2>Budżety: </h2>
    <ul class="flex flex-wrap flex-row gap-x-5 gap-y-3">
        <?php foreach ($budgets as $budget) { ?>
            <form class="fixed-form" action="../index.php" method="POST">
                <li>
                    <div class="text-center"><p class="text-xl"><?php echo $budget['miesiac'];
                            ?></p>
                        Gotowka - <?php echo $budget['gotowka']; ?> PLN
                        <br/>Konto bankowe - <?php echo $budget['konto_bankowe']; ?> PLN
                    </div>
                </li>
                <button type="submit" name="deleteBudget">Usuń</button>
                <input type="hidden" name="id" value=<?php echo $budget[0]; ?> />
            </form>
        <?php } ?>
    </ul>

    <form action="../index.php" method="POST">
        <select name="miesiac">
            <option value="Styczeń">Styczeń</option>
            <option value="Luty">Luty</option>
            <option value="Marzec">Marzec</option>
            <option value="Kwiecień">Kwiecień</option>
            <option value="Maj">Maj</option>
            <option value="Czerwiec">Czerwiec</option>
            <option value="Lipiec">Lipiec</option>
            <option value="Sierpień">Sierpień</option>
            <option value="Wrzesień">Wrzesień</option>
            <option value="Październik">Październik</option>
            <option value="Listopad">Listopad</option>
            <option value="Grudzień">Grudzień</option>
        </select>
        <input type="text" name="gotowka" placeholder="Budzet w gotówce" />
        <input type="text" name="konto_bankowe" placeholder="Budzet na koncie bankowym" />
        <input type="submit" name="budzet" value="Dodaj budżet" />
    </form>
</div>

<?php endif ?>