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
                        <form class="sign__form sign__form--profile sign__form--first">
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
                                        <input id="firstname" type="text" class="sign__input" readonly
                                            value="{{old('role', $user->role?? 1)==0 ? 'Viewer':'N/A'}}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <a href="{{route('viewers.index')}}" class="sign__btn" type="button">Back</a>
                                </div>
                            </div>
                        </form>
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
                            {{-- <th>AUTHOR</th> --}}
                            <th>TEXT</th>
                            <th>LIKE / DISLIKE</th>
                            <th>CRAETED DATE</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{$i = 0}}
                        @foreach ($comments as $comment)
                        {{$i++}}
                        <tr>
                            <td>
                                <div class="main__table-text">{{$i}}</div>
                            </td>
                            <td>
                                <div class="main__table-text"><a href="#">{{$comment->movie->title}}</a></div>
                            </td>
                            {{-- <td>
                                <div class="main__table-text">$user->name</div>
                            </td> --}}
                            <td>
                                <div id="" class="main__table-text shortTextCmt">{{$comment->content}}</div>
                            </td>
                            <td>
                                <div class="main__table-text">{{$comment->like_count}} / {{$comment->dislike_count}}
                                </div>
                            </td>
                            <td>
                                <div class="main__table-text">{{ \Carbon\Carbon::parse($comment->created_at)->format('d
                                    M Y, H:i') }}</div>
                            </td>
                            <td>
                                <div class="main__table-btns">
                                    <a onclick="showCommentAlertViewer('{{$comment->content}}', '{{ \Carbon\Carbon::parse($comment->created_at)->format('d.m.Y, H:i')}}', '{{$comment->user->name}}', '{{$comment->user->avatar}}')" class="main__table-btn main__table-btn--view">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z" />
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
            {{$comments->links('admin.widgets.paginator')}}
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
                            <th>TEXT</th>
                            <th>RATING</th>
                            <th>CRAETED DATE</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{$i = 0}}
                        @foreach ($ratings as $rate)
                        {{$i++}}
                        <tr>
                            <td>
                                <div class="main__table-text">{{$i}}</div>
                            </td>
                            <td>
                                <div class="main__table-text"><a href="#">{{$rate->movie->title}}</a></div>
                            </td>
                            <td>
                                <div class="shortTextRate main__table-text">{{$rate->content}}</div>
                            </td>
                            <td>
                                <div class="main__table-text main__table-text--rate"><svg
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M22,9.67A1,1,0,0,0,21.14,9l-5.69-.83L12.9,3a1,1,0,0,0-1.8,0L8.55,8.16,2.86,9a1,1,0,0,0-.81.68,1,1,0,0,0,.25,1l4.13,4-1,5.68A1,1,0,0,0,6.9,21.44L12,18.77l5.1,2.67a.93.93,0,0,0,.46.12,1,1,0,0,0,.59-.19,1,1,0,0,0,.4-1l-1-5.68,4.13-4A1,1,0,0,0,22,9.67Zm-6.15,4a1,1,0,0,0-.29.88l.72,4.2-3.76-2a1.06,1.06,0,0,0-.94,0l-3.76,2,.72-4.2a1,1,0,0,0-.29-.88l-3-3,4.21-.61a1,1,0,0,0,.76-.55L12,5.7l1.88,3.82a1,1,0,0,0,.76.55l4.21.61Z" />
                                    </svg> {{ number_format($rate->rate), 1 }}</div>
                            </td>
                            <td>
                                <div class="main__table-text">{{ \Carbon\Carbon::parse($rate->created_at)->format('d M
                                    Y, H:i') }}</div>
                            </td>
                            <td>
                                <div class="main__table-btns">
                                    <a onclick="showCommentAlert('{{$rate->content}}','{{ \Carbon\Carbon::parse($rate->created_at)->format('d.m.Y, H:i')}} by {{$rate->user->name}}','{{$rate->title}}','{{$rate->user->avatar}}', '{{$rate->rate}}')" class="main__table-btn main__table-btn--view">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path
                                                d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z" />
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
            {{$ratings->links('admin.widgets.paginator')}}
        </div>
        <!-- end paginator -->
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

<script>
    function showCommentAlertViewer(TextCmt, Created_at, Author, Avatar) {
        var overlay = document.createElement('div');
        overlay.setAttribute('class', 'overlay');
        overlay.style.position = 'fixed';
        overlay.style.top = '0';
        overlay.style.left = '0';
        overlay.style.width = '100%';
        overlay.style.height = '100%';
        overlay.style.backgroundColor = 'rgba(20, 23, 31, 0.7)'; // Màu đen với độ mờ 50%
        overlay.style.zIndex = '9998'; // Đặt z-index thấp hơn so với cảnh báo
        overlay.style.opacity = '0'; // Ban đầu ẩn overlay
        overlay.style.transition = 'opacity 0.4s ease-in-out'; // Thêm hiệu ứng transition
        document.body.appendChild(overlay);
        // Tạo phần tử div cho alert
        var alertDiv = document.createElement('div');
        alertDiv.style.position = 'fixed';
        alertDiv.style.top = '50%';
        alertDiv.style.left = '50%';
        alertDiv.style.transform = 'translate(-50%, -50%)';
        alertDiv.style.backgroundColor = 'rgb(21, 31, 48)';
        alertDiv.style.padding = '20px';
        alertDiv.style.borderRadius = '20px';
        alertDiv.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
        alertDiv.style.zIndex = '9999';
        alertDiv.style.opacity = '0';
        alertDiv.style.transition = 'opacity 0.4s ease-in-out';
        alertDiv.style.width = '700px';

        // Tạo phần tử div cho header của alert
        var alertHeader = document.createElement('div');
        alertHeader.style.borderBottom = '0.3px solid #ddd';
        alertHeader.style.paddingBottom = '16px';
        alertHeader.style.marginBottom = '5px';
        alertHeader.style.display = 'flex';
        alertHeader.style.alignItems = 'center';

        // Tạo phần tử img cho ảnh đại diện
        var avatarImg = document.createElement('img');
        avatarImg.setAttribute('src', Avatar);
        avatarImg.setAttribute('alt', 'John Doe');
        avatarImg.style.width = '50px';
        avatarImg.style.height = '50px';
        avatarImg.style.marginRight = '10px';
        avatarImg.style.borderRadius = '10px';

        // Tạo phần tử div cho nội dung header của alert
        var alertHeaderChild = document.createElement('div');
        alertHeaderChild.classList.add('alert-header-child');

        // Tạo phần tử h4 cho tiêu đề của alert
        var alertTitle = document.createElement('h4');
        alertTitle.classList.add('alert-title');
        alertTitle.textContent = Author;
        // Thêm CSS cho alert-title
        alertTitle.style.fontSize = '16px';
        alertTitle.style.fontWeight = 'bold';
        alertTitle.style.margin = '0';
        alertTitle.style.color = 'white';

        // Tạo phần tử p cho ngày của alert
        var alertDate = document.createElement('p');
        alertDate.classList.add('alert-date');
        alertDate.textContent = Created_at;
        // Thêm CSS cho alert-date
        alertDate.style.fontSize = '12px';
        alertDate.style.color = 'white';
        alertDate.style.margin = '0';

        // Gắn các phần tử con vào phần tử cha
        alertHeaderChild.appendChild(alertTitle);
        alertHeaderChild.appendChild(alertDate);
        alertHeader.appendChild(avatarImg);
        alertHeader.appendChild(alertHeaderChild);

        // Tạo phần tử div cho nội dung của alert
        var alertContent = document.createElement('div');
        alertContent.style.marginTop = '10px';
        alertContent.style.color = 'white';
        // alertContent.style.borderBottom = '0.5px solid #ddd';

        // Tạo phần tử p cho nội dung của alert
        var alertParagraph = document.createElement('p');
        alertParagraph.textContent = TextCmt;

        // Gắn phần tử p vào phần tử div của nội dung alert
        alertContent.appendChild(alertParagraph);

        // Gắn các phần tử con vào phần tử div chính của alert
        alertDiv.appendChild(alertHeader);
        alertDiv.appendChild(alertContent);

        // Lấy phần tử đầu tiên trong body
        var firstElement = document.body.firstChild;
        // Chèn cửa sổ alert vào trước phần tử đầu tiên trong body
        document.body.insertBefore(alertDiv, firstElement);

        // Kích hoạt hiệu ứng hiển thị dần
        setTimeout(function() {
            overlay.style.opacity = '1';
            alertDiv.style.opacity = '1';
        }, 100); // Cho một khoảng nhỏ để trình duyệt cập nhật DOM trước khi kích hoạt transition


                // Bắt sự kiện click ngoài overlay
        overlay.addEventListener('click', function(event) {
            if (event.target === overlay) {
                overlay.style.opacity = '0'; // Ẩn overlay khi click ra ngoài
                alertDiv.style.opacity = '0'; // Ẩn alertDiv khi click ra ngoài
                setTimeout(function() {
                    document.body.removeChild(overlay);
                    document.body.removeChild(alertDiv);
                }, 1000); // Sau 1 giây, xóa overlay và alertDiv
            }
        });
    }

</script>
<script>
    function showCommentAlert(rateContent, Author, Title, Avatar, Rating) {
        var overlay = document.createElement('div');
        overlay.setAttribute('class', 'overlay');
        overlay.style.position = 'fixed';
        overlay.style.top = '0';
        overlay.style.left = '0';
        overlay.style.width = '100%';
        overlay.style.height = '100%';
        overlay.style.backgroundColor = 'rgba(20, 23, 31, 0.7)'; // Màu đen với độ mờ 50%
        overlay.style.zIndex = '9998'; // Đặt z-index thấp hơn so với cảnh báo
        overlay.style.opacity = '0'; // Ban đầu ẩn overlay
        overlay.style.transition = 'opacity 0.4s ease-in-out'; // Thêm hiệu ứng transition
        document.body.appendChild(overlay);

        // Tạo phần tử div cho alert
        var alertDiv = document.createElement('div');
        alertDiv.style.position = 'fixed';
        alertDiv.style.top = '50%';
        alertDiv.style.left = '50%';
        alertDiv.style.transform = 'translate(-50%, -50%)';
        alertDiv.style.backgroundColor = 'rgb(21, 31, 48)';
        alertDiv.style.padding = '20px';
        alertDiv.style.borderRadius = '20px';
        alertDiv.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
        alertDiv.style.zIndex = '9999';
        alertDiv.style.opacity = '0';
        alertDiv.style.transition = 'opacity 0.4s ease-in-out';
        alertDiv.style.width = '700px';

        // Tạo phần tử div cho header của alert
        var alertHeader = document.createElement('div');
        alertHeader.style.borderBottom = '0.3px solid #ddd';
        alertHeader.style.paddingBottom = '16px';
        alertHeader.style.marginBottom = '5px';
        alertHeader.style.display = 'flex';
        alertHeader.style.alignItems = 'center';

        // Tạo phần tử img cho ảnh đại diện
        var avatarImg = document.createElement('img');
        avatarImg.setAttribute('src', Avatar);
        avatarImg.setAttribute('alt', 'Avatar');
        avatarImg.style.width = '50px';
        avatarImg.style.height = '50px';
        avatarImg.style.marginRight = '10px';
        avatarImg.style.borderRadius = '10px';

        // Tạo phần tử div cho nội dung header của alert
        var alertHeaderChild = document.createElement('div');
        alertHeaderChild.classList.add('alert-header-child');

        // Tạo phần tử h4 cho tiêu đề của alert
        var alertTitle = document.createElement('h4');
        alertTitle.classList.add('alert-title');
        alertTitle.textContent = Title;
        // Thêm CSS cho alert-title
        alertTitle.style.fontSize = '16px';
        alertTitle.style.fontWeight = 'bold';
        alertTitle.style.margin = '0';
        alertTitle.style.color = 'white';

        // Tạo phần tử p cho ngày của alert
        var alertDate = document.createElement('p');
        alertDate.classList.add('alert-date');
        alertDate.textContent = Author;
        // Thêm CSS cho alert-date
        alertDate.style.fontSize = '12px';
        alertDate.style.color = 'white';
        alertDate.style.margin = '0';

        // Gắn các phần tử con vào phần tử cha
        alertHeaderChild.appendChild(alertTitle);
        alertHeaderChild.appendChild(alertDate);
        alertHeader.appendChild(avatarImg);
        alertHeader.appendChild(alertHeaderChild);

        // Tạo phần tử div cho nội dung của alert
        var alertContent = document.createElement('div');
        alertContent.style.marginTop = '10px';
        alertContent.style.color = 'white';

        // Tạo phần tử p cho nội dung của alert
        var alertParagraph = document.createElement('p');
        alertParagraph.textContent = rateContent;

        // Gắn phần tử p vào phần tử div của nội dung alert
        alertContent.appendChild(alertParagraph);

        // Tạo phần tử span cho đánh giá
        var alertRating = document.createElement('span');
        alertRating.classList.add('reviews__rating');

        // Tạo phần tử svg cho biểu tượng đánh giá
        // var svgIcon = document.createElement('svg');
        // svgIcon.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
        // svgIcon.setAttribute('viewBox', '0 0 24 24');
        // var path = document.createElement('path');
        // path.setAttribute('d', 'M22,9.67A1,1,0,0,0,21.14,9l-5.69-.83L12.9,3a1,1,0,0,0-1.8,0L8.55,8.16,2.86,9a1,1,0,0,0-.81.68,1,1,0,0,0,.25,1l4.13,4-1,5.68A1,1,0,0,0,6.9,21.44L12,18.77l5.1,2.67a.93.93,0,0,0,.46.12,1,1,0,0,0,.59-.19,1,1,0,0,0,.4-1l-1-5.68,4.13-4A1,1,0,0,0,22,9.67Zm-6.15,4a1,1,0,0,0-.29.88l.72,4.2-3.76-2a1.06,1.06,0,0,0-.94,0l-3.76,2,.72-4.2a1,1,0,0,0-.29-.88l-3-3,4.21-.61a1,1,0,0,0,.76-.55L12,5.7l1.88,3.82a1,1,0,0,0,.76.55l4.21.61Z');
        // svgIcon.appendChild(path);

        // Tạo phần tử svg cho biểu tượng đánh giá
        var svgIcon = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        svgIcon.setAttribute('viewBox', '0 0 24 24');

        // Tạo phần tử path cho đường dẫn trong SVG
        var path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        path.setAttribute('d', 'M22,9.67A1,1,0,0,0,21.14,9l-5.69-.83L12.9,3a1,1,0,0,0-1.8,0L8.55,8.16,2.86,9a1,1,0,0,0-.81.68,1,1,0,0,0,.25,1l4.13,4-1,5.68A1,1,0,0,0,6.9,21.44L12,18.77l5.1,2.67a.93.93,0,0,0,.46.12,1,1,0,0,0,.59-.19,1,1,0,0,0,.4-1l-1-5.68,4.13-4A1,1,0,0,0,22,9.67Zm-6.15,4a1,1,0,0,0-.29.88l.72,4.2-3.76-2a1.06,1.06,0,0,0-.94,0l-3.76,2,.72-4.2a1,1,0,0,0-.29-.88l-3-3,4.21-.61a1,1,0,0,0,.76-.55L12,5.7l1.88,3.82a1,1,0,0,0,.76.55l4.21.61Z');
        svgIcon.appendChild(path);

        // Tạo phần tử chứa nội dung đánh giá
        var ratingContent = document.createTextNode(' ' + Rating);

        // Gắn các phần tử con vào phần tử span
        alertRating.appendChild(svgIcon);
        alertRating.appendChild(ratingContent);

        // Thêm CSS cho reviews__rating
        alertRating.style.float = 'right'; // Gắn phần tử span vào góc phải
        alertRating.style.marginLeft = '5px'; // Tạo khoảng cách giữa span và các phần tử khác
        alertRating.style.marginRight = '8px'; // Tạo khoảng cách giữa span và các phần tử khác
        alertRating.style.marginTop = '22px'; // Tạo khoảng cách giữa span và các phần tử khác
        alertRating.style.fontSize = '15px'; // Tạo khoảng cách giữa span và các phần tử khác


        // Gắn phần tử span vào phần tử nội dung của alert
        alertContent.appendChild(alertRating);

        // Gắn các phần tử con vào phần tử div chính của alert
        alertDiv.appendChild(alertHeader);
        alertDiv.appendChild(alertContent);

        // Lấy phần tử đầu tiên trong body
        var firstElement = document.body.firstChild;
        // Chèn cửa sổ alert vào trước phần tử đầu tiên trong body
        document.body.insertBefore(alertDiv, firstElement);

        // Kích hoạt hiệu ứng hiển thị dần
        setTimeout(function() {
            overlay.style.opacity = '1';
            alertDiv.style.opacity = '1';
        }, 100); // Cho một khoảng nhỏ để trình duyệt cập nhật DOM trước khi kích hoạt transition

        // Bắt sự kiện click ngoài overlay
        overlay.addEventListener('click', function(event) {
            if (event.target === overlay) {
                overlay.style.opacity = '0'; // Ẩn overlay khi click ra ngoài
                alertDiv.style.opacity = '0'; // Ẩn alertDiv khi click ra ngoài
                setTimeout(function() {
                    document.body.removeChild(overlay);
                    document.body.removeChild(alertDiv);
                }, 1000); // Sau 1 giây, xóa overlay và alertDiv
            }
        });
    }
</script>
@endsection
