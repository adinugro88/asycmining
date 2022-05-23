<?php

namespace App\Exports;
use DB;
use App\Models\Datahasil;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DatahasilExport implements FromQuery, WithHeadings, ShouldAutoSize

{
    use Exportable;
    protected $user_id,$tglawal,$tglakhir,$coin;

    public function headings() :array
    {
        return [
            "No Invoice",
            "Nama ", 
            "Tanggal Coating",
            "Tanggal Coating Selanjutnya", 
            "Car Mat",
            "Trunk Mat",
            "No Telpon",
        ];
    }

    function __construct($user_id,$tglawal,$tglakhir,$coin) {
        $this->user_id = $user_id;
        $this->tglawal = $tglawal;
        $this->tglakhir = $tglakhir;
        $this->coin = $coin;
    }


 public function query()
 {
     return Datahasil::query()->where('users_id', "=", $this->user_id)
     ->where('coin', '=', $this->coin)
     ->whereBetween('tgl', [$this->tglawal, $this->tglakhir])
     ->groupBy(DB::raw("DATE_FORMAT(tgl, '%d-%m-%Y')"))
     ->select('tgl','coin')
     ->get();
 }

 //DB::raw('sum(INVERT_IDR) as akumulasi,sum(active_mesin) as mesinaktif ,sum(ratelistrik) as totallistrik,count(mesin) as mesincount'

//  public function collection()
//  {
//      return Datahasil::where('users_id', "=", $this->user_id)
//      ->where('coin', '=', $this->coin)
//      ->whereBetween('tgl', [$this->tglawal, $this->tglakhir])
//      ->groupBy(DB::raw("DATE_FORMAT(tgl, '%d-%m-%Y')"))
//      ->select("*",DB::raw('sum(INVERT_IDR) as akumulasi,sum(active_mesin) as mesinaktif ,sum(ratelistrik) as totallistrik,count(mesin) as mesincount'))
//      ->get();
//  }
  
}
