<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pesanan - Optik Arsy</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            /* background-color: #f5f5f5; */
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .struk-container {
            width: 100%;
            max-width: 450px;
            background-color: white;
            padding: 30px 20px;
            /* box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); */
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #d32f2f;
            padding-bottom: 15px;
        }

        .logo-section {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #d32f2f 0%, #b71c1c 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 24px;
            margin-right: 10px;
            box-shadow: 0 2px 5px rgba(211, 47, 47, 0.3);
        }

        .logo-text {
            text-align: left;
        }

        .logo-text h1 {
            color: #d32f2f;
            font-size: 24px;
            font-weight: bold;
            margin: 0;
            letter-spacing: 1px;
        }

        .logo-text p {
            color: #666;
            font-size: 11px;
            margin: 2px 0;
        }

        .logo-text .address {
            color: #999;
            font-size: 10px;
            margin-top: 3px;
        }

        .nota-title {
            color: #d32f2f;
            font-size: 18px;
            font-weight: bold;
            margin: 15px 0 10px 0;
        }

        .nota-number {
            color: #333;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .nota-number span {
            font-weight: bold;
        }

        .form-section {
            margin-bottom: 20px;
            font-size: 12px;
        }

        .form-row {
            display: flex;
            margin-bottom: 8px;
            align-items: flex-start;
        }

        .form-label {
            color: #d32f2f;
            font-weight: bold;
            width: 70px;
            flex-shrink: 0;
        }

        .form-separator {
            color: #d32f2f;
            margin: 0 8px;
            width: 8px;
            text-align: center;
        }

        .form-input {
            flex: 1;
            border-bottom: 1px dotted #d32f2f;
            padding-bottom: 2px;
            color: #333;
        }

        .form-right {
            margin-left: auto;
            text-align: right;
            width: 45%;
        }

        .form-right .form-input {
            border-bottom: 1px dotted #d32f2f;
        }

        .resep-section {
            margin: 25px 0;
        }

        .resep-title {
            color: #d32f2f;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
        }

        .resep-table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid #d32f2f;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .resep-table th {
            background-color: white;
            color: #d32f2f;
            padding: 8px 5px;
            text-align: center;
            font-weight: bold;
            border-right: 1px solid #d32f2f;
            border-bottom: 1px solid #d32f2f;
            font-size: 11px;
        }

        .resep-table th:last-child {
            border-right: none;
        }

        .resep-table td {
            padding: 12px 5px;
            text-align: center;
            border-right: 1px solid #d32f2f;
            border-bottom: 1px solid #d32f2f;
            height: 30px;
        }

        .resep-table td:last-child {
            border-right: none;
        }

        .resep-table tr:last-child td {
            border-bottom: none;
        }

        .resep-label {
            color: #d32f2f;
            font-weight: bold;
            text-align: left;
            padding-left: 8px;
        }

        .note-section {
            margin: 20px 0;
            font-size: 11px;
        }

        .note-label {
            color: #d32f2f;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .note-line {
            border-bottom: 1px dotted #d32f2f;
            min-height: 20px;
            margin-bottom: 10px;
        }

        .warning-box {
            background-color: #d32f2f;
            color: white;
            padding: 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            border-top: 2px solid #d32f2f;
            padding-top: 15px;
        }

        .footer-text {
            color: #d32f2f;
            font-size: 12px;
            font-weight: bold;
        }

        @media print {
            body {
                background-color: white;
                padding: 0;
            }

            .struk-container {
                box-shadow: none;
                max-width: 100%;
            }
        }

        /* Untuk layout yang lebih responsif */
        .form-right {
            display: inline-block;
            margin-left: 20px;
        }

        .form-row-double {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .form-row-double>div {
            flex: 1;
        }

        .form-row-double>div:last-child {
            margin-left: 20px;
        }
    </style>
</head>

<body>
    <div class="struk-container">
        <!-- Header dengan Logo -->
        <div class="header">
            <div class="logo-section">
                <div class="logo">
                    <img src="{{ asset('storage/' . $pengaturan->logo) }}" alt="Logo Optik" width="70">
                </div>
                <div class="logo-text">
                    <h1 style="text-align: center">{{ $pengaturan['nama_toko'] ?? 'OPTIK' }}</h1>
                    <p>{{ $pengaturan['deskripsi'] ?? 'Computer System Refraksi & Contact Lens Centre' }}</p>
                    <p class="address">{{ $pengaturan['alamat'] ?? '-' }} Telp. {{ $pengaturan['telp'] ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Nota Pesanan -->
        <div class="nota-title">NOTA PESANAN</div>
        <div class="nota-number">
            No. <span>{{ str_pad($RmPembayaran->id, 6, '0', STR_PAD_LEFT) }}</span>
            <span style="float: right; margin-right: 20px;">Tgl. {{ \Carbon\Carbon::now()->format('d-m-Y') }}</span>
        </div>

        <!-- Form Section -->
        <div class="form-section">
            <div class="form-row">
                <div class="form-label">Pro</div>
                <div class="form-separator">:</div>
                <div class="form-input">{{ $RmPemeriksaan->pasien->nama_pasien }}</div>
            </div>

            <div class="form-row">
                <div class="form-label">Alamat</div>
                <div class="form-separator">:</div>
                <div class="form-input">{{ $RmPemeriksaan->pasien->alamat ?? '-' }}</div>
            </div>

            <div class="form-row-double">
                <div>
                    <div style="color: #d32f2f; font-weight: bold; font-size: 12px;">Frame</div>
                    <div style="border-bottom: 1px dotted #d32f2f; height: 20px; margin-top: 5px;">
                        {{ $RmPemeriksaan->pesanan->frame?->merk ?? '-' }} -
                        {{ $RmPemeriksaan->pesanan->frame?->kode_frame ?? '-' }}</div>
                </div>
                <div>
                    <div style="color: #d32f2f; font-weight: bold; font-size: 12px;">Rp.
                        {{ number_format($RmPemeriksaan->pesanan->frame->harga ?? 0, 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="form-row-double">
                <div>
                    <div style="color: #d32f2f; font-weight: bold; font-size: 12px;">Lensa</div>
                    <div style="border-bottom: 1px dotted #d32f2f; height: 20px; margin-top: 5px;">
                        {{ $RmPemeriksaan->pesanan->lensa->nama_lensa ?? '-' }}</div>
                </div>
                <div>
                    <div style="color: #d32f2f; font-weight: bold; font-size: 12px;">Rp.
                        {{ number_format($RmPemeriksaan->pesanan->lensa->harga ?? 0, 0, ',', '.') }}
                    </div>
                </div>
            </div>

            {{-- Section for Accessories --}}
            @if ($RmPemeriksaan->pesanan->aksesoris->isNotEmpty())
                @foreach ($RmPemeriksaan->pesanan->aksesoris as $aksesoris)
                    <div class="form-row-double">
                        <div>
                            <div style="color: #d32f2f; font-weight: bold; font-size: 12px;">Aksesoris</div>
                            <div style="border-bottom: 1px dotted #d32f2f; height: 20px; margin-top: 5px;">
                                {{ $aksesoris->nama ?? '-' }}
                                @if ($aksesoris->pivot->jumlah > 1)
                                    (x{{ $aksesoris->pivot->jumlah }})
                                @endif
                            </div>
                        </div>
                        <div>
                            <div style="color: #d32f2f; font-weight: bold; font-size: 12px;">Rp.
                                {{ number_format(($aksesoris->harga ?? 0) * ($aksesoris->pivot->jumlah ?? 1), 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            <div class="form-row">
                <div class="form-label">Resep</div>
                <div class="form-separator">:</div>
                <div class="form-input">{{ $RmPemeriksaan->resep->resep_dari ?? '-' }}</div>
                @php
                    $hg = $RmPemeriksaan->pesanan->biaya_kacamata;
                    $dp1 = $RmPemeriksaan->pesanan->pembayarans->sum('jumlah');
                @endphp
                <div style="margin-left: 20px; text-align: right;">
                    <div style="color: #d32f2f; font-weight: bold; font-size: 11px;">Jumlah : Rp.
                        {{ number_format($hg, 0, ',', '.') }}</div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-label">Siap Tgl</div>
                <div class="form-separator">:</div>
                <div class="form-input">{{ optional($RmPemeriksaan->pesanan->tanggal_pengambilan)->format('d-m-Y') }}
                </div>
                <div style="margin-left: 20px; text-align: right;">
                    <div style="color: #d32f2f; font-weight: bold; font-size: 11px;">Bayar : Rp.
                        {{ number_format($dp1, 0, ',', '.') }}</div>
                </div>
            </div>

            <div style="text-align: right; margin-top: 10px;">
                @php
                    $ss = $hg - $dp1;
                @endphp
                <div style="color: #d32f2f; font-weight: bold; font-size: 11px;">Sisa : Rp.
                    {{ number_format($ss, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Resep Kacamata -->
        <div class="resep-section">
            <div class="resep-title">RESEP KACAMATA</div>
            <table class="resep-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Sph</th>
                        <th>Cyl</th>
                        <th>Axis</th>
                        <th>Add</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="resep-label">R</td>
                        <td>{{ $RmPemeriksaan->resep->od_sferis ?? '-' }}</td>
                        <td>{{ $RmPemeriksaan->resep->od_silindris ?? '-' }}</td>
                        <td>{{ $RmPemeriksaan->resep->od_axis ?? '-' }}</td>
                        <td>{{ $RmPemeriksaan->resep->od_add_lensa ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="resep-label">L</td>
                        <td>{{ $RmPemeriksaan->resep->os_sferis ?? '-' }}</td>
                        <td>{{ $RmPemeriksaan->resep->os_silindris ?? '-' }}</td>
                        <td>{{ $RmPemeriksaan->resep->os_axis ?? '-' }}</td>
                        <td>{{ $RmPemeriksaan->resep->os_add_lensa ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Note Section -->
        <div class="note-section">
            <div class="note-label">Note : {{ $RmPemeriksaan->diagnosa ?? '-' }}</div>
            <div class="note-line"></div>
        </div>

        <!-- Warning Box -->
        <div class="warning-box">
            ⚠️ Barang yang tidak diambil dalam waktu 3 bulan, bukan lagi tanggung jawab optik
        </div>

        <!-- Footer -->
        <div class="footer">
            <div></div>
            <div class="footer-text">{{ $RmPemeriksaan->user?->name ?? ($pengaturan['nama_toko'] ?? 'OPTIK') }}</div>
        </div>
    </div>
</body>

</html>
