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
   
    public function mount()
    {
        $this->coin = "BTC";
         $pilih = User::where('is_admin', 0)->first();
         $this->user = $pilih->id;
     
    }
    
    public function render()
    {   
        return view('livewire.payment-crud',[
            'payment'       => Payment::paginate(5),
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
            'walletcompany' => 'required',
            'listrik' => 'required',
            'investor' => 'required',
            'management' => 'required',
            'ratecointousd' => 'required',
            'feecointousd' => 'required',
            'totalusd' => 'required',
            'rateusdtobidr' => 'required',
            'feebidr' => 'required',
            'totalbidr' => 'required',
            'feecointoidr' => 'required',
            'feecoin' => 'required',
            'totalcoin' => 'required',
            'total' => 'required',
            'catatan' => 'required',
        ]); 

        Payment::updateOrCreate(['id' => $this->payment_id], [
        'tanggal'               => $this->tgl,
        'tglakhir'              => $this->tglakhir,
        'coin'                  => $this->coin,
        'users_id'              => $this->user,
        'wallet'                => $this->Wallet,
        'networkfee'            => $this->networkfee,
        'walletcompany'         => $this->walletcompany,
        'listrik'               => $this->listrik,
        'investor'              => $this->investor,
        'management'            => $this->management,
        'ratecointousd'         => $this->ratecointousd,
        'feecointousd'          => $this->feecointousd,
        'totalusd'              => $this->totalusd,
        'feebidr'               => $this->feebidr,
        'feecointoidr'          => $this->feecointoidr,
        'total'                 => $this->total,
        'catatan'               => $this->catatan,
        'feecoin'               => $this->feecoin,
        'totalcoin'             => $this->totalcoin,
        'totalbidr'             => $this->totalbidr,
        'rateusdtobidr'         => $this->rateusdtobidr,
        ]);

        session()->flash('message', $this->payment_id ? 'Data Berhasil Diupdate.' : 'Data Berhasil Ditambahkan.');
        $this->dispatchBrowserEvent('closeModal');
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
    }

    public function delete()

    {

        Payment::find($this->select)->delete();
        session()->flash('message', 'Data Berhasil DIhapus.');
        $this->dispatchBrowserEvent('closeHapus');

    }

}
