<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApkContactController extends Controller
{
    public function index()
    {
        $namabo = getDataBo2();
        $namabo = strtolower($namabo);
        $url = 'https://www.m3y0kl1n3.com/api/' . $namabo . 'contacts';
        $options = [
            'http' => [
                'header' => 'postman-token: 54a06989-9a14-4515-afca-766a0f6f3dd9'
            ]
        ];

        $context = stream_context_create($options);

        $data = file_get_contents($url, false, $context);
        $data = json_decode($data, true);

        if ($data["data"] != []) {
            $data = $data['data'][0];
        }

        return view('contact.index', [
            'title' => 'APK - Contact',
            'menu' => 'contact',
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {
        $id = $request['id'];
        $telegram = $request['telegram'];
        $whatsapp = $request['whatsapp'];
        $line = $request['line'];
        $livechat = $request['livechat'];
        $facebook = $request['facebook'];
        $penilaian = $request['penilaian'];

        $namabo = getDataBo2();
        $namabo = strtolower($namabo);
        $url = 'https://www.m3y0kl1n3.com/api/' . $namabo . 'contacts/' . $id;
        $data = [
            'telegram' => $telegram,
            'whatsapp' => $whatsapp,
            'line' => $line,
            'livechat' => $livechat,
            'facebook' => $facebook,
            'penilaian' => $penilaian
        ];
        $data_string = json_encode($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string),
            'postman-token: 54a06989-9a14-4515-afca-766a0f6f3dd9' // header baru
        ));

        $result = curl_exec($ch);
        $result = json_decode($result, true);
        // $result = $result['message'];
        // Cek apakah ada error saat melakukan request
        if (curl_error($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        // if($result == "App key not found"){
        //     return $result;
        // }
        curl_close($ch);
        return redirect("/apk/contact")->withSuccess('Success, Data berhasil diubah!');
    }
}
