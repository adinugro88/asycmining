@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5><b>List Investor</b></h5></div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no =0; ?>
                            @foreach ($listinvestor as $post)
                            <?php $no ++ ?>
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $post -> name }}</td>
                             
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection