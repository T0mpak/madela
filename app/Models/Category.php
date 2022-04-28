<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getUniqueVendorCode($model)
    {
        do {
            $code = Str::random(12);
        } while ($model::query()->where(compact('code'))->exists());

        return $code;
    }
    
    public function products(){
    	return $this->hasMany(Product::class);
	}
	
	public function photos()
	{
		return $this->morphMany(Photo::class,'imageable');
	}
	
	public function get_first_photo_path()
	{
		return "storage/".$this->photos()->first()->path;
	}
}
