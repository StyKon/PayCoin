@extends('backend.layouts.master')
@section('title','PayCoin || Provider Edit')
@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Provider</h5>
    <div class="card-body">
      <form method="post" action="{{route('provider.update',$provider->id)}}">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="inputCompany" class="col-form-label">Company Name <span class="text-danger">*</span></label>
        <input id="inputCompany" type="text" name="companyname" placeholder="Enter Company Name"  value="{{$provider->companyname}}" class="form-control">
        @error('companyname')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="inputFirstName" class="col-form-label">First Name <span class="text-danger">*</span></label>
        <input id="inputFirstName" type="text" name="firstname" placeholder="Enter First Name"  value="{{$provider->firstname}}" class="form-control">
        @error('firstname')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="inputLastName" class="col-form-label">Last Name <span class="text-danger">*</span></label>
        <input id="inputLastName" type="text" name="lastname" placeholder="Enter Last Name"  value="{{$provider->lastname}}" class="form-control">
        @error('lastname')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="inputPhone1" class="col-form-label">Phone 1 <span class="text-danger">*</span></label>
        <input id="inputPhone1" type="text" name="phone1" placeholder="Enter Phone 1"  value="{{$provider->phone1}}" class="form-control">
        @error('phone1')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="inputPhone2" class="col-form-label">Phone 2 <span class="text-danger">*</span></label>
        <input id="inputPhone2" type="text" name="phone2" placeholder="Enter Phone 2"  value="{{$provider->phone2}}" class="form-control">
        @error('phone2')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="inputAdresse" class="col-form-label">Adresse <span class="text-danger">*</span></label>
        <input id="inputAdresse" type="text" name="adresse" placeholder="Enter Adresse"  value="{{$provider->adresse}}" class="form-control">
        @error('adresse')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="inputEmail" class="col-form-label">Email <span class="text-danger">*</span></label>
        <input id="inputEmail" type="text" name="email" placeholder="Enter Email"  value="{{$provider->email}}" class="form-control">
        @error('email')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="form-group">
          <label for="cat_id">Category <span class="text-danger">*</span></label>
          <select name="cat_id" id="cat_id" class="form-control">
              <option value="">--Select any category--</option>
              @foreach($categories as $key=>$cat_data)
                  <option value='{{$cat_data->id}}' {{(($provider->cat_id==$cat_data->id)? 'selected' : '')}}>{{$cat_data->title}}</option>
              @endforeach
          </select>
        </div>

        {{-- {{$product->child_cat_id}} --}}
        <div class="form-group {{(($provider->child_cat_id)? '' : 'd-none')}}" id="child_cat_div">
          <label for="child_cat_id">Child Category</label>
          <select name="child_cat_id[]" id="child_cat_id" class="form-control" multiple>
              <option value="">--Select any child category--</option>

          </select>
        </div>

        <div class="form-group">
          <label for="inputPhoto" class="col-form-label">Logo <span class="text-danger">*</span></label>
          <div class="input-group">
              <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                  <i class="fa fa-picture-o"></i> Choose
                  </a>
              </span>
          <input id="thumbnail" class="form-control" type="text" name="logo" value="{{$provider->logo}}">
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          @error('logo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div  class="row">
        <div class="col-md-6">
        <div id="map"></div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
        <input id="lat" type="text" name="lat" placeholder="lat"  value="{{$provider->lat}}" class="form-control" >
        @error('lat')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>
        <div class="form-group">
         <input id="long" type="text" name="long" placeholder="Long"  value="{{$provider->long}}" class="form-control" >
        @error('long')
        <span class="text-danger">{{$message}}</span>
        @enderror
        </div>
        </div>
        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Write short description.....",
        tabsize: 2,
        height: 150
    });
    });
</script>

<script>
    var map=new GMaps({
      el: '#map',
      zoom: 6,
      lat: 34.8793046018861,
      lng: 10.445881644012438,
      click: function(e) {
        // alert('click');
        var latLng = e.latLng;
        console.log(latLng);
        var lat = $('#lat');
        var long = $('#long');
        lat.val(latLng.lat());
        long.val(latLng.lng());
        map.removeMarkers();
        map.addMarker({
            lat: latLng.lat(),
            lng: latLng.lng(),
            title: 'Create Here',
            click: function(e) {
                alert('You clicked in this marker');
            }
        });

    },
});

@isset($provider)
map.addMarker({
    lat: {{$provider->lat}},
    lng: {{$provider->long}},
    title: 'Create Here',
    click: function(e) {
        alert('You clicked in this marker');
    }
});
@endisset
</script>

<script>
  var  child_cat_id='{{$child_cat_id}}'.match(/\d/g);
        // alert(child_cat_id);
        $('#cat_id').change(function(){
            var cat_id=$(this).val();

            if(cat_id !=null){
                // ajax call
                $.ajax({
                    url:"/admin/category/"+cat_id+"/child",
                    type:"POST",
                    data:{
                        _token:"{{csrf_token()}}"
                    },
                    success:function(response){
                        if(typeof(response)!='object'){
                            response=$.parseJSON(response);
                        }
                        var html_option="<option value=''>--Select any one--</option>";
                        if(response.status){
                            var data=response.data;
                            if(response.data){
                                $('#child_cat_div').removeClass('d-none');
                                $.each(data,function(id,title){
                                    html_option += "<option value='"+id+"' "+(child_cat_id.includes(id) ? 'selected ' : '')+">"+title+"</option>";
                                });
                            }
                            else{
                                console.log('no response data');
                            }
                        }
                        else{
                            $('#child_cat_div').addClass('d-none');
                        }
                        $('#child_cat_id').html(html_option);

                    }
                });
            }
            else{
            }

        });
        if(child_cat_id!=null){
            $('#cat_id').change();
        }
        /**************************************** */

</script>
@endpush
