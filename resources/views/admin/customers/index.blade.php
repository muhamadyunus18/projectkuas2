@extends('admin.layouts.app')

@section('title', 'Customers')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customers</h1>
    </div>
    <form method="GET" class="mb-3">
        <div class="input-group" style="max-width:350px;">
            <input type="text" name="search" class="form-control" placeholder="Cari nama/email/telepon..." value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Total Pesanan</th>
                            <th>Total Belanja</th>
                            <th>Tanggal Daftar</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                            <tr>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone ?? '-' }}</td>
                                <td>{{ $customer->address ?? '-' }}</td>
                                <td>{{ $customerStats[$customer->_id]['orders_count'] ?? 0 }}</td>
                                <td>Rp {{ number_format($customerStats[$customer->_id]['orders_sum_total'] ?? 0, 0, ',', '.') }}</td>
                                <td>{{ $customer->created_at ? \Carbon\Carbon::parse($customer->created_at)->format('d-m-Y') : '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.customers.show', $customer) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No customers found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $customers->links() }}
        </div>
    </div>
</div>
@endsection 