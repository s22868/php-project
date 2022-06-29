<?php


#dodawanie wydatku
if (isset($_POST['wydatki']) && isset($_POST['typ_id']) && isset($_POST['budzet_id']) && isset($_POST['dzien']) && isset($_POST['opis']) && isset($_POST['kwota'])) {
    $statement = $db->prepare("INSERT INTO wydatki (kwota, id_typu, id_budzet, dzien, opis) VALUES (:kwota, :id_typu, :id_budzet, :dzien, :opis)");
    $statement->bindParam(':kwota', $_POST['kwota']);
    $statement->bindParam(':id_typu', $_POST['typ_id']);
    $statement->bindParam(':id_budzet', $_POST['budzet_id']);
    $statement->bindParam(':dzien', $_POST['dzien']);
    $statement->bindParam(':opis', $_POST['opis']);
    $statement->execute();
}

#usuwanie wydatku
if (isset($_POST['deleteOutgoing'])) {
    $statement = $db->prepare("DELETE FROM wydatki WHERE id = :id");
    $statement->bindParam(':id', $_POST['id']);
    $statement->execute();
}

$outgoings = getOutgoings();

?>

<?php if($types && $budgets): ?>

<div class="component">

    <h2>Wydatki:</h2>
    
    <ul class="flex flex-wrap flex-row gap-x-5 gap-y-3">
        <?php foreach ($outgoings as $outgoing) { ?>
            <form  action="../index.php" method="POST">
                <li>
                    <div>
                Kwota - <?php echo $outgoing['kwota']; ?> PLN
                <br /> Opis - <?php echo $outgoing['opis']; ?>
                <br /> Typ - <?php echo $outgoing['typ']; ?>
                <br /> Kategoria - <?php echo $outgoing['kategoria']; ?>
                <br /> Miesiac - <?php echo $outgoing['miesiac']; ?>
                <br /> Dzien - <?php echo $outgoing['dzien']; ?>
        </div>
            </li>
            <button type="submit" name="deleteOutgoing">Usuń</button>
            <input type="hidden" name="id" value=<?php echo $outgoing[0]; ?> />
        </form>
        <?php } ?>
        
    </ul>
    
    <script>
        window.onload = () => onBudgetChange();
        const onBudgetChange = () => {
            
            const getFullDate = (month) => {
                switch (month) {
                    case 'Styczeń':
                        return {
                            min: new Date().getFullYear() + '-01-01',
                            max: new Date().getFullYear() + '-01-31'
                        }
                        case 'Luty':
                            return {
                                min: new Date().getFullYear() + '-02-01',
                                max: new Date().getFullYear() + '-02-28'
                            }
                            case 'Marzec':
                                return {
                                    min: new Date().getFullYear() + '-03-01',
                                    max: new Date().getFullYear() + '-03-31'
                                }
                                case 'Kwiecień':
                                    return {
                                        min: new Date().getFullYear() + '-04-01',
                                        max: new Date().getFullYear() + '-04-30'
                                    }
                                case 'Maj':
                                    return {
                                        min: new Date().getFullYear() + '-05-01',
                                            max: new Date().getFullYear() + '-05-31'
                                    }
                                    case 'Czerwiec':
                                        return {
                                            min: new Date().getFullYear() + '-06-01',
                                            max: new Date().getFullYear() + '-06-30'
                                        }
                                        case 'Lipiec':
                                            return {
                                                min: new Date().getFullYear() + '-07-01',
                                                max: new Date().getFullYear() + '-07-31'
                                            }
                                            case 'Sierpień':
                                                return {
                                                    min: new Date().getFullYear() + '-08-01',
                                                    max: new Date().getFullYear() + '-08-30'
                                                }
                                                case 'Wrzesień':
                                                    return {
                                                        min: new Date().getFullYear() + '-09-01',
                                                        max: new Date().getFullYear() + '-09-31'
                                                    }
                                                    case 'Październik':
                                                        return {
                                                            min: new Date().getFullYear() + '-10-01',
                                                            max: new Date().getFullYear() + '-10-30'
                                                        }
                                                        case 'Listopad':
                                                            return {
                                                                min: new Date().getFullYear() + '-11-01',
                                                                max: new Date().getFullYear() + '-11-31'
                                                            }
                                                            case 'Grudzień':
                                                                return {
                                                                    min: new Date().getFullYear() + '-12-01',
                                                                        max: new Date().getFullYear() + '-12-30'
                                                                }
                                                            }
        }
        
        const budget = document.getElementById('budget');
        
        const fullDate = getFullDate(budget.options[budget.selectedIndex].text)
        const dateElement = document.getElementById('date');
        dateElement.min = `${fullDate.min}`;
        dateElement.max = `${fullDate.max}`;
        dateElement.value = `${fullDate.min}`;
    };
</script>

<form action="../index.php" method="POST">
    <input id="date" type="date" name="dzien" placeholder="data" />
    <select name="typ_id" placeholder="typ">
        <?php foreach ($types as $type) { ?>
            <option value="<?php echo $type[0]; ?>">
                <?php echo $type['typ'];
        } ?>
    </select>
    <select id="budget" onchange="onBudgetChange()" name="budzet_id" placeholder="budzet">
        <?php foreach ($budgets as $budzet) { ?>
            <option value="<?php echo $budzet[0]; ?>">
                <?php echo $budzet['miesiac'];
        } ?>
        </select>
        <input type="number" name="kwota" placeholder="kwota" />
        <input type="text" name="opis" placeholder="opis" />
        <input type="submit" name="wydatki" value="Dodaj wydatek" />
        
    </form>
</div>

<?php endif; ?>