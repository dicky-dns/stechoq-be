<?php

namespace App\Http\Requests;

use App\Data\LoginData;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class LoginRequest extends FormRequest
{
    /** @use WithData<LoginData> */
    use WithData;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    protected function dataClass(): string
    {
        return LoginData::class;
    }
}
