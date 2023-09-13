<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use HasFactory, HasTranslations;
    protected $fillable = ['name','description','job','rate','image'];
    public $translatable = ['name','description','job'];
    public $filesPath = 'testimonial';
    public static $translatableColumns = [
        'name' => [
            'type'=>'text',
            'validations'=> 'required|string|min:3|max:25',
            'is_textarea'=> false,
        ],
        'description' => [
            'type'=>'text',
            'validations'=> 'required|string|min:3',
            'is_textarea'=>true,
        ],
        'job' => [
            'type'=>'text',
            'validations'=> 'required|string|min:3|max:25',
            'is_textarea'=> false,
        ],
    ];

    public static function getTranslatableFields(): array
    {
        return array_keys(self::$translatableColumns);
    }
    public static array $rules = [
        'rate'=>'nullable|numeric|min:1|max:5',
        'image'=>'required|image|mimes:jpg,png,jpeg,svg,gif,webp',
    ];
}
