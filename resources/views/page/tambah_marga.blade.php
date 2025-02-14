@extends('layout.index')

@section('content')

<section class="content">
  <div class="container">
    <div class="row">
      <div class="col-12" >
        <div class="card">
          <div class="card-body">
            <div style="float: right;">
              <button class="btn btn-info" data-toggle="modal" data-target="#modal-default">Tambah Marga</button>
            </div><br><br>
            <table  id="example" class="display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Marga</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($list_marga as $key => $value)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $value->nama_marga}}</td>
                  <td><center><a data-toggle="modal" data-target="#modal-edit" onclick="setmarga('{{$value->nama_marga}}','{{$value->id_marga}}')" style="cursor: pointer; color: white;" class="btn btn-info"><i class="fas fa-eye"></i></a></center></td>
                </tr>
                @endforeach
              </tbody>
              
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Marga</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Nama Marga</label>
              <input type="text" id="nama_marga"  class="form-control" name="">
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
            <button type="button" class="btn btn-primary btn btn-success" onclick="storemarga()">Simpan</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Marga</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Nama Marga</label>
              <input type="text" id="nama_marga_update" value="" class="form-control" name="">
            </div>
          </div>
          <input type="hidden" id="id_marga_update" value="">
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
            <button type="button" class="btn btn-primary btn btn-success" onclick="updatemarga()">Update</button>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection

<script src="{{ asset('public/theme/plugins/jquery/jquery.min.js')}}"></script>

<script>

  function updatemarga(){
    $.ajax({
      type: "GET",
      url: '{{ route("Marga.update_marga")}}',
      data: {
          nama_marga: $('#nama_marga_update').val(),
          id_marga  : $('#id_marga_update').val()
      },
      success: function(responses){  
        location.reload()
      }
    });
  }

  function setmarga(name,id){
    $('#nama_marga_update').val(name)
    $('#id_marga_update').val(id)
  }

  function storemarga(){
    $.ajax({
      type: "GET",
      url: '{{ route("Marga.store_marga")}}',
      data: {
          nama_marga: $('#nama_marga').val(),
          alamat : $('#alamat_marga').val(),
      },
      success: function(responses){  
        location.reload()
      }
    });
  }

  $(document).ready(function() {
    $('#example').DataTable( {
        "scrollX": true
    } );

    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

  });

</script>

<style type="text/css">
  div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
</style>