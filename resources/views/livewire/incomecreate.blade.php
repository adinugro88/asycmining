@if ($show == true)
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal</label>
                    <input type="date" class="form-control" placeholder="Tanggal" wire:model='tgl'>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Coin</label>
                    <select class="custom-select" wire:model="coin">
                        <option value="BTC"  {{ $ubah == "BTC" ? 'selected' : '' }}>BTC</option>
                        <option value="BCH">BCH</option>
                        <option value="LITE">LITE</option>
                        <option value="DODGE">DODGE</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Mesin</label>
                    <select class="custom-select" wire:model="mesin">
                        @foreach ($listmesin as $db)
                        <option value="{{ $db->namamesin }}">{{ $db->namamesin }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Income Total By Day</label>
                    <input type="text" class="form-control"  wire:model.defer="incometotalbyday">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Rate By Day</label>
                    <input type="text" class="form-control"  wire:model.defer="rate">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Active Mesin</label>
                    <input type="text" class="form-control"  wire:model.defer="active_mesin">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Persen Investor</label>
                    <input type="text" class="form-control"  wire:model.defer="investorpersen">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Persen Manajemen</label>
                    <input type="text" class="form-control"  wire:model.defer="manajemenpersen">
                </div>
            </div>

            <div class="col-md-6">
                <button class="btn btn-primary" wire:click='hitung()'>hitung</button>
                @if ($validatehitung == true)
                <b class="text-danger ml-4">Data Tidak Boleh ada yang Kosong okay</b>
                @endif
            </div>
       

            <div class="col-md-12 mt-4">
                <h4>Cek Data</h4>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal</label>
                    <input type="text" class="form-control"  wire:model="tgl"  disabled>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Coin</label>
                    <input type="text" class="form-control" wire:model="coin"  disabled>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Income By Day</label>
                    <input type="text" class="form-control" wire:model="incometotalbyday" disabled>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Mesin</label>
                    <input type="text" class="form-control" wire:model="mesin"  disabled>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nilai</label>
                    <p class="d-none">{{isset($pembagi) ?  $pembagi : '0' }}</p>
                    
                  
                    <input type="text" class="form-control" wire:model='nilai' disabled>
                  
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Qty</label>
                
                    <input type="text" class="form-control" wire:model="qty"  disabled>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Watt</label>
                    
                    <input type="text" class="form-control"wire:model="watt"  disabled>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nilai Sebenarnya</label>
                    <input type="text" class="form-control"  value="{{ number_format($nilaisbr,9) }}"
                    disabled>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Rate By Day</label>
                    <input type="text" class="form-control"   wire:model="rate" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Rate Listrik</label>
                  
                    <input type="text" class="form-control"  value="{{ $ratelistrik}}"  disabled>
                   
                
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Active Mesin</label>
                    <input type="text" class="form-control" wire:model="active_mesin" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Listrik</label>
                    <input type="text" class="form-control"  value="{{ $listrik = number_format($listrik,8) }}" disabled>                   
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Hasil Listrik - Pendapatan</label>
                 
                    <input type="text" class="form-control"  value="{{ $hasillistrikkurang = number_format($hasillistrikkurang,12) }}"
                    disabled> 
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Hasil Investor</label>
                    <input type="text" class="form-control" value="{{ $investorcoin = number_format($investorcoin,10) }}"  disabled>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Hasil Investor IDR</label>
                    <input type="text" class="form-control" value=" {{  "Rp ". number_format( $invert_idr, 0, ",", ".")  }}" disabled> 
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Hasil Manajemen</label>      
                    <input type="text" class="form-control"  value="{{ $manage = number_format($manage,10) }}" disabled>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Hasil Menajemen IDR</label>
                    <input type="text" class="form-control" value=" {{"Rp ". number_format( $manage_IDR, 0, ",", ".")  }}" disabled>
               
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            wire:click="cancel()">Close</button>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="button" class="btn btn-primary" wire:click="store()">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endif
