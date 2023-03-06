<?php

namespace backend\components;

use yii\base\Widget;
use yii\helpers\Html;

class ColumnsWidget extends Widget
{
    public $columns = [12];
    public $columnLabels = [];

    public function init()
    {
        if(count($this->columns) == 0)
            $this->columns = [12];
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function run()
    {
        $numRows = ceil(count($this->columnLabels) / count($this->columns));
        $rows = [];
        for ( $i = 0; $i < $numRows; $i++) {
            $labelsSelected = array_slice($this->columnLabels,$i * count($this->columns), count($this->columns));
            foreach ($labelsSelected as $label){
                $rows[$i][] = $label;
            }
        }
        $html = "";
        return $this->render('columns-widget',['columns' => $this->columns, 'rows' => $rows]);
    }
}