@php
    $user=Auth::user()->name;
    if (date('H')>=0 && date('H')<12)
        $msg = $user.", bom dia";

    else if (date('H')>=12 && date('H')<18)
        $msg = $user.", boa tarde";

    else
        $msg = $user.", boa noite";
@endphp

@extends('admim.master.layout')


@section('title', 'Início')
@section('pageHeader', "{$msg}")
@section('content')
<?php $plugin=0; ?>

@endsection
