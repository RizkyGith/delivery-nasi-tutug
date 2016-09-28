<?php

namespace App\Schema;

use \Norm\Norm;
use \Bono\Helper\URL;
use \Bono\App;
use \Norm\Schema\DateTime;

class DatePicker extends DateTime
{

    private $date_format = "Y-m-d";
    public function cell($value, $entry = NULL)
    {
        if ($value instanceof \Norm\Type\DateTime) {
            $result = date($this->date_format, strtotime($value->__toString()));
        } else {
            $result = $value;
        }

        return $result;
    }

    public function setFormat($format='Y-m-d'){
        $this->date_format = $format;
    }

    public function formatReadonly($value, $entry = null)
    {
        return '<span class="field">'.($this->formatPlain($value, $entry) ?: '&nbsp;').'</span>';
    }


    public function formatPlain($value, $entry = null)
    {
        if (is_null($value)) {
            return "";
        }
        return date($this->date_format, strtotime($value->__toString()));
    }

    public function cleanString($string)
    {
       $string = str_replace(' ', '_', $string);
       $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

       return preg_replace('/-+/', '-', $string);
    }

    public function formatInput ($value, $entry = NULL)
    {
        $app = App::getInstance();

        if ($value instanceof \Norm\Type\DateTime) {
            $value = date($this->date_format, strtotime($value->__toString()));
        } else {
            if (!empty($value)) {
                $value =  date($this->date_format, strtotime($value));
            }
        }

        if ($this['formatReadonly']) {
            return '<span class="field">'.date($this->date_format, strtotime($value)).'</span>';
        }

        return $this->render('_schema/datepicker/input', array(
            'value' => $value,
            'entry' => $entry,
            'self' => $this,
            'clean_name' => $this->cleanString($this['name'])
        ));
    }
}
