@extends('layouts.admin') 

@section('content')  
					<input type="hidden" id="headerdata" value="{{ __("Brands") }}">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __("Brands") }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }} </a>
											</li>
											<li>
												<a href="javascript:;">{{ \DB::table('brands')->where('id',$id)->pluck('name_en')->first() }} </a>
											</li>
										</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct">

                        @include('includes.admin.form-success')  

										<div class="table-responsiv">
												<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr>
									                        <th>{{ __("Name English") }}</th>
									                        <th>{{ __("Name Arabic") }}</th>
									                       
														</tr>
													</thead>
												</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>



{{-- HIGHLIGHT MODAL --}}

										<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal2" aria-hidden="true">
										
										
										<div class="modal-dialog highlight" role="document">
										<div class="modal-content">
												<div class="submit-loader">
														<img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
												</div>
											<div class="modal-header">
											<h5 class="modal-title"></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											</div>
											<div class="modal-body">

											</div>
											<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __("Close") }}</button>
											</div>
										</div>
										</div>
</div>

{{-- HIGHLIGHT ENDS --}}

{{-- CATALOG MODAL --}}

<div class="modal fade" id="BrandMove" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

	<div class="modal-header d-block text-center">
		<h4 class="modal-title d-inline-block">{{ __("Update Information") }}</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	</div>

    <form  action="{{ route('action_filter_brand') }}" id="action_form" method="GET" onsubmit="return ConfirmBrandMove();">
         
        <input type="hidden" name="inputArr" id="inputArr">
         <!-- Modal body -->
        <div class="modal-body">
            <div class="row">
    			<div class="col-lg-12">
    				<div class="left-area">
    					<h4 class="heading">{{ __('Brands') }}*</h4>
    				</div>
    			</div>
    			<div class="col-lg-12">
    				<select  name="brand_id" >
    					<option value="1">Brand 1</option>
    					<option value="2">Brand 2</option>
    					<option value="3">Brand 3</option>
    					<option value="4">Brand 4</option>
    				</select>
    			</div>
    		</div>
		
									
        </div>

          <!-- Modal footer -->
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cancel") }}</button>
            <button type="submit" class="btn btn-success" >{{ __("Submit") }}</button>
        </div>
    </form>
     

    </div>
  </div>
</div>

<div class="modal fade" id="categoryMove" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

	<div class="modal-header d-block text-center">
		<h4 class="modal-title d-inline-block">{{ __("Update Information") }}</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	</div>

    <form  action="{{ route('action_filter') }}" id="action_form2" method="GET" onsubmit="return ConfirmDelete();">
         
        <input type="hidden" name="inputArr" id="inputArr2">
         <!-- Modal body -->
        <div class="modal-body">
            <div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Category') }}*</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select id="cat" name="category_id" required="">
												<option value="">{{ __('Select Category') }}</option>
												@foreach(App\Models\Category::where('status','1')->get() as $cat)
												<option data-href="{{ route('admin-subcat-load',$cat->id) }}"
													value="{{ $cat->id }}">{{$cat->name_en}}</option>
												@endforeach
											</select>
										</div>
									</div>
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Sub Category') }}*</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select id="subcat" name="subcategory_id" disabled="">
												<option value="">{{ __('Select Sub Category') }}</option>
											</select>
										</div>
									</div>
		
									<div class="row">
										<div class="col-lg-12">
											<div class="left-area">
												<h4 class="heading">{{ __('Child Category') }}*</h4>
											</div>
										</div>
										<div class="col-lg-12">
											<select id="childcat" name="childcategory_id" disabled="">
												<option value="">{{ __('Select Child Category') }}</option>
											</select>
										</div>
									</div>
        </div>

          <!-- Modal footer -->
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cancel") }}</button>
            <button type="submit" class="btn btn-success" >{{ __("Submit") }}</button>
        </div>
    </form>
     

    </div>
  </div>
</div>


