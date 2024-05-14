<?php

namespace App\Http\Controllers;

use App\Services\ClientService;
use App\Models\CityDirectory;
use App\Models\IndustryCategories;
use App\Models\InquiryItems;
use App\Models\IsBusinessRegistered;
use App\Resources\CustomerInquiryResource;
use App\Resources\InquiryResource;
use App\Http\Requests\InquiryRequest;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;
use Knuckles\Scribe\Attributes\BodyParam;

class CustomerInquiryController  extends Controller
{
    //
    /**
     * Summary of __construct
     * @param ClientService $clientService
     */
    protected $service;
    public function __construct(ClientService $service)
    {
        $this->service = $service;
    }

    /**
     * Summary of GetInitialOptions
     * @return CustomerInquiryResource
     */
    #[Response(status: 200, content: ["message" => "請求失敗"])]
    #[Response(status:200, contains:['city' => ['台北市', '...'], 'industry' => ['運輸業', '...'], 'inquiry' => ['報價', '接洽'], 'is_business_registered' => [true, false]], description: '請求成功', type: CustomerInquiryResource::class)]
    function GetInitialOptions ()
    {
        $city = CityDirectory::directories();
        $industry = IndustryCategories::directories();
        $inquiry = InquiryItems::directories();
        $isBusiness = IsBusinessRegistered::directories();

        return CustomerInquiryResource::make($city, $industry, $inquiry, $isBusiness);
    }

    /**
     * 取得最新十筆諮詢
     */
    #[Response(status:200, content:["massge" => "請求失敗"])]
    #[Response(status:200, content:["company_name" => "大潤發有限股份公司", "contact_person" => "黃某某", "contact_email" => "abcd@exampel.com", "contact_phone" => 0987563527, "company_location" => "台北市", "business_registration" => true, "industry_category" => "零售業", "consultation_item" => "接洽", "number_of_users" => null, "notes" => "這是備註",  ], type: InquiryResourse::class)]
    function getNewTenInquiry()
    {
        $newInquiry = $this->service->getLastTen();
        return InquiryResource::collection($newInquiry);
    }

    /**
     * 新增諮詢
     */
    #[BodyParam(name: "company_name", description: "公司名稱", required: false)]
    #[BodyParam(name: "contact_person", description: "聯絡人", required: true)]
    #[BodyParam(name: "contact_email", description: "聯絡信箱", required: true)]
    #[BodyParam(name: "contact_phone", description: "聯絡電話", required: true)]
    #[BodyParam(name: "company_location", description: "公司地址", required: true)]
    #[BodyParam(name: "business_registration", description: "公司是否註冊", required: true)]
    #[BodyParam(name: "industry_category", description: "產業類別", required: true)]
    #[BodyParam(name: "consultation_item", description: "諮詢項目", required: true)]
    #[BodyParam(name: "number_of_users", description: "使用者數量，諮詢項目為報價時必填", required: false)]
    #[BodyParam(name: "notes", description: "備註", required: false)]
    function addNewInquiry(InquiryRequest $request)
    {
        $data = $request->all();
        $newInquiry = $this->service->store($data);
        return InquiryResource::make($newInquiry);
    }

}
