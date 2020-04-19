@extends('layout')

@section('header')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Alternatif</h1>
</div>

<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
        <li class="breadcrumb-item active">Alternatif</li>
    </ol>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Alternatif</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">Tambah Alternatif</button>
                    </div>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center" id="tabelAlternatif">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Alternatif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->alternatif }}</td>
                                <td>
                                    <button class="btn btn-warning edit" data-id="{{ $data->id }}" data-nama="{{ $data->alternatif }}" data-toggle="modal" data-target="#modalEdit">Edit</button>
                                    <form action="{{ route('alternatif.delete', [$data]) }}" method="post" style="display: inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin menghapus data ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    <!-- /.card -->
    </div>
</div>
@endsection

@section('modal')
<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Alternatif</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('alternatif.store') }}" id="formTambah" method="post">
            @csrf
            <label for="name">Nama Alternatif</label>
            <input type="text" name="name" id="name" class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
        </form>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Alternatif</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('alternatif.update') }}" id="formEdit" method="post">
            @csrf
            <label for="alternatif">Nama Alternatif</label>
            <input type="hidden" name="aidi" id="aidi">
            <input type="text" name="alternatif" id="alternatif" class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
        </form>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
    $("#tabelAlternatif").DataTable({
        "paging":   false,
        "ordering": false,
        "searching": false,
        "info":     false
    });

    $(".edit").click(function(e){
        let id = $(e.target).data('id');
        let nama = $(e.target).data('nama');
        $("#aidi").val(id);
        $("#alternatif").val(nama);
    });
</script>
@endsection