<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ApkLinkController extends Controller
{
    public function index()
    {

        $data = $this->getData();
        $search = request('search');

        if ($search  != '') {
            $results = [];
            foreach ($data as $d) {
                if (strpos($d['link'], $search) !== false) {
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

        return view('link.index', [
            'title' => 'APK - Links',
            'menu' => 'link',
            'data' => $paginator
        ]);
    }

    public function data($id)
    {

        $data = $this->getData($id);

        return response()->json($data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'link' => 'required',
        ]);

        $data = $request->all();

        $link = $data['link'];
        $id = '';

        $methode  = "POST";

        $this->action($id, $link, $methode);
        return response()->json([
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'link' => 'required'
        ]);

        $id = $request->id;
        $link = $request->link;

        $methode  = "PUT";

        $this->action($id, $link, $methode);
        return response()->json(['success' => 'Item berhasil diupdate!']);
    }

    public function delete($id)
    {
        $data = $this->getData($id);
        $id = $data['id'];
        $link = $data['link'];
        $methode = "DELETE";

        $this->action($id, $link, $methode);
        return redirect("/apk/link")->with('success', 'Bo berhasil dihapus!');;
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
        $namabo = getDataBo2();
        $namabo = strtolower($namabo);
        if ($id != '') {
            $url = "https://www.m3y0kl1n3.com/api/" . $namabo . "linkalts/" . $id;
        } else {
            $url = "https://www.m3y0kl1n3.com/api/" . $namabo . "linkalts";
        }
        // dd($url);

        return $url;
    }

    public function action($id, $link, $method = "POST")
    {
        $url = $this->getUrl($id);

        $data = [
            'link' => $link,
        ];
        $data_string = json_encode($data);

        $headers = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string),
            'header' => 'postman-token: 54a06989-9a14-4515-afca-766a0f6f3dd9'
        );

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        if (curl_error($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);

        return $result;
    }
}
