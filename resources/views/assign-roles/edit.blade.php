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
                        <form action="{{ route('assign.roles.update', $user_role->user_id) }}" method="POST" class="row">
                            @csrf
                            @method('PUT')

                            <div class="col-md-6 mb-3">
                                <label for="users" class="form-label">user</label>
                                <select name="user_id" class="form-select" id="users">
                                    <option value="{{$user_role->user_id}}">{{$user_role->user_name}}</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="roles" class="form-label">role</label>
                                <select name="role_id" class="form-select" id="roles">
                                    @foreach ($roles as $role)
                                    <option value="{{$role->id}}" @if ($role->id === $user_role->role_id) selected @endif>{{$role->name}}</option>
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
