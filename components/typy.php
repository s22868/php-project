<?php

#dodawanie typu
if (isset($_POST['typ']) && isset($_POST['kategoria_id'])) {
    $statement = $db->prepare("INSERT INTO typy (typ, id_kategoria) VALUES (:typ, :id_kategoria)");
    $statement->bindParam(':typ', $_POST['typ']);
    $statement->bindParam(':id_kategoria', $_POST['kategoria_id']);
    $statement->execute();
}

#usuwanie typu
if (isset($_POST['deleteType'])) {
    $statement = $db->prepare("DELETE FROM typy WHERE id = :id");
    $statement->bindParam(':id', $_POST['id']);
    $statement->execute();
}


$types = getTypes();

?>

<?php if($categories): ?>

<div class="component">

    <h2>
        Typy:
    </h2>
    
    <ul>
        <?php foreach ($types as $type) { ?>
            <li><div>
                <?php echo $type['typ']; ?>
                <?php echo '(kat. - ' . $type["kategoria"] . ')'; ?>
        </div></li>
            <form action="./index.php" method="POST">
                <input type="hidden" name="id" value=<?php echo $type[0]; ?> />
                <button type="submit" name="deleteType">Usuń</button>
            </form>
            <?php } ?>
        </ul>
        
        <form action="./index.php" method="POST">
            <input type="text" name="typ" placeholder="typ" />
            <select name="kategoria_id" placeholder="kategoria">
                <?php foreach ($categories as $category) { ?>
                    <option value="<?php echo $category['id']; ?>">
                        <?php echo $category['kategoria'];
        } ?>
    </select>
    <input type="submit" value="Dodaj typ" />
</form>
</div>

<?php endif; ?>