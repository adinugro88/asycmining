<div class="container">
    <div class="col-md-12 mb-5">
        <button type="button" wire:click="$set('show', true)" class="btn btn-primary">
        Tambah Data
        </button>
    </div>
     
    @include('livewire.createpayment')

    @include('livewire.createpay')


    <div class="col-md-12">
        <div class="card">
            @if (session()->has('message'))
            <div class="alert alert-info mb-0" id="alertoi" role="alert">
                {{ session('message') }}
            </div>
            @endif
            
            <div class="card-header mt-0">
                <h5>List Payment</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-fit">
                    <thead class="">
                        <tr style=" white-space: nowrap;">
                            <th scope="col" style="width: auto">No</th>
                            <th scope="col" style="width: auto">Nama Investor</th>
                            <th scope="col" style="width: auto">Tanggal Coin Dari Dan Akhir </th>
                            <th scope="col">Tanggal Indikator</th>
                            <th scope="col">Coin</th>
                            <th scope="col">Saldo Awal</th>
                            <th scope="col">Saldo Akhir</th>
                            <th scope="col">Wallet</th>
                            <th scope="col">Network Fee</th>
                            <th scope="col">Network Fee To Idr</th>
                            <th scope="col">Total Fee To Idr</th>
                            <th scope="col">Wallet Company</th>
                            <th scope="col">Rate Lite To BTC</th>
                            <th scope="col">Investor * Rate Lite To BTC</th>
                            <th scope="col">Fee Lite To BTC</th>
                            <th scope="col">Total Btc</th>
                            <th scope="col">listrik</th>
                            <th scope="col">investor</th>
                            <th scope="col">Management</th>
                            <th scope="col">Rate Coin To USDT</th>
                            <th scope="col">Fee Coin To USDT</th>
                            <th scope="col">Total USDT</th>
                            <th scope="col">Rate USDT to Bidr</th>
                            <th scope="col">Fee Bidr</th>
                            <th scope="col">Total Bidr</th>
                            <th scope="col">Fee Coin To Idr</th>
                            <th scope="col">fee Coin Langsung</th>
                            <th scope="col">Total Coin Langsung</th>
                            <th scope="col">Total</th>
                            <th scope="col">Lebih Kurang Bayar</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                        @foreach ($payment as $key=> $post)
                        
                        <tr style=" white-space: nowrap;">
                            <td>{{ $key+ $payment->firstItem() }}</td>
                            <td>{{ $post ->user->name }}</td>
                            <td>{{ $post ->catatan	}}</td>
                            <td>{{ $post ->tglakhir }}</td>
                            <td>{{ $post ->coin }}</td>
                            <td>{{ number_format($post ->saldoawal,8)  }}</td>
                            <td>{{ number_format($post ->saldoakhir,8) }}</td>
                            <td>{{ number_format($post ->wallet,8) }}</td>
                            <td>{{ $post ->networkfee }}</td>
                            <td>{{ $post ->networkfeetoidr }}</td>
                            <td>{{ $post ->totalfeeidr }}</td>
                            <td>{{ number_format( $post ->walletcompany ,6) }}</td>
                            <td>{{ number_format($post ->ratelitetobtc ,6) }} </td>
                            <td>{{ number_format($post ->investorlitetobtc ,6) }} </td>
                            <td>{{ number_format($post ->feelitetobtc ,6) }} </td>
                            <td>{{ number_format($post ->totalbtc ,6) }} </td>
                            <td>{{ number_format($post ->listrik ,6) }} </td>
                            <td>{{ number_format($post ->investor ,6) }}</td>
                            <td>{{ number_format($post ->management ,6) }}</td>
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
                            <td>{{ $post ->total	}}</td>
                            <td>{{ $post ->lebihkurangbayar }} </td>
                            <td>{{ $post ->tanggal }}</td>
                            <td>
                                <button wire:click="selectedItem({{ $post->id }},'update')" class="btn btn-primary" >edit</button>
                                <button wire:click="selectedItem({{ $post->id }},'delete')" type="button"
                                    class="btn btn-danger">Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- {{ $payment->links('pagination::bootstrap-4') }} --}}
                </div>
                {{-- {{ $payment->links('pagination::bootstrap-4') }} --}}
                @if ($payment->hasPages())
                <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
                    <span>
                        {{-- Previous Page Link --}}
                        @if ($payment->onFirstPage())
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                {!! __('pagination.previous') !!}
                            </span>
                        @else
                            <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                {!! __('pagination.previous') !!}
                            </button>
                        @endif
                    </span>
        
                    <span>
                        {{-- Next Page Link --}}
                        @if ($payment->hasMorePages())
                            <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                {!! __('pagination.next') !!}
                            </button>
                        @else
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                {!! __('pagination.next') !!}
                            </span>
                        @endif
                    </span>
                </nav>
            @endif
            </div>
        </div>
    </div>
</div>