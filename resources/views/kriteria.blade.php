@extends('layout')

@section('header')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Kriteria</h1>
</div>

<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
        <li class="breadcrumb-item active">Kriteria</li>
    </ol>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Kriteria</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="display: inline-block">
                        <button class="btn btn-success" data-toggle="modal" data-target="#modalPerbandingan">Perbandingan</button>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">Tambah Kriteria</button>
                    </div>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center" id="tabelKriteria">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kriteria</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->kriteria }}</td>
                                <td>
                                    <button class="btn btn-info perbandingan" data-id="{{ $data->id }}" data-nama="{{ $data->kriteria }}" data-toggle="modal" data-target="#modalPerbandinganAlternatif">Perbandingan</button>
                                    <button class="btn btn-warning edit" data-id="{{ $data->id }}" data-nama="{{ $data->kriteria }}" data-toggle="modal" data-target="#modalEdit">Edit</button>
                                    <form action="{{ route('kriteria.delete', [$data]) }}" method="post" style="display: inline-block">
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
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Kriteria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('kriteria.store') }}" id="formTambah" method="post">
            @csrf
            <label for="name">Nama Kriteria</label>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Kriteria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('kriteria.update') }}" id="formEdit" method="post">
            @csrf
            <label for="kriteria">Nama Kriteria</label>
            <input type="hidden" name="aidi" id="aidi">
            <input type="text" name="kriteria" id="kriteria" class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
        </form>
    </div>
  </div>
</div>

<!-- Modal Perbandingan Kriteria -->
<div class="modal fade" id="modalPerbandingan" tabindex="-1" role="dialog" aria-labelledby="modalPerbandinganTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Perbandingan Kriteria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('perbandinganKriteria.update') }}" id="formPerbandingan" method="post">
            @csrf
            @foreach($perbandingans as $p)
                <div class="row mb-2">
                    <div class="col-3">
                        <input type="text" class="form-control" value="{{ $p->kriteria1->kriteria }}" disabled>
                    </div>
                    <div class="col-6">
                        <select name="perbandingan[]" class="form-control">
                            @foreach($pembandings as $pembanding)
                                <option value="{{ $p->kriteria1->id }}-{{ $p->kriteria2->id }}-{{ $pembanding->id }}" <?= $p->pembanding->id == $pembanding->id ? 'selected' : '' ?>>{{ $pembanding->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" value="{{ $p->kriteria2->kriteria }}" disabled>
                    </div>
                </div>
            @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
        </form>
    </div>
  </div>
</div>

<!-- Modal Perbandingan Alternatif -->
<div class="modal fade" id="modalPerbandinganAlternatif" tabindex="-1" role="dialog" aria-labelledby="modalPerbandinganAlternatifTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="alternatifTitle">Perbandingan Kriteria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('perbandinganAlternatif.update') }}" id="formPerbandinganAlternatif" method="post">
            @csrf
            <input type="hidden" name="kriteria_id" id="kriteria_id" value="">
            @foreach($alternatifs as $p)
                <div class="row mb-2 k{{ $p->kriteria->id }} pak">
                    <div class="col-3">
                        <input type="text" class="form-control" value="{{ $p->alternatif1->alternatif }}" disabled>
                    </div>
                    <div class="col-6">
                        <select name="perbandinganAlternatif[]" class="form-control">
                            @foreach($pembandings as $pembanding)
                                <option value="{{ $p->alternatif1->id }}-{{ $p->alternatif2->id }}-{{ $p->kriteria->id }}-{{ $pembanding->id }}" <?= $p->pembanding->id == $pembanding->id ? 'selected' : '' ?>>{{ $pembanding->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" value="{{ $p->alternatif2->alternatif }}" disabled>
                    </div>
                </div>
            @endforeach
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
    $("#tabelKriteria").DataTable({
        "paging":   false,
        "ordering": false,
        "searching": false,
        "info":     false
    });

    $(".edit").click(function(e){
        let id = $(e.target).data('id');
        let nama = $(e.target).data('nama');
        $("#aidi").val(id);
        $("#kriteria").val(nama);
    });

    $(".perbandingan").click(function(e){
        let id = $(e.target).data('id');
        let nama = $(e.target).data('nama');
        $("#kriteria_id").val(id);
        $("#alternatifTitle").html("Perbandingan kriteria "+nama);

        $(".pak").hide();
        $(".k"+id).show();
    });
</script>
@endsection