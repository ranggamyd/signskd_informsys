@extends('layouts.app')

@section('title', 'Signed SKD')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Signed SKD</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="/signed_skd">Signed SKD</a></div>
                    <div class="breadcrumb-item">Index</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                {{-- <h4>Signed SKD</h4> --}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="skd_table">
                                        <thead>
                                            <tr class="text-center">
                                                <th class="text-center">#</th>
                                                <th>No. Surat</th>
                                                <th>Nama Pasien</th>
                                                <th>Tanggal</th>
                                                <th>Nama Dokter</th>
                                                {{-- <th>Hash</th> --}}
                                                <th>QR Code</th>
                                                <th>PDF</th>
                                                <th><span class="sr-only">Opsi</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($signed_skds as $item)
                                                <tr>
                                                    <th class="text-center align-middle">{{ $loop->index + 1 }}</th>
                                                    <td class="text-center align-middle"><span class="bage">{{ $item->skd->no_surat }}</span></td>
                                                    <td class="align-middle">{{ $item->skd->patient->nama }}</td>
                                                    <td class="text-center align-middle"><span class="badge">{{ date('d M Y', strtotime($item->created_at)) }}</span></td>
                                                    <td class="align-middle">{{ $item->skd->doctor->nama }}</td>
                                                    {{-- <td class="text-center align-middle">{{ $item->hash }}</td> --}}
                                                    <td class="text-center align-middle">{!! QrCode::size(50)->generate(route('signed_skd.check', base64_encode($item->hash))) !!}</td>
                                                    <td class="text-center align-middle">
                                                        <a href="{{ asset('pdfs/' . $item->pdf) }}" target="__blank"
                                                            class="btn btn-outline-danger"><i
                                                                class="fas fa-file-pdf mr-2"></i>PDF
                                                        </a>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <div class="btn-group">
                                                            <div class="dropdown d-inline">
                                                                <button class="btn btn-primary dropdown-toggle"
                                                                    type="button" data-toggle="dropdown">
                                                                    Opsi
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <form action="/signed_skd/{{ $item->id }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit"
                                                                            class="dropdown-item has-icon d-flex align-items-center"
                                                                            onclick="return confirm('Apakah anda yakin?')">
                                                                            <i class="fas fa-trash"></i>Hapus Signed SKD
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

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/datatables/datatables.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script>
        $("#skd_table").dataTable();
    </script>
@endpush
