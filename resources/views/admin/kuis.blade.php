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
                                        <a id="edit-btn" class="btn btn-warning btn-xs edit_button" data-toggle="modal"
                                        data-id="{{ $jadwal->id }}"
                                        data-nama="{{ $jadwal->nama }}"
                                        data-waktu_mulai="{{ $jadwal->waktu_mulai}}"
                                        data-waktu_selesai="{{$jadwal->waktu_selesai}}"
                                        data-makul_id="{{$jadwal->makul_id}}"
                                        data-type="{{$jadwal->type}}"
                                        data-deskripsi="{{$jadwal->deskripsi}}"
                                        data-keyword="{{$jadwal->keyword}}"
                                        data-target="#myModalUpdate"><span class="fa fa-pencil-square-o"></span> Edit</a>
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
              <input type="datetime-local" name="waktu_mulai" required="required" class="form-control waktu_mulai" style="width:300px;"/>
            </div>
          </div>
            <div class="form-group">
            <label class="col-sm-3 control-label">Waktu Selesai :</label>
            <div class="col-sm-8">
              <input type="datetime-local" name="waktu_selesai" required="required" class="form-control waktu_selesai" style="width:300px;"/>
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
      <!-- Modal Update -->
    <div class="modal fade" id="myModalUpdate" role="dialog">
   <div class="modal-dialog">

     <!-- Modal content-->
     <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title">Edit Jadwal Baru</h4>
     </div>
     <div class="modal-body">
       <form name="formCreateUser" action="{{ route('jadwalTambahan.update') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
         {{ csrf_field() }}
         <input type="hidden" name="id" class="id">
         <input type="hidden" name="_method" value="PATCH">
       <div class="form-group">
         <label class="col-sm-3 control-label">Makul :</label>
         <div class="col-sm-8">
           <select class="select2_single form-control makul_id" required="" name="makul_id">
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
           <input type="text" name="nama" required="required" class="form-control nama" style="width:300px;"/>
         </div>
       </div>
        <div class="form-group">
         <label class="col-sm-3 control-label">Deskripsi :</label>
         <div class="col-sm-8">
           <input type="text" name="deskripsi" required="required" class="form-control deskripsi" style="width:300px;"/>
         </div>
       </div>
         <div class="form-group">
         <label class="col-sm-3 control-label">Waktu Mulai :</label>
         <div class="col-sm-8">
           <input type="datetime-local" name="waktu_mulai" required="required" class="form-control waktu_mulai" style="width:300px;"/>
         </div>
       </div>
         <div class="form-group">
         <label class="col-sm-3 control-label waktu_selesai">Waktu Selesai :</label>
         <div class="col-sm-8">
           <input type="datetime-local" name="waktu_selesai" required="required" class="form-control waktu_selesai" style="width:300px;"/>
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
           <input type="text" name="keyword" required="required" class="form-control keyword" style="width:300px;"/>
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
        var nama = $(this).data('nama');
        $(".nama").val(nama);
        var waktu_mulai = $(this).data('waktu_mulai');
        $(".waktu_mulai").val(waktu_mulai);
        var waktu_selesai= $(this).data('waktu_selesai');
        $(".waktu_selesai").val(waktu_selesai);
        var type = $(this).data('type');
        $(".type").val(type);
        var deskripsi = $(this).data('deskripsi');
        $(".deskripsi").val(deskripsi);
        var keyword = $(this).data('keyword');
        $(".keyword").val(keyword);
        var makul_id = $(this).data('makul_id');
        $(".makul_id").val(makul_id);


    });
    </script>
@endsection
