<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateRequest extends FormRequest
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
            'nama' => 'required|string|max:50',
            'divisi' => 'required|string|max:20',
            'keterangan' => 'required|string|max:500'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama siswa wajib diisi',
            'nama.max' => 'Nama maksimal 255 karakter',
            'divisi.required' => 'Divisi wajib diisi',
            'divisi.max' => 'Divisi maksimal 20 kata',
            'keterangan.required' => 'Keterangan wajib diisi',
            'keterangan.max' => 'Keterangan maksimal 500 karakter',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validasi error',
            'errors' => $validator->errors(),
            'code' => 422
        ], 422));
    }
}
