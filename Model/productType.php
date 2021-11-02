<?php
namespace Model;
use Nesc\DB\Model\Model;

class productType extends Model
{
  protected $table = "productstype";

  public function products(){
    return $this->hasMany('products' , 'productstype_id');
  }

}