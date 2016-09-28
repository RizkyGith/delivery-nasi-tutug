<?php

namespace App\Controller;

use \Norm\Norm;
use \Norm\Controller\NormController;
use \Bono\Helper\URL;

class RegisterController extends NormController 
    {
    //* mapRoute
    public function mapRoute()
    {
        parent::mapRoute();

        // $this->map('/null/laporan', 'laporan')->via('GET');
  
    }

    public function create () {

        var_dump('expression'); exit();
    }


}