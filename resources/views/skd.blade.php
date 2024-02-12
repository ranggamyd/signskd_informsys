@extends('layouts.app')

@section('title', 'Registrasi SKD')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Registrasi SKD</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="/skd">Registrasi SKD</a></div>
                    <div class="breadcrumb-item">Index</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#create_skd">
                                    <i class="fas fa-plus mr-2"></i>Buat SKD
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="skd_table">
                                        <thead>
                                            <tr class="text-center">
                                                <th class="text-center">#</th>
                                                <th>No. Surat</th>
                                                <th>Nama Pasien</th>
                                                <th>Diagnosa</th>
                                                <th>Nama Dokter</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Tanggal Keluar</th>
                                                <th><span class="sr-only">Opsi</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($skds as $item)
                                                <tr>
                                                    <th class="text-center">{{ $loop->index + 1 }}</th>
                                                    <td class="text-center"><span class="badge">{{ $item->no_surat }}</span></td>
                                                    <td>{{ $item->patient->nama }}</td>
                                                    <td>{{ $item->diagnosa }}</td>
                                                    <td>{{ $item->doctor->nama }}</td>
                                                    <td class="text-center">
                                                        <span
                                                            class="badge">{{ date('d-m-Y', strtotime($item->tanggal_masuk)) }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span
                                                            class="badge">{{ date('d-m-Y', strtotime($item->tanggal_keluar)) }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="/skd/sign_skd/{{ $item->id }}"
                                                                class="btn btn-outline-secondary mr-2"
                                                                onclick="return confirm('Apakah anda yakin?')"
                                                                title="Sign SKD"><i class="fas fa-qrcode"></i></a>
                                                            <div class="dropdown d-inline">
                                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                                    data-toggle="dropdown">
                                                                    Opsi
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <button
                                                                        class="dropdown-item has-icon d-flex align-items-center"
                                                                        data-toggle="modal"
                                                                        data-target="#edit_skd_{{ $item->id }}">
                                                                        <i class="fas fa-edit"></i>Edit SKD
                                                                    </button>
                                                                    <form action="/skd/{{ $item->id }}" method="POST">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit"
                                                                            class="dropdown-item has-icon d-flex align-items-center"
                                                                            onclick="return confirm('Apakah anda yakin?')">
                                                                            <i class="fas fa-trash"></i>Hapus SKD
                                                                        </button>
                                                                    </form>
                                                                </div>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="create_skd">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buat SKD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/skd" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nomor Surat</label>
                            <input type="text" name="no_surat" value="{{ old('no_surat', $no_surat) }}"
                                class="form-control @error('no_surat') is-invalid @enderror">
                            @error('no_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Pasien</label>
                                    <select name="patient_id"
                                        class="form-control @error('patient_id') is-invalid @enderror">
                                        <option hidden></option>
                                        @foreach ($patients as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('patient_id', session()->has('create_with_patient') ? session('create_with_patient') : '') == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('patient_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Dokter</label>
                                    <select name="doctor_id" class="form-control @error('doctor_id') is-invalid @enderror">
                                        <option hidden></option>
                                        @foreach ($doctors as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('doctor_id') == $item->id ? 'selected' : '' }}>{{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('doctor_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Diagnosa</label>
                            <textarea name="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror">{{ old('diagnosa') }}</textarea>
                            @error('diagnosa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Tanggal Masuk</label>
                                    <input type="date" name="tanggal_masuk"
                                        value="{{ old('tanggal_masuk', date('Y-m-d')) }}"
                                        class="form-control @error('tanggal_masuk') is-invalid @enderror">
                                    @error('tanggal_masuk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Tanggal Keluar</label>
                                    <input type="date" name="tanggal_keluar"
                                        value="{{ old('tanggal_keluar', date('Y-m-d')) }}"
                                        class="form-control @error('tanggal_keluar') is-invalid @enderror">
                                    @error('tanggal_keluar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
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

    @foreach ($skds as $item)
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_skd_{{ $item->id }}">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit SKD</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/skd/{{ $item->id }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nomor Surat</label>
                                <input type="text" name="no_surat" value="{{ old('no_surat', $item->no_surat) }}"
                                    class="form-control @error('no_surat') is-invalid @enderror">
                                @error('no_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Pasien</label>
                                        <select name="patient_id"
                                            class="form-control @error('patient_id') is-invalid @enderror">
                                            <option hidden></option>
                                            @foreach ($patients as $patient)
                                                <option value="{{ $patient->id }}"
                                                    {{ old('patient_id', $item->patient_id) == $patient->id ? 'selected' : '' }}>
                                                    {{ $patient->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('patient_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Dokter</label>
                                        <select name="doctor_id"
                                            class="form-control @error('doctor_id') is-invalid @enderror">
                                            <option hidden></option>
                                            @foreach ($doctors as $doctor)
                                                <option value="{{ $doctor->id }}"
                                                    {{ old('doctor_id', $item->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                                    {{ $doctor->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('doctor_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Diagnosa</label>
                                <textarea name="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror">{{ old('diagnosa', $item->diagnosa) }}</textarea>
                                @error('diagnosa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Tanggal Masuk</label>
                                        <input type="date" name="tanggal_masuk"
                                            value="{{ old('tanggal_masuk', date('Y-m-d', strtotime($item->tanggal_masuk))) }}"
                                            class="form-control @error('tanggal_masuk') is-invalid @enderror">
                                        @error('tanggal_masuk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Tanggal Keluar</label>
                                        <input type="date" name="tanggal_keluar"
                                            value="{{ old('tanggal_keluar', date('Y-m-d', strtotime($item->tanggal_keluar))) }}"
                                            class="form-control @error('tanggal_keluar') is-invalid @enderror">
                                        @error('tanggal_keluar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
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
        $("#skd_table").dataTable();

        @error('create')
            $("#create_skd").modal("show");
        @enderror

        @error('edit')
            $("#edit_skd_{{ $message }}").modal("show");
        @enderror

        @if (session()->has('create_with_patient'))
            $("#create_skd").modal("show");
        @endif
    </script>
@endpush
