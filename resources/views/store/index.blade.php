@extends('layouts.app')
@section('content')
<div class="container">
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="row ">
  <div class="col-md-9  mb-3">
      <a class="btn btn-success" href="{{route('stores.create')}}" >Create Store</a>
      <button class="btn btn-danger" id="delete_selected_btn">Delete Selected</button>
  </div>
  <div class="col-md-3" id="pagination-btn">
    {{$stores->links()}}
  </div>
</div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col"><input type="checkbox" id="select_all_checkbox"></th>
      <th scope="col">Name</th>
      <th scope="col">Category</th>
      <th scope="col">Address</th>
      <th scope="col">Description</th>
      <th scope="col">Created by</th>
      <th scope="col">Updated by</th>
    </tr>
  </thead>
  <tbody id="stores_table">

    @foreach ($stores as $store)
      <tr>
        <th scope="row"><input type="checkbox" class="row_checkbox" value="{{$store->id}}"></th>
        <td><a href="{{route('stores.edit',['store'=>$store])}}">{{$store->name}}</a></td>
        <td>{{$store->category->name}}</td>
        <td>{{$store->address}}</td>
        <td>{{$store->description}}</td>
        <td>
        @if(count($store->revisionHistory)>0)
          @foreach($store->revisionHistory as $history)
            @if($history->key == 'created_at' && !$history->old_value)
            {{ $history->userResponsible()->name }}
            @break
            @endif
            @if($loop->last)
              Not available
            @endif
          @endforeach
        @else
        Not avaiable
        @endif
      </td>
      <td>
        @if(count($store->revisionHistory)>0)
          @foreach($store->revisionHistory as $history)
            @if($history->key != 'created_at')
            {{ $history->userResponsible()->name}}
            @break
            @endif
          @endforeach
        @else
         Not available
        @endif
      </td>
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
            console.log(response);
            $("#pagination-btn").html(response.html);
            var tabledata="";
            var created_by="Not Avaiable";
            response.stores.data.forEach(store => {
              var url = '{{ route("stores.edit", ":id") }}';
              url = url.replace(':id', store.id);
              if(store.revision_history.length>0){
                store.revision_history.forEach(history => {
                  if(history.key=="created_at"){
                    created_by=history.user_id;
                  }
              });
              }
              tabledata+=`<tr>
                <th scope="row">${store.id}</th>
                <td><a href="${url}">${store.name}</a></td>
                <td>${store.category.name}</td>
                <td>${store.address}</td>
                <td>${store.description}</td>
                <td>${store.created_by}</td>
                <td>${store.updated_by}</td>
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

      $("#select_all_checkbox").click(function(){
          if($(this).is(':checked')){
            $(".row_checkbox").attr('checked',true);
            return;
          }
          $(".row_checkbox").attr('checked',false);
      });

      $("#delete_selected_btn").click(function(){
          var selected_rows=[];
          $(".row_checkbox").each(function(index){
              if(this.checked==true){
                selected_rows.push(this.value);
              }
          });
          var url='{{route("stores.destroy", ":id")}}';
          url = url.replace(':id', selected_rows);
          
          $.ajax({
            type:'delete',
            data:{"ids":selected_rows,"_token": "{{ csrf_token() }}"},
            url:url,
            success:function(response){
              if(response){
                $(".row_checkbox").each(function(index){
                  if(this.checked==true){
                      $(this).closest('tr').remove();
                  }   
                });
              }
            }
          });
      });
    });
</script>
@endsection