@extends('admin.master')
@section('body')
<!-- main title -->
<div class="col-12">
    <div class="main__title">
        <h2>{{$pagename}}</h2>

        <span class="main__title-stat">{{$total}} total</span>

        <div class="main__title-wrap">
            <!-- filter sort -->
            <div class="filter" id="filter__sort">
                <span class="filter__item-label">Sort by:</span>

                <div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-sort" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <input type="button" value="Date created">
                    <span></span>
                </div>

                <ul class="filter__item-menu dropdown-menu scrollbar-dropdown" aria-labelledby="filter-sort">
                    <li>Date created</li>
                    <li>Pricing plan</li>
                    <li>Status</li>
                </ul>
            </div>
            <!-- end filter sort -->

            <!-- search -->
            <form action="#" class="main__title-form">
                <input type="text" placeholder="Find user..">
                <button type="button">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="8.25998" cy="8.25995" r="7.48191" stroke="#2F80ED" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></circle>
                        <path d="M13.4637 13.8523L16.3971 16.778" stroke="#2F80ED" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </form>
            <!-- end search -->
        </div>
        <style>
            .notification-badge {
                background-color: red;
                color: white;
                padding: 5px 8px;
                margin-left: 10px;
                margin-right: -28px;
                border-radius: 50%;
                font-size: 12px;
                vertical-align: middle; /* Để canh giữa theo chiều dọc */
            }
        </style>
        <a href="#" class="main__title-link">
            REQUEST
            <p></p>
            <span style="position: relative;">
                @if(1 > 0)
                    <span class="notification-badge">9</span>
                @endif
            </span>
        </a>
    </div>
</div>
<!-- end main title -->

