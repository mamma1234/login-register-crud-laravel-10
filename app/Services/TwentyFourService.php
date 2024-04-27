<?php

namespace App\Services;


use App\Models\Dispatch;
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



    public function getCarTon()
    {
        $params = [
            "data" => ''
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'call24-api-key' => $this->apiKey
        ])->post($this->apiUrl . '/order/cargoTon', $params);


        $data = $response['data'];
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

    public function getAddr()
    {
        $json = json_encode(["sido" => "서울"], JSON_UNESCAPED_UNICODE);
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

    public function pkcs5Pad($text, $blocksize = 16)
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

}