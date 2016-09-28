<?php

namespace App\Controller;

use \Norm\Norm;
use \Norm\Controller\NormController;
use \Bono\Helper\URL;
use \App\Report\ReportExport;

class profilController extends NormController 
    {
    //* mapRoute
    public function mapRoute()
    {
        parent::mapRoute();

        $this->map('/null/tentangKami', 'tentangKami')->via('GET');
  
    }

    function tentangKami ()
    {
    
    }

}