<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InquiryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'company_name' => ['nullable', 'string', 'max:255'],
            'contact_person' => ['required', 'string', 'max:255'],
            'contact_email' => ['required', 'email', 'string','max:255'],
            'contact_phone' => ['required', 'string', 'max:255'],
            'company_location' => ['required', 'string', 'max:255'],
            'business_registration' => ['required', 'boolean'],
            'industry_category' => ['required', 'string', 'max:255'],
            'consultation_item' => ['required', 'string', 'max:255'],
            'number_of_users' => [('consultation_item' == '報價') ? 'required' : 'nullable', 'integer', 'min:1'],
            'notes' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'contact_person.required' => '聯絡人為必填',
            'contact_email.required' => '聯絡信箱為必填',
            'contact_email.email' => '聯絡信箱格式錯誤',
            'contact_phone.required' => '聯絡電話為必填',
            'company_location.required' => '公司地址為必填',
            'business_registration.required' => '公司是否註冊為必填',
            'industry_category.required' => '產業類別為必填',
            'consultation_item.required' => '諮詢項目為必填',
            'number_of_users.required' => '使用者數量為必填',
        ];
    }
}
