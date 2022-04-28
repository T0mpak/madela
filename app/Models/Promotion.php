<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Promotion extends Model
{
    use HasFactory;
    
    protected $guarded = [];
	
	public function photos()
	{
		return $this->morphMany(Photo::class,'imageable');
	}
	
	public function get_first_photo_path()
	{
		return "storage/".$this->photos()->first()->path;
	}
	
	public static function getPromoCode($model)
	{
		do {
			$promocode = strtoupper(Str::random(10));
		} while ($model::query()->where(compact('promocode'))->exists());
		
		return $promocode;
	}
}
