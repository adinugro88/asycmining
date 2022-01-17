@if ($show == true)
<div class="col-md-12 mb-5">
    <div class="card">
        <div class="card-body">
            <div class="row mb-5">
                <div class="col-md-12 text-right mb-2 mt-0">
                    <button wire:click='cancel()' class="btn btn-danger">x</button>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Transfer</label>
                        <div class="input-group date " data-provide="datepicker">
                            <input  class="form-control datepicker" id="tanggal" wire:model="tgl"
                                onchange="this.dispatchEvent(new InputEvent('input'))"  type="date" data-date="" dateformat="y M d">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                        @error('tgl') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal akhir</label>
                        <div class="input-group date " data-provide="datepicker">
                            <input  class="form-control datepicker" id="tanggal" wire:model="tglakhir"
                                onchange="this.dispatchEvent(new InputEvent('input'))"  type="date" data-date="" dateformat="y M d">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                        @error('tglakhir') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Investor</label>
                        <select class="custom-select" wire:model="user">
                            @foreach ( $investorpilih as $db)
                            <option value="{{$db->id }}">{{$db->name }}</option>
                            @endforeach
                        </select>
                        {{ $user }}
                        @error('user') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Coin</label>
                        <select class="custom-select" wire:model="coin">
                            <option value="BTC" selected>BTC</option>
                            <option value="BCH">BCH</option>
                        </select>
                        {{ $coin }}
                        @error('coin') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Wallet</label>
                        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Wallet"
                            wire:model="Wallet">
                            @error('Wallet') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Network Fee</label>
                        <input type="text" class="form-control" placeholder="Network Fee" wire:model="networkfee">
                        @error('networkfee') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Wallet Company</label>
                        <input type="text" class="form-control" placeholder="Wallet Company"
                            wire:model="walletcompany">
                            @error('walletcompany') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Listrik</label>
                        <input type="text" class="form-control" placeholder="Listrik" wire:model="listrik" ">
                        @error('listrik') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Investor</label>
                        <input type="text" class="form-control" placeholder="Investor" wire:model="investor" " >
                        @error('investor') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Management</label>
                        <input type="text" class="form-control" placeholder="Management" wire:model="management">
                        @error('management') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-12 mt-3 text-center">
                    <b>BCH KE IDR NOTED</b>
                    <hr>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Rate Coin To USDT</label>
                        <input type="text" class="form-control" placeholder="Rate Coin To USDT"
                            wire:model="ratecointousd">
                        @error('ratecointousd') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Fee Coin To USDT</label>
                        <input type="text" class="form-control" placeholder="Fee Coin To USDT" wire:model="feecointousd">
                        @error('feecointousd') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Total USDT</label>
                        <input type="text" class="form-control" placeholder="Total USD" wire:model="totalusd">
                        @error('totalusd') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>


                <div class="col-md-12 mt-3 text-center">
                    <b> BTC KE IDR NOTED</b>
                    <hr>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Rate Coin To Bidr</label>
                        <input type="text" class="form-control" placeholder="Rate BTC To Bidr"
                            wire:model="rateusdtobidr">
                            @error('rateusdtobidr') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Fee To Bidr</label>
                        <input type="text" class="form-control" placeholder="Fee Bidr" wire:model="feebidr">
                        @error('feebidr') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Total Bidr</label>
                        <input type="text" class="form-control" placeholder="Fee Bidr" wire:model="totalbidr">
                        @error('totalbidr') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Fee Coin To IDR</label>
                        <input type="text" class="form-control" placeholder="Fee BTC To IDR"
                            wire:model="feecointoidr">
                            @error('feecointoidr') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>


                <div class="col-md-12 mt-3 text-center">
                    <b>Transfer LANGSUNG KE COIN NOTED</b>
                    <hr>
                </div>
                <div class="col-md-4 ">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Fee Coin</label>
                        <input type="text" class="form-control" placeholder="Rate Coin To USDT"
                            wire:model="feecoin">
                            @error('feecoin') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>


                <div class="col-md-8">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Total Coin</label>
                        <input type="text" class="form-control" placeholder="Total Coin"
                            wire:model="totalcoin">
                            @error('totalcoin') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-4 mt-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Total</label>
                        <input type="text" class="form-control" aria-describedby="networkfee" placeholder="Total"
                            wire:model="total">
                            @error('total') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-8 mt-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Note</label>
                        <textarea type="text" class="form-control" aria-describedby="networkfee" placeholder="Note"
                            wire:model="catatan"></textarea>

                            @error('catatan') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <button type="button" class="btn btn-secondary mr-3" wire:click="cancel()">Close</button>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-primary" wire:click="store()">Save changes</button>
                </div>


            </div> <!-- row -->
        </div>

    </div>

</div>


@endif


