<style>
    .table td,
    .table th {
        white-space: normal!important;
    }

    .avatar-sm-new {
        width: 75px !important;
        height: 75px !important;
        font-size: 0.875rem;
    }
    .crear {
    border: 2px solid #24b4fb;
    background-color: #24b4fb;
    border-radius: 0.9em;
    padding: 0.8em 1.2em 0.8em 1em;
    transition: all ease-in-out 0.2s;
    font-size: 14px;
    }

    .crear span {
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    font-weight: 600;
    }

    .crear:hover {
    background-color: #0071e2;
    }
    .notification {
        padding: 1rem;
        background-color: #28a745;
        color: #fff;
        border-radius: 5px;
        transition: opacity 0.5s, transform 0.5s;
        opacity: 0;
        transform: translateY(-20px);
    }

    .notification.show {
        /* Estilo para mostrar la notificación */
        opacity: 1;
        transform: translateY(0);
    }

    .radio-inputs {
  position: relative;
  display: flex;
  flex-wrap: wrap;
  border-radius: 0.5rem;
  background-color: #EC407A ;
  box-sizing: border-box;
  box-shadow: 0 0 0px 1px rgba(0, 0, 0, 0.06);
  padding: 0.25rem;
  width: 300px;
  font-size: 14px;
  margin-bottom: 20px;
}

.radio-inputs .radio {
  flex: 1 1 auto;
  text-align: center;
}

.radio-inputs .radio input {
  display: none;
}

.radio-inputs .radio .name {
  display: flex;
  cursor: pointer;
  align-items: center;
  justify-content: center;
  border-radius: 0.5rem;
  border: none;
  padding: .5rem 0;
  color: #2d2d2d;
  transition: all .15s ease-in-out;
}

.radio-inputs .radio input:checked + .name {
  background-color: #fff;
  font-weight: 600;
}


</style>

@extends('layout.template')

@section('content')
<div class="container">
    <div class="container-fluid py-4">
        <h1 class="mb-4">Eliminar Cita</h1>
        <div class="row">
            <div class="col-lg-6">
                <p>¿Estás seguro de que deseas eliminar la cita con ID <b>{{$cita->id_cita}}</b> para el usuario <b>{{ $cita->paciente->primer_nombre }} {{ $cita->paciente->primer_apellido }}</b>?</p>
                <form action="{{ route('Citas.destroy', ['id' => $cita->id_cita]) }}" method="POST" onsubmit="mostrarLoader()">
                    @csrf
                    @method('DELETE') {{-- Agregar este campo para indicar el método DELETE --}}
                    <button type="submit" class="btn btn-danger">Eliminar Cita</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
