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
    </div>
</div>
<!-- end main title -->

<div class="col-12">
    <div class="main__table-wrap">
        <table class="main__table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>BASIC INFO</th>
                    {{-- <th>NAME</th> --}}
                    <th>EMAIL</th>
                    <th>COMMENTS</th>
                    <th>REVIEWS</th>
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
                                    <h3>{{$user->name}}</h3>
                                    @if ($user->role == 0)
                                        <span>Viewer</span>
                                    @else
                                        <span>N/A</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        {{-- <td>
                            <div class="main__table-text">{{$user->name}}</div>
                        </td> --}}
                        <td>
                            <div class="main__table-text">{{$user->email}}</div>
                        </td>
                        <td>
                            <div class="main__table-text">{{$user->comments_count}}</div>
                        </td>
                        <td>
                            <div class="main__table-text">{{$user->ratings_count}}</div>
                        </td>
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
                                <a href="{{ route('viewers.show', $user->id) }}" class="main__table-btn main__table-btn--view">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z"/></svg>                                </a>
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

<!-- paginator -->
<div class="col-12">
    {{$users->links('admin.widgets.paginator')}}
</div>
<!-- end paginator -->
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
            href = "/administrator/viewers/changestatus-" + userId + "-" + status;
        } else {
            href = "/administrator/viewers/changestatus-" + userId + "-" + status;
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
