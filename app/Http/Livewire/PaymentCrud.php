<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Payment;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class PaymentCrud extends Component
{
    use WithPagination;
    public $tgl;
    public $tglakhir;
    public $coin;
    public $tgltransfer;
    public $user;
    public $Wallet;
    public $networkfee;
    public $walletcompany;
    public $listrik;
    public $investor;
    public $management;
    public $ratecointousd;
    public $feecointousd;
    public $totalusd;
    public $rateusdtobidr;
    public $feebidr;
    public $feecointoidr;
    public $total;
    public $feecoin;
    public $totalcoin;
    public $catatan;
    public $payment_id;
    public $totalbidr;
    public $show = false;
    public $saldoawal;
    public $saldoakhir;
    public $networkfeetoidr;
    public $totalfeetoidr;
    public $ratelitetobtc;
    public $investorratelitetobtc;
    public $feelitetobtc;
    public $totalbtc;
    public $lebihkurangbayar;
    public $coinxbidrrate;
    public $invminnetworkfee;



   
    public function mount()
    {
        $this->coin = "BTC";
         $pilih = User::where('is_admin', 0)->first();
         $this->user = $pilih->id;
     
    }
    
    public function render()
    {   
        return view('livewire.payment-crud',[
            'payment'       => Payment::orderBy('created_at','desc')
            ->paginate(5),
            'investorpilih' => User::where('is_admin', 0)->get()
        ]);
    }

    public function showtambah()
    {
        $this->show = true;
        $this->resetCreateForm();
    }

   

    private function resetCreateForm(){
      $this->Wallet         = "";
      $this->networkfee     = "";
      $this->walletcompany  = "";
      $this->listrik        = "";
      $this->investor       = "";
      $this->management     = "";
      $this->ratecointousd  = "";
      $this->feecointousd   = "";
      $this->totalusd       = "";
      $this->rateusdtobidr  = "";
      $this->feebidr        = "";
      $this->feecointoidr   = "";
      $this->total          = "";
      $this->catatan        = "";
      $this->feecoin        = "";
      $this->totalcoin      = "";
      $this->saldoawal      = "";
      $this->saldoakhir     = "";

      $this->networkfeetoidr                = "";
      $this->totalfeetoidr                  = "";
      $this->ratelitetobtc                  = "";
      $this->investorratelitetobtc          = "";
      $this->feelitetobtc                   = "";
      $this->totalbtc                       = "";
      $this->lebihkurangbayar               = "";
      $this->coinxbidrrate                  = "";
      $this->invminnetworkfee               = "";   
     }

    public function cancel()
    {
        $this->resetCreateForm();
        $this->show = false;
        return redirect()->route('payment');
    }

    public function selectedItem($itemId,$action)
    {
        $this->select = $itemId;
        // $this->dispatchBrowserEvent('openHapus');

        $this->select = $itemId;
        if($action == 'update')
        {
            // $this->dispatchBrowserEvent('openModal');
            $this->edit();
            $this->show = true;
        }
        else {
            $this->dispatchBrowserEvent('openHapus');
            
        }
    
    }

    public function store()
    {

        $this->validate([
            'tgl' => 'required',
            'tglakhir' => 'required',
            'coin' => 'required',
            'user' => 'required',
            'Wallet' => 'required',
            'networkfee' => 'required',
            'listrik' => 'required',
            'investor' => 'required',
            'management' => 'required',
            'rateusdtobidr' => 'required',
            'feebidr' => 'required',
            'totalbidr' => 'required',
            'feecointoidr' => 'required',
            'feecoin' => 'required',
            'totalcoin' => 'required',
            'total' => 'required',
            'catatan' => 'required',
            'saldoawal' => 'required',
            'saldoakhir' => 'required',
        ]); 

        Payment::updateOrCreate(['id' => $this->payment_id], [
        'tanggal'               => $this->tgl,
        'tglakhir'              => $this->tglakhir,
        'coin'                  => $this->coin,
        'users_id'              => $this->user,
        'wallet'                => $this->Wallet,
        'networkfee'            => $this->networkfee,
        'walletcompany'         => 0,
        'listrik'               => $this->listrik,
        'investor'              => $this->investor,
        'management'            => $this->management,
        'ratecointousd'         => 0,
        'feecointousd'          => 0,
        'totalusd'              => 0,
        'feebidr'               => $this->feebidr,
        'feecointoidr'          => $this->feecointoidr,
        'total'                 => $this->total,
        'catatan'               => $this->catatan,
        'feecoin'               => $this->feecoin,
        'totalcoin'             => $this->totalcoin,
        'totalbidr'             => $this->totalbidr,
        'rateusdtobidr'         => $this->rateusdtobidr,
        'saldoawal'             => $this->saldoawal,
        'saldoakhir'            => $this->saldoakhir,

        'networkfeetoidr'       => 0,
        'totalfeeidr'           => 0,
        'ratelitetobtc'         => $this->ratelitetobtc,
        'feelitetobtc'          => $this->feelitetobtc,
        'totalbtc'              => $this->totalbtc,
        'investorlitetobtc'     => $this->investorratelitetobtc,
        'coinxbidrrate'         => $this->coinxbidrrate,
        'lebihkurangbayar'      => $this->lebihkurangbayar,
        'invminnetwrokfee'      => $this->invminnetworkfee,
        ]);

        session()->flash('message', $this->payment_id ? 'Data Berhasil Diupdate.' : 'Data Berhasil Ditambahkan.');
        $this->dispatchBrowserEvent('closeModal');
        return redirect()->to('/admin/payment');
        $this->show = false;
        $this->resetCreateForm();
    }

   

    public function edit()
    {
        $post = Payment::findOrFail($this->select);
        $this->payment_id           = $this->select;
        $this->tgl                  = $post->tanggal;
        $this->tglakhir             = $post->tglakhir;
        $this->coin                 = $post->coin;
        $this->Wallet               = $post->wallet;
        $this->networkfee           = $post->networkfee;
        $this->walletcompany        = $post->walletcompany;
        $this->listrik              = $post->listrik;
        $this->investor             = $post->investor;
        $this->management           = $post->management;
        $this->ratecointousd        = $post->ratecointousd;
        $this->feecointousd         = $post->feecointousd;
        $this->totalusd             = $post->totalusd;
        $this->feebidr              = $post->feebidr;
        $this->feecointoidr        = $post->feecointoidr;
        $this->total                = $post->total;
        $this->catatan              = $post->catatan;
        $this->user                 = $post->users_id;
        $this->totalbidr            = $post->totalbidr;
        $this->rateusdtobidr        = $post->rateusdtobidr;
        $this->totalcoin            = $post->totalcoin;
        $this->feecoin              = $post->feecoin;
        $this->saldoawal            = $post->saldoawal;
        $this->saldoakhir           = $post->saldoakhir;

        $this->networkfeetoidr                 = $post->networkfeetoidr;
        $this->totalfeetoidr                   = $post->totalfeeidr;
        $this->ratelitetobtc                   = $post->ratelitetobtc;
        $this->feelitetobtc                    = $post->feelitetobtc;
        $this->totalbtc                        = $post->totalbtc;
        $this->investorratelitetobtc           = $post->investorlitetobtc;
        $this->coinxbidrrate                   = $post->coinxbidrrate;
        $this->lebihkurangbayar                = $post->lebihkurangbayar;
        $this->invminnetworkfee                = $post->invminnetwrokfee;

    }

    public function delete()

    {

        Payment::find($this->select)->delete();
        session()->flash('message', 'Data Berhasil DIhapus.');
        $this->dispatchBrowserEvent('closeHapus');

    }

}
