@extends('layouts.app')

@section('title', 'Kelola User')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buttons.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            {{-- <div class="section-header">
                <h1>Kelola User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="/user">User</a></div>
                    <div class="breadcrumb-item">Index</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#create_user">
                                    <i class="fas fa-plus mr-2"></i>Tambah User
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="user_table">
                                        <thead>
                                            <tr class="text-center">
                                                <th class="text-center">#</th>
                                                <th>Avatar</th>
                                                <th>Nama User</th>
                                                <th>Username</th>
                                                <th>E-Mail</th>
                                                <th>No. Telepon</th>
                                                <th>Role</th>
                                                <th>Mitra</th>
                                                <th><span class="sr-only">Opsi</span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $item)
                                                <tr>
                                                    <th class="text-center align-middle">{{ $loop->index + 1 }}</th>
                                                    <td class="text-center align-middle">
                                                        <img src="{{ asset('img/avatar/' . $item->avatar) }}"
                                                            class="img-thumbnail rounded-circle" style="width: 50px;">
                                                    </td>
                                                    <td class="align-middle">{{ $item->name }}</td>
                                                    <td class="align-middle">{{ $item->username }}</td>
                                                    <td class="align-middle">{{ $item->email }}</td>
                                                    <td class="text-center align-middle"><span
                                                            class="badge">{{ $item->phone }}</span></td>
                                                    <td class="text-center align-middle"><span
                                                            class="badge">{{ $item->role }}</span></td>
                                                    <td class="text-center align-middle"><span
                                                            class="badge">{{ $item->partner->nama_mitra ?: '-' }}</span></td>
                                                    <td class="align-middle" class="text-center">
                                                        <div class="dropdown d-inline">
                                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                                data-toggle="dropdown">
                                                                Opsi
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <button
                                                                    class="dropdown-item has-icon d-flex align-items-center"
                                                                    data-toggle="modal"
                                                                    data-target="#show_user_{{ $item->id }}">
                                                                    <i class="fas fa-eye"></i>Detail User
                                                                </button>
                                                                <button
                                                                    class="dropdown-item has-icon d-flex align-items-center"
                                                                    data-toggle="modal"
                                                                    data-target="#edit_user_{{ $item->id }}">
                                                                    <i class="fas fa-edit"></i>Edit User
                                                                </button>
                                                                <form action="/user/{{ $item->id }}" method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit"
                                                                        class="dropdown-item has-icon d-flex align-items-center"
                                                                        onclick="return confirm('Apakah anda yakin?')">
                                                                        <i class="fas fa-trash"></i>Hapus User
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
            </div> --}}
        </section>
    </div>
@endsection

@push('modals')
    <div class="modal fade" tabindex="-1" role="dialog" id="create_user">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/user" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama User</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" value="{{ old('username') }}"
                                class="form-control @error('username') is-invalid @enderror">
                            @error('username')
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
                                    <input type="text" name="phone" value="{{ old('phone') }}"
                                        class="form-control @error('phone') is-invalid @enderror">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" value="{{ old('password') }}"
                                        class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation"
                                        value="{{ old('password_confirmation') }}"
                                        class="form-control @error('password_confirmation') is-invalid @enderror">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Avatar</label>
                            <input type="file" name="avatar" value="{{ old('avatar') }}" accept="image/*"
                                class="form-control-file @error('avatar') is-invalid @enderror">
                            @error('avatar')
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

    @foreach ($users as $item)
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_user_{{ $item->id }}">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/user/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama User</label>
                                <input type="text" name="name" value="{{ old('name', $item->name) }}"
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" value="{{ old('username', $item->username) }}"
                                    class="form-control @error('username') is-invalid @enderror">
                                @error('username')
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
                                        <input type="text" name="phone" value="{{ old('phone', $item->phone) }}"
                                            class="form-control @error('phone') is-invalid @enderror">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" value="{{ old('password') }}"
                                            class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation"
                                            value="{{ old('password_confirmation') }}"
                                            class="form-control @error('password_confirmation') is-invalid @enderror">
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Avatar</label>
                                <input type="file" name="avatar" value="{{ old('avatar') }}" accept="image/*"
                                    class="form-control-file @error('avatar') is-invalid @enderror">
                                @error('avatar')
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

        <div class="modal fade" tabindex="-1" role="dialog" id="show_user_{{ $item->id }}">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama User</label>
                            <input readonly type="text" name="name" value="{{ old('name', $item->name) }}"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input readonly type="text" name="username"
                                value="{{ old('username', $item->username) }}"
                                class="form-control @error('username') is-invalid @enderror">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>E-Mail</label>
                                    <input readonly type="email" name="email"
                                        value="{{ old('email', $item->email) }}"
                                        class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>No. Telepon</label>
                                    <input readonly type="text" name="phone"
                                        value="{{ old('phone', $item->phone) }}"
                                        class="form-control @error('phone') is-invalid @enderror">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" data-dismiss="modal" class="btn btn-primary"><i
                                class="fas fa-times mr-2"></i>Tutup</button>
                    </div>
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
        $('#user_table').DataTable({
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
        }).buttons().container().appendTo('#user_table_wrapper .col-md-6:eq(0)');

        @error('create')
            $("#create_user").modal("show");
        @enderror

        @error('edit')
            $("#edit_user_{{ $message }}").modal("show");
        @enderror

        @if (session()->has('update_profile'))
            $("#edit_user_{{ session('update_profile')->id }}").modal("show");
        @endif

        @if (session()->has('show_profile'))
            $("#show_user_{{ session('show_profile')->id }}").modal("show");
        @endif
    </script>
@endpush
