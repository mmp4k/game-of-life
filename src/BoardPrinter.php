<?php

declare(strict_types=1);

class BoardPrinter
{
    private $board;

    public function __construct(Board $board)
    {
        $this->board = $board;
    }

    public function asHtml(): string
    {
        $mappedCells = $this->map();
        $return = '<table>';

        for ($y = 0; $y < 99999; $y++) {
            if (!isset($mappedCells['0+'.$y])) {
                break;
            }
            $return .= '<tr>';
            for ($x = 0; $x < 99999; $x++) {
                if (!isset($mappedCells[$x.'+'.$y])) {
                    break;
                }
                $return .= '<td '.(!$mappedCells[$x.'+'.$y] ? 'bgcolor="#006400;"' : 'bgcolor="grey;"').' style="width:15px;height:15px"></td>';
            }
            $return .= '</tr>';
        }
        return $return . '</table>';
    }

    private function map()
    {
        $mappedCells = [];

        foreach ($this->board->cells() as $cell) {
            $mappedCells[$cell->positionX().'+'.$cell->positionY()] = $cell->isDead();
        }

        return $mappedCells;
    }
}
