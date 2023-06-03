@extends('layout.main')

@section('container')
    <div class="col-12">
        <div class="container-fluid py-4">
            {{-- <h4 class="ms-1 font-weight-bold">List Link</h4> --}}
            <div class="row my-4" id="container-id">

                <div class="col-md-3 mt-2">
                    <button type="button" class="btn btn-icon btn-3 btn btn-outline-light bg-dark" data-bs-toggle="modal"
                        data-bs-target="#modal-bo-tambah" id="tambah">
                        <i class="ni ni-fat-add"></i> Tambah
                    </button>
                </div>
                <div class="col-md-6">
                </div>
                <div class="col-md-3">
                    <form action="/apk/link">
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fas fa-search"
                                        aria-hidden="true"></i></span>
                                <input type="text" class="form-control" placeholder="Search..." name="search"
                                    value="{{ request('search') }}">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead style="position: sticky; z-index: 1;" class="thead-dark">
                                <tr>
                                    <th class="text-center">
                                        <h6>No.</h6>
                                    </th>
                                    <th width="90%" class="text-center">
                                        <h6>Link</h6>
                                    </th>
                                    <th class="text-center">
                                        <h6>Action</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody data-aos="fade-up" data-aos-duration="900">
                                @foreach ($data as $d)
                                    <tr>
                                        <td class="text-center text-white"> {{ $loop->iteration }} </td>
                                        <td class="text-center text-white"> {{ $d['link'] }} </td>
                                        <td class="project-actions text-right mt-10">


                                            <div class="d-flex align-items-center">

                                                <button type="button" class="badge btn-info bg-dark edit"
                                                    data-bs-toggle="modal" data-bs-target="#modal-bo-edit" id="edit"
                                                    value="{{ $d['id'] }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                    <span class="badge">Edit</span>
                                                </button>
                                                <form action="{{ url('/apk/link/delete/' . $d['id']) }}" method="POST">
                                                    <input type="hidden" id="boid" name="boid">

                                                    {{-- <a class="btn btn-sm btn-primary  btn-outline-light bg-dark" href="{{ route('bo.show',$d->id) }}"> <i class="fas fa-eye"></i> Show</a> --}}
                                                    {{-- <a class="btn btn-sm btn-info  btn-outline-light bg-dark" href="{{ route('bo.edit',$d->id) }}"><i class="fas fa-pencil-alt"></i> Edit</a> --}}
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- <button type="submit" class="badge btn-info bg-dark" onclick = "return confirm('Apakah anda yakin ingin menghapus?');"><i class="fas fa-trash"></i> Delete</button> --}}
                                                    <button type="submit" class="badge btn-danger bg-dark"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-bo-edit{{ $d['id'] }}" id="edit"
                                                        value="{{ $d['id'] }}"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus?');">
                                                        <i class="fas fa-pencil-alt"></i>
                                                        <span class="badge">Delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- MODAL TAMBAH --}}
            <div class="modal fade" id="modal-bo-tambah" tabindex="-1" role="dialog" aria-labelledby="modal-bo"
                aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="alert alert-danger"></div>
                        <form id="form-bo">
                            @csrf
                            <div class="modal-header bg-modal-popup">
                                <h6 class="modal-title" id="modal-title-default text-white">Tambah Link</h6>
                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true" class="close-btn-popup">X</span>
                                </button>
                            </div>

                            <div class="modal-body bg-modal-popup">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="link"
                                                class="form-control-label text-white @error('link') is-invalid @enderror">Link</label>
                                            <input class="form-control" type="text" id="link" name="link"
                                                placeholder="Masukkan Link">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer bg-modal-popup">
                                <button type="submit" id="submit-btn"
                                    class="btn bg-gradient-dark btn-outline-light my-4">Submit</button>
                                <button type="button" id="cancel-btn-tambah"
                                    class="btn bg-gradient-dark btn-outline-light my-4"
                                    data-bs-dismiss="modal">Batal</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            {{-- MODAL EDIT --}}
            <div class="modal fade" id="modal-bo-edit" tabindex="-1" role="dialog" aria-labelledby="modal-bo"
                aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="alert alert-danger"></div>
                        <form id="form-bo">
                            @csrf
                            <div class="modal-header bg-modal-popup">
                                <h6 class="modal-title text-white" id="modal-title-default">Edit Link</h6>
                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true" class="close-btn-popup">X</span>
                                </button>
                            </div>

                            <div class="modal-body bg-modal-popup">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="form-control" type="hidden" id="id-edit" name="id-edit">
                                            <label for="link-edit"
                                                class="form-control-label text-white @error('link-edit') is-invalid @enderror">Link</label>
                                            <input class="form-control" type="text" id="link-edit" name="link"
                                                placeholder="Masukkan Link">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer bg-modal-popup">
                                <button type="submit"
                                    class="btn bg-gradient-dark btn-outline-light my-4 edit-btn">Submit</button>
                                <button type="button" id="cancel-btn-edit"
                                    class="btn bg-gradient-dark btn-outline-light my-4"
                                    data-bs-dismiss="modal">Batal</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $("#submit-btn").click(function(e) {
                    event.preventDefault();

                    $.ajax({
                        url: "{{ url('/apk/link/create') }}",
                        method: "POST",
                        data: {
                            link: $("#link").val(),
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(result) {

                            if (result.errors) {
                                $('.alert-danger').html('');

                                $.each(result.errors, function(key, value) {
                                    $('.alert-danger').show();
                                    $('.alert-danger').append('<li>' + value + '</li>');
                                });
                            } else {
                                $('.alert-danger').hide();
                                $.pjax.reload({
                                    container: '#container-id'
                                });
                                $("#modal-bo-tambah").modal("hide");
                            }
                            // console.log(response);
                        },
                        error: function(xhr) {
                            // tambahkan kode untuk menangani kesalahan saat mengirimkan data ke server
                            console.log(xhr.responseText);
                        }
                    });
                });

                var id;
                $(document).on('click', '.edit', function() {
                    id = $(this).val();

                    fetch(`/apk/link/data/${id}`).then(response => response.json()).then(data => {
                        document.getElementById('id-edit').value = data.id;
                        document.getElementById('link-edit').value = data.link;
                    });
                });


                $(".edit-btn").click(function(e) {

                    event.preventDefault();

                    $.ajax({
                        url: "/apk/link/update/" + $("#id-edit").val(),
                        method: "POST",
                        data: {
                            id: $("#id-edit").val(),
                            link: $("#link-edit").val(),
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(result) {
                            if (result.errors) {
                                $('.alert-danger').html('');

                                $.each(result.errors, function(key, value) {
                                    $('.alert-danger').show();
                                    $('.alert-danger').append('<li>' + value + '</li>');
                                });
                            } else {
                                $('.alert-danger').hide();

                                $.pjax.reload({
                                    container: '#container-id'
                                });
                                $("#modal-bo-edit").modal("hide");
                            }
                            // console.log(response);
                        },
                        error: function(xhr) {
                            // tambahkan kode untuk menangani kesalahan saat mengirimkan data ke server
                            console.log(xhr.responseText);
                        }
                    });

                });

                $("#cancel-btn-tambah").click(function(e) {
                    $('#link').val('');
                    $('.alert-danger').hide();
                });

                $("#modal-bo-edit").on("hidden.bs.modal", function() {
                    $('#link').val('');
                    $('.alert-danger').hide();
                });


                $("#modal-bo-tambah").on("hidden.bs.modal", function() {
                    $('#link').val('');
                    $('.alert-danger').hide();
                });

                $("#cancel-btn-edit").click(function(e) {
                    $('#link').val('');
                    $('.alert-danger').hide();
                });
            });
        </script>
        <div class="d-flex justify-content-end">
            {{ $data->links() }}
        </div>
    @endsection
