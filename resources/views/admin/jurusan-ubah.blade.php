<div class="modal fade top" id="ubah{{$jurusan->id}}" tabindex="-1" role="dialog" aria-labelledby="ubah{{$jurusan->id}}Label" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubah{{$jurusan->id}}Label">Ubah Data Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
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
            <div class="modal-body">
                <form action="{{route('jurusan.update',$jurusan->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="jurusan">Nama Jurusan</label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan" value="{{$jurusan->jurusan}}">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
