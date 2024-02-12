@extends('layouts.app')

@section('title', 'Dashboard')

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
                            <div class="card-header">
                                <h4>Total Pasien</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_pasien }}
                            </div>
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
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Signed SKD</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_signed_skd }}/{{ $total_skd }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Users</h4>
                            </div>
                            <div class="card-body">
                                {{ $total_users }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>List of Unsigned SKD</h4>
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
        </section>
    </div>
@endsection
