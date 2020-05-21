@extends('layout.index')

@section('content')

<section class="content">
  <div class="container">
    <div class="row">
      <div class="col-12" >
        <div class="card">
          <div class="card-body">
            <table  id="example" class="display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Marga</th>
                  <th scope="col">Email</th>
                  <th scope="col">No. Telpon</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">Referensi oleh</th>
                  <th scope="col">Status user</th>
                  <th scope="col">Status admin</th>
                </tr>
              </thead>
              <tbody>
                @foreach($list as $key => $value)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td><a href="{{route('Member.HalamanMember',$value->id_member)}}">{{$value->nama}}</a></td>
                  <td>{{ $value->nama_marga }}</td>
                  <td>{{ $value->email }}</td>
                  <td>{{ $value->no_telpon }}</td>
                  <td>{{ $value->alamat }}</td>
                  <td>{{ $value->referensi }}</td>
                  <td>
                    @if($value->status_member == 'Approved')
                      <a href="#" class="btn btn-success" data-toggle="modal" onclick="passdatamember('{{ $value->id_member }}')" data-target="#modal-default">Approved</a>
                    @elseif($value->status_member == 'Requested')
                      <a href="#" class="btn btn-warning" data-toggle="modal" onclick="passdatamember('{{ $value->id_member }}')" data-target="#modal-default">Requested</a>
                    @else
                      <a href="#" class="btn btn-danger" data-toggle="modal" onclick="passdatamember('{{ $value->id_member }}')" data-target="#modal-default">Rejected</a>
                    @endif
                  </td>
                  <td>
                    @if($value->status_admin == 0)
                      <a href="#" class="btn btn-danger">Tidak Aktif</a>
                    @else
                      <a href="#" class="btn btn-success">Aktif</a>
                    @endif

                  </td>
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
          <h4 class="modal-title">Rubah Status Member</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <div class="modal-body">
            <input type="hidden" name="id_member" id="id_member" value="">
            <div class="form-group">
              <select class="form-control" id="status_member">
                <option>Requested</option>
                <option>Approved</option>
                <option>Rejected</option>
              </select>
            </div>
          </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
        <button type="button" class="btn btn-success" onclick="updatestatusmember()">Simpan</button>
        </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

<script src="{{ asset('public/theme/plugins/jquery/jquery.min.js')}}"></script>

<script>
  function passdatamember(val){
    $('#id_member').val(val)
  }
  function updatestatusmember(){
    $.ajax({
      type: "GET",
      url: '{{ route("Member.updatemember")}}',
      data: {
        status : $('#status_member').val(),
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

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Status Member Berhasil Dirubah'
      })
    });
  } );

</script>

<style type="text/css">
  div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
</style>