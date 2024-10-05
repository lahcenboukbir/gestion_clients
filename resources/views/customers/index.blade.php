@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Liste des clients</h5>
            </div>

            <div class="card-body">
                <table id="scroll-horizontal-datatable" class="table w-100 nowrap table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Entreprise</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr class="align-baseline">
                                <td>{{$customer->id}}</td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->company}}</td>
                                <td>
                                    <a href="{{route('customers.show', $customer->id)}}"
                                        class="btn btn-success btn-sm py-0 px-2">
                                        <span class="mdi mdi-eye-outline"></span>
                                    </a>

                                    <button type="button" class="btn btn-danger btn-sm py-0 px-2" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{$customer->id}}">
                                        <span class="mdi mdi-delete-outline"></span>
                                    </button>

                                    <div class="modal fade" id="deleteModal{{$customer->id}}" tabindex="-1"
                                        aria-labelledby="deleteModal{{$customer->id}}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="deleteModal{{$customer->id}}">
                                                        Supprimer {{$customer->name}}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{route('customers.destroy', $customer->id)}}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="button" class="btn btn-dark btn-sm py-0 px-2"
                                                            data-bs-dismiss="modal">
                                                            <span class="mdi mdi-close"></span></button>
                                                        <button type="submit" class="btn btn-danger btn-sm py-0 px-2">
                                                            <span class="mdi mdi-delete-outline"></span>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
