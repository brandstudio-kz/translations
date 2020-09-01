<?php

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => [
        config('backpack.base.web_middleware', 'web'),
        config('backpack.base.middleware_key', 'admin'),
    ],
    'namespace'  => 'BrandStudio\Translations\Http\Controllers',
], function () { // custom admin routes
    Route::crud('translation', 'TranslationCrudController');
});

Route::group([
    'prefix' => config('translations.prefix'),
    'middleware' => config('translations.middleware'),
    'namespace'  => 'BrandStudio\Translations\Http\Controllers',
], function() {
    Route::get('translation', 'TranslationController@index');
    Route::post('translation', 'TranslationController@store');
});
