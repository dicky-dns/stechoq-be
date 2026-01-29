<?php

namespace App\Http\Requests;

use App\Data\IssueData;
use App\Enums\IssueStatus;
use App\Enums\IssueType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\WithData;

class StoreIssueRequest extends FormRequest
{
    /** @use WithData<IssueData> */
    use WithData;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'type' => ['required', Rule::in(array_map(fn ($case) => $case->value, IssueType::cases()))],
            'status' => ['nullable', Rule::in(array_map(fn ($case) => $case->value, IssueStatus::cases()))],
            'priority' => ['required', 'integer', 'min:1', 'max:5'],
            'assignee_id' => ['nullable', 'exists:users,id'],
            'working_hour' => ['sometimes', 'numeric', 'min:0'],
        ];
    }

    protected function dataClass(): string
    {
        return IssueData::class;
    }
}
