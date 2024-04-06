@extends('layouts.app')

@section('title', 'Kelola Mitra')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kelola Mitra</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="/partner">Mitra</a></div>
                    <div class="breadcrumb-item">Index</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#create_partner">
                                    <i class="fas fa-plus mr-2"></i>Tambah Mitra
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="partner_table">
                                        <thead>
                                            <tr class="text-center">
                                                <th class="text-center">#</th>
                                                <th>Nama Perusahaan</th>
                                                <th>Alamat</th>
                                                <th>Keterangan</th>
                                                <th><span class="sr-only">Opsi</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($partners as $item)
                                                <tr>
                                                    <th class="text-center">{{ $loop->index + 1 }}</th>
                                                    <td>{{ $item->nama_mitra }}</td>
                                                    <td>{{ $item->alamat }}</td>
                                                    <td class="text-center">{{ $item->keterangan ?: '-' }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <div class="dropdown d-inline">
                                                                <button class="btn btn-primary dropdown-toggle"
                                                                    type="button" data-toggle="dropdown">
                                                                    Opsi
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <button
                                                                        class="dropdown-item has-icon d-flex align-items-center"
                                                                        data-toggle="modal"
                                                                        data-target="#edit_partner_{{ $item->id }}">
                                                                        <i class="fas fa-edit"></i>Edit Mitra
                                                                    </button>
                                                                    <form action="/partner/{{ $item->id }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit"
                                                                            class="dropdown-item has-icon d-flex align-items-center"
                                                                            onclick="return confirm('Apakah anda yakin?')">
                                                                            <i class="fas fa-trash"></i>Hapus Mitra
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
    <div class="modal fade" tabindex="-1" role="dialog" id="create_partner">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Mitra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/partner" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Mitra</label>
                            <input type="text" name="nama" value="{{ old('nama') }}"
                                class="form-control @error('nama') is-invalid @enderror">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
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

    @foreach ($partners as $item)
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_partner_{{ $item->id }}">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Mitra</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/partner/{{ $item->id }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Mitra</label>
                                <input type="text" name="nama" value="{{ old('nama', $item->nama) }}"
                                    class="form-control @error('nama') is-invalid @enderror">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $item->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $item->keterangan) }}</textarea>
                                @error('keterangan')
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
    <script src="{{ asset('js/plugin/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugin/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/plugin/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('js/plugin/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/plugin/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/plugin/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugin/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugin/datatables/buttons.colVis.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script>
        $('#partner_table').DataTable({
            "lengthChange": false,
            "buttons": [{
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel mr-2"></i>Excel',
                    className: 'btn btn-success',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf mr-2"></i>PDF',
                    className: 'btn btn-danger',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print mr-2"></i>Print',
                    className: 'btn btn-info',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
            ]
        }).buttons().container().appendTo('#partner_table_wrapper .col-md-6:eq(0)');

        @error('create')
            $("#create_partner").modal("show");
        @enderror

        @error('edit')
            $("#edit_partner_{{ $message }}").modal("show");
        @enderror
    </script>
@endpush
