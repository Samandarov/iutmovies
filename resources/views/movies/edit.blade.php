@extends('layouts.app')
@section('content')
	<h1>Edit a movie</h1>
	<a name="forms">
	<a name="csrf-field">
	<form method='POST' action="/movies/{{$movie->id}}" enctype="multipart/form-data">
		 @csrf
		 @method('PUT')
	    <div class="form-group">
	    	<label>Title</label>
	    	<input type="text" name="title" placeholder="Title" class="form-control" value='{{$movie->title}}'>
	    </div>
	    <div class="form-group">
	    	<label>IMDB ID</label>
	    	<input type="text" name="imdb_id" placeholder="IMDB ID" class="form-control" value='{{$movie->imdb_id}}'>
	    </div>
	    <div class="form-group">
	    	<label>Type</label>
	    	<input type="text" name="type" placeholder="Type" class="form-control" value='{{$movie->type}}'>
	    </div>
	    <div class="form-group">
	    	<label>Link</label>
	    	<input type="text" name="link" placeholder="Link" class="form-control" value='{{$movie->link}}'>
	    </div>
	    <div class="form-group">
	    	<input type="submit" class="btn btn-primary">
		</div>
	</form>
	</a>
	</a>
@endsection
