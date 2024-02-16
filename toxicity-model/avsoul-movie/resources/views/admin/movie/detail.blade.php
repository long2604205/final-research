@extends('admin.master')
@section('body')
<!-- main title -->
<div class="col-12">
    <div class="main__title">
        <h2>{{$pagename}}</h2>
    </div>
</div>
<!-- end main title -->

<!-- profile -->
<div class="col-12">
    <div class="profile__content">
        <!-- profile user -->
        <div class="">
        </div>
        <!-- end profile user -->

        <!-- profile tabs nav -->
        <ul class="nav nav-tabs profile__tabs" id="profile__tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1"
                    aria-selected="true">Details</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab-2" role="tab" aria-controls="tab-2"
                    aria-selected="false">Comments</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tab-3" role="tab" aria-controls="tab-3"
                    aria-selected="false">Reviews</a>
            </li>
        </ul>
        <!-- end profile tabs nav -->

        <!-- profile mobile tabs nav -->
        <div class="profile__mobile-tabs" id="profile__mobile-tabs">
            <div class="profile__mobile-tabs-btn dropdown-toggle" role="navigation" id="mobile-tabs"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <input type="button" value="Profile">
                <span></span>
            </div>

            <div class="profile__mobile-tabs-menu dropdown-menu" aria-labelledby="mobile-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="1-tab" data-toggle="tab" href="#tab-1"
                            role="tab" aria-controls="tab-1" aria-selected="true">Profile</a></li>

                    <li class="nav-item"><a class="nav-link" id="2-tab" data-toggle="tab" href="#tab-2" role="tab"
                            aria-controls="tab-2" aria-selected="false">Comments</a></li>

                    <li class="nav-item"><a class="nav-link" id="3-tab" data-toggle="tab" href="#tab-3" role="tab"
                            aria-controls="tab-3" aria-selected="false">Reviews</a></li>
                </ul>
            </div>
        </div>
        <!-- end profile mobile tabs nav -->

        <!-- profile btns -->
        <div class="profile__actions">
            <a href="#modal-status3" class="profile__action profile__action--banned open-modal"><svg
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M12,13a1.49,1.49,0,0,0-1,2.61V17a1,1,0,0,0,2,0V15.61A1.49,1.49,0,0,0,12,13Zm5-4V7A5,5,0,0,0,7,7V9a3,3,0,0,0-3,3v7a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V12A3,3,0,0,0,17,9ZM9,7a3,3,0,0,1,6,0V9H9Zm9,12a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V12a1,1,0,0,1,1-1H17a1,1,0,0,1,1,1Z" />
                </svg></a>
            <a href="#modal-delete3" class="profile__action profile__action--delete open-modal"><svg
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z" />
                </svg></a>
        </div>
        <!-- end profile btns -->
    </div>
</div>
<!-- end profile -->

