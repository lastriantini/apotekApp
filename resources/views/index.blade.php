{{--panngil file template--}}
@extends('layouts.template')

{{--isi bagian yield--}}
@section('content')

<div class="jumbotron py-4 px-5">
    <h1 class="display-4">Selamat Datang !</h1>
    <hr class="my-4">
    <p>Aplikasi ini digunakan hanya oleh pegawai admisnistator APOTEK. Digunakan untuk mengelola data obat, penyetokan, jua pembelian (kasir). </p>
</div>
@endsection

{{--bisa css juga--}}
@push('script')
<script>
    console.log("hello")
</script>