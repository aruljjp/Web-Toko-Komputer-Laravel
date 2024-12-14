<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota</title>
    <style>
        body{
            background-color: #F6F6F6; 
            margin: 0;
            padding: 0;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 50%;
            margin-right: auto;
            margin-left: auto;
        }
        .brand-section{
           background-color:palevioletred;
           text-align: center;
           padding: 10px 40px;
        }
        .logo{
            width: 30%;
        }

        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-6{
            width: 50%;
            flex: 0 0 auto;
        }
        .text-black{
            color: black;
        }
        .company-details{
            float: right;
            text-align: right;
        }
        .body-section{
            padding: 16px;
            border: 1px solid black;
        }
        .heading{
            font-size: 20px;
            margin-bottom: 05px;
        }
        .sub-heading{
            color: #262626;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: palevioletred;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px black;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-right{
            text-align: end;
        }
        .w-20{
            width: 20%;
        }
        @media screen and (max-width:900px){
            .container{
            width: 95%;
            margin-right: auto;
            margin-left: auto;
            }
            .brand-section{
            background-color:white;
            padding: 10px 40px;
            }
            .logo{
                width: 50%;
            }
            .row{
                display: flex;
                flex-wrap: wrap;
            }
            .col-6{
                width: 50%;
                flex: 0 0 auto;
            }
            .text-white{
                color: #fff;
            }
            .company-details{
                float: right;
                text-align: right;
            }
            .body-section{
                padding: 16px;
                border: 1px solid black;
            }
            .heading{
                font-size: 20px;
                margin-bottom: 05px;
            }
            .sub-heading{
                color: #262626;
            }
            table{
                background-color: #fff;
                width: 100%;
                border-collapse: collapse;
            }
            table thead tr{
                border: 1px solid #111;
                background-color: palevioletred;
            }
            table td {
                vertical-align: middle !important;
                text-align: center;
            }
            table th, table td {
                padding-top: 08px;
                padding-bottom: 08px;
            }
            .table-bordered{
                box-shadow: 0px 0px 5px 0.5px rgb(10, 22, 24);
            }
            .table-bordered td, .table-bordered th {
                border: 1px solid #dee2e6;
            }
            .text-right{
                text-align:end;
            }
            .w-20{
                width: 20%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="brand-section">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="text-black">AF Computer</h1>
                </div>
                {{-- <div class="col-6">
                    <div class="company-details">
                        <p class="text-white">assdad asd  asda asdad a sd</p>
                        <p class="text-white">assdad asd asd</p>
                        <p class="text-white">+91 888555XXXX</p>
                    </div>
                </div> --}}
            </div>
        </div>
        @php
            
        @endphp
        @foreach($pembelian as $table)
        <div class="body-section">
            <div class="row">
                <div class="col-6">
                    <h2 class="heading">No: {{$table->id_pembelian}}</h2>
                    <p class="sub-heading">Tanggal: {{substr($table->updated_at,0,10)}} </p>
                </div>
                <div class="col-6" style="text-align: right">
                    <p class="sub-heading">Rekanan: {{$table->nama}}</p>
                    <p class="sub-heading">Telp: {{$table->telp}}</p>
                    <p class="sub-heading">Alamat: {{$table->alamat}}</p>
                </div>
            </div>
        </div>
        @endforeach

        <div class="body-section">
            <h3 class="heading">Order Barang</h3>
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th class="w-20">Qty</th>
                        <th class="w-20">Harga</th>
                        <th class="w-20">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $grand = 0;
                    @endphp
                    @foreach($detail as $table)
                    <tr>
                        <td>{{$table->id}}</td>
                        <td>{{$table->nama}}</td>
                        <td>{{$table->qty}}</td>
                        <td>{{number_format($table->harga,"0",",",".")}}</td>
                        <td>{{number_format($table->total,"0",",",".")}}</td>
                    </tr>
                    @php
                        $grand += $table->total
                    @endphp
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-right">Grand Total</td>
                        <td>{{number_format($grand,"0",",",".")}}</td>
                    </tr>
                </tbody>
            </table>
           
            <br>
            {{-- <h3 class="heading">Terima Kasih Udah Membeli.</h3> --}}
        </div>     
    </div>      
    <script>
        window.print();
    </script>
</body>
</html>