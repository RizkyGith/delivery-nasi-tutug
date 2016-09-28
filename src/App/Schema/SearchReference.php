<?php

namespace App\Schema;

use Norm\Norm;
use Bono\App;
// use Norm\Schema\Reference;

// TODO recheck this implementation later
// FIXME remove all properties and add attributes by set()

class SearchReference extends Reference {

    // protected $foreign;
    // protected $foreignLabel;
    // protected $foreignKey;
    protected $filterColumns;

    // public function to($foreign, $foreignKey, $foreignLabel = null) {
    //     $this['foreign'] = $foreign;
    //     if (is_null($foreignLabel)) {
    //         $this['foreignLabel'] = $foreignKey;
    //         $this['foreignKey'] = null;
    //     } else {
    //         $this['foreignLabel'] = $foreignLabel;
    //         $this['foreignKey'] = $foreignKey;
    //     }
    //     return $this;
    // }

    public function filterColumns($columns = array()){

        $this->filterColumns = $columns;

        return $this;
    }

    public function getFilterColumns($type = 'json'){
        if($type == 'json'){
            if(empty($this->filterColumns)){
                return json_encode(array(''));
            }

            return json_encode($this->filterColumns);
        }else{
            
            return $this->filterColumns;
        }
    }


    public function formatInput($value, $entry = NULL) {
        $app = App::getInstance();

        $foreign = Norm::factory($this['foreign']);

        if ($this['readonly']) {
            if (is_null($this['foreignKey'])) {

                $entry = Norm::factory($this['foreign'])->findOne($value);
            } else {
                $criteria = array($this['foreignKey'] => $value);
                $entry = Norm::factory($this['foreign'])->findOne($criteria);
            }



            if (is_callable($this['foreignLabel'])) {
                $getLabel = $this['foreignLabel'];
                $label = $getLabel($entry);
            } else {
                $label = $entry[$this['foreignLabel']];
            }
            return '<span class="field">'.$label.'</span>';
        }


        if(!empty($value)){
            $entry = $foreign->findOne($value);
        }


        return $app->theme->partial('_schema/searchreference', array(
            'self' => $this,
            'value' => $value,
            'entry' => $entry,
            'foreignName' => $foreign->name,
            'criteria' => $this['byCriteria'],
        ));
    }


}
