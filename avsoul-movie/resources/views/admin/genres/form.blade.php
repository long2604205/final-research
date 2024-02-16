@extends('admin.master')
@section('body')
<div class="row">
    <!-- main title -->
    <div class="col-12">
        <div class="main__title">
            <h2>{{$pagename}}</h2>
        </div>
    </div>
    <!-- end main title -->

    <!-- form -->
    <div class="col-12">
        <form method="POST" action="{{$action}}" class="form">
            <div class="row">
                <div class="col-12 col-md-5 form__cover">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-12">
                            {{-- <label onclick="openfile('image')">Product's image</label> --}}
                            <div class="form__img">
                                <label onclick="openfile('image')" for="form__img-upload">Upload cover (190 x 270)</label>
                                <img src="{{old('image',$genre->image?? '') }}" onclick="openfile('image')" width="100"/>
                                <input required value="{{$genre->image ?? 'N/A'}}" type="hidden" name="image" id="image" class="form-control" placeholder="">
                            </div>
                            {{-- <div class="form__img">
                                <label for="form__img-upload">Upload cover (190 x 270)</label>
                                <input id="form__img-upload" name="form__img-upload" type="file" accept=".png, .jpg, .jpeg">
                                <img id="form__img" src="#" alt=" ">
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-7 form__content">
                    <div class="row">
                        <div class="col-12">
                            <div class="form__group">
                                <input value="{{$genre->title ?? ''}}" required name="title" type="text" class="form__input" placeholder="Title">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form__group">
                                <select name="status" class="js-example-basic-single" id="quality">
                                    <option {{old('status', $genre->status?? 1)==1 ? 'selected':''}} value="1">Publish</option>
                                    <option {{old('status', $genre->status?? 1)==2 ? 'selected':''}} value="2">Hidden</option>
                                </select>
                            </div>
                        </div>
                        @csrf
                        @method($method)
                        <div class="col-12">
                            <div class="form__group">
                                <button type="submit" class="form__btn" style="width: 100%">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- end form -->
</div>
@endsection
