<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApkSettingController extends Controller
{

    public function index()
    {
        $namabo = getDataBo2();
        $namabo = strtolower($namabo);
        $url = 'https://www.m3y0kl1n3.com/api/' . $namabo . 'settings';
        $options = [
            'http' => [
                'header' => 'postman-token: 54a06989-9a14-4515-afca-766a0f6f3dd9'
            ]
        ];
        $context = stream_context_create($options);
        $data = file_get_contents($url, false, $context);
        $data = json_decode($data, true);
        $data = $data['data'][0];

        return view('setting.index', [
            'title' => 'APK - Settings',
            'menu' => 'setting',
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {
        $id = $request['id'];
        $home = $request['home'];
        $syair = $request['syair'];
        $hadiah = $request['hadiah'];
        $jadwal = $request['jadwal'];
        $promo = $request['promo'];
        $content = $request['content'];
        $rtp = $request['rtp'];

        $namabo = getDataBo2();
        $namabo = strtolower($namabo);
        $url = 'https://www.m3y0kl1n3.com/api/' . $namabo . 'settings/' . $id;
        $data = [
            'home' => $home,
            'syair' => $syair,
            'hadiah' => $hadiah,
            'jadwal' => $jadwal,
            'promo' => $promo,
            'content' => $content,
            'rtp' => $rtp,
        ];
        $data_string = json_encode($data);
        // dd($data_string);                                                                                 
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string),
            'postman-token: 54a06989-9a14-4515-afca-766a0f6f3dd9'
        ));

        $result = curl_exec($ch);
        // dd($result);
        // Cek apakah ada error saat melakukan request
        if (curl_error($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);
        return redirect("/apk/setting")->withSuccess('Success, Data berhasil diubah!');
    }
}
