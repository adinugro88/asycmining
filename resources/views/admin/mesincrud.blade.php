@extends('layouts.app')
   
@section('content')

    @livewire('mesin-crud',['id'=>$id])

@endsection