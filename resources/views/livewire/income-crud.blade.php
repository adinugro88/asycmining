<div class="container">
    <div class="col-md-3 mb-5">

        <h4>Investor<b>&nbsp; {{ $investor->name }}</b></h4>
        <button type="button" class="btn btn-primary" wire:click="$set('show', true)">
            Tambah Data
        </button>
    </div>

    @include('livewire.incomecreate')

    <div class="col-md-6  mt-5">
        <div class="row">
            <div class="col-md-2">
                <b class="mt-5">Pilih Coin</b>
            </div>
            <div class="col-md-6">
                <div class="form-group">

                    <select class="custom-select" wire:model="ubah">
                        @foreach ( $listcoin as $db)
                        <option value="{{$db->coin }}">{{$db->coin }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>



    @include('livewire.incomedel')

    <div class="col-md-12">
        <div class="card">
            @if (session()->has('message'))
            <div class="alert alert-info mb-0" id="alertoi" role="alert">
                {{ session('message') }}
            </div>
            @endif

            <div class="card-header mt-0">
                <h5>List Mesin</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Coin</th>
                            <th scope="col">Mesin</th>
                            <th scope="col">Total Coin Per Hari</th>
                            <th scope="col">Nilai IDR</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no =0; ?>
                        @foreach ($datahasil as $key=> $post)
                        <?php $no ++ ?>
                        <tr>
                            <td>{{ $key+ $datahasil->firstItem() }}</td>
                            <td>{{ $post -> tgl }}</td>
                            <td>{{ $post -> coin }}</td>
                            <td>{{ $post -> mesin }}</td>
                            <td>{{ $post -> nilai }}</td>
                            <td>{{"Rp " . number_format( $post->INVERT_IDR, 0, ",", ".")  }}</td>

                            <td>

                                <button wire:click="selectedItem({{ $post->id }},'delete')" type="button"
                                    class="btn btn-danger">Hapus</button>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>

                {{-- {{ $datahasil->withQueryString()->links('pagination::bootstrap-4') }} --}}

                <div>
                    @if ($datahasil->hasPages())
                        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
                            <span>
                                {{-- Previous Page Link --}}
                                @if ($datahasil->onFirstPage())
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
                                @if ($datahasil->hasMorePages())
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
</div>
