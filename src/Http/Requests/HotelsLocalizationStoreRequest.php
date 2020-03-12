<?php

namespace Selene\Modules\MapsModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelsLocalizationStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'                  => 'required|string|max:250|unique:mongodb.maps',
            'full_name'             => 'required|string|max:250|unique:mongodb.maps',
            'localization'          => 'required|string|max:250',
            'coordinates.latitude'  => 'required|numeric',
            'coordinates.longitude' => 'required|numeric',
            'logo_file'             => 'image',
            'photo_file'            => 'image',
            'copyright'             => 'string|max:250',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required'     => 'To pole jest wymagane.',
            'localization.required'  => 'To pole jest wymagane.',
            'name.required'          => 'To pole jest wymagane.',
            'coordinates.*.required' => 'To pole jest wymagane.',
            '*.string'               => 'To pole wymaga podania wartosci alfanumerycznej.',
            '*.numeric'              => 'To pole wymaga podania wartosci numerycznej.',
            '*.max'                  => 'To pole może zawierać maksymalnie 250 znaków.',
            '*.unique'               => 'To pole musi być unikalne.',
        ];
    }
}
