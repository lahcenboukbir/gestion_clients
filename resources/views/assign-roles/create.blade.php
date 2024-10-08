@role('admin')

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Affecter des Rôles</h5>
                </div>

                <div class="card-body">
                    <div>
                        <form action="{{ route('assign.roles.store') }}" method="POST" class="row">
                            @csrf

                            <div class="col-md-6 mb-3">
                                <label for="users" class="form-label">user</label>
                                <select name="user_id" class="form-select" id="users">
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="roles" class="form-label">role</label>
                                <select name="role_id" class="form-select" id="roles">
                                    @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <a href="{{ route('assign.roles.index') }}" class="btn btn-light">Retour</a>
                                <button class="btn btn-success" type="submit">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@endrole
