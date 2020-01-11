@extends('layouts.global')


@section('title')
    Edit  Order
@endsection


@section('content')
<div class="row">
    <div class="col">
        <form action="{{route('orders.update', [$order->id])}}" method="POST" class="shadow-sm p-3 bg-white" autocomplete="off">
            
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="invoice">Invoice Number</label>
                <input type="text" name="invoice" id="invoice" class="form-control" value="{{$order->invoice_number}}" disabled>
            </div>
            
            <div class="form-group">
                <label for="buyer">Buyer</label>
                <input type="text" name="buyer" id="buyer" class="form-control" value="{{$order->user->name}}" disabled>
            </div>

            <div class="form-group">
                <label for="created">Created At</label>
                <input type="text" name="created" id="created" class="form-control" disabled="disabled" value="{{$order->created_at}}">
            </div>

            <div class="form-group">
                <label for="book"> Books ({{$order->totalQuantity}})</label>
                <ul>
                    @foreach ($order->books as $book)
                        <li>{{$book->title}} <b>{{$book->pivot->quantity}}</b></li>
                    @endforeach
                </ul>
            </div>

            <div class="form-group">
                <label for="total">Total Price</label>
                <input type="text" name="total" id="total" class="form-control" value="{{$order->total_price}}">
            </div>

            <div class="form-group">
                <label for="status">Status Order</label>
                <select name="status" id="status" class="form-control">
                    <option value="SUBMIT" {{$order->status === 'SUBMIT' ? 'selected' : ''}}>SUBMIT</option>
                    <option value="PROCESS" {{$order->status === 'PROCESS' ? 'selected' : ''}}>PROCESS</option>
                    <option value="FINISH" {{$order->status === 'FINISH' ? 'selected' : ''}}>FINISH</option>
                    <option value="CANCEL" {{$order->status === 'CANCEL' ? 'selected' : ''}}>CANCEL</option>
                </select>
            </div>
            
            <div class="ml-0">
                {{-- <button class="btn btn-primary">UPDATE</button> --}}
                <input type="submit" value="Update" class="btn btn-primary">
                <a href="{{route('orders.index')}}" class="btn btn-warning text-white">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
