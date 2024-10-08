@role('admin')

    @extends('layouts.app')

    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ $role->name }}</h5>
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($role_permissions as $role_permission)
                                <li class="list-group-item">
                                    {{ $role_permission->name }}
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-3">
                            <a href="{{ route('roles.index') }}" class="btn btn-light">Retour</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

@endrole
