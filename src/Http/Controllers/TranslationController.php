<?php

namespace BrandStudio\Translations\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use BrandStudio\Translations\Translation;

class TranslationController extends Controller
{

    public function index(Request $request)
    {
        $query = Translation::query();

        $translations = $query->get()->toArray();
        $data = [];

        foreach($translations as $translation) {
            $data[$translation['hash']] = $translation['value'];
        }

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $text = $request->text;
        $key = md5($text);

        $translation = Translation::where('hash', $key)->first();

        if (!$translation) {
            $translation = Translation::create([
                'hash' => $key,
                'value' => $text,
            ]);
        }

        return response()->json(['success' => true]);
    }

}
