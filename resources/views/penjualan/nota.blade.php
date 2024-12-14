<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota</title>
    <style>        
        @page , body { margin:0; padding: 0; }
        #nota { max-width: 210px; margin-left: 200px }
        #nota header { text-align: center; }
        #nota header .logo { width: 80%; }
        #nota header p { font-family: Tahoma; font-size: 14px; margin: 0; padding: 0; }
        #nota header table { margin: 5px 0; padding: 5px 0; border-bottom: 1px dashed;  }
        #nota header table td  { font-family: Tahoma; font-size: 14px; margin: 0; padding: 0; text-align: left; }

        #nota .content table { border-collapse: collapse; }
        #nota .content table td { font-size: 12px; font-family: Tahoma; }
        #nota .right { text-align: right; }
        #nota td.price { vertical-align: top; text-align: right; font-size: 16px; }

        #nota .grandtotal { border-top: 1px dashed; margin: 5px 0; padding: 5px 0; }
        #nota .grandtotal table tr td { font-size: 14px; font-family: Tahoma; }

        #nota .thank p { text-align: center; }
    </style>
</head>
<body>
    <div id="nota">
        <header>
            {{-- <img src="{{ asset('images/logo.png') }}" alt="" class="logo"> --}}
            @php

            @endphp
            @foreach($penjualan as $pjl)
            <p>AGEECOM</p>
            {{-- <p>Tanggal : {{ substr($pjl->updated_at,0,10) }}</p> --}}
            {{-- <p>Jl.Serayu Madiun</p> --}}
            <table width="100%">
                <tr>
                    <td>Nota : {{ $pjl->id_penjualan }}</td>
                </tr>
                {{-- <tr>
                    <td>Tanggal : {{ substr($pjl->updated_at,0,10) }}</td>
                </tr> --}}
                <tr>
                    <td>Kasir : {{ Auth::user()->name }}</td>
                </tr>
                <tr>
                    <td>Pelanggan : {{ $pjl->nama }}</td>
                </tr>
            </table>
            @endforeach
        </header>
        <div class="content">
            <table width="100%">
                @php
                    $grand = 0;
                @endphp
                @foreach($detail as $det)
                <tr>
                    <td width="65%">
                        {{ $det->nama }}<br/>
                        {{ number_format($det->harga,"0",",",".") }}  x  {{$det->qty}}  =
                    </td>
                    <td width="35%" class="right">
                        {{$det->diskon}}%
                        {{-- {{number_format($det->diskon_nominal,"0",",",".")}} --}}
                        <br/>
                        {{ number_format($det->total,"0",",",".") }}
                    </td>
                </tr>

                {{-- Menjumlakan Subtotal --}}
                @php
                    $grand += $det->total;
                    // $grand += $det->total  
                @endphp
                {{-- End Sub Total --}}
                @endforeach
            </table>
        </div>
        <div class="grandtotal">
            {{-- Hitung Bayar --}}
            <table width="100%">
                <tr>
                    <td width="65%">Total Bayar</td>
                    <td>=</td>
                    <td class="right">{{ number_format($grand,"0",",",".") }} </td>
                </tr>
                @foreach($penjualan as $pjl)
                <tr>
                    <td width="65%">Bayar</td>
                    <td>=</td>
                    <td class="right">{{ number_format($pjl->bayar,"0",",",".") }} </td>
                </tr>
                @php
                    $kembali = $pjl->bayar -= $grand
                @endphp
                @endforeach
                <tr>
                    <td width="65%">Kembalian</td>
                    <td>=</td>
                    <td class="right" style="border-top:1px dashed">{{ number_format($kembali,"0",",",".") }} </td>
                </tr>
            </table>
        </div>
        <div class="thank">
            <p>Barang yang sudah dibeli Dan Sudah di bawa pulang tidak bisa dikembalikan lagi kecuali ada perjanjian.</p>
        </div>
    </div>
    {{-- Print --}}
    <script>
        window.print();
    </script>
</body>
</html>
