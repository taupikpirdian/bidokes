@extends('layouts.app')
@section('content')
  <h4 class="mb-3">Tentang :</h4>
  <p class="fs-5">{{ $aboutUs->content ?? "-" }}</p>
@endsection
