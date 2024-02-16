<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- CSS -->
<link rel="stylesheet" href="{{asset('main/css/bootstrap-reboot.min.css')}}">
<link rel="stylesheet" href="{{asset('main/css/bootstrap-grid.min.css')}}">
<link rel="stylesheet" href="{{asset('main/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('main/css/slider-radio.css')}}">
<link rel="stylesheet" href="{{asset('main/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('main/css/magnific-popup.css')}}">
<link rel="stylesheet" href="{{asset('main/css/plyr.css')}}">
<link rel="stylesheet" href="{{asset('main/css/main.css')}}">

<!-- Favicons -->
<link rel="icon" type="image/png" href="{{asset('main/icon/favicon-32x32.png')}}')}}" sizes="32x32">
<link rel="apple-touch-icon" href="{{asset('main/icon/favicon-32x32.png')}}')}}">

<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="Dmitry Volkov">
<title>FlixTV – Movies & TV Shows, Online cinema HTML Template</title>


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

