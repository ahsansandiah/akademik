@extends('template')

@section('title', 'List Guru')
@section('page-title', 'Input Data Guru')
@section('content')

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">

                <a data-toggle="modal" data-target="#add" class="btn bg-purple " font-16" style="margin-bottom:30px;">Tambah</a>

                    <table class="table table-striped" style="width: 100%;">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Nama Depan</th>
                                <th>Nama Belakang</th>
                                <th>Alamat</th>
                                <th>No Telepon</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = $data->firstItem();?>
                            @if($data->count())  
                            @foreach($data as $val)  
                            <tr>
                                <td>{{ $no++}}</td>
                                <td>{{ $val->nip or "-" }}</td>
                                <td>{{ $val->user->name or "-"}}</td>
                                <td>{{ $val->nama_depan or "-"}}</td>
                                <td>{{ $val->nama_belakang or "-"}}</td>
                                <td>{{ $val->alamat or "-"}}</td>
                                <td>{{ $val->no_telp or "-"}}</td>
                                <td>
                                    <a data-toggle="modal" data-target="#edit{{$val->id}}"><span class="fa fa-pencil"></span></a>
                                    <a href="{{url('data-guru/detail', $val->id)}}"><i class="fa fa-eye"></i></a>      
                                    <a href="{{action('Guru\DataGuruController@destroy',$val->id)}}" id="hapus" ><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">No Records found !!</td>
                                    </tr>
                                @endif
                        </tbody>
                    </table>
                {{$data->render()}}
            </div>
        </div>

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('data-guru.store') }}" enctype="multipart/form-data">
                           {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Guru</h4>
                        </div>
                        <div class="modal-body">                                       
                            <div class="form-group" {{$errors->has('nip') ? 'has-error' : ''}}>
                                <label for="">NIP</label>
                                <input type="text" name="nip" id="nip" class="form-control input-sm" required>
                                <span class="text-danger">{{ $errors->first('nip') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="">User</label>
                                <input type="text" id="user_id" class="form-control" autocomplete="off" required>
                                <input type="hidden" name="user_id" id="userValue" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Depan</label>
                                <input type="text" name="nama_depan" id="nama_depan" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Belakang</label>
                                <input type="text" name="nama_belakang" id="nama_belakang" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">No Telepon</label>
                                <input type="text" name="no_telp" id="no_telp" class="form-control input-sm" required>
                            </div>                                                       
                        </div>
                        <div class="modal-footer">
                            <div>
                                 <input type="submit" value="Simpan" class="btn btn-subscribe" >
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>      

        @foreach($data as $val)
        <div class="modal fade" id="edit{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('data-guru.update',$val->id) }}" >
                    {{ csrf_field() }}
                    <input name="_method" type="hidden" value="PATCH">
                        <div class="modal-header">
                            <h4>Edit Data Guru</h4>
                        </div>
                        <div class="modal-body">                                         
                            <div class="form-group" {{$errors->has('nip') ? 'has-error' : ''}}>
                                <label for="">NIP</label>
                                <input type="text" value="{{ $val->nip }}" name="nip" id="nip" class="form-control input-sm" required>
                                 <span class="text-danger">{{ $errors->first('nip') }}</span>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="user_id" id="user_id2" value="{{ $val->user->name or "-" }}" class="form-control" placeholder="Nama" autocomplete="off" required>
                                <input type="hidden" value="{{ $val->user_id }}" name="user_id2" id="userValue2" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Depan</label>
                                <input type="text" value="{{ $val->nama_depan }}" name="nama_depan" id="nama_depan" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Belakang</label>
                                <input type="text" value="{{ $val->nama_belakang }}" name="nama_belakang" id="nama_belakang" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" value="{{ $val->alamat }}" name="alamat" id="alamat" class="form-control input-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="">No Telepon</label>
                                <input type="text" value="{{ $val->no_telp }}" name="no_telp" id="no_telp" class="form-control input-sm" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div>
                                <input type="submit"  value="Simpan" class="btn btn-subscribe" >
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>  
        @endforeach
    </section>
</div>

@endsection

@section('script')

@include('sweet::alert')
<script src="{{ asset('adminlte/bower_components/bootstrap-typeahead.js') }}"></script>  
<script src="{{ asset('adminlte/bower_components/jquery.mockjax.js') }}"></script>  
<script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<script type="text/javascript">
    $(function() {
        function displayResult(item) {            
            $("#userValue").val(item.value);
        }
        $('#user_id').typeahead({
            source: [
                @foreach($user as $value)
                    { id: {{ $value['id'] }}, name: '{{ $value['name'] }}' },
                @endforeach
            ],
            onSelect: displayResult
        });
    });

</script>

<script type="text/javascript">
    $(function() {
        function displayResult(item) {            
            $("#userValue2").val(item.value);
        }
        $('#user_id2').typeahead({
            source: [
                @foreach($user as $value)
                    { id: {{ $value['id'] }}, name: '{{ $value['name'] }}' },
                @endforeach
            ],
            onSelect: displayResult
        });
    });

</script>


@endsection



