<div class="row justify-content-center">
    <div class="col-md-12 mb-5">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Tambah Data
        </button>
    </div>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Edit Investor</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Nama" wire:model.defer="nama">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Email"
                                wire:model.defer="email">
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="cancel()">Close</button>
              <button type="button" class="btn btn-primary" wire:click="store()">Save changes</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="HapusUserLabel">Hapus User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                Yain Mau HApus Ciuss??
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click="delete()" class="btn btn-primary">Hapus Data</button>
                </div>
            </div>
            </div>
        </div>


            

            <div class="col-md-12">
                <div class="card">

                    @if (session()->has('message'))
                    <div class="alert alert-info mb-0" id="alertoi" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif
                    
                    <div class="card-header mt-0">
                        <h5><b>List Investor</b></h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no =0; ?>
                                @foreach ($listinvestor as $post)
                                <?php $no ++ ?>
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $post -> name }}</td>
                                    <td>{{ $post -> email }}</td>
                                
                                    <td>
                                        <button wire:click="selectedItem({{ $post->id }},'update')" class="btn btn-primary" >edit</button>
                                        <button wire:click="selectedItem({{ $post->id }},'delete')" type="button"
                                            class="btn btn-danger">Hapus</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true close-btn">×</span>
                            </button>
                        </div>
                    <div class="modal-body">
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                            <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal" data-dismiss="modal">Yes, Delete</button>
                        </div>
                    </div>
                </div>
            </div>



        </div>
