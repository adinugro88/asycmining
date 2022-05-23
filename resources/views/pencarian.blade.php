@extends('layouts.app')

<style>
    .table-responsive-fix {
        display: table !important;
    }

</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5><b> Daftar Mesin</b></h5>
                </div>
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

            <div class="row">
                <div class="col-md-12 col-12">
                    <h4 class="mt-4"><b>Filter Data</b></h4>
                    <form action="/data/find" method="get">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="">pilihan Coin</label>
                                <select name="coin" class="form-control" name="coin" id="">
                                    @foreach ($url as $db)
                                    <option value="{{ $db->coin }}" @if( $db->coin ==$coin  ) selected @endif>{{ $db->coin }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Tanggal Awal dan akhir</label>
                                <div class="input-group input-daterange">
                                    <input name="tglawal" class="form-control" value="{{ old('tglawal') }}" type="date" id="birthday" name="tglawal">
                                    &nbsp;  &nbsp;
                                    <div>to</div>
                                    &nbsp;  &nbsp;
                                    <input name="tglakhir" class="form-control" value="{{ old('tglakhir') }}" type="date" id="birthday" name="tglakhir">
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">Cari Data</label>
                                <button type="submit" class="btn btn-info form-control">Cari Data</button>
                            </div>
                        </div>
                    </form>

                    {{-- <form action="/download/excel" method="Post">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <button type="submit" class="btn btn-success form-control">Download Excel</button>
                            </div>
                            <div class="form-group col-md-4">
                               <input type="hidden" name="coin" value="{{$coin}}" id="">
                               <input type="hidden" name="tglawal" value="{{$tglawal}}" id="">
                               <input type="hidden" name="tglakhir" value="{{$tglakhir}}" id="">
                            </div>
                            
                           
                        </div>
                    </form> --}}
                    <button id="sheetjsexport"><b>Export as XLSX</b></button>
                </div>
               

            </div>




            <div class="card mt-4">

                <div class="card-body">
                    <table id="TableToExport" class="table table table-responsive w-100 d-block d-md-table tabelbaru">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">jumlah Mesin</th>
                                <th scope="col">Jam Aktif/mesin</th>
                                <th scope="col">Watt</th>
                                <th scope="col">income</th>
                                <th scope="col">Listrik</th>
                                <th scope="col">Biaya Listrik IDR</th>
                                <th scope="col">Investor</th>
                                <th scope="col">Rate</th>
                                <th scope="col">Pendapatan Investor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0 ?>
                            @foreach($miner as $db)
                            <?php $no++  ?>
                            {{-- <p> {{ number_format($db->sum, 9) }}</p>
                            <p>{{ $db->tanggal }}</p> --}}
                            <tr>
                                <td>{{  \Carbon\Carbon::parse($db->tgl )->format('d M Y') }}</td>
                                <td>{{ $db->mesincount }}</td>
                                <td>{{ $db->active_mesin }}</td>
                                <td>{{ $db->watt }}</td>
                                <td>{{ number_format($db->nilaisbr,9) }}</td>
                                <td>{{ number_format($db->listrik,9) }}</td>
                                <td>{{ "Rp " . number_format($db -> ratelistrik, 0, ",", ".") }}</td>
                                <td>{{ number_format($db->investor,9) }}</td>
                                <td>{{"Rp " . number_format( $db->rate, 0, ",", ".")  }}</td>
                                <td>{{"Rp " . number_format( $db->akumulasi, 0, ",", ".")  }}</td>
                            </tr>
                            @endforeach
                           
                            <tr>
                                <td colspan="2">
                                   Total Jam 
                                </td>
                                <td colspan="2">
                                    @foreach($totaljam as $db)
                                   <b>{{ $db->totaljammesin}}</b> 
                                    @endforeach
                                </td>
                                <td >
                                    Total Wallet in {{$coin}}
                                </td>
                                <td colspan="2">
                                    @foreach($totalwallet as $db)
                                    <b> {{ number_format($db->walletttl,9) }} </b> 
                                    @endforeach
                                </td>
                                <td >
                                   Wallet - Listrik  {{$coin}} 
                                </td>
                                <td colspan="2">
                                    @foreach($walletkuranglistrik as $db)
                                  <b>{{ number_format($db->hasil,8) }}</b>
                                    @endforeach
                                </td>
                              
                            </tr>
                            <tr>
                                <td colspan="2">
                                    Total Listrik IDR
                                </td>
                                <td colspan="2">
                                    @foreach($totallistrik as $db)
                                     <b> {{"Rp " . number_format( $db->tllistrik, 0, ",", ".")  }} </b>
                                    @endforeach
                                </td>
                                <td>
                                    Total Investor 
                                </td>
                                <td colspan="2">
                                    @foreach($investor as $db)
                                    <b>{{"Rp " . number_format( $db->totalinv, 0, ",", ".")  }}</b> 
                                    @endforeach
                                </td>
                                <td>
                                    Total Management 
                                </td>
                                <td colspan="2">
                                    @foreach($Management as $db)
                                   <b>{{"Rp " . number_format( $db->totalmanage, 0, ",", ".")  }} </b> 
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    Pilihan Coin :
                                </td>
                                <td colspan="2">
                                   <b> {{ $coin }}</b>
                                </td>
                                <td >
                                    Tanggal Awal:
                                </td>
                                <td colspan="2">
                                    <b>{{ \Carbon\Carbon::parse($tglawal)->format('d M Y') }}</b>
                                </td>
                                <td >
                                    Tanggal Akhir:
                                </td>
                                <td colspan="2">
                                    <b> {{ \Carbon\Carbon::parse($tglakhir)->format('d M Y') }}</b>
                                </td>
                              
                            </tr>
                            <tr>
                                <td colspan="2">
                                  Miner :
                                </td>
                                <td colspan="2">
                                  <b> {{ Auth::user()->name }}</b> 
                                </td>
                         
                            </tr>
                            {{-- <div class="row">
                                <div class="col-md-4 ">
                                   
                                </div>
                                <div class="col-md-4 ">
                                    @foreach($totalwallet as $db)
                                   <h5>Total Wallet in {{$coin}} : <br> <b> {{ number_format($db->walletttl,9) }} </b> </h5>
                                   @endforeach
                                </div>
                                <div class="col-md-4 ">
                                    @foreach($walletkuranglistrik as $db)
                                   <h5>Total Wallet - Listrik in  {{$coin}}  : <br> <b>{{ number_format($db->hasil,8) }}</b> </h5>
                                   @endforeach
                                </div>
                                <div class="col-md-4 mt-3">
                                    @foreach($totallistrik as $db)
                                   <h5>Total Listrik in IDR  <br> <b> {{"Rp " . number_format( $db->tllistrik, 0, ",", ".")  }} </b> </h5>
                                   @endforeach
                                </div>
                               
                                <div class="col-md-4 mt-3">
                                    @foreach($investor as $db)
                                   <h5>Total Investor :  <br> <b>{{"Rp " . number_format( $db->totalinv, 0, ",", ".")  }}</b> </h5>
                                   @endforeach
                                </div>
                                <div class="col-md-4 mt-3">
                                    @foreach($Management as $db)
                                   <h5>Total Management:  <br> <b>{{"Rp " . number_format( $db->totalmanage, 0, ",", ".")  }} </b> </h5>
                                   @endforeach
                                </div>
                            </div> --}}
                        </tbody>
                    
                        
                    </table>
                    {{-- </div> --}}
                 
                </div>

            </div>
        </div>


    </div>
</div>
@endsection

@push('scripts')
<script>
   document.getElementById("sheetjsexport").addEventListener('click', function() {
  /* Create worksheet from HTML DOM TABLE */
  
  var wb = XLSX.utils.table_to_book(document.getElementById("TableToExport"));
  /* Export to file (start a download) */
  wb['!cols'] = [{ width: 20 }, { width: 20 }, { width: 150 } ];
  XLSX.writeFile(wb, "Filter.xlsx");
});

</script>

@endpush