<!-- users -->
<div class="col-12">
    <div class="main__table-wrap">
        <table class="main__table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ROLE</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    {{-- <th>COMMENTS</th>
                    <th>REVIEWS</th> --}}
                    <th>STATUS</th>
                    <th>CRAETED DATE</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>

            <tbody>
                {{$i = 0}}
                @foreach ($users as $user)
                {{$i++}}
                    <tr>
                        <td>
                            <div class="main__table-text">{{$i}}</div>
                        </td>
                        <td>
                            <div class="main__user">
                                <div class="main__avatar">
                                    <img src="{{$user->avatar}}" alt="{{$user->name}}">
                                </div>
                                <div class="main__meta">
                                    {{-- <h3>{{$user->name}}</h3> --}}
                                    @if ($user->role == 1)
                                        <span>ADMIN</span>
                                    @elseif($user->role == 2)
                                        <span>MANAGER</span>
                                    @else
                                        <span>STAFF</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="main__table-text">{{$user->name}}</div>
                        </td>
                        <td>
                            <div class="main__table-text">{{$user->email}}</div>
                        </td>
                        {{-- <td>
                            <div class="main__table-text">{{$user->comments_count}}</div>
                        </td>
                        <td>
                            <div class="main__table-text">{{$user->ratings_count}}</div>
                        </td> --}}
                        <td>
                            @if ($user->status == 1)
                                <div class="main__table-text main__table-text--green">Active</div>
                            @elseif($user->status == 2)
                                <div class="main__table-text main__table-text--red">Banned</div>
                            @endif
                        </td>
                        <td>
                            <div class="main__table-text">{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</div>
                        </td>
                        <td>
                            <div class="main__table-btns">
                                <a href="{{ route('user.show', $user->id) }}" class="main__table-btn main__table-btn--edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M224 0a128 128 0 1 1 0 256A128 128 0 1 1 224 0zM178.3 304h91.4c11.8 0 23.4 1.2 34.5 3.3c-2.1 18.5 7.4 35.6 21.8 44.8c-16.6 10.6-26.7 31.6-20 53.3c4 12.9 9.4 25.5 16.4 37.6s15.2 23.1 24.4 33c15.7 16.9 39.6 18.4 57.2 8.7v.9c0 9.2 2.7 18.5 7.9 26.3H29.7C13.3 512 0 498.7 0 482.3C0 383.8 79.8 304 178.3 304zM436 218.2c0-7 4.5-13.3 11.3-14.8c10.5-2.4 21.5-3.7 32.7-3.7s22.2 1.3 32.7 3.7c6.8 1.5 11.3 7.8 11.3 14.8v17.7c0 7.8 4.8 14.8 11.6 18.7c6.8 3.9 15.1 4.5 21.8 .6l13.8-7.9c6.1-3.5 13.7-2.7 18.5 2.4c7.6 8.1 14.3 17.2 20.1 27.2s10.3 20.4 13.5 31c2.1 6.7-1.1 13.7-7.2 17.2l-14.4 8.3c-6.5 3.7-10 10.9-10 18.4s3.5 14.7 10 18.4l14.4 8.3c6.1 3.5 9.2 10.5 7.2 17.2c-3.3 10.6-7.8 21-13.5 31s-12.5 19.1-20.1 27.2c-4.8 5.1-12.5 5.9-18.5 2.4l-13.8-7.9c-6.7-3.9-15.1-3.3-21.8 .6c-6.8 3.9-11.6 10.9-11.6 18.7v17.7c0 7-4.5 13.3-11.3 14.8c-10.5 2.4-21.5 3.7-32.7 3.7s-22.2-1.3-32.7-3.7c-6.8-1.5-11.3-7.8-11.3-14.8V467.8c0-7.9-4.9-14.9-11.7-18.9c-6.8-3.9-15.2-4.5-22-.6l-13.5 7.8c-6.1 3.5-13.7 2.7-18.5-2.4c-7.6-8.1-14.3-17.2-20.1-27.2s-10.3-20.4-13.5-31c-2.1-6.7 1.1-13.7 7.2-17.2l14-8.1c6.5-3.8 10.1-11.1 10.1-18.6s-3.5-14.8-10.1-18.6l-14-8.1c-6.1-3.5-9.2-10.5-7.2-17.2c3.3-10.6 7.7-21 13.5-31s12.5-19.1 20.1-27.2c4.8-5.1 12.4-5.9 18.5-2.4l13.6 7.8c6.8 3.9 15.2 3.3 22-.6c6.9-3.9 11.7-11 11.7-18.9V218.2zm92.1 133.5a48.1 48.1 0 1 0 -96.1 0 48.1 48.1 0 1 0 96.1 0z"/></svg>
                                </a>
                                @if ($user->status == 1)
                                    <a onclick="showCustomAlert({{$user->id}},{{$user->status}},2)" class="main__table-btn main__table-btn--banned">
                                        <svg style="fill: #eb5757" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,13a1.49,1.49,0,0,0-1,2.61V17a1,1,0,0,0,2,0V15.61A1.49,1.49,0,0,0,12,13Zm5-4V7A5,5,0,0,0,7,7V9a3,3,0,0,0-3,3v7a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V12A3,3,0,0,0,17,9ZM9,7a3,3,0,0,1,6,0V9H9Zm9,12a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V12a1,1,0,0,1,1-1H17a1,1,0,0,1,1,1Z"/></svg>
                                    </a>
                                @else
                                    <a onclick="showCustomAlert({{$user->id}},{{$user->status}},1)" class="main__table-btn main__table-btn--banned">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-640h360v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85h-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640Zm0 480h480v-400H240v400Zm240-120q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM240-160v-400 400Z"/></svg>                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- end users -->

<!-- paginator -->
<div class="col-12">
    {{$users->links('admin.widgets.paginator')}}
</div>
<!-- end paginator -->

<script>
    function showCustomAlert(movieId, status) {
        // Tạo phần tử overlay và thêm CSS trực tiếp
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

        // Tạo cảnh báo tùy chỉnh
        var toxicAlert = document.createElement('div');
        toxicAlert.setAttribute('id', 'toxicAlert');
        toxicAlert.style.position = 'fixed';
        toxicAlert.style.top = '50%';
        toxicAlert.style.left = '50%';
        toxicAlert.style.transform = 'translate(-50%, -50%)';
        toxicAlert.style.backgroundColor = 'rgb(21, 31, 48)';
        toxicAlert.style.padding = '20px';
        toxicAlert.style.borderRadius = '20px';
        toxicAlert.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
        toxicAlert.style.zIndex = '9999'; // Set z-index to a high value
        toxicAlert.style.opacity = '0'; // Ban đầu ẩn toxicAlert
        toxicAlert.style.transition = 'opacity 0.4s ease-in-out'; // Thêm hiệu ứng transition
        toxicAlert.style.width = '420px';

        var title = document.createElement('h2');
        title.textContent = 'Notification';
        title.style.fontSize = '28px';
        title.style.color = 'White';
        toxicAlert.appendChild(title);

        var message = document.createElement('p');
        message.textContent = 'Are you sure to permanently delete this Movie?';
        message.style.color = 'White';
        message.style.fontSize = '14px';
        toxicAlert.appendChild(message);

        toxicAlert.style.textAlign = 'center';

        var confirmButton = document.createElement('button');
        confirmButton.textContent = 'DELETE';
        confirmButton.style.padding = '10px 40px';
        confirmButton.style.backgroundColor = '#2f80ed';
        confirmButton.style.color = 'white';
        confirmButton.style.border = 'none';
        confirmButton.style.borderRadius = '18px';
        confirmButton.style.cursor = 'pointer';
        confirmButton.style.marginRight = '20px';
        confirmButton.style.fontSize = '14px';
        // confirmButton.onclick = function() {
        //     document.getElementById('form-' + movieId).submit();
        confirmButton.onclick = function() {
            // Xác định href tùy thuộc vào giá trị status
            var href;
            if (status === 1) {
                href = "{{ route('user.changeStatus', ['id' => $user->id, 'status' => 2 ]) }}";
            } else {
                href = "{{ route('user.changeStatus', ['id' => $user->id, 'status' => 1 ]) }}";
            }

            // Chuyển hướng đến href sau khi xác nhận hành động
            setTimeout(function() {
                window.location.href = href;
            }, 500); // Đợi 500 miligiây trước khi chuyển hướng
        };
        toxicAlert.appendChild(confirmButton);

        var cancelButton = document.createElement('button');
        cancelButton.textContent = 'CANCEL';
        cancelButton.style.padding = '10px 40px';
        cancelButton.style.backgroundColor = 'White';
        cancelButton.style.color = 'Black';
        cancelButton.style.border = 'none';
        cancelButton.style.borderRadius = '18px';
        cancelButton.style.cursor = 'pointer';
        cancelButton.style.fontSize = '14px';
        cancelButton.onclick = function() {
            overlay.style.opacity = '0'; // Ẩn overlay khi cancel
            toxicAlert.style.opacity = '0'; // Ẩn toxicAlert khi cancel
            setTimeout(function() {
                document.body.removeChild(overlay);
                document.body.removeChild(toxicAlert);
            }, 1000); // Sau 1 giây, xóa overlay và toxicAlert
        };
        toxicAlert.appendChild(cancelButton);

        // Lấy phần tử đầu tiên trong body
        var firstElement = document.body.firstChild;

        // Chèn cửa sổ alert vào trước phần tử đầu tiên trong body
        document.body.insertBefore(toxicAlert, firstElement);

        // Kích hoạt hiệu ứng hiển thị dần
        setTimeout(function() {
            overlay.style.opacity = '1';
            toxicAlert.style.opacity = '1';
        }, 100); // Cho một khoảng nhỏ để trình duyệt cập nhật DOM trước khi kích hoạt transition
    }
</script>

{{-- <script>
function showCustomAlert(userId, now,status) {
    // Tạo phần tử overlay và thêm CSS trực tiếp
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

    // Tạo cảnh báo tùy chỉnh
    var toxicAlert = document.createElement('div');
    toxicAlert.setAttribute('id', 'toxicAlert');
    toxicAlert.style.position = 'fixed';
    toxicAlert.style.top = '50%';
    toxicAlert.style.left = '50%';
    toxicAlert.style.transform = 'translate(-50%, -50%)';
    toxicAlert.style.backgroundColor = 'rgb(21, 31, 48)';
    toxicAlert.style.padding = '20px';
    toxicAlert.style.borderRadius = '20px';
    toxicAlert.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
    toxicAlert.style.zIndex = '9999'; // Set z-index to a high value
    toxicAlert.style.opacity = '0'; // Ban đầu ẩn toxicAlert
    toxicAlert.style.transition = 'opacity 0.4s ease-in-out'; // Thêm hiệu ứng transition
    toxicAlert.style.width = '420px';

    var title = document.createElement('h2');
    title.textContent = 'Notification';
    title.style.fontSize = '28px';
    title.style.color = 'White';
    toxicAlert.appendChild(title);

    var message = document.createElement('p');
    message.textContent = 'Are you sure to permanently delete this Movie?';
    message.style.color = 'White';
    message.style.fontSize = '14px';
    toxicAlert.appendChild(message);

    toxicAlert.style.textAlign = 'center';

    var confirmButton = document.createElement('button');
    confirmButton.textContent = 'DELETE';
    confirmButton.style.padding = '10px 40px';
    confirmButton.style.backgroundColor = '#2f80ed';
    confirmButton.style.color = 'white';
    confirmButton.style.border = 'none';
    confirmButton.style.borderRadius = '18px';
    confirmButton.style.cursor = 'pointer';
    confirmButton.style.marginRight = '20px';
    confirmButton.style.fontSize = '14px';
    // confirmButton.onclick = function() {
    //     document.getElementById('form-' + movieId).submit();
    confirmButton.onclick = function() {
        // Xác định href tùy thuộc vào giá trị status
        var href;
        if (now === 1) {
            href = "{{ route('user.changeStatus', ['id' => " + userId + ", 'status' => " + status + "]) }}";
        } else {
            href = "{{ route('user.changeStatus', ['id' => " + userId + ", 'status' => " + status + "]) }}";
        }



        // Chuyển hướng đến href sau khi xác nhận hành động
        setTimeout(function() {
            window.location.href = href;
        }, 500); // Đợi 500 miligiây trước khi chuyển hướng
    };
    toxicAlert.appendChild(confirmButton);

    var cancelButton = document.createElement('button');
    cancelButton.textContent = 'CANCEL';
    cancelButton.style.padding = '10px 40px';
    cancelButton.style.backgroundColor = 'White';
    cancelButton.style.color = 'Black';
    cancelButton.style.border = 'none';
    cancelButton.style.borderRadius = '18px';
    cancelButton.style.cursor = 'pointer';
    cancelButton.style.fontSize = '14px';
    cancelButton.onclick = function() {
        overlay.style.opacity = '0'; // Ẩn overlay khi cancel
        toxicAlert.style.opacity = '0'; // Ẩn toxicAlert khi cancel
        setTimeout(function() {
            document.body.removeChild(overlay);
            document.body.removeChild(toxicAlert);
        }, 1000); // Sau 1 giây, xóa overlay và toxicAlert
    };
    toxicAlert.appendChild(cancelButton);

    // Lấy phần tử đầu tiên trong body
    var firstElement = document.body.firstChild;

    // Chèn cửa sổ alert vào trước phần tử đầu tiên trong body
    document.body.insertBefore(toxicAlert, firstElement);

    // Kích hoạt hiệu ứng hiển thị dần
    setTimeout(function() {
        overlay.style.opacity = '1';
        toxicAlert.style.opacity = '1';
    }, 100); // Cho một khoảng nhỏ để trình duyệt cập nhật DOM trước khi kích hoạt transition
}
</script> --}}

<script>
    function showCustomAlert(userId, now, status) {
        // Tạo phần tử overlay và thêm CSS trực tiếp
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

        // Tạo cảnh báo tùy chỉnh
        var toxicAlert = document.createElement('div');
        toxicAlert.setAttribute('id', 'toxicAlert');
        toxicAlert.style.position = 'fixed';
        toxicAlert.style.top = '50%';
        toxicAlert.style.left = '50%';
        toxicAlert.style.transform = 'translate(-50%, -50%)';
        toxicAlert.style.backgroundColor = 'rgb(21, 31, 48)';
        toxicAlert.style.padding = '20px';
        toxicAlert.style.borderRadius = '20px';
        toxicAlert.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
        toxicAlert.style.zIndex = '9999'; // Set z-index to a high value
        toxicAlert.style.opacity = '0'; // Ban đầu ẩn toxicAlert
        toxicAlert.style.transition = 'opacity 0.4s ease-in-out'; // Thêm hiệu ứng transition
        toxicAlert.style.width = '420px';

        var title = document.createElement('h2');
        title.textContent = 'Notification';
        title.style.fontSize = '28px';
        title.style.color = 'White';
        toxicAlert.appendChild(title);

        var message = document.createElement('p');
        message.textContent = 'Are you sure to lock this user?';
        message.style.color = 'White';
        message.style.fontSize = '14px';
        toxicAlert.appendChild(message);

        toxicAlert.style.textAlign = 'center';

        var confirmButton = document.createElement('button');
        confirmButton.textContent = 'CONFIRM';
        confirmButton.style.padding = '10px 40px';
        confirmButton.style.backgroundColor = '#2f80ed';
        confirmButton.style.color = 'white';
        confirmButton.style.border = 'none';
        confirmButton.style.borderRadius = '18px';
        confirmButton.style.cursor = 'pointer';
        confirmButton.style.marginRight = '20px';
        confirmButton.style.fontSize = '14px';

        // Tạo href dựa trên giá trị của userId và status
        var href;
        if (now === 1) {
            href = "/administrator/users/changestatus-" + userId + "-" + status;
        } else {
            href = "/administrator/users/changestatus-" + userId + "-" + status;
        }

        confirmButton.onclick = function() {
            // Chuyển hướng đến href sau khi xác nhận hành động
            setTimeout(function() {
                window.location.href = href;
            }, 500); // Đợi 500 miligiây trước khi chuyển hướng
        };
        toxicAlert.appendChild(confirmButton);

        var cancelButton = document.createElement('button');
        cancelButton.textContent = 'CANCEL';
        cancelButton.style.padding = '10px 40px';
        cancelButton.style.backgroundColor = 'White';
        cancelButton.style.color = 'Black';
        cancelButton.style.border = 'none';
        cancelButton.style.borderRadius = '18px';
        cancelButton.style.cursor = 'pointer';
        cancelButton.style.fontSize = '14px';
        cancelButton.onclick = function() {
            overlay.style.opacity = '0'; // Ẩn overlay khi cancel
            toxicAlert.style.opacity = '0'; // Ẩn toxicAlert khi cancel
            setTimeout(function() {
                document.body.removeChild(overlay);
                document.body.removeChild(toxicAlert);
            }, 1000); // Sau 1 giây, xóa overlay và toxicAlert
        };
        toxicAlert.appendChild(cancelButton);

        // Lấy phần tử đầu tiên trong body
        var firstElement = document.body.firstChild;

        // Chèn cửa sổ alert vào trước phần tử đầu tiên trong body
        document.body.insertBefore(toxicAlert, firstElement);

        // Kích hoạt hiệu ứng hiển thị dần
        setTimeout(function() {
            overlay.style.opacity = '1';
            toxicAlert.style.opacity = '1';
        }, 100); // Cho một khoảng nhỏ để trình duyệt cập nhật DOM trước khi kích hoạt transition
    }
</script>

@endsection
