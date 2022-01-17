<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Investor extends Component
{
    public $listinvestor;
    public $nama;
    public $email;
    public $inves_id;
    public $deleteId;
    public $select;


    public function render()
    {
        $this->listinvestor = Auth::User()->orderBy('created_at','desc',)->where('is_admin',0)->get();
        return view('livewire.investor');
    }

    private function resetCreateForm(){
        $this->nama = '';
        $this->email = '';
        $this->inves_id = '';
    }

    public function cancel()
    {
        $this->resetCreateForm();
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
        $post = User::findOrFail($this->select);
        $this->inves_id = $this->select;
        $this->nama = $post->name;
        $this->email = $post->email;

    }


    public function delete()

    {

        User::find($this->select)->delete();
        session()->flash('message', 'Data Berhasil DIhapus.');
        $this->dispatchBrowserEvent('closeHapus');

    }

    public function store()
    {
        User::updateOrCreate(['id' => $this->inves_id], [
            'name' => $this->nama,
            'email' => $this->email,
            'password' => Hash::make('@mining123'),
            'is_admin' => 0,
        ]);

        session()->flash('message', $this->inves_id ? 'Data Berhasil Diupdate.' : 'Data Berhasil Ditambahkan.');
        $this->dispatchBrowserEvent('closeModal');
        $this->resetCreateForm();
    }

}
