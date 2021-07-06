<?php

namespace App\Http\Requests;

use App\Models\CocoaBatch;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CocoaBatchRequest extends FormRequest
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
            'description' => ['required', 'string', 'max:255', 'unique:cocoa_batches'],
            'provider' => ['required', 'string', Rule::in(CocoaBatch::PROVIDERS)],
            'origin' => ['required', 'string', Rule::in(CocoaBatch::ORIGINS)],
        ];
    }

    private function update()
    {
        return [
            'description' => ['required', 'string', 'max:255', Rule::unique('cocoa_batches')->ignore($this->cocoa_batch->id)],
            'provider' => ['required', 'string', Rule::in(CocoaBatch::PROVIDERS)],
            'origin' => ['required', 'string', Rule::in(CocoaBatch::ORIGINS)],
        ];
    }
}
