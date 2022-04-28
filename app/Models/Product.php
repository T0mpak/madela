<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    protected $hidden = [
    	'created_at',
		'updated_at',
	];
	
	public static function getUniqueVendorCode($model, $category_id, $manufacturer_id, $product_name)
	{
		do {
			$random_6_symbols = strtoupper(Str::random(6));
			$category = Category::find($category_id);
			$category_2_symbols = strtoupper(substr($category->name, 0, 2));
			$manufacturer = Manufacturer::find($manufacturer_id);
			$manufacturer_2_symbols = strtoupper(substr($manufacturer->name, 0, 2));
			$product_2_symbols = strtoupper(substr($product_name, 0, 2));
			$code = $category_2_symbols.$manufacturer_2_symbols.$product_2_symbols.$random_6_symbols;
		} while ($model::query()->where(compact('code'))->exists());
		
		return $code;
	}
	
	public function category() {
		return $this->belongsTo(Category::class);
	}
	
	public function manufacturer() {
		return $this->belongsTo(Manufacturer::class);
	}
	
	public function photos()
	{
		return $this->morphMany(Photo::class,'imageable');
	}
	
	public function get_first_photo_path()
	{
		return "storage/".$this->photos()->first()->path;
	}
	
	public function orders()
	{
		return $this->belongsToMany(Order::class);
	}
}
