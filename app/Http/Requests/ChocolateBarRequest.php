<?php

namespace App\Http\Requests;

use App\Rules\GramProportion;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChocolateBarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ($this->isMethod('post') ? $this->store() : $this->update());
    }

    private function store()
    {
        return [
            'weight' => ['required', 'integer', 'gt:0'],
            'code' => ['required', 'string', 'min:8', 'max:8', 'alpha_num', 'unique:chocolate_bars'],
            'cocoa_batches.*.id' => ['required', 'integer', 'exists:cocoa_batches'], 
            'cocoa_batches' => ['required', 'array', new GramProportion()],
            'cocoa_batches.*.grams' => ['required', 'integer', 'gt:0'], 
        ];
    }

    private function update()
    {
        return [
            'weight' => ['required', 'integer', 'gt:0'],
            'code' => [
                'required', 'string', 'min:8', 'max:8', 'alpha_num', 
                Rule::unique('chocolate_bars')->ignore($this->chocolate_bar->id),
            ],
            'cocoa_batches' => ['required', 'array', new GramProportion()],
            'cocoa_batches.*.id' => ['required', 'integer', 'exists:cocoa_batches'], 
            'cocoa_batches.*.grams' => ['required', 'integer', 'gt:0'], 
        ];
    }
}
