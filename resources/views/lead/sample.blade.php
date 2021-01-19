@extends('layouts.master')

@push('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
@endpush
@push('style')

@endpush

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Leads</li>
  </ol>
</nav>
<div class="container">
   
    <div class="row">
        <div class="col-12">
          <a href="javascript:void(0)" class="btn btn-info mb-2" id="create-new-lead">Add Lead</a> 
          
          <table class="table table-bordered" id="laravel_crud">
           <thead>
              <tr>
                 <th>Client Name</th>
                 <th>Clinet Email</th>
                 <th>Lead Date</th>
                 <th>Generated By</th>
                 <th>Lead Country</th>
                 <th>Lead Type</th>
                 <th>Recent Comment</th>
                 <th>Lead Status</th>
                 <th colspan="2">Action</th>
              </tr>
           </thead>
        
          </table>
         
       </div> 
    </div>
</div>
<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="leadCrudModal"></h4>
    </div>
    <div class="modal-body">
        <form id="leadForm" name="leadForm" class="form-horizontal">
           <input type="hidden" name="lead_id" id="lead_id">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="title" name="title" value="" required="">
                </div>
            </div>
 
            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-12">
                    <input class="form-control" id="description" name="description" value="" required="">
                </div>
            </div>
           
            <div class="item">
          <p>Your Full Legal Name (As Enrolled)</p>
          <div class="name-item">
            <input type="text" name="name" placeholder="First" />
            <input type="text" name="name" placeholder="Last" />
          </div>
        </div>
        <div class="item">
          <p>Major</p>
          <input type="text" name="name"/>
        </div>
        <div class="item">
          <p>Expected Year of Graduation</p>
          <input type="text" name="name"/>
        </div>
        <div class="item">
          <p>Address</p>
          <input type="text" name="name" placeholder="Street address"/>
          <input type="text" name="name" placeholder="Street address line 2"/>
          <div class="city-item">
            <input type="text" name="name" placeholder="City" />
            <input type="text" name="name" placeholder="Region" />
            <input type="text" name="name" placeholder="Postal / Zip code" />
            <select>
              <option value="">Country</option>
              <option value="1">Russia</option>
              <option value="2">Germany</option>
              <option value="3">France</option>
              <option value="4">Armenia</option>
              <option value="5">USA</option>
            </select>
          </div>
        </div>
        <div class="item">
          <p>Email</p>
          <input type="text" name="name"/>
        </div>
        <div class="item">
          <p>Phone</p>
          <input type="text" name="name"/>
        </div>
 
        <div class="item">
          <p>First date on which the events or issues occurred</p>
          <input type="date" name="name" required/>
          <i class="fas fa-calendar-alt"></i>
        </div>
        <div class="item">
          <p>Name(s) of the person(s) involved</p>
          <textarea rows="5"></textarea>
        </div>
     
        <div class="col-sm-offset-2 col-sm-10">
             <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save
             </button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        
    </div>
</div>
</div>
</div>
@endsection

@push('script')

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script>
  $(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#create-new-lead').click(function () {
        $('#btn-save').val("create-lead");
        $('#leadForm').trigger("reset");
        $('#leadCrudModal').html("Add New lead");
        $('#ajax-crud-modal').modal('show');
    });
 
    $('body').on('click', '#edit-lead', function () {
      var lead_id = $(this).data('id');
      $.get('leads/'+lead_id+'/edit', function (data) {
         $('#leadCrudModal').html("Edit lead");
          $('#btn-save').val("edit-lead");
          $('#ajax-crud-modal').modal('show');
          $('#lead_id').val(data.id);
          $('#title').val(data.title);
          $('#description').val(data.description);  
      })
   });

    $('body').on('click', '.delete-lead', function () {
        var lead_id = $(this).data("id");
        confirm("Are You sure want to delete !");
 
        $.ajax({
            type: "DELETE",
            url: "{{ url('leads')}}"+'/'+lead_id,
            success: function (data) {
                $("#lead_id_" + lead_id).remove();
                
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });   
  });
 
 if ($("#leadForm").length > 0) {
      $("#leadForm").validate({
 
     submitHandler: function(form) {

      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');
      if(actionType == 'create-lead') {
      $.ajax({
          data: $('#leadForm').serialize(),
          url: "{{ route('leads.add') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              var lead = '<tr id="lead_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.title + '</td><td>' + data.description + '</td>';
              lead += '<td><a href="javascript:void(0)" id="edit-lead" data-id="' + data.id + '" class="btn btn-info"><i class="far fa-edit"></i></a></td>';
              lead += '<td><a href="javascript:void(0)" id="delete-lead" data-id="' + data.id + '" class="btn btn-danger delete-lead"><i class="fas fa-trash-alt"></i></a></td></tr>';
                     
             
              $('#leads-crud').prepend(lead);
    
              $('#leadForm').trigger("reset");
              $('#ajax-crud-modal').modal('hide');
              $('#btn-save').html('Save Created');
              
          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Save Changes err');
          }
      });
    }
    else {           

      $.ajax({
          data: $('#leadForm').serialize(),
          url: "{{ route('leads.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              var lead = '<tr id="lead_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.title + '</td><td>' + data.description + '</td>';
              lead += '<td><a href="javascript:void(0)" id="edit-lead" data-id="' + data.id + '" class="btn btn-info"><i class="far fa-edit"></i></a></td>';
              lead += '<td><a href="javascript:void(0)" id="delete-lead" data-id="' + data.id + '" class="btn btn-danger delete-lead"><i class="fas fa-trash-alt"></i></a></td></tr>';
                     
              $("#lead_id_" + data.id).replaceWith(lead); 
              $('#leadForm').trigger("reset");
              $('#ajax-crud-modal').modal('hide');
              $('#btn-save').html('Save Updated');
              
          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Save updates err');
          }
      });
    }
    }
  })
}
   
  
</script>

@endpush

