@extends('layouts.global')

@section('title')
    Order List
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif

    {{-- daftar user disini --}}
    
    <form action="{{route('orders.index')}}" class="form-inline">
        <input type="text" name="buyer_email" class="form-control mr-sm-2" value="{{Request::get('buyer_email')}}" placeholder="search by buyer email">
        
        <select name="status" class="custom-select mr-sm-2">
            <option value="">Any</option>
            <option value="SUBMIT" {{Request::get('status') === 'SUBMIT' ? 'selected':''}}>SUBMIT</option>
            <option value="PROCESS" {{Request::get('status') === 'PROCESS' ? 'selected':''}}>PROCESS</option>
            <option value="FINISH" {{Request::get('status') === 'FINISH' ? 'selected':''}}>FINISH</option>
            <option value="CANCEL" {{Request::get('status') === 'CANCEL' ? 'selected':''}}>CANCEL</option>
        </select>

        <input type="submit" value="Filter" class="btn btn-primary">
    </form>

    <hr class="my-3">

    <div class="table-responsive">
        <table class="table table-hover table-striped" width="100%">
            <thead>
                <tr>
                    <th class="font-weight-bold">Invoice Number</th>
                    <th class="font-weight-bold">Status</th>
                    <th class="font-weight-bold">Buyer</th>
                    <th class="font-weight-bold">Total Qty</th>
                    <th class="font-weight-bold">Order Date</th>
                    <th class="font-weight-bold">Total Price</th>
                    <th class="font-weight-bold">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{$order->invoice_number}}</td>
                        <td>
                            @if ($order->status === 'SUBMIT')
                                <span class="badge badge-pill badge-warning text-white">{{$order->status}}</span>
                            @elseif($order->status === 'PROCESS')
                                <span class="badge badge-pill badge-info text-white">{{$order->status}}</span>
                            @elseif($order->status === 'FINISH')
                                <span class="badge badge-pill badge-success text-white">{{$order->status}}</span>
                            @elseif($order->status === 'CANCEL')
                                <span class="badge badge-pill badge-dark text-white">{{$order->status}}</span>
                            @endif
                        </td>
                        <td>
                            {{$order->user->name}} <br>
                            {{$order->user->email}}
                        </td>
                        <td>{{$order->totalQuantity}} pc(s)</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->total_price}}</td>      
                        <td>
                            <a href="{{route('orders.edit', [$order->id])}}" class="btn btn-info text-white btn-sm">Edit</a>
                            {{-- <form action="{{route('books.destroy', [$book->id])}}" class="d-inline" method="POST" onsubmit="return confirm('move book to trash')">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" value="Trash" class="btn btn-danger btn-sm">
                            </form>
                            <a href="{{route('books.show', [$book->id])}}" class="btn btn-primary btn-sm">Detail</a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                {{$orders->appends(Request::all())->links()}}
            </ul>
        </nav>
    </div>
@endsection