@extends('adminlte::page')

@section('title', 'Registrar Bien')

@section('content_header')
    <h1>Registrar Bien</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-body">
                    <form role="form" method="POST" action="{{ route('bienes.store') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="ubicacion_id">Ubicación</label>
                                <select class="form-control" id="ubicacion_id" name="ubicacion_id">
                                    <option value="">Seleccione una ubicación</option>
                                    @foreach ($ubicaciones as $ubicacion)
                                        <option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="sede_id">Sede</label>
                                <select class="form-control" id="sede_id" name="sede_id" disabled>
                                    <option value="">Seleccione una sede</option>
                                </select>
                            </div>

                            <div class="form-group col-6{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required autofocus>
                                @if ($errors->has('nombre'))
                                    <span class="help-block">{{ $errors->first('nombre') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-6{{ $errors->has('categoria') ? ' has-error' : '' }}">
                                <label for="categoria">Categoría</label>
                                <select class="form-control" id="categoria_id" name="categoria_id">
                                    <option value="">Seleccione una categoria</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('categoria_id'))
                                    <span class="help-block">{{ $errors->first('categoria_id') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-6{{ $errors->has('modelo') ? ' has-error' : '' }}">
                                <label for="modelo">Modelo</label>
                                <input type="text" class="form-control" id="modelo" name="modelo" value="{{ old('modelo') }}" required>
                                @if ($errors->has('modelo'))
                                    <span class="help-block">{{ $errors->first('modelo') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-6{{ $errors->has('codigo') ? ' has-error' : '' }}">
                                <label for="codigo">Codigo</label>
                                <input type="text" class="form-control" id="codigo" name="codigo" value="{{ old('codigo') }}" required>
                                @if ($errors->has('codigo'))
                                    <span class="help-block">{{ $errors->first('codigo') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-6{{ $errors->has('cantidad') ? ' has-error' : '' }}">
                                <label for="cantidad">Cantidad</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ old('cantidad') }}" required>
                                @if ($errors->has('cantidad'))
                                    <span class="help-block">{{ $errors->first('cantidad') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-6{{ $errors->has('estatus') ? ' has-error' : '' }}">
                                <label for="estatus">Categoría</label>
                                <select class="form-control" id="estatus" name="estatus">
                                    <option value="">Seleccione una estatus</option>
                                    <option value="ACTIVO">ACTIVO</option>
                                    <option value="INACTIVO">INACTIVO</option>
                                </select>
                                @if ($errors->has('estatus'))
                                    <span class="help-block">{{ $errors->first('estatus') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-12{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                                <label for="descripcion">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
                                @if ($errors->has('descripcion'))
                                    <span class="help-block">{{ $errors->first('descripcion') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#ubicacion_id').on('change', function() {
                var ubicacionId = $(this).val();
                if (ubicacionId) {
                    $('#sede_id').prop('disabled', false);
                    $.ajax({
                        url: '{{ route('sedes.byUbicacion') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            ubicacion_id: ubicacionId
                        },
                        success: function(data) {
                            $('#sede_id').html(data.options);
                        }
                    });
                } else {
                    $('#sede_id').prop('disabled', true);
                    $('#sede_id').html('<option value="">Seleccione una sede</option>');
                }
            });
        });
    </script>
@stop