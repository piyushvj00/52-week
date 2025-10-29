<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         return [
            'name' => 'required|string|max:255',
            'leader_id' => 'required|exists:users,id',
            'portal_set_id' => 'required|exists:portal_sets,id',
            'group_number' => 'required|integer|min:1|max:52',
            'project_name' => 'required|string|max:255',
            'project_description' => 'nullable|string',
                                    'target_amount' => 'required|numeric|min:1',

          
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
            'video' => 'nullable|file|mimes:mp4,avi,mov|max:10240', // 10MB max
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Portal name is required',
            'leader_id.required' => 'Please select a leader',
            'leader_id.exists' => 'Selected leader does not exist',
            'target_amount.required' => 'Target amount is required',
            'target_amount.min' => 'Target amount must be at least 1',
            'portal_set_id.required' => 'Please select a portal set',
            'portal_set_id.exists' => 'Selected portal set does not exist',
            'group_number.required' => 'Group number is required',
            'group_number.min' => 'Group number must be at least 1',
            'group_number.max' => 'Group number cannot exceed 52',
            'project_name.required' => 'Project name is required',
            'start_date.required' => 'Start date is required',
            'start_date.after_or_equal' => 'Start date cannot be in the past',
            'end_date.required' => 'End date is required',
            'end_date.after' => 'End date must be after start date',
            'logo.image' => 'Logo must be an image file',
            'logo.mimes' => 'Logo must be JPEG, PNG, JPG or GIF format',
            'logo.max' => 'Logo size cannot exceed 2MB',
            'video.mimes' => 'Video must be MP4, AVI or MOV format',
            'video.max' => 'Video size cannot exceed 10MB',
        ];
    }
}