<div class="modal fade" id="catalog-modal" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

	<div class="modal-header d-block text-center">
		<h4 class="modal-title d-inline-block">{{ __("Update Status") }}</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	</div>


      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{ __("You are about to change the status of this Product.") }}</p>
            <p class="text-center">{{ __("Do you want to proceed?") }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cancel") }}</button>
            <a class="btn btn-success btn-ok">{{ __("Proceed") }}</a>
      </div>

    </div>
  </div>
</div>

{{-- CATALOG MODAL ENDS --}}


{{-- DELETE MODAL --}}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

	<div class="modal-header d-block text-center">
		<h4 class="modal-title d-inline-block">{{ __("Confirm Delete") }}</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	</div>

      <!-- Modal body -->
      <div class="modal-body">
            <p class="text-center">{{ __("You are about to delete this Product.") }}</p>
            <p class="text-center">{{ __("Do you want to proceed?") }}</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cancel") }}</button>
            <a class="btn btn-danger btn-ok">{{ __("Delete") }}</a>
      </div>

    </div>
  </div>
</div>


<div class="modal fade" id="confirm-delete_bulk"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

	<div class="modal-header d-block text-center">
		<h4 class="modal-title d-inline-block">{{ __("Confirm Delete") }}</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
	</div>
        <form  action="{{ route('action_filter_delete') }}" id="action_form1" method="GET" onsubmit="return ConfirmDeleteBulk();">
        <input type="hidden" name="inputArr" id="inputArr1">
              <!-- Modal body -->
              <div class="modal-body">
                    <p class="text-center">{{ __("You are about to delete this Product.") }}</p>
                    <p class="text-center">{{ __("Do you want to proceed?") }}</p>
              </div>
        
              <!-- Modal footer -->
              <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cancel") }}</button>
                    <button type="submit" class="btn btn-danger" >{{ __("Delete") }}</button>
              </div>
        </form>
    </div>
  </div>
</div>

{{-- DELETE MODAL ENDS --}}


{{-- GALLERY MODAL --}}

		<div class="modal fade" id="setgallery" tabindex="-1" role="dialog" aria-labelledby="setgallery" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">{{ __("Image Gallery") }}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">??</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="top-area">
						<div class="row">
							<div class="col-sm-6 text-right">
								<div class="upload-img-btn">
									<form  method="POST" enctype="multipart/form-data" id="form-gallery">
										{{ csrf_field() }}
									<input type="hidden" id="pid" name="product_id" value="">
									<input type="file" name="gallery[]" class="hidden" id="uploadgallery" accept="image/*" multiple>
											<label for="image-upload" id="prod_gallery"><i class="icofont-upload-alt"></i>{{ __("Upload File") }}</label>
									</form>
								</div>
							</div>
							<div class="col-sm-6">
								<a href="javascript:;" class="upload-done" data-dismiss="modal"> <i class="fas fa-check"></i> {{ __("Done") }}</a>
							</div>
							<div class="col-sm-12 text-center">( <small>{{ __("You can upload multiple Images") }}.</small> )</div>
						</div>
					</div>
					<div class="gallery-images">
						<div class="selected-image">
							<div class="row">


							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>


{{-- GALLERY MODAL ENDS --}}

@endsection    



@section('scripts')


{{-- DATA TABLE --}}

    <script type="text/javascript">

		var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin-prod-datatables9995',$id) }}',
               columns: [
                        
                        { data: 'name_en', name: 'name_en' },
                        { data: 'name_ar', name: 'name_ar' }
                     ],
                language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                },
				drawCallback : function( settings ) {
	    				$('.select').niceSelect();	
				}
            });

      												
									


{{-- DATA TABLE ENDS--}}


</script>


