@extends('layouts.app')

@section('title', 'Kelola Pasien')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kelola Pasien</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="/patient">Pasien</a></div>
                    <div class="breadcrumb-item">Index</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#create_patient">
                                    <i class="fas fa-plus mr-2"></i>Tambah Pasien
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="patient_table">
                                        <thead>
                                            <tr class="text-center">
                                                <th class="text-center">#</th>
                                                <th>NIK</th>
                                                <th>Nama Pasien</th>
                                                <th>Umur</th>
                                                <th>Jenis Kelamin</th>
                                                <th>TTL</th>
                                                <th>No. Telepon</th>
                                                <th>Pekerjaan</th>
                                                <th>Alamat</th>
                                                <th><span class="sr-only">Opsi</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($patients as $item)
                                                <tr>
                                                    <th class="text-center">{{ $loop->index + 1 }}</th>
                                                    <td class="text-center"><span class="badge">{{ $item->nik }}</span></td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td class="text-center">{{ $item->umur }}</td>
                                                    <td class="text-center">{{ $item->jenis_kelamin }}</td>
                                                    <td class="text-center">
                                                        {{ $item->tempat_lahir }},<br>
                                                        {{ date('d-m-Y', strtotime($item->tanggal_lahir)) }}
                                                    </td>
                                                    <td class="text-center"><span class="badge">{{ $item->telepon }}</span></td>
                                                    <td class="text-center">{{ $item->pekerjaan }}</td>
                                                    <td>{{ $item->alamat }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="/patient/create_skd/{{ $item->id }}"
                                                                class="btn btn-outline-secondary mr-2" title="Buat SKD"><i
                                                                    class="fas fa-envelope-open-text"></i></a>
                                                            <div class="dropdown d-inline">
                                                                <button class="btn btn-primary dropdown-toggle"
                                                                    type="button" data-toggle="dropdown">
                                                                    Opsi
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <button
                                                                        class="dropdown-item has-icon d-flex align-items-center"
                                                                        data-toggle="modal"
                                                                        data-target="#edit_patient_{{ $item->id }}">
                                                                        <i class="fas fa-edit"></i>Edit Pasien
                                                                    </button>
                                                                    <form action="/patient/{{ $item->id }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit"
                                                                            class="dropdown-item has-icon d-flex align-items-center"
                                                                            onclick="return confirm('Apakah anda yakin?')">
                                                                            <i class="fas fa-trash"></i>Hapus Pasien
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
    <div class="modal fade" tabindex="-1" role="dialog" id="create_patient">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/patient" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nomor Induk KTP</label>
                            <input type="text" name="nik" value="{{ old('nik') }}"
                                class="form-control @error('nik') is-invalid @enderror">
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama" value="{{ old('nama') }}"
                                class="form-control @error('nama') is-invalid @enderror">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin"
                                        class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                        <option hidden></option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                        <option value="Tidak Diketahui">Tidak Diketahui</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Umur</label>
                                    <input type="number" name="umur" value="{{ old('umur') }}"
                                        class="form-control @error('umur') is-invalid @enderror">
                                    @error('umur')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                        class="form-control @error('tempat_lahir') is-invalid @enderror">
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror">
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}"
                                        class="form-control @error('pekerjaan') is-invalid @enderror">
                                    @error('pekerjaan')
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

    @foreach ($patients as $item)
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_patient_{{ $item->id }}">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Pasien</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/patient/{{ $item->id }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nomor Induk KTP</label>
                                <input type="text" name="nik" value="{{ old('nik', $item->nik) }}"
                                    class="form-control @error('nik') is-invalid @enderror">
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama Pasien</label>
                                <input type="text" name="nama" value="{{ old('nama', $item->nama) }}"
                                    class="form-control @error('nama') is-invalid @enderror">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select name="jenis_kelamin"
                                            class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                            <option hidden></option>
                                            <option value="Laki-laki"
                                                {{ old('jenis_kelamin', 'Laki-laki') == $item->jenis_kelamin ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="Perempuan"
                                                {{ old('jenis_kelamin', 'Perempuan') == $item->jenis_kelamin ? 'selected' : '' }}>
                                                Perempuan</option>
                                            <option value="Tidak Diketahui"
                                                {{ old('jenis_kelamin', 'Tidak Diketahui') == $item->jenis_kelamin ? 'selected' : '' }}>
                                                Tidak Diketahui</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Umur</label>
                                        <input type="number" name="umur" value="{{ old('umur', $item->umur) }}"
                                            class="form-control @error('umur') is-invalid @enderror">
                                        @error('umur')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir"
                                            value="{{ old('tempat_lahir', $item->tempat_lahir) }}"
                                            class="form-control @error('tempat_lahir') is-invalid @enderror">
                                        @error('tempat_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir"
                                            value="{{ old('tanggal_lahir', $item->tanggal_lahir) }}"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror">
                                        @error('tanggal_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Pekerjaan</label>
                                        <input type="text" name="pekerjaan"
                                            value="{{ old('pekerjaan', $item->pekerjaan) }}"
                                            class="form-control @error('pekerjaan') is-invalid @enderror">
                                        @error('pekerjaan')
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
        $("#patient_table").dataTable();

        @error('create')
            $("#create_patient").modal("show");
        @enderror

        @error('edit')
            $("#edit_patient_{{ $message }}").modal("show");
        @enderror
    </script>
@endpush
