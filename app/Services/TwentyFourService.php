<?php

namespace App\Services;


use App\Models\Dispatch;
use App\Models\Order;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Exception;

class TwentyFourService
{

    private $apiUrl = 'https://api.15887924.com:18091/api';
    private $apiKey = '04e7736bc0a86333026fc1276228b76a';
    private $passphrase = '04e7736bc0a8633306e80c9c8c558baf';
    private $iv = '77728a85d234f0cd';


/*
    {
        "startWide":"경기",
        "startSgg":"수원",
        "startDong":"정자동",
        "startDetail":"5번지",
        "endWide":"인천",
        "endSgg":"남구",
        "endDong":"도화동",
        "endDetail":"도화프라자",
        "multiCargoGub":"혼적",
        "urgent":"긴급",
        "shuttleCargoInfo":"왕복",
        "cargoTon":"1.4",
        "truckType":"카고",
        "frgton":"1.5",
        "startPlanDt":"20181010",
        "endPlanDt":"20181011",
        "startLoad":"수작업",
        "endLoad":"지게차",
        "cargoDsc":"사과 상자20개",
        "farePaytype":"선착불",
        "fare":"40000",
        "fee":"10000",
        "endAreaPhone":"01012345678",
        "firstType":"01",
        "firstShipperNm":"우리전자",
        "firstShipperInfo":"0212341234",
        "firstShipperBizNo":"1234567891",
        "taxbillType":"Y",
        "payPlanYmd":"",
        "ddID":"10000-1"
    }
*/    

/*
{
  "ordNo":"234567890",
  "cjCarNum":"서울88바1234",
  "cjCargoTon":"5",
  "cjTruckType":"플축카고",
  "cjLoadOption":"7m40"
}
*/

    public function setOrder($id)
    {
        $order = Order::findOrFail($id);
        $json = [
            "startWide" => $order->start_address_siNm ,
            "startSgg" => $order->start_address_sggNm ,
            "startDong" => $order->start_address_emdNm ,
            "startDetail" => $order->start_address_detail ,
            "endWide" => $order->end_address_siNm ,
            "endSgg" => $order->end_address_sggNm ,
            "endDong" => $order->end_address_emdNm ,
            "endDetail" => $order->end_address_detail ,
            "multiCargoGub" => $order->is_mix ? "홍적" : "" ,
            "urgent" => $order->is_urgent ? "긴급" : "" ,
            "shuttleCargoInfo" => $order->is_round ? "왕복" : "" ,
            "cargoTon" => $order->car_ton ,
            "truckType" => $order->car_type ,
            "frgton" => $order->freight_ton ,
            "startPlanDt" => $order->start_date ,
            "endPlanDt" => $order->end_date ,
            "startLoad" => $order->start_work ,
            "endLoad" => $order->end_work ,
            "cargoDsc" => $order->freight_desc ,
            "farePaytype" => $order->fare_pay_type ,
            "fare" => $order->fare ,
            "fee" => $order->fee ?? 0,
            "endAreaPhone" => $order->end_phone_number ,
            "firstType" => $order->user_type ?? '',
            "firstShipperNm" => $order->shipper_name ?? '',
            "firstShipperInfo" => $order->shipper_phone_number ?? '',
            "firstShipperBizNo" => $order->shipper_biz_number ?? '',
            "taxbillType" => $order->is_tax_invoice ? "Y" : "N" ,
            "payPlanYmd" => $order->pay_due_date ?? '',
            "ddID" => '', // "70173",
        ];
        Log::debug($json);
        $json = json_encode($json, JSON_UNESCAPED_UNICODE);
        $json = $this->pkcs5Pad($json);
        $data = openssl_encrypt($json, 'AES-256-CBC', $this->passphrase, 0, $this->iv);
        $params = [
            "data" => $data
        ];
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'call24-api-key' => $this->apiKey
        ])->post($this->apiUrl . '/order/addOrder', $params);
        if ($response['code'] != 1) {
            throw new Exception($response['message']);
        }
        $data = $response['data'];
        $decryptedData = openssl_decrypt($data, 'AES-256-CBC', $this->passphrase, 0, $this->iv);

        return json_decode($decryptedData, true);
    }

    public function getCarTon()
    {
        $params = [
            "data" => ''
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'call24-api-key' => $this->apiKey
        ])->post($this->apiUrl . '/order/cargoTon', $params);
        if ($response['code'] != 1) {
            throw new Exception($result['message']);
        }
        $decryptedData = openssl_decrypt($data, 'AES-256-CBC', $this->passphrase, 0, $this->iv);

        return json_decode($decryptedData, true);
    }


    public function getCarType()
    {
        $json = json_encode(["cargoTon" => 1], JSON_UNESCAPED_UNICODE);
        $json = $this->pkcs5Pad($json);
        $data = openssl_encrypt($json, 'AES-256-CBC', $this->passphrase, 0, $this->iv);
        $params = [
            "data" => $data
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'call24-api-key' => $this->apiKey
        ])->post($this->apiUrl . '/order/truckType', $params);


        $data = $response['data'];
        $decryptedData = openssl_decrypt($data, 'AES-256-CBC', $this->passphrase, 0, $this->iv);

        return json_decode($decryptedData, true);
    }

    public function getAddr($sido = null, $gugun = null)
    {
        $json = json_encode(["sido" => $sido, "gugun" => $gugun], JSON_UNESCAPED_UNICODE);
        $json = $this->pkcs5Pad($json);
        $data = openssl_encrypt($json, 'AES-256-CBC', $this->passphrase, 0, $this->iv);
        $params = [
            'data' => $data
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'call24-api-key' => $this->apiKey
        ])->post($this->apiUrl . '/order/addr', $params);


        $data = $response['data'];
        $decryptedData = openssl_decrypt($data, 'AES-256-CBC', $this->passphrase, 0, $this->iv);

        return json_decode($decryptedData, true);
    }

    public function getOrderAll()
    {
        $params = [
            "data" => ''
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'call24-api-key' => $this->apiKey
        ])->post($this->apiUrl . '/order/getOrderAll', $params);

        $data = $response['data'];
        $decryptedData = openssl_decrypt($data, 'AES-256-CBC', $this->passphrase, 0, $this->iv);

        return json_decode($decryptedData, true);
    }

    public function pkcs5Pad($text, $blocksize = 16)
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

}