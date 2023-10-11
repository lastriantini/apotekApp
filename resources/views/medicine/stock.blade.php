@extends('layouts.template')

@section('content')
    @if (Session::get('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if (Session::get('deleted'))
    <div class="alert alert-warning">{{Session::get('deleted')}}</div>
    @endif
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th class="text-center">Stok</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($medicines as $item)
            <tr>
                <td>{{ ($medicines ->currentpage()-1) * $medicines ->perpage() + $loop->index + 1 }}</td>
                <td>{{ $item['name'] }}</td>
                <td class="text-center">{{ $item['stock'] }}</td>
                <td class="d-flex justify-content-center">
                    <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-stock" onclick="edit({{$item['id']}})">Tambah Stock</div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        @if ($medicines->count())
            {{$medicines->links()}}
        @endif
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tambah-stock" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data Stock</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div>
                            <label for="name"class="form-table">Nama Obat : </label>
                            <input type="text" name="name" id="name" class="form-control" disabled>
                        </div>
                        <div>
                            <label for="stock" class="form-label">Stock : </label>
                            <input type="number" name="stock" id="stock" class="form-control">
                        </div>
                            {{--input type hidden, digunakan untuk data yang nantinya berguna namun tidak ingin diperlihatkan ke user--}}
                            <input type="hidden" name="id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function edit(id) {
            // simpan url route yang edit kedalam variable url, untuk path parameternya diisi dengan path dinamis versi js
            let url = "{{ route('medicine.show' , "id") }}" ;

            //isi :id di url atas diisi dari id argument func nya
            url = url.replace("id" , id) ;

        //request ke server lewat javascript, hanya bisa menggunakan perantara ajax
        $.ajax({
            //type method Route:: nya
            type : "GET" ,

            //url yang sudah dibuat diatas(yg manggil route, url yang dituju)
            url : url ,
            dataType : 'json',

            //kalo js berhasil memproses permintaan request ke url tersebut, yang akan dilakukan:
            success: function (res) {
                //ress akan berisidata hasil proses pengambilan di server(request url nya)
                //memunculkan modal yang id nya tambah-stock
                $('#tambah-stock').modal('show') ;

                //element html yg id nya id pada halaman ini, value nya akan diisi dengan data response bagian id , begitupun yang lainnya
                $('#id').val(res.id) ;
                $('#name').val(res.name) ;
                $('#stock').val(res.stock) ;
            }
        });
    }
    </script>
@endpush