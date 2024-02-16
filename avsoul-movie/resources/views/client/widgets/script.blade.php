<script src="{{asset('main/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('main/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('main/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('main/js/slider-radio.js')}}"></script>
<script src="{{asset('main/js/select2.min.js')}}"></script>
<script src="{{asset('main/js/smooth-scrollbar.js')}}"></script>
<script src="{{asset('main/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('main/js/plyr.min.js')}}"></script>
<script src="{{asset('main/js/main.js')}}"></script>

<script>
    $(document).ready(function() {
        $('.reviews__form').submit(function(e) {
            e.preventDefault(); // Ngăn chặn gửi form mặc định

            var form = $(this);
            var formData = form.serialize(); // Lấy dữ liệu từ form

            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: formData,
                dataType: 'json',
                success: function(response) {
                    var rating = response.rating;
                    var ratingHtml = '<li class="reviews__item">' +
                                        '<div class="reviews__autor">' +
                                            '<img class="reviews__avatar" src="' + rating.avatar + '" alt="">' + // Thêm avatar của người dùng
                                            '<span class="reviews__name">' + rating.title + '</span>' +
                                            '<span class="reviews__time">' + rating.created_at + ' by ' + rating.user_name + '</span>' +
                                            '<span class="reviews__rating"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22,9.67A1,1,0,0,0,21.14,9l-5.69-.83L12.9,3a1,1,0,0,0-1.8,0L8.55,8.16,2.86,9a1,1,0,0,0-.81.68,1,1,0,0,0,.25,1l4.13,4-1,5.68A1,1,0,0,0,6.9,21.44L12,18.77l5.1,2.67a.93.93,0,0,0,.46.12,1,1,0,0,0,.59-.19,1,1,0,0,0,.4-1l-1-5.68,4.13-4A1,1,0,0,0,22,9.67Zm-6.15,4a1,1,0,0,0-.29.88l.72,4.2-3.76-2a1.06,1.06,0,0,0-.94,0l-3.76,2,.72-4.2a1,1,0,0,0-.29-.88l-3-3,4.21-.61a1,1,0,0,0,.76-.55L12,5.7l1.88,3.82a1,1,0,0,0,.76.55l4.21.61Z" /></svg>' + rating.rate + '</span>' +
                                        '</div>' +
                                        '<p class="reviews__text">' + rating.content + '</p>' +
                                    '</li>';
                    $('.reviews__list').append(ratingHtml); // Thêm đánh giá mới vào danh sách
                    form.trigger('reset'); // Xóa dữ liệu trong form
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

{{-- <script>
document.addEventListener("DOMContentLoaded", function() {
    var form = document.querySelector('.comments__form');
    form.addEventListener("submit", function(e) {
        e.preventDefault(); // Ngăn chặn gửi form mặc định

        var formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            var comment = data.comment;
            var ratingHtml = '<li class="comments__item">' +
                                '<div class="comments__autor">' +
                                    '<img class="comments__avatar" src="' + comment.avatar + '" alt="">' +
                                    '<span class="comments__name">' + comment.user_name + '</span>' +
                                    '<span class="comments__time">' + comment.created_at + '</span>' +
                                '</div>' +
                                '<p class="comments__text">' + comment.content + '</p>' +
                                '<div class="comments__actions">' +
                                    '<div class="comments__rate">' +
                                        '<button type="button">' +
                                            '<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                                                '<path d="M11 7.3273V14.6537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>' +
                                                '<path d="M14.6667 10.9905H7.33333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>' +
                                                '<path fill-rule="evenodd" clip-rule="evenodd" d="M15.6857 1H6.31429C3.04762 1 1 3.31208 1 6.58516V15.4148C1 18.6879 3.0381 21 6.31429 21H15.6857C18.9619 21 21 18.6879 21 15.4148V6.58516C21 3.31208 18.9619 1 15.6857 1Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>' +
                                            '</svg>' + comment.like_count +
                                        '</button>' +
                                        '<button type="button">' + comment.dislike_count +
                                            '<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                                                '<path d="M14.6667 10.9905H7.33333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>' +
                                                '<path fill-rule="evenodd" clip-rule="evenodd" d="M15.6857 1H6.31429C3.04762 1 1 3.31208 1 6.58516V15.4148C1 18.6879 3.0381 21 6.31429 21H15.6857C18.9619 21 21 18.6879 21 15.4148V6.58516C21 3.31208 18.9619 1 15.6857 1Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>' +
                                            '</svg>' +
                                        '</button>' +
                                    '</div>' +
                                    '<button type="button">' +
                                        '<svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">' +
                                            '<polyline points="400 160 464 224 400 288" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></polyline>' +
                                            '<path d="M448,224H154C95.24,224,48,273.33,48,332v20" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>' +
                                        '</svg><span>Reply</span>' +
                                    '</button>' +
                                    '<button type="button">' +
                                        '<svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">' +
                                            '<polyline points="320 120 368 168 320 216" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></polyline>' +
                                            '<path d="M352,168H144a80.24,80.24,0,0,0-80,80v16" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>' +
                                            '<polyline points="192 392 144 344 192 296" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></polyline>' +
                                            '<path d="M160,344H368a80.24,80.24,0,0,0,80-80V248" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>' +
                                        '</svg><span>Quote</span>' +
                                    '</button>' +
                                '</div>' +
                            '</div>' +
                        '</li>';
            var commentsList = document.querySelector('.comments__list');
            commentsList.insertAdjacentHTML('beforeend', ratingHtml);
            form.reset(); // Xóa dữ liệu trong form
        })
        .catch(function(error) {
            console.error(error);
        });
    });
});
</script> --}}


{{-- <script>
document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('.comments__form');
    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        const content = document.getElementById('text').value.trim();

        // Kiểm tra content rỗng
        if (content === '') {
            alert('Please enter a comment.');
            return;
        }

        try {
            // Gửi comment lên phương thức kiểm tra toxic
            const response = await fetch('{{route('mov.predict')}}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ comment: content })
            });

            if (!response.ok) {
                throw new Error('Failed to check toxicity.');
            }

            const result = await response.json();

            // Kiểm tra kết quả toxic
            const isToxic = result.toxic;
            const toxicMessage = isToxic ? 'Yes' : 'No';

            // Nếu comment không toxic, lưu vào database
            if (!isToxic) {
                const saveResponse = await fetch('{{route('mov.comment')}}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ content: content })
                });

                if (!saveResponse.ok) {
                    throw new Error('Failed to save comment.');
                }

                const savedComment = await saveResponse.json();
                alert('Comment saved successfully: ' + savedComment.comment.content);
            } else {
                // Nếu comment toxic, hiển thị cảnh báo
                alert('Your comment contains toxic content and cannot be saved.');
            }
        } catch (error) {
            console.error('Error:', error.message);
            alert(error.message);
        }
    });
});
</script> --}}

