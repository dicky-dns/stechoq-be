<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Data\ProjectData;
use App\Enums\ProjectStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\WithData;

class ProjectRequest extends FormRequest
{
    /** @use WithData<ProjectData> */
    use WithData;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'status' => ['nullable', Rule::in(array_map(fn ($case) => $case->value, ProjectStatus::cases()))],
        ];
    }

    protected function dataClass(): string
    {
        return ProjectData::class;
    }
}
