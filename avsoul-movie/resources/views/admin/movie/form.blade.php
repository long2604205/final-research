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
                            <div class="form__img">
                                <label onclick="openfile('image')" for="form__img-upload">Upload cover (190 x 270)</label>
                                <img src="{{old('image',$movie->image?? '') }}" onclick="openfile('image')" width="100"/>
                                <input required value="{{$movie->image ?? 'N/A'}}" type="hidden" name="image" id="image" class="form-control" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-7 form__content">
                    <div class="row">
                        <div class="col-12">
                            <div class="form__group">
                                <input required type="text" class="form__input" placeholder="Title" name="title" value="{{$movie->title ?? ''}}" id="title" onchange="stralias('title','alias')">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form__group">
                                <input required type="text" class="form__input" placeholder="Alias" name="alias" value="{{$movie->alias ?? ''}}" id="alias" readonly>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form__group">
                                <textarea id="text" name="description" class="form__textarea" placeholder="Description">{{$movie->description ?? ''}}</textarea>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="form__group">
                                <input type="text" class="form__input" placeholder="Release year" name="year" value="{{$movie->year ?? ''}}">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="form__group">
                                <input type="text" class="form__input" placeholder="Duration in minutes" name="duration" value="{{$movie->duration ?? ''}}">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="form__group">
                                <select class="js-example-basic-single" id="quality" name="quality">
                                    <option {{old('quality', $movie->quality?? 1)==1 ? 'selected':''}} value="1">FullHD</option>
                                    <option {{old('quality', $movie->quality?? 1)==2 ? 'selected':''}} value="2">HD</option>
                                    <option {{old('quality', $movie->quality?? 1)==3 ? 'selected':''}} value="3">SD</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="form__group">
                                <input type="text" class="form__input" placeholder="Age" name="age" value="{{$movie->age ?? ''}}">
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form__group">
                                <select class="js-example-basic-multiple" multiple id="country" name="country">
                                    {{-- <option value=""></option> --}}
                                </select>
                            </div>
                        </div>


                        <div class="col-12 col-lg-6">
                            <div class="form__group">
                                <select class="js-example-basic-multiple" name="genres[]" id="genre" multiple="multiple">
                                    @foreach ($genres as $genre)
                                    {{-- <option value="{{$genre->id}}">{{$genre->title}}</option> --}}
                                    @php
                                    $selected = '';
                                    // Kiểm tra xem form đang được sử dụng cho việc chỉnh sửa bộ phim
                                    if (isset($movie)) {
                                        // Nếu là chỉnh sửa, kiểm tra xem thể loại có nằm trong danh sách thể loại của bộ phim hay không
                                        if ($movie->genres->contains($genre->id)) {
                                            $selected = 'selected';
                                        }
                                    }
                                    @endphp
                                    {{-- <option value="{{$genre->id}}" {{ $movie->genres->contains($genre->id) ? 'selected' : '' }}>{{$genre->title}}</option> --}}
                                    <option value="{{$genre->id}}" {{$selected}}>{{$genre->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12= col-lg-3">
                            <ul class="form__radio">
                                <li>
                                    <span>Status:</span>
                                </li>
                                <li>
                                    <input {{old('status', $movie->status?? 1)==1 ? 'checked':''}} value="1" id="type1" type="radio" name="status" name="status">
                                    <label for="type1">Publish</label>
                                </li>
                                <li>
                                    <input {{old('status', $movie->status?? 1)==2 ? 'checked':''}} value="2" id="type2" type="radio" name="status" name="status">
                                    <label for="type2">Hidden</label>
                                </li>
                            </ul>
                        </div>

                        <div class="col-12 col-lg-9">
                            <div class="form__group form__group--link">
                                <input type="text" class="form__input" placeholder="Video add a link" name="video" value="{{$movie->video ?? 'N/A'}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form__img" style="max-height:300px">
                        <label onclick="openfile('images')" for="form__img-upload">Upload Photos (190 x 270)</label>
                        <img src="{{old('images',$movie->images?? '') }}" onclick="openfile('images')" width="100"/>
                        <input required value="{{$movie->images ?? 'N/A'}}" type="hidden" name="images" id="images" class="form-control" placeholder="">

                        {{-- <label for="form__img-upload">Upload Photos (190 x 270)</label>
                        <input id="form__img-upload" name="form__img-upload" type="file" accept=".png, .jpg, .jpeg">
                        <img id="form__img" src="#" alt=" "> --}}
                    </div>
                </div>
                <style>
                    #form__btn__a {
                        width: 100%;
                        background: rgb(107, 83, 231);
                        color: rgb(255, 255, 255);
                        transition: background-color 0.3s; /* Thêm hiệu ứng chuyển đổi màu */
                    }

                    #form__btn__a:hover {
                        background-color: rgb(255, 255, 255); /* Chỉnh màu nền khi hover thành màu đen */
                        color: rgb(0, 0, 0); /* Đổi màu chữ khi hover để phù hợp với màu nền mới */
                    }
                </style>
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <a id="form__btn__a" href="{{route('movie.index')}}" class="form__btn">Back</a>
                        </div>
                        @csrf
                        @method($method)
                        <div class="col-6">
                            <button type="submit" class="form__btn" style="width: 100%">save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- end form -->
</div>
<script>
    // Mảng chứa các quốc gia
    var countries = [
        "Afghanistan", "Åland Islands", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla",
        "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan",
        "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan",
        "Bolivia", "Bosnia and Herzegovina", "Botswana", "Bouvet Island", "Brazil", "Brunei Darussalam", "Bulgaria",
        "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands",
        "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", "Congo", "Congo", "Cook Islands",
        "Costa Rica", "Cote D'ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica",
        "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia",
        "Faroe Islands", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar",
        "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-bissau",
        "Guyana", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland",
        "Isle of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati",
        "Korea", "Kuwait", "Kyrgyzstan", "Lao People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia",
        "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Macedonia", "Madagascar", "Malawi",
        "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte",
        "Mexico", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia",
        "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger",
        "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama",
        "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar",
        "Reunion", "Romania", "Russian Federation", "Rwanda", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia",
        "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia",
        "South Africa", "Spain", "Sri Lanka", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic",
        "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor-leste", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago",
        "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates",
        "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Viet Nam", "Western Sahara",
        "Yemen", "Zambia", "Zimbabwe"
    ];

    // Lấy select element bằng id
    var select = document.getElementById('country');

    // Đổ dữ liệu vào select element
    countries.forEach(function(country) {
        var option = document.createElement('option');
        option.value = country;
        option.textContent = country;
        select.appendChild(option);
    });
    // Script để chọn giá trị quốc gia của phim trong form chỉnh sửa
    var selectedCountry = "{{ $movie->country ?? '' }}";
    var countrySelect = document.getElementById('country');
    for (var i = 0; i < countrySelect.options.length; i++) {
        if (countrySelect.options[i].value === selectedCountry) {
            countrySelect.options[i].selected = true;
            break;
        }
    }
</script>

@endsection
