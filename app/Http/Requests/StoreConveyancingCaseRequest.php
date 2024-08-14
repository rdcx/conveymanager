<?php

namespace App\Http\Requests;

use App\Models\ConveyancingCase;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreConveyancingCaseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('store', [ConveyancingCase::class, $this->route('property')]);
    }

    public function rules()
    {
        return [
            'property_id' => 'required|exists:properties,id',
            'conveyancer_id' => 'required|exists:users,id',
            'client_id' => 'required|exists:clients,id', 
            'status' => 'required|string|in:initiated,in_progress,completed,cancelled',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ];
    }
}