@extends('layouts.main')

@section('title')
    БД -> Связи объекта
@endsection

@section('content')
    <tabs>
        <ul class="nav nav-tabs">
            <li role="presentation"><a href="{{ route('objects.edit', ['$object_id' => $object->id]) }}">Объект</a></li>
            <li role="presentation" class="active"><a href="#">Связи</a></li>
            <li role="presentation"><a href="#">База "Р"</a></li>
        </ul>
    </tabs>
    <div class="row" id="errors" style="display:none">
        <br>
        <div class="alert alert-danger">
            <ul>
                <li></li>
            </ul>
        </div>
    </div>
    <div class="row">
        @if (count($errors) > 0)
            <br>
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="row">
        <form action="" method="POST">
            <h3>Добавить связь</h3>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="inputObject1">Объект 1</label>
                        <input type="text" class="form-control" name="inputObject1" id="inputObject1" placeholder="Объект 1" value="{{ $object->fio }}" readonly>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="inputLinkType">Тип связи</label>
                    <select class="form-control" id="inputLinkType">
                        <option value="<="><=</option>
                        <option value="=>">=></option>
                        <option value="<=>"><=></option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-default" id="addlink">Создать</button>
                    </div>
                </div>
                <input type="text" name="_token" value="{{ csrf_token() }}" hidden>
            </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="inputObject2">Объект 2</label>
                    <input type="text" class="form-control" name="inputObject2" id="inputObject2" placeholder="Объект 2" value="">
            </div>
        </div>
        </form>
    </div>
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="addlink-modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Найден следующий объект. Добавить связь?</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-hover" id="table-modal">
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-primary">Да</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        var token = '{{ Session::token() }}';
        var url = '{{ route('objects.linkModal', ['object_id' => $object->id]) }}';
        var object1id = '{{ $object->id }}';
    </script>
@endsection