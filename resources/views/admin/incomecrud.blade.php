@extends('layouts.app')
   
@section('content')
@livewire('income-crud',['id'=>$id])
@endsection