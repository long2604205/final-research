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
        <div class="profile__user">
            <div class="profile__avatar">
                <img src="{{$user->avatar}}" alt="">
            </div>
            <!-- or red -->
            <div class="profile__meta profile__meta--green">
                <h3>{{$user->name}}
                    <span style="color: {{ $user->status == 1 ? '' : ($user->status == 2 ? 'red' : '') }}">
                        {{ $user->status == 1 ? '(Active)' : ($user->status == 2 ? '(Banned)' : '') }}
                    </span>
                </h3>
                <span>AVSoul TV ID: {{$user->socialite_id}}</span>
            </div>
        </div>
        <!-- end profile user -->

        <!-- profile tabs nav -->
        <ul class="nav nav-tabs profile__tabs" id="profile__tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tab-1" role="tab" aria-controls="tab-1"
                    aria-selected="true">Profile</a>
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
                </ul>
            </div>
        </div>
        <!-- end profile mobile tabs nav -->
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
                    <div class="col-12 col-lg-12">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                        <form action="{{$action}}" method="POST"
                            class="sign__form sign__form--profile sign__form--first">
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="sign__title">Profile details</h4>
                                </div>

                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    <div class="sign__group">
                                        <label class="sign__label" for="username">Email</label>
                                        <input id="username" type="text" class="sign__input" value="{{$user->email}}"
                                            readonly>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    <div class="sign__group">
                                        <label class="sign__label" for="email">Status</label>
                                        <input id="email" type="text" class="sign__input"
                                            value="{{ $user->status == 1 ? 'Active' : ($user->status == 2 ? 'Banned' : '') }}"
                                            readonly>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    <div class="sign__group">
                                        <label class="sign__label" for="firstname">Name</label>
                                        <input id="firstname" type="text" class="sign__input" readonly
                                            value="{{$user->name}}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                    <div class="sign__group">
                                        <label class="sign__label" for="rights">Role</label>
                                        <select class="js-example-basic-single" id="rights" name="role">
                                            <option {{old('role', $user->role?? 1)==0 ? 'selected':''}} value="0">Viewer
                                            </option>
                                            <option {{old('role', $user->role?? 1)==1 ? 'selected':''}} value="1">Admin
                                            </option>
                                            <option {{old('role', $user->role?? 1)==2 ? 'selected':''}}
                                                value="2">Manager</option>
                                            <option {{old('role', $user->role?? 1)==3 ? 'selected':''}} value="3">Staff
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    @csrf
                                    @method($method)
                                    <button class="sign__btn" type="submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- end details form -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end content tabs -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var maxLength = 35; // Số ký tự tối đa bạn muốn hiển thị
        var textElements = document.getElementsByClassName('shortTextCmt');

        // Lặp qua tất cả các phần tử có class 'shortTextCmt'
        Array.from(textElements).forEach(function(textElement) {
            var text = textElement.textContent.trim();

            if (text.length > maxLength) {
                var shortTextCmt = text.slice(0, maxLength) + '...';
                textElement.textContent = shortTextCmt;
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var maxLength = 35; // Số ký tự tối đa bạn muốn hiển thị
        var textElements = document.getElementsByClassName('shortTextRate');

        // Lặp qua tất cả các phần tử có class 'shortTextCmt'
        Array.from(textElements).forEach(function(textElement) {
            var text = textElement.textContent.trim();

            if (text.length > maxLength) {
                var shortTextRate = text.slice(0, maxLength) + '...';
                textElement.textContent = shortTextRate;
            }
        });
    });
</script>
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        var maxLength = 35; // Số ký tự tối đa bạn muốn hiển thị
        var textElement = document.getElementById('shortenedTextRate');
        var text = textElement.textContent.trim();

        if (text.length > maxLength) {
            var shortenedText = text.slice(0, maxLength) + '...';
            textElement.textContent = shortenedText;
        }
    });
</script> --}}
@endsection
