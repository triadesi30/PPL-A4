@extends('layout.template-about')
@section('content')
<style>
    body {
        background-color:#dfeef7;        
    }
</style>

<div class='container-fluid page-wrap' style='padding-top:6%; padding-bottom:3%;' >
	<div class='news'>
		<div class="row">
           
        <div class="col-xs-8 col-xs-offset-1 col-md-6 col-md-offset-1 layout" style="border-radius:5px;">

            <h2>Find your favorite pet!</h2>
            @include('common.error')
            <form method="POST">
                {!! csrf_field() !!}
                <div class="form-inline">
                    <div class="form-group">
                    <label class="in-form" for="exampleInputEmail1" style="display:block;">Domicile</label>
                    <select class="form-control" name="domicile">
                        <option value="" disabled selected>Select your domicile</option>
                        <option value="1">Jakarta Utara</option>
                        <option value="2">Jakarta Timur</option>
                        <option value="3">Jakarta Pusat</option>
                        <option value="4">Jakarta Barat</option>
                        <option value="5">Jakarta Selatan</option>
                        <option value="6">Bogor</option>
                        <option value="7">Depok</option>
                        <option value="8">Tangerang</option>
                        <option value="9">Bekasi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="in-form" for="exampleInputEmail1"  style="display:block;">Type</label>
                    <select class="form-control" name="type">
                        <option value="1">Any</option>
                        <option value="2">Cat</option>
                        <option value="3">Dog</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="in-form" for="exampleInputEmail1"  style="display:block;">Breed</label>
                    <input type="text" name="breed" id="breed" class=" form-control" placeholder="Breed" required>
                </div>

                </div>
                <div class="form-inline">
                    <div class="form-group">
                    <label class="in-form" for="exampleInputEmail1"  style="display:block;">Sex</label>
                    <select class="form-control" name="sex">
                        <option value="1">Any</option>
                        <option value="2">Female</option>
                        <option value="3">Male</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="in-form" for="exampleInputEmail1"  style="display:block;">Age</label>
                    <select class="form-control" name="age">

                        <option value="1">Any</option>
                        <option value="2">0-6 months</option>
                        <option value="3">6-12 months</option>
                        <option value="4">12-18 months</option>
                        <option value="5">More than 2 years</option>
                        <option value="6">More than 3 years</option>

                    </select>
                </div>

                </div>
                

                <div class="form-group">
                    <button type="submit" class="register-button btn btn-success">Search</button>
                </div>
            </form>

        </div>
      
    </div>
      
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h3>Featured Pets :</h3>
           
            <div class="col-xs-18 col-sm-6 col-md-4">
                <div class="thumbnail thumbnail-home">
                    <img src="{{URL::to('/image/sample3.png')}}" alt="">
                    <div class="caption">
                        <h4>Leonardo</h4>
                        <p>
							He is a male dog and very friendly, even...
						</p>
						<a href="#" class="btn btn-info btn-sm" role="button">Learn More</a>
                    </div>
                </div>
            </div>


            <div class="col-xs-18 col-sm-6 col-md-4">
                <div class="thumbnail thumbnail-home">
                    <img src="{{URL::to('/image/sample.jpg')}}" alt="">
                    <div class="caption">
                        <h4>Kitty</h4>
                        <p>
							Born as the cutest cat ever, Kitty...
						</p>
						<a href="#" class="btn btn-info btn-sm" role="button">Learn More</a>
					</div>
                </div>
            </div>

            <div class="col-xs-18 col-sm-6 col-md-4">
                <div class="thumbnail thumbnail-home">
                    <img src="{{URL::to('/image/sample2.jpg')}}" alt="">
                    <div class="caption">
                        <h4>Smith</h4>
                        <p>Smith, just like the name of the great...
                        </p>
						<a href="#" class="btn btn-info btn-sm" role="button">Learn More</a>
					</div>
                </div>
            </div>
           </div>
            </div>
        </div>

@endsection