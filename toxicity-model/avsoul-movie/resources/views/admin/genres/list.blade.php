@extends('admin.master')
@section('body')
<div class="row">
    <!-- main title -->
    <div class="col-12">
        <div class="main__title">
            <h2>{{$title}}</h2>

            <span class="main__title-stat">{{$total}} total</span>
            <div class="main__title-wrap">
                <!-- filter sort -->
                <div class="filter" id="filter__sort">
                    <span class="filter__item-label">Sort by:</span>

                    <div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-sort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <input type="button" value="Date created">
                        <span></span>
                    </div>

                    <ul class="filter__item-menu dropdown-menu scrollbar-dropdown" aria-labelledby="filter-sort">
                        <li>Date created</li>
                        <li>Rating</li>
                        <li>Views</li>
                    </ul>
                </div>
                <!-- end filter sort -->

                <!-- search -->
                <form action="#" class="main__title-form">
                    <input type="text" placeholder="Find movie / tv series..">
                    <button type="button">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="8.25998" cy="8.25995" r="7.48191" stroke="#2F80ED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle><path d="M13.4637 13.8523L16.3971 16.778" stroke="#2F80ED" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </button>
                </form>
                <!-- end search -->
            </div>
            <a href="{{route('genre.create')}}" class="main__title-link">ADD GENRES</a>
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
                        <th>IMAGE</th>
                        <th>TITLE</th>
                        <th>STATUS</th>
                        <th>CRAETED DATE</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>

                <tbody>
                    {{$i = 0}}
                    @foreach ($list as $genre)
                    {{ $i++ }}
                    <tr>
                        <td>
                            <div class="main__table-text">{{$i}}</div>
                        </td>
                        <td style="text-align: center; background-color:#171F2F">
                            {{-- <div class="main__table-text">
                            </div> --}}
                            {{-- <img src="{{asset('main/img/tenkino.jpeg')}}" style="height: 70px;"> --}}
                            <img src="{{$genre->image?? ''}}" style="height: 70px;">
                        </td>
                        <td>
                            <div class="main__table-text"><a href="#">{{ $genre->title }}</a></div>
                        </td>
                        <td>
                            @if ($genre->status == 1)
                                <div class="main__table-text main__table-text--green">Publish</div>
                            @elseif($genre->status == 2)
                                <div class="main__table-text main__table-text--red">Hidden</div>
                            @endif
                        </td>
                        <td>
                            <div class="main__table-text">
                                {{ \Carbon\Carbon::parse($genre->created_at)->format('d M Y') }}
                            </div>
                        </td>
                        <td>
                            <div class="main__table-btns">
                                <a href="#modal-status" class="main__table-btn main__table-btn--banned open-modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,13a1.49,1.49,0,0,0-1,2.61V17a1,1,0,0,0,2,0V15.61A1.49,1.49,0,0,0,12,13Zm5-4V7A5,5,0,0,0,7,7V9a3,3,0,0,0-3,3v7a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V12A3,3,0,0,0,17,9ZM9,7a3,3,0,0,1,6,0V9H9Zm9,12a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V12a1,1,0,0,1,1-1H17a1,1,0,0,1,1,1Z"/></svg>
                                </a>
                                <a href="{{ route('genre.edit', $genre->id) }}" class="main__table-btn main__table-btn--edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22,7.24a1,1,0,0,0-.29-.71L17.47,2.29A1,1,0,0,0,16.76,2a1,1,0,0,0-.71.29L13.22,5.12h0L2.29,16.05a1,1,0,0,0-.29.71V21a1,1,0,0,0,1,1H7.24A1,1,0,0,0,8,21.71L18.87,10.78h0L21.71,8a1.19,1.19,0,0,0,.22-.33,1,1,0,0,0,0-.24.7.7,0,0,0,0-.14ZM6.83,20H4V17.17l9.93-9.93,2.83,2.83ZM18.17,8.66,15.34,5.83l1.42-1.41,2.82,2.82Z"/></svg>
                                </a>
                                {{-- <a href="#modal-delete" class="main__table-btn main__table-btn--delete open-modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/></svg>
                                </a> --}}
                                <form method="POST" id="form-{{$genre->id}}" action="{{ route('genre.destroy', $genre->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a onclick="showCustomAlert({{ $genre->id }})" type="button" class="main__table-btn main__table-btn--delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/></svg>
                                    </a>
                                </form>
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
        {{ $list->links('admin.widgets.paginator') }}
    </div>
    <!-- end paginator -->
</div>
<script>

    function showCustomAlert(genreId) {
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
        message.textContent = 'Are you sure to permanently delete this Genre?';
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
        confirmButton.onclick = function() {
            document.getElementById('form-' + genreId).submit();
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
