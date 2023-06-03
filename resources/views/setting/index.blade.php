@extends('layout.main')

@section('container')
    <div class="col-xl-5 col-lg-5 col-md-5 mt-4  mx-auto">
        <div class="card z-index-0">
            <div class="card-header text-left pt-4 px-5">
                {{-- <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 border-bottom pb-3">
                    <h5><b>EDIT SETTING</b></h5>
                </div> --}}
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <div class="card-body ">
                <form method="post" action="/apk/setting/update" class="mb-2">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" id="id" name="id" value="{{ $data['id'] }}">
                        <label for="home"
                            class="form-control-label text-white @error('home') is-invalid @enderror">Home</label>
                        <input class="form-control" type="text" value="{{ $data['home'] }}" id="home" name="home"
                            placeholder="Masukan Home">
                        @if ($errors->has('home'))
                            <span class="text-danger">{{ $errors->first('home') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="syair"
                            class="form-control-label text-white @error('syair') is-invalid @enderror">Syair</label>
                        <input class="form-control" type="text" id="syair" name="syair"
                            value="{{ $data['syair'] }}" placeholder="Masukkan Syair">
                        @if ($errors->has('syair'))
                            <span class="text-danger">{{ $errors->first('syair') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="hadiah"
                            class="form-control-label text-white @error('hadiah') is-invalid @enderror">Hadiah</label>
                        <input class="form-control" type="text" id="hadiah" name="hadiah"
                            value="{{ $data['hadiah'] }}" placeholder="Masukkan Hadiah">
                        @if ($errors->has('hadiah'))
                            <span class="text-danger">{{ $errors->first('hadiah') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="jadwal"
                            class="form-control-label text-white @error('jadwal') is-invalid @enderror">Jadwal</label>
                        <input class="form-control" type="text" id="jadwal" name="jadwal"
                            value="{{ $data['jadwal'] }}" placeholder="Masukkan Jadwal">
                        @if ($errors->has('jadwal'))
                            <span class="text-danger">{{ $errors->first('jadwal') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="promo"
                            class="form-control-label text-white @error('promo') is-invalid @enderror">Promo</label>
                        <input class="form-control" type="text" id="promo" name="promo"
                            value="{{ $data['promo'] }}" placeholder="Masukkan Promo">
                        @if ($errors->has('promo'))
                            <span class="text-danger">{{ $errors->first('promo') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="content"
                            class="form-control-label text-white @error('content') is-invalid @enderror">Content</label>
                        <input class="form-control" type="text" id="content" name="content"
                            value="{{ $data['content'] }}" placeholder="Masukkan Content">
                        @if ($errors->has('content'))
                            <span class="text-danger">{{ $errors->first('content') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="rtp"
                            class="form-control-label text-white @error('rtp') is-invalid @enderror">Rtp</label>
                        <input class="form-control" type="text" id="rtp" name="rtp" placeholder="Masukkan Rtp"
                            value="{{ $data['rtp'] }}">
                        @if ($errors->has('rtp'))
                            <span class="text-danger">{{ $errors->first('rtp') }}</span>
                        @endif
                    </div>

                    <div>
                        <button type="submit" class="btn btn-icon btn-3 btn btn-outline-light my-4 bg-dark">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
