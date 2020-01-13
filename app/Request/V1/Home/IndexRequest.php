<?php

declare(strict_types=1);

namespace App\Request\V1\Home;

use Hyperf\Validation\Request\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'foo' => 'required|max:255',
            'bar' => 'required',
        ];
    }
}
