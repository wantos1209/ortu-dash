@extends('layout.main')

@section('container')
    <div class="col-xl-5 col-lg-5 col-md-5 mt-4 mx-auto">
        <div class="card z-index-0">
            <div class="card-header text-left pt-4 px-5">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1 border-bottom pb-3">
                    <h5><b>EDIT CONTACT</b></h5>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="card-body">
                <form method="post" action="/apk/contact/update" class="mb-2">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" id="id" name="id" value="{{ $data['id'] }}">
                        <label for="telegram"
                            class="form-control-label text-white @error('telegram') is-invalid @enderror">Telegram</label>
                        <input class="form-control" type="text" value="{{ $data['telegram'] }}" id="telegram"
                            name="telegram" placeholder="Masukan Isi telegram">
                        @if ($errors->has('telegram'))
                            <span class="text-danger">{{ $errors->first('telegram') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="whatsapp"
                            class="form-control-label text-white @error('whatsapp') is-invalid @enderror">Whatsapp</label>
                        <input class="form-control" type="text" id="whatsapp" name="whatsapp"
                            value="{{ $data['whatsapp'] }}" placeholder="Masukkan Whatsapp">
                        @if ($errors->has('whatsapp'))
                            <span class="text-danger">{{ $errors->first('whatsapp') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="line"
                            class="form-control-label text-white @error('line') is-invalid @enderror">Line</label>
                        <input class="form-control" type="text" id="line" name="line" value="{{ $data['line'] }}"
                            placeholder="Masukkan Line">
                        @if ($errors->has('line'))
                            <span class="text-danger">{{ $errors->first('line') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="livechat"
                            class="form-control-label text-white @error('livechat') is-invalid @enderror">Livechat</label>
                        <input class="form-control" type="text" id="livechat" name="livechat"
                            value="{{ $data['livechat'] }}" placeholder="Masukkan Livechat">
                        @if ($errors->has('livechat'))
                            <span class="text-danger">{{ $errors->first('livechat') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="facebook"
                            class="form-control-label text-white @error('facebook') is-invalid @enderror">Facebook</label>
                        <input class="form-control" type="text" id="facebook" name="facebook"
                            value="{{ $data['facebook'] }}" placeholder="Masukkan Facebook">
                        @if ($errors->has('facebook'))
                            <span class="text-danger">{{ $errors->first('facebook') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="penilaian"
                            class="form-control-label text-white @error('penilaian') is-invalid @enderror">Penilaian</label>
                        <input class="form-control" type="text" id="penilaian" name="penilaian"
                            value="{{ $data['penilaian'] }}" placeholder="Masukkan Penilaian">
                        @if ($errors->has('penilaian'))
                            <span class="text-danger">{{ $errors->first('penilaian') }}</span>
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
