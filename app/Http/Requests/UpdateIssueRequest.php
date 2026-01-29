<?php

namespace App\Http\Requests;

use App\Data\IssueData;
use App\Enums\IssueStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\WithData;

class UpdateIssueRequest extends FormRequest
{
    /** @use WithData<IssueData> */
    use WithData;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $user = Auth::user();

        return [
            'status' => $user->isManager() ? ['nullable'] : ['required', Rule::in(array_map(fn ($case) => $case->value, IssueStatus::cases()))],
            'assignee_id' => $user->isManager() ? ['required', 'exists:users,id'] : ['nullable'],
            'working_hour' => $user->isManager() ? ['sometimes', 'numeric', 'min:0'] : ['required', 'numeric', 'min:0'],
        ];
    }

    protected function dataClass(): string
    {
        return IssueData::class;
    }
}
