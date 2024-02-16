<script src="{{asset('admin/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('admin/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('admin/js/smooth-scrollbar.js')}}"></script>
<script src="{{asset('admin/js/select2.min.js')}}"></script>
{{-- <script src="{{asset('admin/js/admin.js')}}"></script> --}}
<script src="{{asset('admin/js/admin.js')}}"></script>

<script>
    $(document).ready(function(){
    // Lấy URL hiện tại
    var currentUrl = window.location.href;

    // Lặp qua từng liên kết trong thanh sidebar
    $(".sidebar__nav-link").each(function(){
        var linkUrl = $(this).attr("href");
        // So sánh URL hiện tại với URL của mỗi liên kết
        if (currentUrl == linkUrl) {
            // Nếu URL trùng khớp, thêm lớp active
            $(this).addClass("sidebar__nav-link--active");
        } else {
            // Nếu không, loại bỏ lớp active
            $(this).removeClass("sidebar__nav-link--active");
        }
    });
});

</script>
