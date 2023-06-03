<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemberitahuan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ApkPemberitahuanController extends Controller
{
    public function index()
    {
        $data = $this->getData();
        $search = request('search');
        if ($search  != '') {
            $results = [];
            foreach ($data as $d) {
                if ((stripos($d['title'], $search) !== false) || (stripos($d['content'], $search) !== false)) {
                    $results[] = $d;
                }
            }
            $data =  $results;
        }
        $perPage = 10;
        $page =  request()->get('page', 1);
        $slicedData = array_slice($data, ($page - 1) * $perPage, $perPage);
        $paginator = new LengthAwarePaginator(
            $slicedData,
            count($data),
            $perPage,
            $page,
            ['path' => url()->current()]
        );

        return view('pemberitahuan.index', [
            'title' => 'APK - Pemberitahuan',
            'menu' => 'pemberitahaun',
            'data' => $paginator
        ]);
    }

    public function data($id = '')
    {

        $data = $this->getData($id);

        return response()->json($data);
    }
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $data = $request->all();

        $title = $data['title'];
        $content = $data['content'];

        $methode  = "POST";


        $this->action($id = '', $title, $content, $methode);
        return redirect("/apk/pemberitahuan")->withSuccess('Data berhasil disimpan!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $id = $request->id;
        $title = $request->title;
        $content = $request->content;

        $methode  = "PUT";

        $this->action($id, $title, $content, $methode);

        return response()->json(['success' => 'Item berhasil diupdate!']);
    }

    public function delete($id)
    {
        $data = $this->getData($id);
        $id = $data['id'];
        $title = $data['title'];
        $content = $data['content'];

        $methode = "DELETE";

        $this->action($id, $title,  $content, $methode);
        return redirect("/apk/pemberitahuan")->withSuccess('Data berhasil dihapus!');
    }

    public function getData($id = '')
    {
        $url = $this->getUrl();
        $options = [
            'http' => [
                'header' => 'postman-token: 54a06989-9a14-4515-afca-766a0f6f3dd9'
            ]
        ];
        $context = stream_context_create($options);
        $data = file_get_contents($url, false, $context);
        $data = json_decode($data, true);
        $data = $data['data'];

        if ($id != '') {
            foreach ($data as $index => $d) {
                if ($d['id'] == $id) {
                    $data = $data[$index];
                }
            }
        }
        return $data;
    }

    public function getUrl($id = '')
    {
        if ($id != '') {
            $url = "https://www.m3y0kl1n3.com/api/ortupemberitahuans/" . $id;
        } else {
            $url = "https://www.m3y0kl1n3.com/api/ortupemberitahuans";
        }

        return $url;
    }

    public function action($id, $title, $content, $methode)
    {
        $url = $this->getUrl($id);

        $data = [
            'title' => $title,
            'content' => $content
        ];
        $data_string = json_encode($data);

        $ch = curl_init($url);

        $headers = [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string),
            'postman-token: 54a06989-9a14-4515-afca-766a0f6f3dd9'
        ];

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $methode);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        // Cek apakah ada error saat melakukan request
        if (curl_error($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);
    }
}
