<?php 

namespace App\Schema;

class Editor extends \Norm\Schema\Text
{
    public function prepare($value)
    {
        return html_entity_decode($value);
    }

     public function formatPlain($value, $entry = null)
    {
        return strip_tags($value);
    }
}