<?php

declare(strict_types=1);

class Cell
{
    private $positionX;
    private $positionY;
    private $isDead;

    public function __construct(int $positionX, int $positionY, bool $isDead)
    {
        $this->positionX = $positionX;
        $this->positionY = $positionY;
        $this->isDead = $isDead;
    }

    public function isDead(): bool {
        return $this->isDead;
    }
    public function isAlive(): bool {
        return !$this->isDead;
    }

    public function positionX(): int
    {
        return $this->positionX;
    }

    public function positionY(): int
    {
        return $this->positionY;
    }

    public function isSame(self $other): bool {
        return $this->positionY === $other->positionY() && $this->positionX === $other->positionX();
    }

    public function areWeNeighbors(Cell $cellToCompare): bool
    {
        if ($cellToCompare->isSame($this)) {
            return false;
        }

        $startX = $this->positionX - 1;
        $endX = $this->positionX + 1;

        $startY = $this->positionY - 1;
        $endY = $this->positionY + 1;

        $xOk = false;
        $yOk = false;
        if ($cellToCompare->positionX() >= $startX && $cellToCompare->positionX() <= $endX) {
            $xOk = true;
        }
        if ($cellToCompare->positionY() >= $startY && $cellToCompare->positionY() <= $endY) {
            $yOk = true;
        }

        return $xOk && $yOk;
    }

    /**
     * @param Cell[] $neighbors
     */
    public function evolveWith($neighbors): Cell
    {
        $isDead = $this->isDead;

        if ($this->isDead() && $this->neighborsAreAlive($neighbors)) {
            $isDead = false;
        } else if ($this->isAlive() && ($this->isAlone($neighbors) || $this->isCrowded($neighbors))) {
            $isDead = true;
        }

        return new Cell($this->positionX(), $this->positionY(), $isDead);
    }

    /**
     * @param Cell[] $cells
     */
    private function isAlone($cells): bool
    {
        $alive = 0;
        foreach ($cells as $cell) {
            if ($cell->isDead()) {
                continue;
            }
            $alive++;
        }

        return $alive < 2;
    }

    /**
     * @param Cell[] $cells
     */
    private function isCrowded($cells): bool
    {
        $alive = 0;
        foreach ($cells as $cell) {
            if ($cell->isDead()) {
                continue;
            }
            $alive++;
        }

        return $alive > 3;
    }

    /**
     * @param Cell[] $cells
     */
    private function neighborsAreAlive($cells): bool
    {
        $alive = 0;
        foreach ($cells as $cell) {
            if ($cell->isDead()) {
                continue;
            }
            $alive++;
        }

        return $alive === 3;

    }
}
