<?php

#dodawanie kategorii
if (isset($_POST['kategoria'])) {
    $statement = $db->prepare("INSERT INTO kategorie (kategoria) VALUES (:kategoria)");
    $statement->bindParam(':kategoria', $_POST['kategoria']);
    $statement->execute();
}

#usuwanie kategorii
if (isset($_POST['deleteCategory'])) {
    $statement = $db->prepare("DELETE FROM kategorie WHERE id = :id");
    $statement->bindParam(':id', $_POST['id']);
    $statement->execute();
}

$categories = getCategories();

?>
<div class="component">
<h2>Kategorie:</h2>
<ul>
    <?php foreach ($categories as $category) { ?>
        <form action="./index.php" method="POST">
            <li><div><?php echo $category['kategoria'];
                ?></div></li>
            <button type="submit" name="deleteCategory">Usuń</button>
            <input type="hidden" name="id" value=<?php echo $category['id']; ?> />
        <?php } ?>
        </form>
</ul>

<form action="./index.php" method="POST">
    <input type="text" name="kategoria" placeholder="kategoria" />
    <input type="submit" value="Dodaj kategorie" />
</form>
    </div>