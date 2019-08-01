@extends('layouts.app')
@section('content')
<div class="container">
@if(isset($store))
  <form method="post" action="{{route('stores.update',['store'=>$store])}}">
  @method('PUT')
  @csrf
@else
    <form method="post" action="{{route('stores.store')}}">
      @csrf
@endif
  <div class="form-group">
    <label for="name">Store Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Nike Store" value="{{$store->name??old('name')}}">
    @error('name')
    <p class="text-danger">{{ $message }}</p>
    @enderror
  </div>
  <div class="form-group">
    <label for="address">Store Address</label>
    <textarea class="form-control" id="address" name="address" rows="3">{{$store->address??old('address')}}</textarea>
    @error('address')
    <p class="text-danger">{{ $message }}</p>
    @enderror
  </div>
  <div class="form-group">
    <label for="description">Store Description</label>
    <textarea class="form-control" id="description" name="description" rows="3">{{$store->description??old('description')}}</textarea>
    @error('description')
    <p class="text-danger">{{ $message }}</p>
    @enderror
  </div>
    <div class="form-group form-check">
    <input type="hidden" name="is_published" value="0">
    <input type="checkbox" {{(isset($store->is_published) && $store->is_published)|| old('is_published')?"checked":""}} class="form-check-input" name="is_published" id="is_published" value="1">
    <label class="form-check-label " for="is_published">Publish</label>
  </div>
   <div class="form-group">
    @if(isset($store))
    <div class="row">
      <div class="col-md-6">
        <input type="submit" class="btn btn-success" value="Update">
      </div>
    </div>
    @else
    <input type="submit" class="btn btn-success" value="Create">
    @endif
  </div>
</form>
@if(isset($store))
<form method="post" action="{{route('stores.destroy',['store'=>$store])}}">
  @method('delete')
  @csrf
  <button type="submit" class="btn btn-sm btn-danger float-right"><i class="fa fa-trash" aria-hidden="true"></i></button>
</form>
@endif
</div>
@endsection