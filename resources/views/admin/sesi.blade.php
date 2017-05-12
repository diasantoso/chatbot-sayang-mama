@extends('admin.template')

@section('content')

<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> Data Sesi </h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_content">

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab1" class="nav nav-tabs bar_tabs left" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content11" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><span class="fa fa-archive"></span> Data Sesi</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"><span class="fa fa-trash"></span> Data Sesi Sudah Dihapus</a>
                        </li>
                      </ul>
                      <div id="myTabContent2" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">

                          <!-------------------------------------------------------------------ARTIKEL INDEX--------------------------->
                          <div class="x_panel">
                            <div class="x_title">
                              <h2> Tabel User <small>Daftar sesi yang telah dimasukkan</small></h2>
                              <ul class="nav navbar-right panel_toolbox">
                                <a id="add-btn" class="btn btn-success" data-toggle="modal" data-target="#myModalAdd"><label class="fa fa-plus-circle"></label>  Tambah User Baru</a>
                              </ul>
                              <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                              <table id="tabel-sesi" class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th align="center">Hari</th>
                                    <th align="center">Sesi</th>
                                    <th align="center">Dibuat pada</th>
                                    <th align="center">Dibuat oleh</th>
                                    <th align="center">Diupdate Pada</th>
                                    <th align="center">Diupdate oleh</th>
                                    <th align="center">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($semuaSesi as $sesi)
                                  @if( $sesi->deleted_at == NULL)
                                  <tr>
                                    <td valign="middle" >{{ $sesi->hari }}</td>
                                    <td valign="middle" >{{ $sesi->sesi }}</td>
                                    <td align="center" valign="middle">{{ $sesi->created_at }}</td>
                                    <td valign="middle">{{ $sesi->createdBy->fullname }}</td>
                                    <td align="center" valign="middle">{{ $sesi->updated_at }}</td>
                                    @if($sesi->updated_by == NULL)
                                    <td align="center" valign="middle"> - </td>
                                    @else
                                    <td valign="middle"> {{ $sesi->updatedBy->fullname }}</td>
                                    @endif

                                    <td valign="middle">
                                      <a id="edit-btn" class="btn btn-warning btn-xs edit_button" data-toggle="modal"
                                      data-id="{{ $sesi->id }}"
                                      data-hari="{{ $sesi->hari }}"
                                      data-sesi="{{ $sesi->sesi }}"
                                      data-target="#myModalUpdate"><span class="fa fa-pencil-square-o"></span> Edit</a>

                                      <!-- <a id="edit-btn" class="btn btn-warning btn-xs" href="{{ route('sesi.edit', $sesi->id) }}"><span class="fa fa-pencil-square-o"></span> Edit</a> -->
                                      <a id="delete-btn" class="btn btn-danger btn-xs" customParam="{{ route('sesi.destroy', $sesi->id) }}" href="#"><span class="fa fa-trash"></span> Hapus</a>
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


                          <!-------------------------------------------------------------------ARTIKEL TERHAPUS INDEX--------------------------->
                          <div class="x_panel">
                            <div class="x_title">
                              <h2> Tabel Sesi Terhapus <small>Daftar sesi yang telah dihapus</small></h2>
                              <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                              <table id="tabel-sesiTerhapus" class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th align="center">Hari</th>
                                    <th align="center">Sesi</th>
                                    <th align="center">Dihapus Pada</th>
                                    <th align="center">Dihapus oleh</th>
                                    <th align="center">Aksi</th>
                                  </tr>
                                </thead>


                                <tbody>
                                  @foreach($semuaSesi as $sesi)
                                  @if( $sesi->deleted_at != NULL)
                                  <tr>
                                    <td valign="middle" >{{ $sesi->hari }}</td>
                                    <td valign="middle" >{{ $sesi->sesi }}</td>
                                    <td align="center" valign="middle">{{ $sesi->deleted_at }}</td>
                                    <td valign="middle">{{ $sesi->deletedBy->fullname }}</td>
                                    <td valign="middle">
                                      <a id="restore-btn" class="btn btn-warning btn-xs" customParam="{{ route('sesiTerhapus.restore', $sesi->id) }}" href="#"><span class="fa fa-retweet"></span> Kembalikan Data</a>
                                    </td>
                                  </tr>
                                  @endif
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>

                        </div>







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
          <h4 class="modal-title">Add New Sesi</h4>
        </div>
        <div class="modal-body">
          <form name="formCreateUser" action="{{ route('sesi.store') }}" class="form-horizontal" method="post">
            {{ csrf_field() }}
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Hari
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="select2_singleHari form-control" required="" name="hari">
                <option></option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Sesi</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select class="select2_singleSesi form-control" required="" name="sesi">
                <option></option>
                @for($counter = 1;$counter<=5;$counter++)
                  <option value="{{ $counter }}">{{ $counter }}</option>
                @endfor
              </select>
            </div>
          </div>
          <div class="form-group modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
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
        <h4 class="modal-title">Update Sesi</h4>
      </div>
      <div class="modal-body">
        <form name="formUpdateUser" action="{{ route('sesi.update') }}" class="form-horizontal" method="post">
          {{ csrf_field() }}
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="id" class="form-control id" style="width:200px;"/>
        <div class="form-group">
          <label class="col-sm-3 control-label">Hari :</label>
          <div class="col-sm-8">
            <input type="text" name="hari" class="form-control hari" style="width:200px;"/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label">Sesi :</label>
          <div class="col-sm-8">
            <!-- <input type="text" name="sesi" class="form-control sesi" style="width:300px;"/> -->
            <select class="select2_singleSesi form-control" required="" name="sesi">
                <option value="{{ $sesi->sesi }}">{{ $sesi->sesi }}</option>
                @for($counter = 1;$counter<=5;$counter++)
                  @if($counter != $sesi->sesi)
                  <option value="{{ $counter }}">{{ $counter }}</option>
                  @endif
                @endfor
              </select>
          </div>
        </div>
        <div class="form-group modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
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
        var hari = $(this).data('hari');
        $(".hari").val(hari);
        var sesi = $(this).data('sesi');
        $(".sesi").val(sesi);

    });
    </script>

  <script>
      $(document).ready(function() {
        $(".select2_singleHari").select2({
          placeholder: "Pilih hari",
          allowClear: true
        });
        $(".select2_singleSesi").select2({
          placeholder: "Pilih sesi",
          allowClear: true
        });
      });
  </script>

  <script>
      var deleter = {

          linkSelector : "a#restore-btn",

          init: function() {
              $(this.linkSelector).on('click', {self:this}, this.handleClick);
          },

          handleClick: function(event) {
              event.preventDefault();

              var self = event.data.self;
              var link = $(this);

          swal({
              title: 'Apakah anda yakin?',
              text: "Data akan dipulihkan ke kondisi sebelum dihapus!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Restore',
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
                  'Data batal untuk dipulihkan',
                  'error'
                )
              }
            })
          },
      };

      deleter.init();
  </script>

  <script>
    $('#tabel-sesiTerhapus').dataTable();
</script>

@endsection
