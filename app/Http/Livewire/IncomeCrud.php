<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Mesin;
use App\Models\User;
use App\Models\Datahasil;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;


class IncomeCrud extends Component
{
    use WithPagination;
    public $investor;
    public $inv_id;
    public $tgl;
    public $coin;
    public $incometotalbyday;
    public $mesin;
    public $nilai;
    public $qty;
    public $nilaisbr;
    public $watt;
    public $rate;
    public $ratelistrik;
    public $active_mesin;
    public $listrik;
    public $hasillistrikkurang;
    public $investorcoin;
    public $invert_idr;
    public $manage;
    public $manage_IDR;
    public $week;
    public $users_id;
    public $mesin_id;
    public $bycoin;
    public $listcoin;
    public $pilihancoin;
    public $ubah;
    public $show = false;
    public $pembagi;
    public $sement;
    public $qtycek;
    public $investorpersen;
    public $manajemenpersen;
    public $mesinfirst;
    public $datahasil_id;
    public $validatehitung = false;
    public $nilaiseber;
    public $select;



    public function mount($id)
    {
      
        $this->inv_id = $id;
        $this->investor = User::where('id',$this->inv_id)->first();
        // dd($this->investor);
        $this->coin = "BTC";
        $this->mesin = "L3+";

        $this->pilihancoin = Datahasil::selectRaw("coin as coin")
        ->groupBy("coin")
        ->where('users_id',$this->inv_id)
        ->first();
        $this->ubah = $this->pilihancoin->coin;
       
        $this->mesinfirst = Mesin::selectRaw("namamesin as namamesin")
        ->first();
    }
    public function render()
    {
      

     
     
        $this->listcoin= Datahasil::selectRaw("coin as coin")
        ->groupBy("coin")
        ->where('users_id',$this->inv_id)
        ->get();
        

        $data = Mesin::selectRaw("pengkali as persentase")
        ->groupBy("pengkali")
        ->where('users_id',$this->inv_id)
        ->where('namamesin',$this->mesin)
        ->first();
        $this->pembagi = $data->persentase;
        
        $data2 = Mesin::selectRaw("qty as qty")
        ->groupBy("qty")
        ->where('users_id',$this->inv_id)
        ->where('namamesin',$this->mesin)
        ->first();
        $this->qty = $data2->qty;

        $data3 = Mesin::selectRaw("watt as watt")
        ->groupBy("watt")
        ->where('users_id',$this->inv_id)
        ->where('namamesin',$this->mesin)
        ->first();
        $this->watt = $data3->watt;

        return view('livewire.income-crud', [
            'datahasil' => Datahasil::where('users_id', '=', $this->inv_id )
            ->where('coin',$this->ubah)
            ->orderBy('tgl','desc')
            ->paginate(10),
            'listmesin'=>Mesin::where('users_id', '=', $this->inv_id )
            ->get()
        ]);
    }

    public function hitung()
    {
        if($this->rate==0||$this->active_mesin==0||$this->investorpersen==0||$this->manajemenpersen==0)
        {
            $this->validatehitung = true;
        }
        else
        {
                $this->validatehitung = false;
                if($this->pembagi == 1)
                {
                    $this->nilai = $this->incometotalbyday;
                }
                if($this->pembagi !== 1)
                {
                    $this->nilai = $this->incometotalbyday * ($this->pembagi/100);
                }

                $this->nilaisbr = $this->nilai / $this->qty; 
                
                if(isset($this->watt)&&isset($this->active_mesin))
                {
                    $this->ratelistrik = $this->watt/1000*1440*$this->active_mesin ;
                }
        
                if(isset($this->rate)&&isset( $this->ratelistrik))
                {
                    $this->listrik  = $this->ratelistrik/ $this->rate;
                }
                if(isset($this->nilaisbr)&&isset( $this->ratelistrik))
                {
                    $this->hasillistrikkurang = $this->nilaisbr - $this->listrik;   
                }
                if(isset($this->hasillistrikkurang)&&isset( $this->investorpersen))
                {
                    $this->investorcoin    = $this->hasillistrikkurang * $this->investorpersen/100;
                }
                if(isset($this->investorcoin)&&isset( $this->rate))
                {
                    $this->invert_idr  = $this->investorcoin * $this->rate;
                }
                if(isset($this->hasillistrikkurang)&&isset( $this->manajemenpersen))
                {
                    $this->manage = $this->hasillistrikkurang * $this->manajemenpersen/100;
                }      
                if(isset($this->manage)&&isset( $this->rate))
                {
                    $this->manage_IDR = $this->manage * $this->rate;
                }
        }

       
    }

