@extends('layouts.app')
@section('content')
<div class="container">
<div class="row ">
  <div class="col-md-3">
      <a class="btn btn-success mb-3" href="{{route('stores.create')}}" >Create Store</a>
  </div>
  <div class="col-md-6">
      <div class="input-group">
        <input type="search" class="form-control" id="search_inp" placeholder="Search ..">
      </div>
  </div>
  <div class="col-md-3" id="pagination-btn">
    {{$stores->links()}}
  </div>
</div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Address</th>
      <th scope="col">Description</th>
    </tr>
  </thead>
  <tbody id="stores_table">

    @foreach ($stores as $store)
      <tr>
        <th scope="row">{{$store->id}}</th>
        <td><a href="{{route('stores.edit',['store'=>$store])}}">{{$store->name}}</a></td>
        <td>{{$store->address}}</td>
        <td>{{$store->description}}</td>
      </tr>
    @endforeach

  </tbody>
</table>

</div>

<script>
    $(document).ready(function(){
      $(document).on('click', '.page-link', function(){
        event.preventDefault();
        var url=$(this).attr('href');
        $.ajax({
          type:'get',
          dataType: 'json',
          url:url,
          success:function(response){
            $("#pagination-btn").html(response.html);
            var tabledata="";
            response.stores.data.forEach(store => {
              var url = '{{ route("stores.edit", ":id") }}';
              url = url.replace(':id', store.id);
              tabledata+=`<tr>
                <th scope="row">${store.id}</th>
                <td><a href="${url}">${store.name}</a></td>
                <td>${store.address}</td>
                <td>${store.description}</td>
                </tr>`;
            });
            $("#stores_table").html(tabledata);
          }
        });
      });

      $("#search_inp").on('keypress',function(e) {
        if(e.which == 13) {
            var searchText=$(this).val();
            alert(searchText);
        }
      });
    });
</script>
@endsection