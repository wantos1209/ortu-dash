<?php

namespace App\Http\Controllers;

use App\Models\ApkBo;

use Illuminate\Http\Request;

class ApkNotifikasiController extends Controller
{
    public function index()
    {
        $namabo = getDataBo2();
        $namabo = strtolower($namabo);
        $url = 'https://www.m3y0kl1n3.com/api/' . $namabo . 'notifications';
        $options = [
            'http' => [
                'header' => 'postman-token: 54a06989-9a14-4515-afca-766a0f6f3dd9'
            ]
        ];
        $context = stream_context_create($options);
        $data = file_get_contents($url, false, $context);
        $data = json_decode($data, true);

        $jenis = 1;
        if ($data['data'] != []) {
            $data = $data['data'][0];
            $jenis = 2;
        }

        return view('notifikiasi.index', [
            'title' => 'APK - Bo',
            'menu' => 'notifikasi',
            'jenis' => $jenis,
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {
        $id = session('id_bo');
        $nama_bo = ApkBo::where('id', $id)->first()->nama;

        $title = $request['title'];
        $body = $request['content'];

        $data = $this->KeyAuthor($nama_bo);

        $key = $data['key'];
        $author = $data['author'];

        $url = 'https://' . $key . '.pushnotifications.pusher.com/publish_api/v1/instances/' . $key . '/publishes';

        $data = [
            'interests' => ['hello'],
            'fcm' => [
                'notification' => [
                    'title' => $title,

                    'body' => $body
                ]
            ]
        ];

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' .  $author,
            'postman-token: 54a06989-9a14-4515-afca-7606a0f6f3dd9'
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        echo $response;
        return redirect("/apk/notifikasi")->withSuccess('Notifikasi berhasil dikirim!');
    }

    public function KeyAuthor($nama_bo)
    {

        if ($nama_bo == 'arwana') {
            $key = '4c50fa57-6d54-49d7-ad85-db0deaf2037d';
            $author = '5A255F6F4F8DD8CD1DDC623A6E3F5048A10CD34920A25B72AFBEB892D812ED0E';
        } else if ($nama_bo == 'jeep') {
            $key = '25c446f4-bb84-4d04-9503-74207cfe6035';
            $author = 'EF68FA456D21234898B5622A0064893295AC3D1FB90F61B0CA5E58A0EFFDD056';
        } else if ($nama_bo == 'doyantoto') {
            $key = 'c5e14943-ff16-4c8e-a146-6371ccc70421';
            $author = '6C7A5F8369A90A7232F7B8C0D0B43C901B33BA1D1C6F49D717B81136C4859FF0';
        } else if ($nama_bo == 'tstoto') {
            $key = 'd5efdd7c-2be7-45b9-a1ef-7bba000a5f27';
            $author = '3F60A36745AA89409F76CAD0BD0FD4296E0D7AD08B4CA58AF412087D719D4BAF';
        } else if ($nama_bo == 'arta') {
            $key = '6ba1211e-2178-42c5-9221-b82fe1836cbf';
            $author = '971222BC37968BFE21EAC49C53A9E04F8E725A4A5BE3C19264958E0A5AAFF07D';
        } else if ($nama_bo == 'neon') {
            $key = '11c5111d-86dc-4dfe-a06e-c272a148d69f';
            $author = 'C96D61C16893DFB985478BE5AFAEDDD60A6607C0CB80B71B3D34855B2A6607BA';
        } else if ($nama_bo == 'zara') {
            $key = '45a0bdf4-1b52-42d7-8cbb-98137ef2bd3d';
            $author = '6E2539809DDF247EFEEE03775B4931D14CCCF97AFA7146E9C11B812F536BDECD';
        } else if ($nama_bo == 'roma') {
            $key = '59eba97c-0977-4259-be5c-e641ee73ba3a';
            $author = 'F3AF5E0151C759AC02316C74384D63F60C1344CF67D375442926B2C3BA0F86F0';
        } else if ($nama_bo == 'nero') {
            $key = '80893687-afea-4661-b07e-02785d5bd3b6';
            $author = '1880DA90A0747088BB42EC5C938A8560901A986AA863360E51104696B3B01BE6';
        } else if ($nama_bo == 'duo') {
            $key = '9dead7a2-975a-4c93-988d-5f0e440ead3f';
            $author = '2B4786CB31948F3DBEDC37E7C388BB1089DE1A19CB9A451F6E497CB9ADFAB74D';
        }
        if (getDataBo2() == 'ortu') {
            $key = '';
            $author = '';
        }
        $keyauthor = ['key' => $key, 'author' => $author];

        return $keyauthor;
    }
}
