@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="card">
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
        @if($message=Session::get('success'))
        <div class="alert alert-success">
            {{$message}}
        </div>
        @endif
        <div class="card-body d-flex justify-content-between align-items-center">
            <h4 class="card-title">Data Mahasiswa</h4>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                Tambah
            </button>
        </div>
        <div class="d-flex justify-content-between align-items-center ml-3 mr-3">
            <form method="GET">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari..." name="search" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i class="ti-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <form action="{{ route('mahasiswa.index') }}" method="get">
                <select name="status_beasiswa" id="status_beasiswa" class="form-control">
                    <option value="all" {{ request('status_beasiswa') == 'all' ? 'selected' : '' }}>Semua</option>
                    <option value="beasiswa" {{ request('status_beasiswa') == 'beasiswa' ? 'selected' : '' }}>Beasiswa</option>
                    <option value="tidak_beasiswa" {{ request('status_beasiswa') == 'tidak_beasiswa' ? 'selected' : '' }}>Tidak Beasiswa</option>
                </select>
            </form>
        </div>
        @include('admin.mahasiswa-tambah')
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Program Studi</th>
                        <th>Semester</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswas as $index => $mahasiswa)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$mahasiswa->nim}}</td>
                        <td>{{$mahasiswa->nama}}</td>
                        <td>{{$mahasiswa->prodi->jurusan->jurusan}}</td>
                        <td>{{$mahasiswa->prodi->prodi}}</td>
                        <td>{{$mahasiswa->semester}}</td>
                        <td>
                            @if($mahasiswa->id_beasiswa == null)
                            <label class="badge badge-danger">Tidak Beasiswa</label>
                            @else
                            <label class="badge badge-success">Beasiswa</label>
                            @endif
                        </td>
                        <td>
                            @include('admin.mahasiswa-ubah')
                            <form action="{{route('mahasiswa.destroy',$mahasiswa->id)}}" method="post">
                                <button type="button" class="badge badge-warning" data-toggle="modal" data-target="#ubah{{$mahasiswa->id}}">
                                    Ubah
                                </button>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="badge badge-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center"><i>Data Kosong</i></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {!! $mahasiswas->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#status_beasiswa").change(function() {
            var selectedValue = $(this).val();
            if (selectedValue !== "all") {
                window.location.href = "{{ route('mahasiswa.index') }}?status_beasiswa=" + selectedValue;
            } else {
                window.location.href = "{{ route('mahasiswa.index') }}";
            }
        });
    });

</script>

@endsection
