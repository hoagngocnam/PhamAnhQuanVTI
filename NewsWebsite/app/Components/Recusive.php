<?php
namespace App\Components;

use App\Categories;

class Recusive{
    private $data;
    private $htmlSelect = "";
    private $showCatTable = "";
    private $categories_id = 0;

    public function __construct($data, $categories_id = 0)
    {
        $this->data=$data;
        $this->categories_id=$categories_id;
    }
    public function showCategories($id = 0,$text = ""){
        foreach($this->data as $v){
            if($v->parent_id == $id){
                $this->htmlSelect .= "<option value='{$v->id}'" . ($v->id == $this->categories_id ? 'selected' : '') . ">{$text} {$v->name}</option>";
                $this ->showCategories($v->id,$text .'--');
            }
        }
        return $this->htmlSelect;
    }

}