<?php

include_once 'src/Cell.php';
include_once 'src/Board.php';
include_once 'src/BoardPrinter.php';

$size = 20;
$cells = [];
for ($x = 0; $x < $size; $x++) {
    for ($y = 0; $y < $size; $y++) {
        $cells[] = new Cell($x, $y, rand(1, 5) !== 1);
    }
}
$board = new Board($cells);
$printer = new BoardPrinter($board);

echo '<div style="display:flex; height: 9999px;flex-wrap: wrap;align-content: flex-start">';
for ($i = 0; $i < 23; $i++) {
    echo $printer->asHtml();

    $board->evolve();
}
echo $printer->asHtml();

echo '</div>';
