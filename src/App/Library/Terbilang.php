<?php

namespace App\Library;

use Bono\App;
use Bono\Helper\URL;
use Norm\Norm;

class Terbilang
{
    
    public function terbilang($i)
    {
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");

        if ($i < 12) return " " . $huruf[$i];
        elseif ($i < 20) return $this->terbilang($i - 10) . " belas";
        elseif ($i < 100) return $this->terbilang($i / 10) . " puluh" . $this->terbilang($i % 10);
        elseif ($i < 200) return " seratus" . $this->terbilang($i - 100);
        elseif ($i < 1000) return $this->terbilang($i / 100) . " ratus" . $this->terbilang($i % 100);
        elseif ($i < 2000) return " seribu" . $this->terbilang($i - 1000);
        elseif ($i < 1000000) return $this->terbilang($i / 1000) . " ribu" . $this->terbilang($i % 1000);
        elseif ($i < 1000000000) return $this->terbilang($i / 1000000) . " juta" . $this->terbilang($i % 1000000);    
    }
}