<!-- content tabs -->
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab">
        <div class="col-12">
            <div class="sign__wrap">
                <div class="row">
                    <!-- details form -->
                    <div class="col-12">
                        <div class="form">
                            <div class="row">
                                <div class="col-12 col-md-5 form__cover">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-md-12">
                                            <div class="form__img">
                                                <img src="{{$movie->image?? ''}}" height="100%"/>                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-7 form__content">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form__group">
                                                <input readonly class="form__input" value="Title: {{$movie->title ?? ''}}" id="title">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form__group">
                                                <input class="form__input" value="Alias: {{$movie->alias ?? ''}}" id="alias" readonly>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form__group">
                                                <textarea readonly class="form__textarea">Description:&nbsp;{{$movie->description ?? ''}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-6">
                                            <div class="form__group">
                                                <input class="form__input" value="Release Year :{{$movie->year ?? ''}}" readonly>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-6">
                                            <div class="form__group">
                                                <input class="form__input" value="Duration :{{$movie->duration ?? ''}} min" readonly>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-3">
                                            <div class="form__group">
                                                @if ($movie->quality == 1)
                                                    <input class="form__input" value="Quality: FullHD" readonly>
                                                @elseif($movie->quality == 2)
                                                    <input class="form__input" value="Quality: HD" readonly>
                                                @else
                                                    <input class="form__input" value="Quality: SD" readonly>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-3">
                                            <div class="form__group">
                                                <input class="form__input" value="Age: {{$movie->age ?? ''}}">
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6">
                                            <div class="form__group">
                                                <input class="form__input" value="Country: {{$movie->country}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <style>
                                    #form__btn__a {
                                        width: 100%;
                                        max-height: 44px;
                                        background: rgb(107, 83, 231);
                                        color: rgb(255, 255, 255);
                                        transition: background-color 0.3s; /* Thêm hiệu ứng chuyển đổi màu */
                                    }
                                </style>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-lg-2">
                                            @if ($movie->status == 1)
                                            <div class="form__group">
                                                <a id="form__btn__a" class="form__btn">Publish</a>
                                            </div>
                                            @else
                                            <div class="form__group">
                                                <a id="form__btn__a" class="form__btn">Hidden</a>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form__group">
                                                <select class="js-example-basic-multiple" id="genre" multiple="multiple" readonly>
                                                    @foreach ($genres as $genre)
                                                    <option disabled {{ $movie->genres->contains($genre->id) ? 'selected' : '' }}>{{$genre->title}}</option>                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6">
                                            <div class="form__group form__group--link">
                                                <input class="form__input" value="{{$movie->video ?? 'N/A'}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form__img" style="max-height:300px">
                                        <img src="{{$movie->images?? ''}}" height="100%" width="100"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end details form -->
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="2-tab">
        <!-- table -->
        <div class="col-12">
            <div class="main__table-wrap">
                <table class="main__table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ITEM</th>
                            <th>AUTHOR</th>
                            <th>CONTENT</th>
                            <th>LIKE / DISLIKE</th>
                            <th>CRAETED DATE</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{$i =0}}
                        @foreach ($comments as $comment)
                        {{$i++}}
                            <tr>
                                <td>
                                    <div class="main__table-text">{{$i}}</div>
                                </td>
                                <td>
                                    <div class="main__table-text"><a href="#">{{$comment->movie->title}}</a></div>
                                </td>
                                <td>
                                    <div class="main__table-text">{{$comment->user->name}}</div>
                                </td>
                                <td>
                                    {{-- <div class="main__table-text">Lorem Ipsum is simply dummy text...</div> --}}
                                    <div id="shortenedText" class="main__table-text">{{$comment->content}}</div>
                                </td>
                                <td>
                                    <div class="main__table-text">{{$comment->like_count}} / {{$comment->dislike_count}}</div>
                                </td>
                                <td>
                                    <div class="main__table-text">{{ \Carbon\Carbon::parse($comment->created_at)->format('d M Y, H:i') }}</div>
                                </td>
                                <td>
                                    <div class="main__table-btns">
                                        <a href="#modal-view" class="main__table-btn main__table-btn--view open-modal">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z" />
                                            </svg>
                                        </a>
                                        <a href="#modal-delete" class="main__table-btn main__table-btn--delete open-modal">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end table -->

        <!-- paginator -->
        <div class="col-12">
            {{ $comments->links('admin.widgets.paginator') }}
        </div>
        <!-- end paginator -->
    </div>

    <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="3-tab">
        <!-- table -->
        <div class="col-12">
            <div class="main__table-wrap">
                <table class="main__table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ITEM</th>
                            <th>AUTHOR</th>
                            <th>CONTENT</th>
                            <th>RATING</th>
                            <th>CRAETED DATE</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{$j = 0}}
                        @foreach ($reviews as $rate)
                        {{$j++}}
                            <tr>
                                <td>
                                    <div class="main__table-text">{{$j}}</div>
                                </td>
                                <td>
                                    <div class="main__table-text"><a href="#">{{$rate->movie->title}}</a></div>
                                </td>
                                <td>
                                    <div class="main__table-text">{{$rate->user->name}}</div>
                                </td>
                                <td>
                                    <div id="shortenedTextRate" class="main__table-text">{{$rate->content}}</div>
                                </td>
                                <td>
                                    <div class="main__table-text main__table-text--rate"><svg
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="M22,9.67A1,1,0,0,0,21.14,9l-5.69-.83L12.9,3a1,1,0,0,0-1.8,0L8.55,8.16,2.86,9a1,1,0,0,0-.81.68,1,1,0,0,0,.25,1l4.13,4-1,5.68A1,1,0,0,0,6.9,21.44L12,18.77l5.1,2.67a.93.93,0,0,0,.46.12,1,1,0,0,0,.59-.19,1,1,0,0,0,.4-1l-1-5.68,4.13-4A1,1,0,0,0,22,9.67Zm-6.15,4a1,1,0,0,0-.29.88l.72,4.2-3.76-2a1.06,1.06,0,0,0-.94,0l-3.76,2,.72-4.2a1,1,0,0,0-.29-.88l-3-3,4.21-.61a1,1,0,0,0,.76-.55L12,5.7l1.88,3.82a1,1,0,0,0,.76.55l4.21.61Z" />
                                        </svg> {{ number_format($rate->rate), 1 }}</div>
                                </td>
                                <td>
                                    <div class="main__table-text">{{ \Carbon\Carbon::parse($rate->created_at)->format('d M Y, H:i') }}</div>
                                </td>
                                <td>
                                    <div class="main__table-btns">
                                        <a href="#modal-view2" class="main__table-btn main__table-btn--view open-modal">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z" />
                                            </svg>
                                        </a>
                                        <a href="#modal-delete2" class="main__table-btn main__table-btn--delete open-modal">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end table -->

        <!-- paginator -->
        <div class="col-12">
            {{$reviews->links('admin.widgets.paginator')}}
        </div>
        <!-- end paginator -->
    </div>
</div>
<!-- end content tabs -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var maxLength = 35; // Số ký tự tối đa bạn muốn hiển thị
        var textElement = document.getElementById('shortenedText');
        var text = textElement.textContent.trim();

        if (text.length > maxLength) {
            var shortenedText = text.slice(0, maxLength) + '...';
            textElement.textContent = shortenedText;
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var maxLength = 35; // Số ký tự tối đa bạn muốn hiển thị
        var textElement = document.getElementById('shortenedTextRate');
        var text = textElement.textContent.trim();

        if (text.length > maxLength) {
            var shortenedText = text.slice(0, maxLength) + '...';
            textElement.textContent = shortenedText;
        }
    });
</script>
@endsection
