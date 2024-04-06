@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-procedures"></i>
                        </div>
                        <div class="card-wrap">
                            @if (!Auth::user()->partner_id)
                                <div class="card-header">
                                    <h4>Total Pasien</h4>
                                </div>
                                <div class="card-body">
                                    {{ $total_pasien }}
                                </div>
                            @else
                                <div class="card-header">
                                    <h4>Daftar Karyawan</h4>
                                </div>
                                <div class="card-body">
                                    {{ $total_pasien }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Dokter</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_dokter }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @if (!Auth::user()->partner_id)
                                <button class="btn btn-primary" data-toggle="modal" data-target="#create_patient">
                                    <i class="fas fa-plus mr-2"></i>Tambah Pasien
                                </button>
                            @endif
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
                                            <th>Instansi/Perusahaan</th>
                                            <th>Alamat</th>
                                            <th><span class="sr-only">Opsi</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patients as $item)
                                            <tr>
                                                <th class="text-center">{{ $loop->index + 1 }}</th>
                                                <td class="text-center"><span class="badge">{{ $item->nik }}</span>
                                                </td>
                                                <td>{{ $item->nama }}</td>
                                                <td class="text-center">{{ $item->umur }}</td>
                                                <td class="text-center">{{ $item->jenis_kelamin }}</td>
                                                <td class="text-center">
                                                    {{ $item->tempat_lahir }},<br>
                                                    {{ date('d-m-Y', strtotime($item->tanggal_lahir)) }}
                                                </td>
                                                <td class="text-center"><span class="badge">{{ $item->telepon }}</span>
                                                </td>
                                                <td class="text-center">{{ $item->pekerjaan }}</td>
                                                <td class="text-center">{{ $item->partner->nama_mitra }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td class="text-center">
                                                    @if (!Auth::user()->partner_id)
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
                                                    @endif
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
        </section>
    </div>
@endsection


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
        $('#patient_table').DataTable({
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
        }).buttons().container().appendTo('#patient_table_wrapper .col-md-6:eq(0)');
    </script>
@endpush
