<?php

namespace App\Schema;

use Norm\Schema\Reference;
use Norm\Norm;
use Bono\Helper\URL;

class AutoComplete extends Reference
{
   

    public function normalizeData()
    {
        if (!is_string($this['foreign'])) {
            $this->flag = 1;
            $data = array();

            foreach ($this['foreign'] as $key => $value) {
                $data[] = array('label' => $value,'value'=>$key);
            }

            $data_sources = json_encode($data);
        } else {
            $this->flag = 2;
            $data_sources = URL::site(strtolower($this['foreign']).'.json');
            
        }

        return $data_sources;
    }

     public function optionLabel($key, $entry)
    {
        
        if (is_scalar($entry)) {
            $label = $entry;
        } elseif ($this['foreignLabel'] instanceof \Closure) {
            $getLabel = $this['foreignLabel'];
            $label = $getLabel($entry);
        } else {
            $label = @$entry[$this['foreignLabel']];
        }

        return $label;
    }

    public function rowData($value){

        if (!is_string($this['foreign'])) {
            return val($this['foreign']) ?: array();
        }

        $model = Norm::factory($this['foreign'])->findOne(array($this['foreignKey'] => $value));
        if(!$model){
            return array();
        }
        return $model;

    }

    

    public function formatInput($value, $entry = null)
    {
        $data_sources = $this->normalizeData($this->get('data_sources'));
        
        return $this->render('_schema/autocomplete/input', array(
            'self' => $this,
            'value' => $value,
            'entry' => $entry,
            'data_sources' => $data_sources,
            'flag' => $this->flag,
        ));
    }
}
