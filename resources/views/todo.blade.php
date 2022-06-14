@extends('layouts.app')
@section('content')

    <div class="dashboard-wrapper">
        <div class="container-fluid  dashboard-content">
            <!-- ============================================================== -->
            <!-- pageheader -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">Yapılacaklar Listesi</h2>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end pageheader -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card p-5">
                        <div class="buttons d-flex justify-content-between">
                            <a  style="height: 40px;" class="btn btn-outline-success active w-25" data-toggle="modal" data-target="#todo_modal">
                                <i style="margin-right: 10px;" class="fa fa-plus"></i>Yapılacak İş Ekle
                            </a>
                            <a  style="height: 40px;" class="btn btn-primary active w-25" href="{{route('todo.get_excel_table')}}">
                                <i style="margin-right: 10px;" class="fa fa-file-csv"></i>İşlerin Excel Tablosunu Al
                            </a>
                            <!--- modal content-->
                            <div class="modal fade" id="todo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Yapılacak İş Ekle</h5>
                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </a>
                                        </div>
                                        <div class="modal-body">
                                            <form id="todo_form">
                                                <div style="margin-bottom: 30px;">
                                                    <label style="margin-left:-10px; white-space: nowrap" for="detail" class="col-2 col-form-label">Yapılacak İş</label>
                                                    <textarea style="margin-bottom: 20px" class="form-control" name="todo_item" id="todo_item" rows="3"></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#" class="btn btn-account" data-dismiss="modal">İptal</a>
                                                    <button type="submit" class="btn btn-success">Kaydet</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <table id="todo-table" class="display nowrap dataTable cell-border" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Yapılacak İş</th>
                                <th>Tamamlanma Durumu</th>
                                <th>Oluşturulma Tarihi</th>
                                <th>Güncelleme Tarihi</th>
                                <th>Güncelle</th>
                                <th>Sil</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Yapılacak İş</th>
                                <th>Tamamlanma Durumu</th>
                                <th>Oluşturulma Tarihi</th>
                                <th>Güncelleme Tarihi</th>
                                <th>Güncelle</th>
                                <th>Sil</th>
                            </tr>
                            </tfoot>
                        </table>

                        <!-- modal content -->
                        <div class="modal fade" id="todo_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> İş Detayları</h5>
                                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </a>
                                    </div>
                                    <form id="update_todo">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="hidden" id="update_todo_id" name="id">

                                                <label style="margin-left:-10px; white-space: nowrap" for="detail" class="col-2 col-form-label">Yapılacak İş</label>
                                                <textarea style="margin-bottom: 20px" class="form-control" name="todo_item" id="update_todo_item" rows="3"></textarea>

                                                <label style="margin-left:-10px; white-space: nowrap" for="inputText4" class="col-2 col-form-label">Tamamlanma Durumu</label>
                                                <select name="is_done" id="update_is_done" style="width: 100%;margin-bottom: 20px" class="form-control">
                                                    <option value="0">Tamamlanmadı!</option>
                                                    <option value="1">Tamamlandı!</option>
                                                </select >
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-default" data-dismiss="modal">Kapat</button>
                                            <button class="btn btn-primary" type="submit" id="button_submit">Kaydet</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript">
        $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                }
            });
        });

        //create form
        $( document ).on("submit",'#todo_form',function (event){
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url:"{{route('todo.create')}}",
                type:'POST',
                data:formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData:false,
                success: function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Başarılı',
                        html: 'Yapılacak iş başarıyla oluşturuldu!'
                    }).then(function (result){
                        if(result.value === true){
                            dataTable.ajax.reload();
                            $('#todo_modal').modal('hide');
                            $('#todo_item').val('');
                        }
                    });
                },
                error: function(data) {

                    var errors = '';
                    for(datas in data.responseJSON['errors']){
                        errors += data.responseJSON['errors'][datas] + '<br>';
                    }
                    //Sweet alert js function
                    Swal.fire({
                        icon:'error',
                        title:'<h1><b>Hata!</b></h1>',
                        html: '<h4>'+errors+'</h4>',
                        position: 'center',
                        height:'500px',
                        width:'600px',
                    });
                }
            });
        });
        // end of create form

        var dataTable = null;

        dataTable = $('#todo-table').DataTable( {
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Turkish.json'
            },
            order: [
                [0,'ASC']
            ],
            processing: true,
            serverSide: true,
            scrollX:true,
            scrollY:true,
            ajax: '{{route('todo.fetch')}}',
            columns: [
                {data:'id'},
                {data:'todo_item'},
                {data:'is_done'},
                {data:'created_at'},
                {data:'updated_at'},
                {data:'button_update'},
                {data:'button_delete'},
            ]
        } );

        function detail(id){
            $.ajax({
                type:'GET',
                data:{id:id},
                url:"{{route('todo.detail')}}",
                success: function (data){
                    $('#update_todo_id').val(data.id);
                    $('#update_todo_item').val(data.todo_item);
                    $('#update_is_done').val(data.is_done);
                    $('#todo_update').modal();
                }
            });
        }

        //update form
        $( document ).on("submit",'#update_todo',function (event){
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url:"{{route('todo.update')}}",
                type:'POST',
                data:formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData:false,
                success: function() {
                    dataTable.ajax.reload();
                    $('#todo_update').modal('hide');
                },
                error: function(data) {

                    var errors = '';
                    for(datas in data.responseJSON['errors']){
                        errors += data.responseJSON['errors'][datas] + '<br>';
                    }
                    //Sweet alert js function
                    Swal.fire({
                        icon:'error',
                        title:'<h1><b>Hata!</b></h1>',
                        html: '<h4>'+errors+'</h4>',
                        position: 'center',
                        height:'500px',
                        width:'600px',
                    });
                }
            });
        });
        // end of update form

        function change_is_done_status(id){
            $.ajax({
                type:'GET',
                data:{id:id},
                url:"{{route('todo.change_is_done_status')}}",
                success: function (){
                    dataTable.ajax.reload();
                }
            });
        }

        function remove(id){
            $.ajax({
                type:'GET',
                data:{id:id},
                url:"{{route('todo.delete')}}",
                success: function (){
                    dataTable.ajax.reload();
                }
            });
        }

    </script>
@endsection

