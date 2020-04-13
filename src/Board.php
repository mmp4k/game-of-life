<?php

declare(strict_types=1);

class Board
{
    /**
     * @var Cell[]
     */
    private $cells;

    /**
     * @param $cells Cell[]
     */
    public function __construct($cells)
    {
        $this->cells = $cells;
    }

    /**
     * @return Cell[]
     */
    public function neighborhood(Cell $cell): array
    {
        $neighbors = [];
        foreach ($this->cells as $cellToCompare) {
            if (!$cell->areWeNeighbors($cellToCompare)) {
                continue;
            }

            $neighbors[] = $cellToCompare;
        }

        return $neighbors;
    }

    /**
     * @return Cell[]
     */
    public function cells(): array {
        return $this->cells;
    }

    public function evolve(): void
    {
        $evolvedCells = [];
        foreach ($this->cells as $cell) {
            $evolvedCells[] = $cell->evolveWith($this->neighborhood($cell));
        }

        $this->cells = $evolvedCells;
    }
}
