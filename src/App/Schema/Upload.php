<?php

namespace App\Schema;

use \Norm\Schema\Field;
use \Bono\Helper\URL;

class Upload extends Field{

    public function formatInput($value, $entry = null)
    {
        if (!empty($value)) {
            $value = htmlentities($value);
        }

        
        return $this->render('_schema/upload/input', array(
                    'value' => $value,
                    'entry' => $entry,
                    'self' => $this,
                    'url' => \Bono\Helper\URL::site('upload_file').'.json',
            ));
        
    }

    public function formatReadonly($value, $entry = null)
    {
        $type = explode('.', $value);
        end($type);         // move the internal pointer to the end of the array
        $key = key($type);
        if($type[$key] == 'jpg' || $type[$key] == 'png' || $type[$key] == 'jpeg')
        {
            return "<a target='_BLANK' href='".URL::base('data/'.$value)."'><img src='".URL::base('data/'.$value)."' width='150px' /></a>";
        }else{
            return "<a target='_BLANK' href='".URL::base('data/'.$value)."'><span class=\"field\">".($this->formatPlain($value, $entry) ?: '&nbsp;')."</span></a>";
        }
    }
}
