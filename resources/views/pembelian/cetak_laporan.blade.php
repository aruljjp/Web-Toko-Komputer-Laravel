<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
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
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }
        .brand-section{
           background-color:white;
           text-align: center;
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
        .text-black{
            color: black;
        }
        .company-details{
            float: right;
            text-align: right;
        }
        .body-section{
            padding: 16px;
            border: 1px solid gray;
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
            background-color: rgb(103, 208, 235);
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
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        @media screen and (max-width:900px){
            .container{
            width: 100%;
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
                border: 1px solid gray;
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
                background-color: #4ec6db;
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
                box-shadow: 0px 0px 5px 0.5px gray;
            }
            .table-bordered td, .table-bordered th {
                border: 1px solid #dee2e6;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="brand-section">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="text-black">Laporan Pembelian</h1>
                </div>
            </div>
        </div>
        <div class="body-section">
            <h3 class="heading">List Rekanan & Barang</h3>
            <br>
            <table class="table table-bordered" style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th>Tanggal Pembelian</th>
                        <th>Nama Rekanan</th>
                        <th>Alamat</th>
                        <th>Telp</th>
                    </tr>
                </thead>
                @foreach($pembelian as $table)
                <tbody>
                    <tr>
                        <td>{{$loop -> iteration}}</td>
                        <td>{{date("l,d F Y",strtotime($table->updated_at))}}</td>
                        <td>{{$table->nama}}</td>
                        <td>{{$table->alamat}}</td>
                        <td>{{$table->telp}}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
            <table class="table table-bordered" style="width: 100%;margin-top: 50px">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th width="10%">Nama Barang</th>
                        <th width="20%">Harga</th>
                        <th width="1%">Qty</th>
                        <th width="20%">Total</th>
                    </tr>
                </thead>
                @foreach($detail as $table)
                <tbody>
                    <tr>
                        <td>{{$loop -> iteration}}</td>
                        <td>{{$table->nama}}</td>
                        <td>{{$table->harga}}</td>
                        <td>{{$table->qty}}</td>
                        <td>{{number_format($table->total,0,',','.')}}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>