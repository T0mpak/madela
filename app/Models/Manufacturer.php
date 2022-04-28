<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Manufacturer extends Model
{
    use HasFactory;
    
    protected $guarded = [];
	
	public function products(){
		return $this->hasMany(Product::class);
	}
	
	public static function get_arrayOfIDs_from_collection(Collection $collection)
	{
		$outer_array = $collection->toArray();
		$res_array = array();
		foreach ($outer_array as $inner_array) {
			array_push($res_array, strval($inner_array["id"]));
		}
		
		return $res_array;
	}
}
