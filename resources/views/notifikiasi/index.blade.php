@extends('layout.main')

@section('container')
    <div class="col-xl-5 col-lg-5 col-md-5 mt-4 mx-auto">
        <div class="card z-index-0">
            <div class="card-header text-left pt-4 px-5">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 border-bottom pb-3">
                    <h5><b>TAMBAH NOTIFIKASI</b></h5>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <div class="card-body">
                <form method="post" action="/apk/notifikasi/update" class="mb-2">
                    @csrf
                    <div class="form-group">
                        @if ($jenis == 2)
                            <input type="hidden" id="id" name="id" value="{{ $data['id'] }}">
                        @endif
                        <label for="title"
                            class="form-control-label text-white @error('title') is-invalid @enderror">Title</label>
                        <input class="form-control" type="text" value="" id="title" name="title"
                            placeholder="Masukan Isi Title">
                        @if ($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="content"
                            class="form-control-label text-white @error('content') is-invalid @enderror">Body</label>
                        <textarea class="form-control" type="text" id="content" name="content" rows="3"
                            placeholder="Masukan Isi Body"></textarea>
                        @if ($errors->has('content'))
                            <span class="text-danger">{{ $errors->first('content') }}</span>
                        @endif
                    </div>

                    <div>
                        <button type="submit" class="btn btn-icon btn-3 btn btn-outline-light my-4 bg-dark"
                            onclick="return confirm('Apakah anda yakin ingin menerbitkan notifikasi ?');">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
