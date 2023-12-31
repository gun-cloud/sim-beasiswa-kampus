@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="card">
        @if($message=Session::get('success'))
        <div class="alert alert-success">
            {{$message}}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> <br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card-body d-flex justify-content-between align-items-center">
            <h4 class="card-title">Data Beasiswa</h4>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                Tambah
            </button>
            @include('admin.beasiswa-tambah')
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Beasiswa</th>
                        <th>Beasiswa</th>
                        <th>Sumber Dana</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beasiswas as $index => $beasiswa)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$beasiswa->nama}}</td>
                        <td>{{$beasiswa->jenis}}</td>
                        <td>{{$beasiswa->sumber}}</td>
                        <td>{{implode(' ', array_slice(str_word_count(strip_tags($beasiswa->deskripsi), 1), 0, 10))}}</td>

                        <td><img src="{{$beasiswa->gambar}}"></td>
                        <td>
                            @include('admin.beasiswa-ubah')
                            <form action="{{route('beasiswa.destroy',$beasiswa->id)}}" method="post">
                                <button type="button" class="badge badge-warning" data-toggle="modal" data-target="#ubah{{$beasiswa->id}}">
                                    Ubah
                                </button>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="badge badge-danger" data-toggle="modal" data-target="#hapus">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center"><i>Data Kosong</i></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
             {!! $beasiswas->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>

@endsection
