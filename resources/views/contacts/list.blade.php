@extends('layouts.main')
@section('title', $page_name)
@section('body')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">{{ __('admin.manage') }} {{ $page_name }}</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{ __('admin.home') }}</a></li>
          <li class="breadcrumb-item active">{{ __('admin.manage') }} {{ $page_name }}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Error content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        @if(Session::has('success'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-check"></i> {{ $page_name }} {{ Session::get('success') }}
              @php
                  Session::forget('success');
              @endphp
          </div>
          @endif
      </div>
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card card-warning card-outline direct-chat-warning">
        <div class="card-header">
          <h3 class="card-title">
            <a href="{{route($page_add)}}" class="btn btn-warning btn-sm"><i class="fas fa-plus"></i> {{ __('admin.add') }} {{ $page_name }}</a>
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="list_table" class="table table-bordered table-striped w-100">
            <thead>
            <tr>
              <th>#</th>
              <th>{{ __('admin.name') }}</th>
              <th>{{ __('admin.email') }}</th>
              <th>{{ __('admin.mobile') }}</th>
              <th>{{ __('admin.designation') }}</th>
              <th>{{ __('admin.company_name') }}</th>
              <th class="text-center">{{ __('admin.action') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rows as $key => $row)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$row->fname}} {{$row->lname}}</td>
              <td>{{$row->email}}</td>
              <td>{{$row->mobile}}</td>
              <td>{{$row->designation}}</td>
              <td>{{$row->company_name}}</td>
              <td class="text-center">
                <a href="{{route($page_update,$row->id)}}" class="btn btn-sm bg-gradient-primary" data-bs-toggle="tooltip" title="{{ __('admin.edit') }}"><i class="fas fa-edit"></i></a>
                <form class="d-inline-block" id="form_{{$row->id}}" action="{{route($page_delete,$row->id)}}" method="post">
                  @csrf
                  <button type="button" data-form="#form_{{$row->id}}" class="btn btn-sm bg-gradient-danger delete-btn" data-bs-toggle="tooltip" title="{{ __('admin.delete') }}"><i class="fas fa-trash"></i></button>
                </form>
                <button type="button" class="btn btn-sm bg-gradient-{{($row->published)?'success':'warning'}} toggle-published"  data-bs-toggle="tooltip" title="{{ ($row->published) ? __('admin.inactive') : __('admin.active') }}" data-id="{{$row->id}}" data-is-published="{{($row->published)}}"><i class="fas fa-{{($row->published)?'check-circle':'ban'}}"></i></button>
              </td>
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('script')
<script>
  $(function () {
    $('#list_table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      "columnDefs": [
        { "width": "5%", "targets": 0 },
        { "width": "15%", "targets": 1 },
        { "width": "15%", "targets": 2 },
        { "width": "10%", "targets": 3 },
        { "width": "20%", "targets": 4 },
        { "width": "20%", "targets": 5 },
        { "width": "15%", "targets": 6 },
      ]
    });
  });

  $(function () {
    $('.toggle-published').on('click',function() {
      var buttonObject = $(this);
      var id = $(this).data('id');
      var isPublished = $(this).data('is-published') ? 0 : 1;
      $.ajax({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:"POST",
        url: "{{route($page_publish_unpublish)}}",
        data:{'id':id,'published':isPublished},
        success:function(data){
          if(data.error) {
            toastr.error(data.error)
          } else {
            toastr.success("{{ $page_name }} "+data.success)
            $(buttonObject).data('is-published',isPublished)
            $(buttonObject).toggleClass('bg-gradient-success bg-gradient-warning')
            $(buttonObject).tooltip('hide').attr('data-original-title', isPublished ? 'Inactive' : 'Active').tooltip('show');
            $(buttonObject).find('i').toggleClass('fa-check-circle fa-ban')
          }
        },  
        error: function(XMLHttpRequest, textStatus, errorThrown) {

        }
      })
    })
  });

  $(function () {
    $(".delete-btn").on('click', function(e) {
      var form = $(this).data('form');
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $(form).submit()
        }
      })
    })
  })
</script>
@endsection