@extends('layout.main')

@section('container')
    <div class="col-12">
        <div class="container-fluid py-4">
            <div class="row my-4" id="container-id">

                <div class="col-md-3">
                    <button type="button" class="btn btn-icon btn-3 btn btn-outline-light bg-dark" data-bs-toggle="modal"
                        data-bs-target="#modal-bo-tambah" id="tambah">
                        <i class="ni ni-fat-add"></i> Tambah
                    </button>
                </div>
                <div class="col-md-6">
                </div>
                <div class="col-md-3">
                    <form action="/apk/bo">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" class="form-control ps-1" placeholder="Type here..." name="search"
                                value="{{ request('search') }}">
                            <button class="btn btn-light" type="submit" id="button-addon2" hidden>Search</button>
                        </div>
                    </form>
                </div>
                <div class="card">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">
                                        <h6>No.</h6>
                                    </th>
                                    <th width="45%" class="text-center">
                                        <h6>Nama</h6>
                                    </th>
                                    <th width="45%" class="text-center">
                                        <h6>Site</h6>
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
                                        <td class="text-center text-white"> {{ $d->nama }} </td>
                                        <td class="text-center text-white"> {{ $d->site }} </td>
                                        <td class="project-actions text-right mt-10">
                                            <form action="{{ url('/apk/bo/delete', $d->id) }}" method="POST">
                                                <button type="button" class="badge btn-info bg-dark edit"
                                                    data-bs-toggle="modal" data-bs-target="#modal-bo-edit" id="edit"
                                                    value="{{ $d['id'] }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                    <span class="badge">Edit</span>
                                                </button>
                                                <input type="hidden" id="boid" name="boid">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge btn-danger bg-dark"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal-bo-edit{{ $d->id }}" id="edit"
                                                    value="{{ $d->id }}"
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus?');">
                                                    <i class="fas fa-pencil-alt"></i>
                                                    <span class="badge">Delete</span>
                                                </button>

                                            </form>
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
                        <form id="form-bo">
                            @csrf
                            <div class="modal-header bg-modal-popup">
                                <h6 class="modal-title" id="modal-title-default text-white">Tambah Bo</h6>
                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true" class="close-btn-popup">X</span>
                                </button>
                            </div>
                            <div class="alert alert-danger"></div>
                            <div class="modal-body bg-modal-popup">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nama"
                                                class="form-control-label text-white @error('nama') is-invalid @enderror">Nama</label>
                                            <input class="form-control" type="text" id="nama" name="nama"
                                                placeholder="Masukkan Nama">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="site"
                                                class="form-control-label text-white @error('site') is-invalid @enderror">Site</label>
                                            <input class="form-control" type="text" id="site" name="site"
                                                placeholder="Masukkan Site">
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
                            @method('PUT')
                            <div class="modal-header bg-modal-popup">
                                <h6 class="modal-title text-white" id="modal-title-default">Edit Bo</h6>
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
                                            <label for="nama-edit"
                                                class="form-control-label text-white @error('nama-edit') is-invalid @enderror">Nama</label>
                                            <input class="form-control" type="text" id="nama-edit" name="nama-edit"
                                                placeholder="Masukkan Nama">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="form-control" type="hidden" id="id-site" name="id-site">
                                            <label for="site-edit"
                                                class="form-control-label text-white @error('site-edit') is-invalid @enderror">Site</label>
                                            <input class="form-control" type="text" id="site-edit" name="site-edit"
                                                placeholder="Masukkan Site">
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
                        url: "{{ url('/apk/bo/create') }}",
                        method: "POST",
                        data: {
                            nama: $("#nama").val(),
                            site: $("#site").val(),
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
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });

                var id;
                $(document).on('click', '.edit', function() {
                    id = $(this).val();

                    fetch(`/apk/bo/data/${id}`).then(response => response
                        .json()).then(data => {
                        document.getElementById('id-edit').value = data.id;
                        document.getElementById('nama-edit').value = data.nama;
                        document.getElementById('site-edit').value = data.site;
                    });
                });


                $(".edit-btn").click(function(e) {

                    event.preventDefault();

                    $.ajax({
                        url: "/apk/bo/update/" + $("#id-edit")
                            .val(),
                        method: "PUT",
                        data: {
                            id: $("#id-edit").val(),
                            nama: $("#nama-edit").val(),
                            site: $("#site-edit").val(),
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
                    $('#nama').val('');
                    $('.alert-danger').hide();
                });

                $("#modal-bo-edit").on("hidden.bs.modal", function() {
                    $('#nama').val('');
                    $('.alert-danger').hide();
                });


                $("#modal-bo-tambah").on("hidden.bs.modal", function() {
                    $('#nama').val('');
                    $('.alert-danger').hide();
                });

                $("#cancel-btn-edit").click(function(e) {
                    $('#nama').val('');
                    $('.alert-danger').hide();
                });
            });
        </script>

        <ul class="pagination pagination-secondary justify-content-end mt-3 me-5">
            {{ $data->onEachSide(1)->links('pagination::bootstrap-4') }}
        </ul>
    @endsection