{{--
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('.comments__form');
    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        const content = document.getElementById('text').value.trim();

        // Kiểm tra content rỗng
        if (content === '') {
            alert('Please enter a comment.');
            return;
        }

        try {
            // Gửi comment lên phương thức kiểm tra toxic
            const response = await fetch('{{ route('mov.predict') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ comment: content })
            });

            if (!response.ok) {
                throw new Error('Failed to check toxicity.');
            }

            const result = await response.json();

            // Kiểm tra kết quả toxic
            const isToxic = result.toxic;

            // Nếu comment không toxic, lưu vào database
            if (!isToxic) {
                const formData = new FormData(form);
                formData.append('content', content); // Thêm nội dung comment vào FormData

                const saveResponse = await fetch(form.action, {
                    method: 'POST',
                    body: formData
                });

                if (!saveResponse.ok) {
                    throw new Error('Failed to save comment.');
                }

                const savedComment = await saveResponse.json();
                alert('Comment saved successfully: ' + savedComment.comment.content);
            } else {
                // Nếu comment toxic, hiển thị cảnh báo
                alert('Your comment contains toxic content and cannot be saved.');
            }
        } catch (error) {
            console.error('Error:', error.message);
            alert(error.message);
        }
    });
});
</script> --}}


<script>
    document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('.comments__form');
    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        const content = document.getElementById('text').value.trim();

        // Kiểm tra content rỗng
        if (content === '') {
            alert('Please enter a comment.');
            return;
        }

        try {
            // Gửi comment lên phương thức kiểm tra toxic
            const response = await fetch('{{ route('mov.predict') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ comment: content })
            });

            if (!response.ok) {
                throw new Error('Failed to check toxicity.');
            }

            const result = await response.json();

            // Kiểm tra kết quả toxic
            const isToxic = result.toxic;

            // Nếu comment không toxic, lưu vào database và cập nhật giao diện người dùng
            if (!isToxic) {
                const formData = new FormData(form);
                formData.append('content', content); // Thêm nội dung comment vào FormData

                const saveResponse = await fetch(form.action, {
                    method: 'POST',
                    body: formData
                });

                if (!saveResponse.ok) {
                    throw new Error('Failed to save comment.');
                }

                const savedComment = await saveResponse.json();
                // Cập nhật giao diện người dùng một cách realtime
                var ratingHtml = '<li class="comments__item">' +
                                    '<div class="comments__autor">' +
                                        '<img class="comments__avatar" src="' + savedComment.comment.avatar + '" alt="">' +
                                        '<span class="comments__name">' + savedComment.comment.user_name + '</span>' +
                                        '<span class="comments__time">' + savedComment.comment.created_at + '</span>' +
                                    '</div>' +
                                    '<p class="comments__text">' + savedComment.comment.content + '</p>' +
                                    '<div class="comments__actions">' +
                                        '<div class="comments__rate">' +
                                            '<button type="button">' +
                                                '<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                                                    '<path d="M11 7.3273V14.6537" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>' +
                                                    '<path d="M14.6667 10.9905H7.33333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>' +
                                                    '<path fill-rule="evenodd" clip-rule="evenodd" d="M15.6857 1H6.31429C3.04762 1 1 3.31208 1 6.58516V15.4148C1 18.6879 3.0381 21 6.31429 21H15.6857C18.9619 21 21 18.6879 21 15.4148V6.58516C21 3.31208 18.9619 1 15.6857 1Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>' +
                                                '</svg>' + savedComment.comment.like_count +
                                            '</button>' +
                                            '<button type="button">' + savedComment.comment.dislike_count +
                                                '<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                                                    '<path d="M14.6667 10.9905H7.33333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>' +
                                                    '<path fill-rule="evenodd" clip-rule="evenodd" d="M15.6857 1H6.31429C3.04762 1 1 3.31208 1 6.58516V15.4148C1 18.6879 3.0381 21 6.31429 21H15.6857C18.9619 21 21 18.6879 21 15.4148V6.58516C21 3.31208 18.9619 1 15.6857 1Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>' +
                                                '</svg>' +
                                            '</button>' +
                                        '</div>' +
                                        '<button type="button">' +
                                            '<svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">' +
                                                '<polyline points="400 160 464 224 400 288" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></polyline>' +
                                                '<path d="M448,224H154C95.24,224,48,273.33,48,332v20" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>' +
                                            '</svg><span>Reply</span>' +
                                        '</button>' +
                                        '<button type="button">' +
                                            '<svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">' +
                                                '<polyline points="320 120 368 168 320 216" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></polyline>' +
                                                '<path d="M352,168H144a80.24,80.24,0,0,0-80,80v16" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>' +
                                                '<polyline points="192 392 144 344 192 296" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></polyline>' +
                                                '<path d="M160,344H368a80.24,80.24,0,0,0,80-80V248" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>' +
                                            '</svg><span>Quote</span>' +
                                        '</button>' +
                                    '</div>' +
                                '</div>' +
                            '</li>';
                var commentsList = document.querySelector('.comments__list');
                commentsList.insertAdjacentHTML('beforeend', ratingHtml);
                form.reset(); // Xóa dữ liệu trong form
                // alert('Comment saved successfully: ' + savedComment.comment.content);
            } else {
                // Nếu comment toxic, hiển thị cảnh báo
                // alert('Your comment contains toxic content. Please use language in a civilized manner.');

                // Nếu comment toxic, hiển thị cảnh báo
                var toxicAlert = document.createElement('div');
                toxicAlert.setAttribute('id', 'toxicAlert');
                toxicAlert.style.position = 'fixed';
                toxicAlert.style.top = '50%';
                toxicAlert.style.left = '50%';
                toxicAlert.style.transform = 'translate(-50%, -50%)';
                toxicAlert.style.backgroundColor = 'white';
                toxicAlert.style.padding = '20px';
                toxicAlert.style.border = '2px solid black';
                toxicAlert.style.borderRadius = '30px';
                toxicAlert.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
                toxicAlert.style.zIndex = '9999'; // Set z-index to a high value

                var title = document.createElement('h2'); // Tạo phần tử h3
                title.textContent = 'WARNING'; // Đặt nội dung tiêu đề
                title.style.fontSize = '30px';
                title.style.color = 'Red';
                toxicAlert.appendChild(title); // Thêm tiêu đề vào alert

                var message = document.createElement('p');
                message.textContent = 'Your comment contains toxic content.\nPlease use language in a civilized manner.';
                message.style.whiteSpace = 'pre-line'; // Thiết lập white-space
                message.style.fontWeight = 'bold';
                message.style.fontSize = '20px';
                toxicAlert.appendChild(message);

                toxicAlert.style.textAlign = 'center';

                var closeButton = document.createElement('button');
                closeButton.textContent = 'CLOSE';
                closeButton.style.float = 'center'
                closeButton.style.padding = '10px 20px';
                closeButton.style.backgroundColor = '#467EE5';
                closeButton.style.color = 'white';
                closeButton.style.border = 'none';
                closeButton.style.borderRadius = '20px';
                closeButton.style.cursor = 'pointer';
                closeButton.style.width = '30%';
                closeButton.onclick = function() {
                document.body.removeChild(toxicAlert);
                };
                toxicAlert.appendChild(closeButton);

                // Lấy phần tử đầu tiên trong body
                var firstElement = document.body.firstChild;

                // Chèn cửa sổ alert vào trước phần tử đầu tiên trong body
                document.body.insertBefore(toxicAlert, firstElement);
            }
        } catch (error) {
            console.error('Error:', error.message);
            alert(error.message);
        }
    });
});
</script>






