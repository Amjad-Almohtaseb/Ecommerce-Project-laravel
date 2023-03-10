@extends('admin.layouts.main')

@section('title') Dashboard @endsection

@section('content')

<style>
    .number-align-items {
        display: flex;
        justify-content: space-between;
        width: 85%;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h6 class="mb-sm-0 font-size-18">Dashboard</h6>
        </div>
    </div>
</div>

<div class="row">

    <!-- Admin and Employee -->

    @if(auth()->user()->user_role=='admin' || auth()->user()->user_role=='employee')

    <!--Number of Products Card -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar-xs me-3">
                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                            <i class="mdi mdi-shopping text-primary" style=" font-size: 24px;"></i>
                        </span>
                    </div>
                    <div class="number-align-items">
                        <h5 class="font-size-14 mb-0">Products</h5>
                        <h6 class="font-size-14 mb-0">{{App\Models\Product::where('store_id',
                            auth()->user()->store_id)->get()->count()}}</h6>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Number of Order Items Card -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar-xs me-3">
                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                            {{-- <i class="fas fa-shopping-cart text-success"></i> --}}
                            <i class="mdi mdi-package-variant-closed text-success" style=" font-size: 24px;"></i>

                        </span>
                    </div>
                    <div class="number-align-items">
                        <h5 class="font-size-14 mb-0">Ordered Items</h5>
                        <h6>{{App\Models\OrderItem::where('store_id', auth()->user()->store_id)->get()->count()}}
                        </h6>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endif

    <!-- Superadmin -->

    @if(auth()->user()->user_role=='superadmin')

    <!--Number of Category Card -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar-xs me-3">
                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                            <i class="fas fa-store text-primary"></i>
                        </span>
                    </div>
                    <div class="number-align-items">
                        <h5 class="font-size-14 mb-0">Number of Stores</h5>
                        <h6>{{App\Models\Store::get()->count()}}</h6>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Number of Orders Card -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar-xs me-3">
                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                            <i class="mdi mdi-package-variant-closed text-success" style=" font-size: 24px;"></i>
                        </span>
                    </div>
                    <div class="number-align-items">
                        <h5 class="font-size-14 mb-0">Orders</h5>
                        <h6>{{App\Models\Order::get()->count()}}</h6>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Number of Admin Card  -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar-xs me-3">
                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                            <i class="fas fa-user-secret text-info"></i>
                        </span>
                    </div>
                    <div class="number-align-items">
                        <h5 class="font-size-14 mb-0">Number of Admin</h5>
                        <h6>{{App\Models\User::where('user_role', 'admin')->get()->count()}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Number of Employee Card  -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar-xs me-3">
                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                            <i class="fas fa-user-tie text-info"></i>
                        </span>
                    </div>
                    <div class="number-align-items">
                        <h5 class="font-size-14 mb-0">Number of Employee</h5>
                        <h6>{{App\Models\User::where('user_role', 'employee')->get()->count()}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif

    <!-- New User Card -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar-xs me-3">
                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                            <i class="fas fa-users text-info"></i>
                        </span>
                    </div>
                    <div class="number-align-items">
                        <h5 class="font-size-14 mb-0">Number Of Customer</h5>
                        <h6>{{App\Models\User::where('user_role', 'customer')->get()->count()}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- end row -->

@endsection

@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- Saas dashboard init -->
<script src="{{ URL::asset('/assets/js/pages/saas-dashboard.init.js') }}"></script>
@endsection