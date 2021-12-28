@extends('layouts.mainadminlayout')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New RssFeed</h1>
        </div>
        <div class="container">
            @if(\Session::has('success'))
                <div class="alert alert-success">
                    {{\Session::get('success')}}
                </div>
            @endif
        </div>
        <form action="{{url('/admin/rssfeeds/store')}}" method="post">
        
            @csrf 
            <div class="form-group">
                <label for="title">Categories</label>
                <select class="form-control @error('categories_id') is-invalid @enderror"" id ="categories" name ="categories_id">
                    <option id =""  value="">Select category</option>
                    @foreach($allCategories as $id => $name)
                    <option id ="{{ $id }}" {{ old('categories_id') == $id ? 'selected' : '' }} value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                @error('categories_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>The category field is required.</strong>
                    </span>
                @enderror
                
            </div>
            <div class="form-group">
                <label for="title">Channels</label>
                <select class="form-control @error('channels_id') is-invalid @enderror" id ="channels_id" name ="channels_id">
                <option id =""  value="">Select channel</option>
                    @foreach($allChannels as $id => $channel_name)
                    <option id ="{{ $id }}" {{ old('channels_id') == $id ? 'selected' : '' }} value="{{ $id }}">{{ $channel_name }}</option>
                    @endforeach
                </select>
                @error('channels_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>The channel field is required.</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="rsslinks">RssFeed Link</label>
                <input type="text" class="form-control  @error('rsslinks') is-invalid @enderror" id="rsslinks" name="rsslinks">
                @error('rsslinks')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="featuredCheck" name="is_featured" value="1">
                <label class="custom-control-label" for="featuredCheck">Is Featured</label>
                </div>
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="statusCheck" name="status" value="1" checked>
                <label class="custom-control-label" for="statusCheck">Is Active</label>
                </div>
            </div>
            
            
            <button type="submit" class="btn btn-primary">Submit</button>


        </form>
    </div>
@stop