<?php

class gameOfLine {

    private $gameArray = array();
    private $sizeX;
    private $sizeY;

    public function gameOfLine($sizeX, $sizeY) {
        $this->setSizeX($sizeX);
        $this->setSizeY($sizeY);
        for ($i = 0; $i <= $this->getSizeX() + 1; $i++) {
            for ($j = 0; $j <= $this->getSizeY() + 1; $j++) {
                $this->gameArray[$i][$j] = 0;
            }
        }
    }

    public function init() {
        for ($i = 1; $i <= $this->getSizeX(); $i++) {
            for ($j = 1; $j <= $this->getSizeY(); $j++) {
                $this->gameArray[$i][$j] = ((rand(0, 1000) < 500) ? 1 : 0);
            }
        }
    }

    public function run() {
        $this->init();
        while (true) {
            $this->display();
            sleep(2);
            $this->gameStep();
        }
    }

    private function gameStep() {
        $gameArrayNew = $this->gameArray;
        for ($i = 1; $i <= $this->getSizeX(); $i++) {
            for ($j = 1; $j <= $this->getSizeY(); $j++) {
                $neighboursCount = $this->getNeighboursCount($i, $j);
                if ($this->gameArray[$i][$j]) {
                    if ($neighboursCount < 2 || $neighboursCount > 3) {
                        $gameArrayNew[$i][$j] = 0;
                    }
                } else {
                    if ($neighboursCount == 3) {
                        $gameArrayNew[$i][$j] = 1;
                    }
                }
            }
        }
        $this->gameArray = $gameArrayNew;
    }

    private function display() {
        for ($i = 1; $i <= $this->getSizeX(); $i++) {
            for ($j = 1; $j <= $this->getSizeY(); $j++) {
                echo $this->gameArray[$i][$j] ? "x" : ".";
            }
            echo "\n";
        }
        echo "\n";
    }

    private function setSizeX($sizeX) {
        $this->sizeX = $sizeX;
    }

    private function setSizeY($sizeY) {
        $this->sizeY = $sizeY;
    }

    private function getSizeX() {
        return $this->sizeX;
    }

    private function getSizeY() {
        return $this->sizeY;
    }

    private function getNeighboursCount($x, $y) {
        return $this->gameArray[$x - 1][$y - 1] + $this->gameArray[$x][$y - 1] + $this->gameArray[$x + 1][$y - 1] +
           $this->gameArray[$x - 1][$y] + $this->gameArray[$x + 1][$y] +
           $this->gameArray[$x - 1][$y + 1] + $this->gameArray[$x][$y + 1] + $this->gameArray[$x + 1][$y + 1];
    }

}
