@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
<div class="card">
  <h5 class="card-header">Order Edit</h5>
  <div class="card-body">
    <form action="{{route('order.update',$order->id)}}" method="POST">
      @csrf
      @method('PATCH')
      <div class="form-group">
        <label for="status">Status :</label>
        <select name="status" id="" class="form-control">
          <option value="">--Select Status--</option>
          <option value="new" {{(($order->status=='new')? 'selected' : '')}}>New</option>
          <option value="process" {{(($order->status=='process')? 'selected' : '')}}>process</option>
          <option value="delivered" {{(($order->status=='delivered')? 'selected' : '')}}>Delivered</option>
          <option value="cancel" {{(($order->status=='cancel')? 'selected' : '')}}>Cancel</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>
@endsection

@push('styles')
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }

</style>
<script>
    var map = new GMaps({
      el: '#map',
      zoom: 6,
      lat: 34.73497454450926,
      lng: 10.769978323699938,
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
@endpush
