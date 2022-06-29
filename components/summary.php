<?php

$sum = summary();

?>

<?php if($sum): ?>
<div class="component mb-5">
<h2>Podsumowanie: </h2>
<ul>
    <?php foreach($sum as $row){ 
        $miesiac = $row['miesiac'];
        $sumaSrodkow = $row['gotowka']+$row['konto_bankowe'];
        $sumaWydatkow = $row['sumKwota'];
        $roznica = $sumaSrodkow-$sumaWydatkow;

        ?>
        <li>
            <p class="text-center text-lg text-sky-600"><?php echo $miesiac; ?></p>
            <p class="text-green-500"><?php echo 'Suma środków w danym miesiącu: ' . $sumaSrodkow ; ?></p>
            <p class="text-orange-300"><?php echo 'Suma wydatków w danym miesiącu: ' . $sumaWydatkow ; ?></p>
            <p class="text-blue-400"><?php echo 'Zostało: ' . $roznica; ?></p>
        </li>
        <?php } ?>

</ul>

    </div>
<?php endif; ?>