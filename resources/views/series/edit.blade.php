@extends('layouts.app')
@section('content')
	<h1>Edit series</h1>
	<a name="forms">
	<a name="csrf-field">
	<form method='POST' action="/series/{{$series->id}}" enctype="multipart/form-data">
		 @csrf
		 @method('PUT')
	    <div class="form-group">
			    	<label>Title</label>
			    	<input type="text" name="title" placeholder="Title" class="form-control" value="{{$series->title}}">
			    </div>
			    <div class="form-group">
			    	<label>IMDB ID</label>
			    	<input type="text" name="imdb_id" placeholder="IMDB ID" class="form-control" value="{{$series->imdb_id}}">
			    </div>
			    <div class="form-group">
			    	<label>Type</label>
			    	<input type="text" name="type" placeholder="Type: anime or series" class="form-control" value="{{$series->type}}">
			    </div>
			    <div class="form-group">
			    	<label>Season</label>
			    	<input type="text" name="season" placeholder="Season" class="form-control" value="{{$series->season}}">
			    </div>
			    <div class="form-group">
			    	<label>Episode</label>
			    	<input type="text" name="episode" placeholder="Episode" class="form-control" value="{{$series->episode}}">
			    </div>
			    <div class="form-group">
			    	<label>Link</label>
			    	<input type="text" name="link" placeholder="Link" class="form-control" value="{{$series->link}}">
			    </div>
	    <div class="form-group">
	    	<input type="submit" class="btn btn-primary">
		</div>
	</form>
	</a>
	</a>
@endsection
