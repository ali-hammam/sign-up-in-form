<?php
namespace Model;
use Nesc\DB\Model\Model;

class product extends Model
{
  protected $table = "products";
  public $fillable = ['productstype_id', 'sku' , 'name' , 'price' , 'details'];

  public function products(){
    return $this->belongsTo('productstype');
  }
}