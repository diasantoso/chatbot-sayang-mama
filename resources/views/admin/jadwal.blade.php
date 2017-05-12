@extends('admin.template')

@section('content')

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> Data Jadwal</h3>
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
                              <h2> Tabel Jadwal <small>Daftar Jadwal yang telah dimasukkan</small></h2>
                              <ul class="nav navbar-right panel_toolbox">
                                <a id="add-btn" class="btn btn-success" data-toggle="modal" data-target="#myModalAdd"><label class="fa fa-plus-circle"></label>  Tambah Jadwal Baru</a>
                              </ul>
                              <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                              <table id="tabel-user" class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th align="center">Matakuliah</th>
                                    <th align="center">Ruangan</th>
                                    <th align="center">Kelas</th>
                                    <th align="center">Hari</th>
                                    <th align="center">Mulai</th>
                                    <th align="center">Selesai</th>
                                    <th align="center">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($semuaJadwal as $jadwal)
                                  @if($jadwal->deleted_at == NULL)
                                  <tr>
                                    <td valign="middle">{{ $jadwal->makul->nama}}</td>
                                    <td valign="middle">{{ $jadwal->ruangan}}</td>
                                    <td valign="middle">{{ $jadwal->kelas}}</td>
                                    <td valign="middle">{{ $jadwal->sesiMulai->hari}}</td>
                                    <td valign="middle">Sesi-{{ $jadwal->sesiMulai->sesi }}  ({{ $jadwal->sesiMulai->waktu}})</td>
                                    <td valign="middle">Sesi-{{ $jadwal->sesiSelesai->sesi}} ({{$jadwal->sesiSelesai->waktu}} )</td>
                                    <td valign="middle">
                                      <a id="delete-btn" class="btn btn-danger btn-xs" customParam="{{ route('jadwal.destroy', $jadwal->id) }}" href="#"><span class="fa fa-trash"></span>Hapus</a>
                                
                                      <a id="edit-btn" class="btn btn-warning btn-xs edit_button" data-toggle="modal"
                                      data-id="{{ $jadwal->id }}"
                                      data-sesi_mulai="{{ $jadwal->sesi_mulai}}"
                                      data-sesi_selesai="{{$jadwal->sesi_selesai}}"
                                      data-makul_id="{{$jadwal->makul_id}}"
                                      data-kelas="{{$jadwal->kelas}}"
                                      data-ruangan="{{$jadwal->ruangan}}"
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
				  <form name="formCreateUser" action="{{ route('jadwal.store') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
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
						 <label class="col-sm-3 control-label">Selesai :</label>
            <div class="col-sm-8">
              <select class="select2_single form-control" required="" name="sesi_mulai">
                  @foreach($semuaSesi as $sesi)
                    @if($sesi->deleted_at == NULL)
                      <option value="{{ $sesi->id }}">{{ $sesi->hari }}-{{ $sesi->sesi }}</option>
                    @endif
                  @endforeach
                </select>
            </div>
					</div>
					<div class="form-group">
					 <label class="col-sm-3 control-label">Mulai :</label>
            <div class="col-sm-8">
              <select class="select2_single form-control" required="" name="sesi_selesai">
                  @foreach($semuaSesi as $sesi)
                    @if($sesi->deleted_at == NULL)
                      <option value="{{ $sesi->id }}">{{ $sesi->hari }}-{{ $sesi->sesi }}</option>
                    @endif
                  @endforeach
                </select>
            </div>
					</div>
            <div class="form-group">
            <label class="col-sm-3 control-label">Kelas :</label>
            <div class="col-sm-8">
              <input type="text" name="kelas" required="required" class="form-control" style="width:300px;"/>
            </div>
          </div>
           <div class="form-group">
            <label class="col-sm-3 control-label">Ruangan :</label>
            <div class="col-sm-8">
              <input type="number" name="ruangan" required="required" class="form-control" style="width:300px;"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Keyword :</label>
            <div class="col-sm-8">
              <input type="text" name="keyword" required="required" class="form-control" style="width:300px;"/>
            </div>
          </div>



           <div class="form-group">
                          <label class="col-sm-3 control-label">Foto :</label>
                        <div class="col-sm-8">
                        <input type="file" name="image" class="form-control" accept="image/*">
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
          <h4 class="modal-title">Tambah Jadwal Baru</h4>
        </div>
        <div class="modal-body">
          <form name="formCreateUser" action="{{ route('jadwal.update') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
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
             <label class="col-sm-3 control-label">Mulai :</label>
            <div class="col-sm-8">
              <select class="select2_single form-control sesi_mulai" required="" name="sesi_mulai">
                  @foreach($semuaSesi as $sesi)
                    @if($makul->deleted_at == NULL)
                      <option value="{{ $sesi->id }}">{{ $sesi->hari }}-{{ $sesi->sesi }}</option>
                    @endif
                  @endforeach
                </select>
            </div>
          </div>
          <div class="form-group">
           <label class="col-sm-3 control-label">Selesai :</label>
            <div class="col-sm-8">
              <select class="select2_single form-control sesi_selesai" required="" name="sesi_selesai">
                  @foreach($semuaSesi as $sesi)
                    @if($makul->deleted_at == NULL)
                      <option value="{{ $sesi->id }}">{{ $sesi->hari }}-{{ $sesi->sesi }}</option>
                    @endif
                  @endforeach
                </select>
            </div>
          </div>
            <div class="form-group">
            <label class="col-sm-3 control-label">Kelas :</label>
            <div class="col-sm-8">
              <input type="text" name="kelas" required="required" class="form-control kelas" style="width:300px;"/>
            </div>
          </div>
           <div class="form-group">
            <label class="col-sm-3 control-label">Ruangan :</label>
            <div class="col-sm-8">
              <input type="number" name="ruangan" required="required" class="form-control ruangan" style="width:300px;"/>
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
        var sesi_mulai = $(this).data('sesi_mulai');
        $(".sesi_mulai").val(sesi_mulai);
        var sesi_selesai = $(this).data('sesi_selesai');
        $(".sesi_selesai").val(sesi_selesai);
        var makul_id = $(this).data('makul_id');
        $(".makul_id").val(makul_id);
        var kelas = $(this).data('kelas');
        $(".kelas").val(kelas);
        var ruangan = $(this).data('ruangan');
        $(".ruangan").val(ruangan);
         var keyword = $(this).data('keyword');
        $(".keyword").val(keyword);

         $(".status option[value=sesi_mulai]").attr('selected','selected');
         $(".status option[value=sesi_selesai]").attr('selected','selected');
         $(".status option[value=makul_id]").attr('selected','selected');



    });
    </script>
@endsection
