<?php

namespace App\Schema;

use Norm\Schema\Object;

class Images extends Object
{
    public function formatInput($value, $entry = null)
    {
        $base_url = \Bono\Helper\URL::base();
        $base_bucket = dirname($base_url);

        return $this->render('_schema/images/input', array(
            'value' => $value,
            'entry' => $entry,
            'uploadUrl' => 'uploader/Upload.php',
            'prefix' => $base_url,
            'base_bucket' => $base_bucket,
        ));
    }

    public function formatReadonly($value, $entry = null)
    {
        $base_url = \Bono\Helper\URL::base();
        $base_bucket = dirname($base_url);

        return $this->render('_schema/images/readonly', array(
            'value' => $value,
            'entry' => $entry,
            'uploadUrl' => 'uploader/Upload.php',
            'prefix' => $base_url,
            'base_bucket' => $base_bucket,
        ));
    }
}
