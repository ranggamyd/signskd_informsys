@extends('layouts.app')

@section('title', 'Kelola Dokter')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kelola Dokter</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="/doctor">Dokter</a></div>
                    <div class="breadcrumb-item">Index</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#create_doctor">
                                    <i class="fas fa-plus mr-2"></i>Tambah Dokter
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="doctor_table">
                                        <thead>
                                            <tr class="text-center">
                                                <th class="text-center">#</th>
                                                <th>Nama Dokter</th>
                                                <th>Spesialis</th>
                                                <th>E-Mail</th>
                                                <th>No. Telepon</th>
                                                <th>Alamat</th>
                                                <th><span class="sr-only">Opsi</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($doctors as $item)
                                                <tr>
                                                    <th class="text-center">{{ $loop->index + 1 }}</th>
                                                    <td>{{ $item->nama }}</td>
                                                    <td class="text-center">{{ $item->spesialis }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td class="text-center"><span class="bage">{{ $item->telepon }}</span></td>
                                                    <td>{{ $item->alamat }}</td>
                                                    <td class="text-center">
                                                        <div class="dropdown d-inline">
                                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                                data-toggle="dropdown">
                                                                Opsi
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <button
                                                                    class="dropdown-item has-icon d-flex align-items-center"
                                                                    data-toggle="modal"
                                                                    data-target="#edit_doctor_{{ $item->id }}">
                                                                    <i class="fas fa-edit"></i>Edit Dokter
                                                                </button>
                                                                <form action="/doctor/{{ $item->id }}" method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit"
                                                                        class="dropdown-item has-icon d-flex align-items-center"
                                                                        onclick="return confirm('Apakah anda yakin?')">
                                                                        <i class="fas fa-trash"></i>Hapus Dokter
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('modals')
    <div class="modal fade" tabindex="-1" role="dialog" id="create_doctor">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Dokter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/doctor" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Dokter</label>
                            <input type="text" name="nama" value="{{ old('nama') }}"
                                class="form-control @error('nama') is-invalid @enderror">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Spesialis</label>
                            <input type="text" name="spesialis" value="{{ old('spesialis') }}"
                                class="form-control @error('spesialis') is-invalid @enderror">
                            @error('spesialis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>E-Mail</label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>No. Telepon</label>
                                    <input type="text" name="telepon" value="{{ old('telepon') }}"
                                        class="form-control @error('telepon') is-invalid @enderror">
                                    @error('telepon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="reset" class="btn btn-secondary"><i
                                class="fas fa-sync-alt mr-2"></i>Reset</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($doctors as $item)
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_doctor_{{ $item->id }}">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Dokter</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/doctor/{{ $item->id }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Dokter</label>
                                <input type="text" name="nama" value="{{ old('nama', $item->nama) }}"
                                    class="form-control @error('nama') is-invalid @enderror">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Spesialis</label>
                                <input type="text" name="spesialis" value="{{ old('spesialis', $item->spesialis) }}"
                                    class="form-control @error('spesialis') is-invalid @enderror">
                                @error('spesialis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>E-Mail</label>
                                        <input type="email" name="email" value="{{ old('email', $item->email) }}"
                                            class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>No. Telepon</label>
                                        <input type="text" name="telepon"
                                            value="{{ old('telepon', $item->telepon) }}"
                                            class="form-control @error('telepon') is-invalid @enderror">
                                        @error('telepon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $item->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="reset" class="btn btn-secondary"><i
                                    class="fas fa-sync-alt mr-2"></i>Reset</button>
                            <button type="submit" class="btn btn-primary"><i
                                    class="fas fa-save mr-2"></i>Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endpush

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/datatables/datatables.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script>
        $("#doctor_table").dataTable();

        @error('create')
            $("#create_doctor").modal("show");
        @enderror

        @error('edit')
            $("#edit_doctor_{{ $message }}").modal("show");
        @enderror
    </script>
@endpush
