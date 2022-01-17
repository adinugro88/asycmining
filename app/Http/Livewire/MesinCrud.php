<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Mesin;
use App\Models\User;
class MesinCrud extends Component
{
    public $namamesin;
    public $watt;
    public $qty;
  
    public $investor;
    public $mesin_id;
    public $datamesin;
    public $invid;
    public $select;
    public $pengkali;
    public $inv_id;


    public function mount($id)
    {
        
        $this->investor = User::where('id',$id)->first();
        // dd($this->investor);
        $this->inv_id = $id;
    }
    public function render()
    {
        $this->datamesin = Mesin::where('users_id', $this->inv_id )->get();
        return view('livewire.mesin-crud');
    }

    

    public function cancel()
    {
        $this->resetdata();
    }
    public function resetdata()
    {
        $this->namamesin="";
        $this->watt="";
        $this->qty="";
        $this->pengkali="";
    }

    public function selectedItem($itemId,$action)
    {
        $this->select = $itemId;
        if($action == 'update')
        {
            $this->dispatchBrowserEvent('openModal');
            $this->edit();
        }
        else {
            $this->dispatchBrowserEvent('openHapus');
            
        }
    }

    public function edit()
    {
        $post = Mesin::findOrFail($this->select);
        $this->mesin_id     = $this->select;
        $this->namamesin    = $post->namamesin;
        $this->watt         = $post->watt;
        $this->qty          = $post->Qty;
        $this->pengkali     = $post->pengkali;
    }

   



    public function delete()

    {

        Mesin::find($this->select)->delete();
        session()->flash('message', 'Data Berhasil DIhapus.');
        $this->dispatchBrowserEvent('closeHapus');

    }

    public function store()
    {
        Mesin::updateOrCreate(['id' => $this->mesin_id], [
            'namamesin'     => $this->namamesin,
            'Qty'           => $this->qty,
            'watt'          => $this->watt,
            'pengkali'      => $this->pengkali,
            'users_id'      => $this->inv_id,
        ]);

        session()->flash('message', $this->mesin_id ? 'Data Berhasil Diupdate.' : 'Data Berhasil Ditambahkan.');
        $this->dispatchBrowserEvent('closeModal');
        $this->resetdata();
        return redirect()->to('/admin/mesin/'.$this->inv_id);
    }
}
