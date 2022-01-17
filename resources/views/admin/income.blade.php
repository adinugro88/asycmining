@extends('layouts.app')
   
@section('content')
<div class="container">
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
                            <td>
                                <a href="/admin/income/{{ $post -> id }}" class="btn btn-primary" >Input Data</a>
                               
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection