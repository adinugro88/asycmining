@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h5><b>Daftar Mesin</b></h5></div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">QTY</th>
                                <th scope="col">nama Mesin</th>
                                <th scope="col">Watt</th>
                                <th scope="col">Coin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no =0; ?>
                            @foreach ($post as $post)
                            <?php $no ++ ?>
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $post -> Qty }}</td>
                                <td>{{ $post -> namamesin }}</td>
                                <td>{{ $post -> watt }}</td>
                                <td>{{ $post -> coin }}</td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>

            <h4 class="mt-4"><b>Pilih Coin</b></h4>
            @foreach ($url as $db)
            <a type="button" class="btn btn-info {{ request()->is('$db->coin*')  ? 'active' : '' }}" href="/coin/{{ $db->coin }}">{{ $db->coin }}</a>
            @endforeach
           
            <div class="card mt-5" id="laporanperday">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12  mb-5">
                        <select name="filter" id="" class="form-select"  onchange="location =this.value;">
                            @foreach ($jmltgl as $db )
                            <option value="/coindate/{{ $datacoin }}/{{ $db->tgl }}" {{ $db->tgl == $tgl ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::parse($db->tgl)->format('d M Y') }}
                            </option>
                            @endforeach
                        </select>
                        </div>
                        <div class="col-md-4 col-12">
                            <h5><b>
                                Tanggal :
                                {{ \Carbon\Carbon::parse($tgl)->format('d M Y') }}
                            </b></h5>
                        </div>
                        <div class="col-md-4 col-12">
                           
                            <h5><b>
                                Total Coin  {{ $datacoin }}/Day :
                                {{number_format( $totalcoin,8)  }}
                            </b></h5>
                            
                        </div>
                        <div class="col-md-4 col-12 text-right">
                 
                            <h5><b>
                                {{ $datacoin }} TOTAL :
                                {{"Rp " . number_format( $total, 0, ",", ".")  }}
                            </b></h5>
                            
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <table class="table table table-responsive w-100 d-block d-md-table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Mesin</th>
                                <th scope="col">Active Mesin</th>
                                <th scope="col">Jam Aktif</th>
                                <th scope="col">Watt</th>
                                <th scope="col">income</th>
                                <th scope="col">Listrik</th>
                                <th scope="col">Income - Listrik </th>
                                <th scope="col">Investor</th>
                                <th scope="col">Rate</th>
                                <th scope="col">Convert in IDR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0 ?>
                            @foreach($miner as $db)
                            <?php $no++  ?>
                            {{-- <p> {{ number_format($db->sum, 9) }}</p>
                            <p>{{ $db->tanggal }}</p> --}}
                            <tr>
                                <th scope="row">{{ $no }}</th>
                                <td>{{ $db->mesin }}</td>
                                <td>{{ $db->active_mesin }}</td>
                                <td>{{ $db->active_mesin }} Jam</td>
                                <td>{{ $db->watt }}</td>
                                <td>{{ number_format($db->nilaisbr,9) }}</td>
                                <td>{{ number_format($db->listrik,9) }}</td>
                                <td>{{ number_format($db->hasillistrikkurang,9) }}</td>
                                <td>{{ number_format($db->investor,9) }}</td>
                                <td>{{"Rp " . number_format( $db->rate, 0, ",", ".")  }}</td>
                                <td>{{"Rp " . number_format( $db->INVERT_IDR, 0, ",", ".")  }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{ $miner->links('pagination::bootstrap-4')}}
                        </div>
                    </div>
                </div>

                

            </div>

            <div class="row">

                <div class="col-md-12 mt-5">
                    <h4> 
                    <b>
                    data akumulasi mulai : 
                    @if ($tglgl == "awal")
                    {{ $tglgl }}

                @else
                {{  \Carbon\Carbon::parse($tglgl)->format('d M Y') }}
                @endif
                    </b>
                </h4>
                </div>

                <div class="col-md-6">
                    <div class="card mt-5">
                        <div class="card-header"><h5><b> Total Wallet</b></h5></div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Coin</th>
                                        <th scope="col">Total Coin </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no =0; ?>
                                    @foreach ($totalweek as $db)
                                    <?php $no ++ ?>
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $db -> coin }}</td>
                                        <td>{{ number_format($db -> totalwallet,9) }}</td>
                                    </tr>
                                    @endforeach
                               
        
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card mt-5">
                        <div class="card-header"><h5><b> Total Listrik</b></h5></div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Coin</th>
                                        <th scope="col">Listrik</th>
                                        <th scope="col">Listrik In IDR </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no =0; ?>
                                    @foreach ($totalweek as $db)
                                    <?php $no ++ ?>
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $db -> coin }}</td>
                                        <td>{{ $db -> totallistrik }}</td>
                                       
                                        <td>{{ "Rp " . number_format($db -> ratelistrik, 0, ",", ".") }}</td>
                                    </tr>
                                    @endforeach
                               
        
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="card mt-5">
                        <div class="card-header"><h5><b> Total Pendapatan</b></h5></div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" rowspan="1">No</th>
                                        <th scope="col" rowspan="1">Coin</th>
                                        <th scope="col" rowspan="1">wallet</th>
                                        <th scope="col" rowspan="1">Listrik</th>
                                        <th scope="col" rowspan="1">Wallet - Listrik</th>
                                        <th scope="col" colspan="2" style="text-align: center">Bagi Hasil</th>
                                    </tr>
                                    <tr style="border: 0">
                                        <th ></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th colspan="">Investor</th>
                                        <th colspan="">Manajemen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no =0; ?>
                                    @foreach ($totalweek as $db)
                                    <?php $no ++ ?>
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $db -> coin }}</td>
                                        <td>{{ number_format($db -> totalwallet,8) }}</td>
                                        <td>{{ $db -> totallistrik }}</td>
                                        <td>{{ number_format($db -> hslkrglistrik,8) }}</td>
                                        <td>{{ number_format($db -> total,9) }}</td>
                                        <td>{{ number_format($db -> totalmanage,9) }}</td>
        
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" class="text-right"><b>Estimasi Pendapatan</b></td>
        
                                        <td><b> {{"Rp " . number_format($totalIncome, 0, ",", ".")}}
                                        </b></td>
                                        <td><b> {{"Rp " . number_format($totalIncomeMNJ, 0, ",", ".")}}
                                        </b></td>
                                    </tr>
        
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-5">
                    <div class="card">            
                        <div class="card-header mt-0">
                            <h5>List Payment</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-fit">
                                    <thead class="">
                                        <tr style=" white-space: nowrap;">
                                            <th scope="col" style="width: auto">No</th>
                                            <th scope="col" style="width: auto">Tanggal Transaksi </th>
                                            <th scope="col">Coin</th>
                                            <th scope="col">Wallet</th>
                                            <th scope="col">Network Fee</th>
                                            <th scope="col">Network Fee To Idr</th>
                                            <th scope="col">Total Fee To Idr</th>
                                            <th scope="col">listrik</th>
                                            <th scope="col">investor</th>
                                            <th scope="col">Management</th>
                                            <th scope="col">Wallet Company</th>
                                            <th scope="col">Rate Lite To BTC</th>
                                            <th scope="col">Investor * Rate Lite To BTC</th>
                                            <th scope="col">Fee Lite To BTC</th>
                                            <th scope="col">Total Btc</th>
                                            <th scope="col">Rate Coin To USDT</th>
                                            <th scope="col">Fee Coin To USDT</th>
                                            <th scope="col">Total USDT</th>
                                            <th scope="col">Rate USDT to Bidr</th>
                                            <th scope="col">Fee Bidr</th>
                                            <th scope="col">Total Bidr</th>
                                            <th scope="col">Fee Coin To Idr</th>
                                            <th scope="col">fee Coin To BTC</th>
                                            <th scope="col">Total Coin To BTC</th>
                                            <th scope="col">Total In IDR</th>
                                            <th scope="col">Lebih / Kurang Transfer </th>
                                            <th scope="col">Tanggal Transaksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no =0; ?>
                                        @foreach ($payment as $key=> $post)
                                        <?php $no ++ ?>
                                        <tr style=" white-space: nowrap;">
                                            <td>{{ $no }}</td>
                                            <td>{{ $post ->catatan	}}</td>
                                            <td>{{ $post ->coin }}</td>
                                            <td>{{ number_format($post ->wallet,8) }}</td>
                                            <td>{{ number_format($post ->networkfee,6) }}</td>
                                            <td>{{ number_format($post ->networkfeetoidr,6) }}</td>
                                            <td>{{ number_format($post ->totalfeeidr,6) }}</td>
                                            <td>{{ number_format($post ->listrik ,6) }} </td>
                                            <td>{{ number_format($post ->investor ,6) }}</td>
                                            <td>{{ number_format($post ->management ,6) }}</td>
                                            <td>{{ number_format( $post ->walletcompany ,6) }} </td>
                                            <td>{{ number_format($post ->ratelitetobtc ,6) }} </td>
                                            <td>{{ number_format($post ->investorlitetobtc ,6) }} </td>
                                            <td>{{ number_format($post ->feelitetobtc ,6) }} </td>
                                            <td>{{ number_format($post ->totalbtc ,6) }} </td>
                                            <td>{{ $post ->ratecointousd}}</td>
                                            @if ($post ->feecoin != 0)
                                            <td>{{ number_format($post ->feecointousd ,6) }}</td>
                                            @else
                                            <td>{{ $post ->feecointousd }}</td>
                                            @endif
                                            <td>{{ $post ->totalusd	}}</td>
                                            <td>{{ $post ->rateusdtobidr}}</td>
                                            <td>{{ $post ->feebidr  }}</td>
                                            <td>{{ $post ->totalbidr	}}</td>
                                            
                                            <td>{{$post ->feecointoidr  }}</td>
                                            @if ($post ->feecoin != 0)
                                            <td>{{ number_format($post ->feecoin ,6) }}</td>
                                            @else
                                            <td>{{$post ->feecoin }}</td>
                                            @endif
                                            
                
                                            <td>{{ $post ->totalcoin}} </td>
                                            <td> {{"Rp " . number_format($post ->total, 0, ",", ".")}}</td>

                                            <td> {{"Rp " . number_format($post ->lebihkurangbayar, 0, ",", ".")  }} </td>
                                            <td> {{ \Carbon\Carbon::parse( $post ->tanggal )->format('d M Y') }}</td>
                                            
                                    
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- {{ $payment->links('pagination::bootstrap-4') }} --}}
                        </div>
                    </div>
                </div>

              
                
            </div>

           
        </div>


    </div>
</div>
@endsection
