<x-loading-indicatore />
@extends('admin.layouts.main')

@section('title') View admin @endsection

@section('content')
<!-- Breadcrumb -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Admins & Employees Table</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class=" breadcrumb-item"><a href="{{route('store.view')}}">Stores Table</a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="text-decoration-line: underline;">Admins & Employees Table</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb -->

<div class="row">
    <div class="col-12">
        <div class="card">
            @if(session()->has('status'))
                <div style="background-color:#ef5b69" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle pr-2"></i>
                    <strong>{{session()->get('status')}}</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card-body">
                {!! Toastr::message() !!}
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap" style="font-size:13px">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th colspan="3">Action</th>
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($adminsAndEmployees as $key=>$adminOrEmployee)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $adminOrEmployee->name }}</td>
                                <td>{{ $adminOrEmployee->email }}</td>
                                <td style="text-align: center;">{{ $adminOrEmployee->phone_number ? $adminOrEmployee->phone_number :'-' }}</td>
                                <td style="text-align: center;">{{ $adminOrEmployee->address ? $adminOrEmployee->address : '-' }}</td>
                                <td>{{ $adminOrEmployee->user_role }}</td>
                                
                                <!-- Button Edit -->
                                <td>
                                    <a href=" {{route('admin.edit', [$adminOrEmployee->id])}} ">
                                        <button class="bg-color-btn" style="color:#198754;"><i
                                                class="fas fa-edit"></i></button>
                                    </a>
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button class="bg-color-btn" type="button" data-toggle="modal" data-target="#exampleModal{{$adminOrEmployee->id}}" style="color: #dc3545;border:none">
                                        <i class="mdi mdi-trash-can font-size-20"></i> 
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$adminOrEmployee->id}}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action=" {{ route('admin.delete', [$adminOrEmployee->id]) }} "
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure you
                                                            want to delete {{$adminOrEmployee->name}}? </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger"
                                                            data-dismiss="submit">Delete</button>
                                                    </div>
                                                </div>
                                            </form>
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
</div>
    <!---Container Fluid-->

@endsection