<?php

namespace BrandStudio\Translations\Http\Controllers;

use BrandStudio\Translations\Http\Requests\TranslationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;


class TranslationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    public function setup()
    {
        CRUD::setModel(config('translations.translation_class'));
        CRUD::setRoute(config('backpack.base.route_prefix') . '/translation');
        CRUD::setEntityNameStrings(trans_choice('translations::translations.translations', 1), trans_choice('translations::translations.translations', 2));

        // CRUD::denyAccess(['create', 'delete', 'show']);
    }

    protected function setupListOperation()
    {
        CRUD::removeAllButtonsFromStack('line');
        CRUD::addColumns([
            [
                'name' => 'row_number',
                'label' => '#',
                'type' => 'row_number',
            ],
            [
                'name' => 'value_ru',
                'label' => trans_choice('translations::translations.translations', 1) . '( ru )',
                'limit' => 3000,
                'view_namespace' => 'brandstudio::translations',
                'type' => 'translation',
                'lang' => 'ru',
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhere('value->ru', 'like', '%'.$searchTerm.'%');
                },
            ],
            [
                'name' => 'value_en',
                'label' => trans_choice('translations::translations.translations', 1) . '( en )',
                'limit' => 3000,
                'view_namespace' => 'brandstudio::translations',
                'type' => 'translation',
                'lang' => 'en',
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhere('value->en', 'like', '%'.$searchTerm.'%');
                },
            ],
            [
                'name' => 'value_kk',
                'label' => trans_choice('translations::translations.translations', 1) . '( kk )',
                'limit' => 3000,
                'view_namespace' => 'brandstudio::translations',
                'type' => 'translation',
                'lang' => 'kk',
                'searchLogic' => function ($query, $column, $searchTerm) {
                    $query->orWhere('value->kk', 'like', '%'.$searchTerm.'%');
                },
            ],
        ]);

    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(TranslationRequest::class);

        CRUD::addField([
            'name' => 'value',
            'label' => trans_choice('translations::translations.translations', 1),
            'type' => 'textarea',
            'hint' => '<small>'.trans('translations::translations.translation_hint').'</small>',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
        CRUD::addField([
            'name' => 'value_ru',
            'label' => '',
            'type' => 'custom_html',
        ])->makeFirstField();

    }

}
