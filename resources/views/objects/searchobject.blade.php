@extends('layouts.main')

@section('title')
    БД -> Пошук по об'єкту
@endsection

@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <form class="form-horizontal" action="{{ route('objects.searchobject') }}" method="POST">
                <div class="form-group">
                    <label for="inputFio" class="col-xs-2 control-label">ФІО/Кличка</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="inputFio" id="inputFio" placeholder="ФІО/Кличка" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress" class="col-xs-2 control-label">Адреса</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="inputAddress" id="inputAddress" placeholder="Адреса" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputWork" class="col-xs-2 control-label">Робота</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="inputWork" id="inputWork" placeholder="Робота" value="">
                    </div>
                </div>
                <div class="form-group">
                        <label for="inputBirthDay" class="col-xs-2 control-label">Дата народження</label>
                    <div class="col-xs-5">
                        <input type="text" class="form-control" name="inputBirthDay1" id="inputBirthDay1" placeholder="з">
                    </div>
                    <div class="col-xs-5">
                        <input type="text" class="form-control" name="inputBirthDay2" id="inputBirthDay2" placeholder="по">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassport" class="col-xs-2 control-label">Паспорт</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="inputPassport" id="inputPassport" placeholder="Паспорт" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCode" class="col-xs-2 control-label">Ід. код</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="inputCode" id="inputCode" placeholder="Ід. код" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSource" class="col-xs-2 control-label">Джерело</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="inputSource" id="inputSource" placeholder="Джерело" value="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-5 col-md-2">
                        <button type="submit" class="btn btn-default">Знайти</button>
                    </div>
                </div>
                <input type="text" name="_token" value="{{ csrf_token() }}" hidden>
            </form>
        </div><!-- /.col-md-4 -->
    </div>
    <div class="row">
        @if (count($errors) > 0)
            <br>
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (isset($objects))
            @if ($objects->count() > 0)
                <div class="row">
                    <div class="col-md-12">
                        <h4>Виведено {{ $objects->count() }} із {{ $objects->total() }} знайдених записів</h4>
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                            <div class="btn-group" role="group">
                                <form action="{{ route('objects.getexcelfromlist') }}" method="POST">
                                    <button type="submit" class="btn btn-default" id="getexcelfromlist">Експортувати до Excel</button>
                                    <input type="text" name="_token" value="{{ csrf_token() }}" hidden>
                                    <input type="text" name="numberList" value="{{ json_encode($numberList) }}" hidden>
                                </form>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default" disabled="disabled">Звязати</button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default" disabled="disabled">Видалити</button>
                            </div>
                        </div>
                    </div>
                </div>
                    <br>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <tr>
                                <th>Ідентифікатор</th>
                                <th>ФІО</th>
                                <th>Адреса</th>
                                <th>Ред.</th>
                            </tr>
                            @foreach( $objects as $object)
                                <tr>
                                    <td>{{ $object->number }}</td>
                                    <td>{{ $object->object->fio }}</td>
                                    <td>{{ $object->object->address }}</td>
                                    <td>
                                        <a href="{{ route('objects.edit', ['object_id' => $object->object->id]) }}">Ред</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
    @endif
    @endif

            <script>
                var token = '{{ Session::token() }}';
                var url = '{{ route('objects.getexcelfromlist') }}';
            </script>
@endsection
