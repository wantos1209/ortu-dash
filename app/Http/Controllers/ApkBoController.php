<?php

namespace App\Http\Controllers;

use App\Models\ApkBo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;

class ApkBoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bo = ApkBo::latest()->filter(request(['search']))->paginate(10)->withQueryString();
        return view('bo.index', [
            'title' => 'APK - Bo',
            'menu' =>  'bo',
            'data' => $bo
        ], compact('bo'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bo.create', [
            'title' => 'APK - Bo',
            'menu' =>  'bo'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:255',
            'site' => 'required|max:255'
        ]);

        // Jika validasi gagal, kirimkan respon error ke Ajax
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            ApkBo::create($request->all());
        }

        return response()->json([
            'message' => 'Data berhasil disimpan.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bo  $bo
     * @return \Illuminate\Http\Response
     */
    public function show(ApkBo $bo)
    {
        return view('bo.show', compact('bo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ApkBo  $bo
     * @return \Illuminate\Http\Response
     */
    public function data($id)
    {
        $data = ApkBo::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ApkBo  $bo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $validateData = $request->validate([
            'nama' => 'required',
            'site' => 'required'
        ]);

        ApkBo::where('id', $id)->update($validateData);

        return response()->json(['success' => 'Item berhasil diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApkBo  $bo
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $data = ApkBo::findOrFail($id);
        $data->delete();

        return redirect("/apk/bo")->with('success', 'Bo berhasil dihapus!');
    }
}
