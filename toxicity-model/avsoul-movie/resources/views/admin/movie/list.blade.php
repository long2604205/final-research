@extends('admin.master')
@section('body')
<div class="row">
    <!-- main title -->
    <div class="col-12">
        <div class="main__title">
            <h2>Movies</h2>

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
                        <li>Status</li>
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
            <a href="{{route('movie.create')}}" class="main__title-link">ADD MOVIES</a>
        </div>
    </div>
    <!-- end main title -->

    <!-- movie -->
    <div class="col-12">
        <div class="main__table-wrap">
            <table class="main__table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>IMAGE</th>
                        <th>TITLE</th>
                        <th>RATING</th>
                        <th>GENRES</th>
                        <th>STATUS</th>
                        <th>CRAETED DATE</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>

                <tbody>
                    {{$i = 0}}
                    @foreach ($list as $movie)
                    {{ $i++ }}
                    <tr>
                        <td>
                            <div class="main__table-text">{{$i}}</div>
                        </td>
                        <td style="text-align: center; background-color:#171F2F">
                            {{-- <div class="main__table-text">
                            </div> --}}
                            <img src="{{$movie->image ?? ''}}" style="height: 70px;">
                        </td>
                        <td>
                            <div class="main__table-text"><a href="#">{{ $movie->title }}</a></div>
                        </td>

                        <td>
                            <div class="main__table-text main__table-text--rate"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22,9.67A1,1,0,0,0,21.14,9l-5.69-.83L12.9,3a1,1,0,0,0-1.8,0L8.55,8.16,2.86,9a1,1,0,0,0-.81.68,1,1,0,0,0,.25,1l4.13,4-1,5.68A1,1,0,0,0,6.9,21.44L12,18.77l5.1,2.67a.93.93,0,0,0,.46.12,1,1,0,0,0,.59-.19,1,1,0,0,0,.4-1l-1-5.68,4.13-4A1,1,0,0,0,22,9.67Zm-6.15,4a1,1,0,0,0-.29.88l.72,4.2-3.76-2a1.06,1.06,0,0,0-.94,0l-3.76,2,.72-4.2a1,1,0,0,0-.29-.88l-3-3,4.21-.61a1,1,0,0,0,.76-.55L12,5.7l1.88,3.82a1,1,0,0,0,.76.55l4.21.61Z"/></svg>
                                {{ number_format($movie->ratings->avg('rate'), 1) }}
                            </div>
                        </td>
                        <td>
                            {{-- <div class="main__table-text">
                                @foreach ($movie->genres as $genre)
                                    {{$genre->title . ", "}}
                                @endforeach
                            </div> --}}
                            <div class="main__table-text">
                                @foreach ($movie->genres as $key => $genre)
                                    {{$genre->title}}
                                    @if (!$loop->last && count($movie->genres) > 1)
                                        {{", "}}
                                    @endif
                                @endforeach
                            </div>
                        </td>
                        <td>
                            @if ($movie->status == 1)
                                <div class="main__table-text main__table-text--green">Publish</div>
                            @elseif($movie->status == 2)
                                <div class="main__table-text main__table-text--red">Hidden</div>
                            @endif
                        </td>
                        <td>
                            <div class="main__table-text">
                                {{ \Carbon\Carbon::parse($movie->created_at)->format('d M Y') }}
                            </div>
                        </td>
                        <td>
                            <div class="main__table-btns">
                                @if ($movie->status == 1)
                                    <a href="{{ route('movie.changeStatus', ['id' => $movie->id, 'status' => 2 ]) }}" class="main__table-btn main__table-btn--banned">
                                        <svg style="fill: #eb5757" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,13a1.49,1.49,0,0,0-1,2.61V17a1,1,0,0,0,2,0V15.61A1.49,1.49,0,0,0,12,13Zm5-4V7A5,5,0,0,0,7,7V9a3,3,0,0,0-3,3v7a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V12A3,3,0,0,0,17,9ZM9,7a3,3,0,0,1,6,0V9H9Zm9,12a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V12a1,1,0,0,1,1-1H17a1,1,0,0,1,1,1Z"/></svg>
                                    </a>
                                @else
                                <a href="{{ route('movie.changeStatus', ['id' => $movie->id, 'status' => 1 ]) }}" class="main__table-btn main__table-btn--banned">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M240-640h360v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85h-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640Zm0 480h480v-400H240v400Zm240-120q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM240-160v-400 400Z"/></svg>                                </a>
                                @endif
                                <a href="{{ route('movie.show', $movie->id) }}" class="main__table-btn main__table-btn--view">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z"/></svg>
                                </a>
                                <a href="{{ route('movie.edit', $movie->id) }}" class="main__table-btn main__table-btn--edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22,7.24a1,1,0,0,0-.29-.71L17.47,2.29A1,1,0,0,0,16.76,2a1,1,0,0,0-.71.29L13.22,5.12h0L2.29,16.05a1,1,0,0,0-.29.71V21a1,1,0,0,0,1,1H7.24A1,1,0,0,0,8,21.71L18.87,10.78h0L21.71,8a1.19,1.19,0,0,0,.22-.33,1,1,0,0,0,0-.24.7.7,0,0,0,0-.14ZM6.83,20H4V17.17l9.93-9.93,2.83,2.83ZM18.17,8.66,15.34,5.83l1.42-1.41,2.82,2.82Z"/></svg>
                                </a>
                                {{-- <form method="POST" id="form-{{$movie->id}}"
                                    action="{{ route('movie.destroy', $movie->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a onclick="if(confirm('Do you want to delete this Item')){document.getElementById('form-{{$movie->id}}').submit()}" type="button" class="main__table-btn main__table-btn--delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/></svg>
                                    </a>
                                </form> --}}
                                <form method="POST" id="form-{{$movie->id}}" action="{{ route('movie.destroy', $movie->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a onclick="showCustomAlert({{ $movie->id }})" type="button" class="main__table-btn main__table-btn--delete">
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
    <!-- end movie -->
    <!-- paginator -->
    <div class="col-12">
        {{ $list->links('admin.widgets.paginator') }}
    </div>
    <!-- end paginator -->
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Lắng nghe sự kiện click trên các mục trong menu dropdown
        document.querySelectorAll('.filter__item-menu li').forEach(function (item) {
            item.addEventListener('click', function () {
                // Lấy tiêu chí sắp xếp được chọn
                var sortBy = this.textContent;

                // Gọi hàm sắp xếp bảng
                sortTable(sortBy);
            });
        });

        // Lắng nghe sự kiện input trên ô nhập liệu tìm kiếm
        document.querySelector('.main__title-form input').addEventListener('input', function () {
            // Lấy giá trị nhập vào ô tìm kiếm
            var searchText = this.value.trim().toLowerCase();

            // Gọi hàm tìm kiếm và hiển thị kết quả
            searchTable(searchText);
        });
    });

    function sortTable(sortBy) {
        // Lấy bảng và các hàng trong bảng
        var table = document.querySelector('.main__table');
        var rows = table.querySelectorAll('tbody tr');

        // Chuyển các hàng thành mảng để có thể sắp xếp
        var rowsArray = Array.from(rows);

        // // Sắp xếp các hàng dựa trên tiêu chí được chọn
        // rowsArray.sort(function (rowA, rowB) {
        //     var valueA, valueB;

        //     // Lấy giá trị của cột tương ứng với tiêu chí sắp xếp
        //     switch (sortBy) {
        //         case 'Date created':
        //             valueA = rowA.querySelector('td:nth-child(7)').textContent;
        //             valueB = rowB.querySelector('td:nth-child(7)').textContent;
        //             break;
        //         case 'Rating':
        //             valueA = parseFloat(rowA.querySelector('td:nth-child(4) svg').nextSibling.textContent);
        //             valueB = parseFloat(rowB.querySelector('td:nth-child(4) svg').nextSibling.textContent);
        //             break;
        //         case 'Status':
        //             valueA = rowA.querySelector('td:nth-child(6)').textContent;
        //             valueB = rowB.querySelector('td:nth-child(6)').textContent;
        //             break;
        //         default:
        //             return 0;
        //     }

        //     // So sánh giá trị và trả về kết quả
        //     if (valueA < valueB) {
        //         return -1;
        //     }
        //     if (valueA > valueB) {
        //         return 1;
        //     }
        //     return 0;
        // });

        // Sắp xếp các hàng dựa trên tiêu chí được chọn
        rowsArray.sort(function(rowA, rowB) {
            var valueA, valueB;

            // Lấy giá trị của cột tương ứng với tiêu chí sắp xếp
            switch (sortBy) {
                case 'Date created':
                    valueA = rowA.querySelector('td:nth-child(7)').textContent;
                    valueB = rowB.querySelector('td:nth-child(7)').textContent;
                    break;
                case 'Rating':
                    // Lấy giá trị rating từ svg tiếp theo trong cột thứ tư
                    valueA = parseFloat(rowA.querySelector('td:nth-child(4) svg').nextSibling.textContent);
                    valueB = parseFloat(rowB.querySelector('td:nth-child(4) svg').nextSibling.textContent);

                    // Đảo ngược so sánh để sắp xếp từ cao xuống thấp
                    if (valueA > valueB) {
                        return -1;
                    }
                    if (valueA < valueB) {
                        return 1;
                    }
                    return 0;
                case 'Status':
                    valueA = rowA.querySelector('td:nth-child(6)').textContent;
                    valueB = rowB.querySelector('td:nth-child(6)').textContent;
                    break;
                default:
                    return 0;
            }

            // So sánh giá trị và trả về kết quả
            if (valueA < valueB) {
                return -1;
            }
            if (valueA > valueB) {
                return 1;
            }
            return 0;
        });

        // Xóa tất cả các hàng trong bảng
        table.querySelector('tbody').innerHTML = '';

        // Thêm các hàng đã được sắp xếp vào bảng
        rowsArray.forEach(function (row) {
            table.querySelector('tbody').appendChild(row);
        });
    }

    function searchTable(searchText) {
        // Lấy bảng và các hàng trong bảng
        var table = document.querySelector('.main__table');
        var rows = table.querySelectorAll('tbody tr');

        // Lặp qua các hàng để tìm kiếm
        rows.forEach(function (row) {
            // Lấy nội dung của các ô trong hàng và chuyển thành chữ thường để tìm kiếm không phân biệt hoa thường
            var rowData = row.textContent.trim().toLowerCase();

            // Nếu nội dung của hàng chứa chuỗi tìm kiếm, hiển thị hàng đó, ngược lại ẩn đi
            if (rowData.includes(searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>


<script>
function showCustomAlert(movieId) {
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
    confirmButton.onclick = function() {
        document.getElementById('form-' + movieId).submit();
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
