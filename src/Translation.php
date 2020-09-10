<?php

namespace BrandStudio\Translations;

use BrandStudio\Starter\Models\Model;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;


class Translation extends Model
{
    use HasTranslations;

    protected $table = 'translations';
    protected $guarded = ['id'];

    protected $translatable = [
        'value'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($translation) {
            $translation->hash = md5($translation->getTranslations('value')['ru']);
        });
    }


    public function getValueRuAttribute() : string
    {
        return $this->getTranslations('value')['ru'] ?? '-';
    }

    public function getValueEnAttribute() : string
    {
        return $this->getTranslations('value')['en'] ?? '-';
    }

    public function getValueKkAttribute() : string
    {
        return $this->getTranslations('value')['kk'] ?? '-';
    }


}
