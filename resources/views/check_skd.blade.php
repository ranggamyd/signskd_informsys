@extends('layouts.auth')

@section('title', 'Cek Validitas SKD')

@section('misc')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Scan Signed SKD</h4>
        </div>
        <div class="card-body">
            <div id="reader" width="100%" height="100%"></div>
        </div>
    </div>
@endsection

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Cek Validitas SKD</h4>
        </div>
        <div class="card-body">
            @if (isset($signed_skd))
                <div class="form-group">
                    <label>Nomor Surat</label>
                    <input readonly type="text" name="no_surat" value="{{ old('no_surat', $signed_skd->skd->no_surat) }}"
                        class="form-control @error('no_surat') is-invalid @enderror">
                    @error('no_surat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Pasien</label>
                            <select disabled name="patient_id"
                                class="form-control @error('patient_id') is-invalid @enderror">
                                <option hidden></option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}"
                                        {{ old('patient_id', $signed_skd->skd->patient_id) == $patient->id ? 'selected' : '' }}>
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
                            <select disabled name="doctor_id" class="form-control @error('doctor_id') is-invalid @enderror">
                                <option hidden></option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}"
                                        {{ old('doctor_id', $signed_skd->skd->doctor_id) == $doctor->id ? 'selected' : '' }}>
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
                    <textarea readonly name="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror">{{ old('diagnosa', $signed_skd->skd->diagnosa) }}</textarea>
                    @error('diagnosa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Tanggal Masuk</label>
                            <input readonly type="date" name="tanggal_masuk"
                                value="{{ old('tanggal_masuk', date('Y-m-d', strtotime($signed_skd->skd->tanggal_masuk))) }}"
                                class="form-control @error('tanggal_masuk') is-invalid @enderror">
                            @error('tanggal_masuk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Tanggal Keluar</label>
                            <input readonly type="date" name="tanggal_keluar"
                                value="{{ old('tanggal_keluar', date('Y-m-d', strtotime($signed_skd->skd->tanggal_keluar))) }}"
                                class="form-control @error('tanggal_keluar') is-invalid @enderror">
                            @error('tanggal_keluar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-right">
                        {{-- {!! QrCode::size(50)->generate(route('signed_skd.check', base64_encode($signed_skd->hash))) !!} --}}
                        <a href="{{ asset('pdfs/' . $signed_skd->pdf) }}" target="__blank"
                            class="btn btn-outline-danger"><i class="fas fa-file-pdf mr-2"></i>Lihat PDF
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/html5-qrcode/html5-qrcode.min.js') }}"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            window.location.href = decodedText;
        }

        function onScanFailure(error) {
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endpush