    public function showtambah()
    {
        $this->show = true;
        $this->resetCreateForm();
    }

    public function cancel()
    {
        $this->resetCreateForm();
        $this->show           = false;
        $this->validatehitung = false;
        return redirect()->to('/admin/income/'.$this->inv_id);
    }

    public function selectedItem($itemId,$action)
    {
        $this->select = $itemId;
        if($action == 'update')
        {
            $this->show = true;
            $this->edit();
        }
        else {
            $this->dispatchBrowserEvent('openHapus');
            
        }
    }

 

    private function resetCreateForm()
    {
        $this->tgl                     = "";
        $this->coin                    = 0;
        $this->incometotalbyday        = 0;
        $this->nilai                   = 0;
        $this->nilaisbr                = 0;
        $this->watt                    = 0;
        $this->rate                    = 0;
        $this->ratelistrik             = 0;
        $this->active_mesin            = 0;
        $this->listrik                 = 0;
        $this->hasillistrikkurang      = 0;
        $this->investorcoin            = 0;
        $this->invert_idr              = 0;
        $this->manage                  = 0;
        $this->manage_IDR              = 0;
        $this->investorpersen          = 0;
        $this->manajemenpersen         = 0;
      }

      public function store()
      {

        $this->validate([
            'tgl'                 => 'required',
            'coin'                => 'required',
            'incometotalbyday'    => 'required',
            'mesin'               => 'required',
            'nilai'               => 'required',
            'qty'                 => 'required',
            'watt'                => 'required',
            'nilaisbr'            => 'required',
            'rate'                => 'required',
            'ratelistrik'         => 'required',
            'active_mesin'        => 'required',
            'listrik'             => 'required',
            'hasillistrikkurang'  => 'required',
            'investorcoin'        => 'required',
            'invert_idr'          => 'required',
            'manage_IDR'          => 'required',
           
        ]); 

       
        for($i=1;$i<=$this->qty;$i++)
        {
            Datahasil::updateOrCreate(['id' => $this->datahasil_id], [
                'tgl' => $this->tgl,
                'coin' => $this->coin,
                'incometotalbyday' => $this->incometotalbyday,
                'mesin' => $this->mesin,
                'nilai' => $this->nilai,
                'qty' => $this->qty,
                'nilaisbr' => $this->nilaisbr,
                'watt' => $this->watt,
                'rate' => $this->rate,
                'ratelistrik' => $this->ratelistrik,
                'active_mesin' => $this->active_mesin,
                'listrik' => $this->listrik,
                'hasillistrikkurang' => $this->hasillistrikkurang,
                'investor' => $this->investorcoin,
                'INVERT_IDR' => $this->invert_idr,
                'manage' => $this->manage,
                'manage_IDR' => $this->manage_IDR,
                'users_id' => $this->inv_id,
                 'created_at' => \Carbon\carbon::now(),
                 'updated_at' => \Carbon\carbon::now()
            ]);
        }
       

        session()->flash('message', $this->datahasil_id ? 'Data Berhasil Diupdate.' : 'Data Berhasil Ditambahkan.');
        $this->dispatchBrowserEvent('closeModal');
        $this->show = false;
        $this->resetCreateForm();
        return redirect()->to('/admin/income/'.$this->inv_id);
      }

      public function delete()

    {

        Datahasil::find($this->select)->delete();
        session()->flash('message', 'Data Berhasil DIhapus.');
        $this->dispatchBrowserEvent('closeHapus');
       

    }

}