<script type="text/javascript">
	



    $(document).on("click", ".set-gallery" , function(){
        var pid = $(this).find('input[type=hidden]').val();
        $('#pid').val(pid);
        $('.selected-image .row').html('');
            $.ajax({
                    type: "GET",
                    url:"{{ route('admin-gallery-show') }}",
                    data:{id:pid},
                    success:function(data){
                      if(data[0] == 0)
                      {
	                    $('.selected-image .row').addClass('justify-content-center');
	      				$('.selected-image .row').html('<h3>{{ __("No Images Found.") }}</h3>');
     				  }
                      else {
	                    $('.selected-image .row').removeClass('justify-content-center');
	      				$('.selected-image .row h3').remove();      
                          var arr = $.map(data[1], function(el) {
                          return el });

                          for(var k in arr)
                          {
        				$('.selected-image .row').append('<div class="col-sm-6">'+
                                        '<div class="img gallery-img">'+
                                            '<span class="remove-img"><i class="fas fa-times"></i>'+
                                            '<input type="hidden" value="'+arr[k]['id']+'">'+
                                            '</span>'+
                                            '<a href="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" target="_blank">'+
                                            '<img src="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" alt="gallery image">'+
                                            '</a>'+
                                        '</div>'+
                                  	'</div>');
                          }                         
                       }
 
                    }
                  });
      });


  $(document).on('click', '.remove-img' ,function() {
    var id = $(this).find('input[type=hidden]').val();
    $(this).parent().parent().remove();
	    $.ajax({
	        type: "GET",
	        url:"{{ route('admin-gallery-delete') }}",
	        data:{id:id}
	    });
  });

  $(document).on('click', '#prod_gallery' ,function() {
    $('#uploadgallery').click();
  });
                                        
                                
  $("#uploadgallery").change(function(){
    $("#form-gallery").submit();  
  });

  $(document).on('submit', '#form-gallery' ,function() {
		  $.ajax({
		   url:"{{ route('admin-gallery-store') }}",
		   method:"POST",
		   data:new FormData(this),
		   dataType:'JSON',
		   contentType: false,
		   cache: false,
		   processData: false,
		   success:function(data)
		   {
		    if(data != 0)
		    {
	                    $('.selected-image .row').removeClass('justify-content-center');
	      				$('.selected-image .row h3').remove();   
		        var arr = $.map(data, function(el) {
		        return el });
		        for(var k in arr)
		           {
        				$('.selected-image .row').append('<div class="col-sm-6">'+
                                        '<div class="img gallery-img">'+
                                            '<span class="remove-img"><i class="fas fa-times"></i>'+
                                            '<input type="hidden" value="'+arr[k]['id']+'">'+
                                            '</span>'+
                                            '<a href="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" target="_blank">'+
                                            '<img src="'+'{{asset('assets/images/galleries').'/'}}'+arr[k]['photo']+'" alt="gallery image">'+
                                            '</a>'+
                                        '</div>'+
                                  	'</div>');
		            }          
		    }
		                     
		                       }

		  });
		  return false;
 }); 


// Gallery Section Update Ends	

  
$(document).ready(function(){
   // Check or Uncheck All checkboxes
   $("#checkAll").change(function(){
     var checked = $(this).is(':checked');
     if(checked){
       $(".checkbox").each(function(){
         $(this).prop("checked",true);
       });
     }else{
       $(".checkbox").each(function(){
         $(this).prop("checked",false);
       });
     }
   });
 
  // Changing state of CheckAll checkbox 
  $(".checkbox").click(function(){
 
    if($(".checkbox").length == $(".checkbox:checked").length) {
      $("#checkAll").prop("checked", true);
    } else {
      $("#checkAll").removeAttr("checked");
    }

  });
});

function ConfirmDelete(){
  var input = [] ;

  $(".checkbox:checked").each(function(){
    input.push($(this).val());
  });
    
  if(input.length == 0){
    alert('Please select some Products first ?') ;
    return false;
  }
  document.getElementById('inputArr2').value = input ;
  document.getElementById("action_form2").submit() ;

}


function ConfirmDeleteBulk(){
    var input = [] ;

  $(".checkbox:checked").each(function(){
    input.push($(this).val());
  });
    
  if(input.length == 0){
    alert('Please select some Products first ?') ;
    return false;
  }
  document.getElementById('inputArr1').value = input ;
  document.getElementById("action_form1").submit() ;
}


function ConfirmBrandMove(){
    var input = [] ;

  $(".checkbox:checked").each(function(){
    input.push($(this).val());
  });
    
  if(input.length == 0){
    alert('Please select some Products first ?') ;
    return false;
  }
  document.getElementById('inputArr').value = input ;
  document.getElementById("action_form").submit() ;
}
</script>




@endsection   