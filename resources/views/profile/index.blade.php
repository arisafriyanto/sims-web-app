@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <div class="mt-3 mb-3" style="max-width: 180px">
                    <img src="{{ asset('images/aris-apriyanto.png') }}" class="img-thumbnail rounded-circle" alt="Foto">
                </div>
                <div>
                    <h2 class="mb-4">{{ $user->name }}</h2>
                </div>

                <div class="row pt-1">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Kandidat</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0">@</span>
                                <input type="text" id="name"
                                    class="form-control form-control-lg border-start-0 ps-0" value="{{ $user->name }}"
                                    readonly>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="position" class="form-label">Posisi Kandidat</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0"><i
                                        class="fa-solid fa-code"></i></span>
                                <input type="text" id="position"
                                    class="form-control form-control-lg border-start-0 ps-0" value="{{ $user->position }}"
                                    readonly>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
