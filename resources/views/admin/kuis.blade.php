@extends('admin.template')

@section('content')

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> Data Kuis / Tugas</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_content">

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <div id="myTabContent2" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">

                          <!-- <!-------------------------------------------------------------------ARTIKEL INDEX--------------------------->
                          <div class="x_panel">
                            <div class="x_title">
                              <h2> Tabel Kuis / Tugas  <small>Daftar kuis/tugas yang telah dimasukkan</small></h2>
                              <ul class="nav navbar-right panel_toolbox">
                                <a id="add-btn" class="btn btn-success" data-toggle="modal" data-target="#myModalAdd"><label class="fa fa-plus-circle"></label>  Tambah Kuis/Tugas Baru</a>
                              </ul>
                              <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                              <table id="tabel-user" class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th align="center">Matakuliah</th>
                                    <th align="center">Nama</th>
                                    <th align="center">Deskripsi</th>
                                    <th align="center">Waktu Mulai</th>
                                    <th align="center">Waktu Selesai</th>
                                    <th align="center">Tipe</th>
                                    <th align="center">Keyword</th>
                                    <th align="center">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($semuaJadwalTambahan as $jadwal)
                                  @if($jadwal->deleted_at == NULL)
                                  <tr>
                                    <td valign="middle">{{ $jadwal->makul->nama}}</td>
                                    <td valign="middle">{{ $jadwal->nama}}</td>
                                    <td valign="middle">{{ $jadwal->deskripsi}}</td>
                                    <td valign="middle">{{ $jadwal->waktu_mulai}}</td>
                                    <td valign="middle">{{ $jadwal->waktu_selesai}}</td>
                                    <td valign="middle">{{ $jadwal->type}}</td>
                                    <td valign="middle">{{ $jadwal->keyword}}</td>
                                    <td valign="middle">
                                        <a id="delete-btn" class="btn btn-danger btn-xs" customParam="{{ route('jadwalTambahan.destroy', $jadwal->id) }}" href="#"><span class="fa fa-trash"></span> Hapus</a>
                                    </td>
                                  </tr>
                                  @endif
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content22" aria-labelledby="profile-tab">

                        </div>
                      </div>
                    </div>

                  </div>


              </div>
            </div>
          </div>
        </div>

        <!-- Modal Add -->
      <div class="modal fade" id="myModalAdd" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Jadwal Baru</h4>
        </div>
        <div class="modal-body">
          <form name="formCreateUser" action="{{ route('jadwalTambahan.store') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
          <div class="form-group">
            <label class="col-sm-3 control-label">Makul :</label>
            <div class="col-sm-8">
              <select class="select2_single form-control" required="" name="makul_id">
                  @foreach($semuaMakul as $makul)
                    @if($makul->deleted_at == NULL)
                      <option value="{{ $makul->id }}">{{ $makul->nama }}</option>
                    @endif
                  @endforeach
                </select>
            </div>
          </div>
            <div class="form-group">
            <label class="col-sm-3 control-label">Nama :</label>
            <div class="col-sm-8">
              <input type="text" name="nama" required="required" class="form-control" style="width:300px;"/>
            </div>
          </div>
           <div class="form-group">
            <label class="col-sm-3 control-label">Deskripsi :</label>
            <div class="col-sm-8">
              <input type="text" name="deskripsi" required="required" class="form-control" style="width:300px;"/>
            </div>
          </div>
            <div class="form-group">
            <label class="col-sm-3 control-label">Waktu Mulai :</label>
            <div class="col-sm-8">
              <input type="datetime-local" name="waktu_mulai" required="required" class="form-control" style="width:300px;"/>
            </div>
          </div>
            <div class="form-group">
            <label class="col-sm-3 control-label">Waktu Selesai :</label>
            <div class="col-sm-8">
              <input type="datetime-local" name="waktu_selesai" required="required" class="form-control" style="width:300px;"/>
            </div>
          </div>
            <div class="form-group">
            <label class="col-sm-3 control-label">Tipe :</label>
            <div class="col-sm-8">
                <select class="select2_single form-control" required="" name="type">
                      <option value="kuis">Kuis</option>
                      <option value="tugas">Tugas</option>
                </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Keyword :</label>
            <div class="col-sm-8">
              <input type="text" name="keyword" required="required" class="form-control" style="width:300px;"/>
            </div>
          </div>
          <div class="form-group modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
          </form>
        </div>
        </div>

      </div>
      </div>



<!-- /page content -->

@endsection

@section('custom_script')

<!-- Script SweetAlert Konfirmasi Hapus -->
<script>
    var deleter = {

        linkSelector : "a#delete-btn",

        init: function() {
            $(this.linkSelector).on('click', {self:this}, this.handleClick);
        },

        handleClick: function(event) {
            event.preventDefault();

            var self = event.data.self;
            var link = $(this);

        swal({
            title: 'Hapus Data',
            text: "Apakah anda yakin ingin menghapus data ini?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            confirmButtonClass: 'btn btn-success btn-lg',
            cancelButtonClass: 'btn btn-danger btn-lg',
            buttonsStyling: false
          }).then(function () {
              window.location = link.attr('customParam');
          }, function (dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
              swal(
                'Batal',
                'Data batal untuk dihapus',
                'error'
              )
            }
          })
        },
    };

    deleter.init();
</script>
<!-- Script SweetAlert Konfirmasi Hapus -->

<!-- Datatables Artikel Index -->
<script>
    $('#tabel-user').dataTable();
</script>
<!-- /Datatables Artikel Index -->

<script type="text/javascript">
  $(document).on( "click", '.edit_button',function(e) {

        var id = $(this).data('id');
        $(".id").val(id);
        var fullname = $(this).data('fullname');
        $(".fullname").val(fullname);
        var npm = $(this).data('npm');
        $(".npm").val(npm);
        var email = $(this).data('email');
        $(".email").val(email);

    });
    </script>
@endsection
