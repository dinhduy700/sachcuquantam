<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Admin Page</title>

    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Montserrat'>
    <link rel="stylesheet" type="text/css" href="{{ url('assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{ url('assets/libs/jquery/jquery-ui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/libs/datetimepicker/jquery.datetimepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/libs/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/backend/responsive.css') }}" type="text/css">

    @stack('styles')
</head>

<body class="main-body">
    @include('backend.layout.header')
    @include('backend.layout.sidebar')

    <div class="main-content">

        @include('backend.component.message')

        @yield('backend-content-wrapper')
    </div>

    @include('backend.layout.footer')

    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery/jquery-ui.min.js') }}"></script>
    <script src={{  asset('assets/libs/datetimepicker/jquery.datetimepicker.full.min.js') }}></script>
    <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/libs/checktree.js') }}"></script> -->
    <script src="{{ asset('assets/libs/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/libs/ckeditor/ckeditor.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script src="{{ asset('assets/backend/main.js') }}"></script>
    {{-- <script src="{{ asset('assets/backend/library.js') }}"></script> --}}
    <script src="{{ asset('vendor/laravel-filemanager/js/filemanager.min.js')}}"></script>
    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
    <script>
        const appURL = "{{ env('APP_URL') }}";
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
          };
            $('.ckeditor').each(function(){
                CKEDITOR.replace(this, options);
            });
        $('.btn-lfm').filemanager('image');
    </script>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
    });

    var channel = pusher.subscribe('Notify');
    channel.bind('notify-channel', function(data) {
        console.log(data);
        var newNotificationHtml = `
            <a href="javascript:;" class="dropdown-item notify-item" attr-notify="${data.id}">
                <div class="icon">
                    <i class="fas ${data.type == 1 ? 'fa-file-invoice-dollar' : 'fa-user-plus'}"></i>
                </div>
                <div class="content">
                    <p>${data.title}</p>
                    <p class="sub-text text-muted">${data.user}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-circle"></i>
                </div>
            </a>
        `;
        
        $('.menu-notification').prepend(newNotificationHtml);
        var notifyUnread = $('#notify-unread').html() != undefined ? parseInt($('#notify-unread').html()) + 1 : 1;
        var newNotificationUnread = `<div class="circle"><span id="notify-unread">${notifyUnread}</span></div>`;
        $('.indicator').html(newNotificationUnread);
    });

    function getNotificationList(paginate) {
        $.ajax({
            type: 'GET',
            url: '/admin/load-notifications',
            data: { paginate },
            success: function(result){
                var newNotificationHtml = '';
                for(i = 0; i < result.length; i++) {
                    newNotificationHtml += `
                        <a href="javascript:;" class="dropdown-item notify-item" attr-notify="${result[i].id}">
                            <div class="icon">
                                <i class="fas ${result[i].data.type == 1 ? 'fa-file-invoice-dollar' : 'fa-user-plus'}"></i>
                            </div>
                            <div class="content">
                                <p>${result[i].data.title}</p>
                                <p class="sub-text text-muted">${result[i].data.user}</p>
                            </div>
                            <div class="icon">
                                <i class="${result[i].read_at == null ? 'fas fa-circle' : ''}"></i>
                            </div>
                        </a>
                    `;
                }
                $('.menu-notification').html(newNotificationHtml);
            },
            error: function(result) {
                console.error('get notification error')
            }
        });
    }

    $('#notificationDropdown').click(function() {
        $(this).next('.dropdown-menu').toggle();
        if ($('#notificationMenu').attr('attr-open') != 'true') {
            getNotificationList(1);
            $('#notificationMenu').attr('attr-open', 'true');
        }
    });

    $('#notify-load-more').click(function() {
        var paginate = $('.menu-notification').attr('attr-load');
        getNotificationList(paginate);
        $('.menu-notification').attr('attr-load', parseInt(paginate) + 1);
    });

    $('.btn-close-notify').click(function() {
        $(this).closest('.dropdown-menu').hide();
    });
    
    $('#delete-notify').click(function() {
        $.ajax({
            type: 'DELETE',
            url: '/admin/delete-notifications',
            data: { },
            success: function(result){
                $('.menu-notification').html('');
                $('.indicator').empty();
            },
            error: function(result) {
                console.error('delete notification error')
            }
        });
    });

    $(document).on('click', '.notify-item', function() {
        const notify = $(this).attr('attr-notify');
        $.ajax({
            type: 'GET',
            url: '/admin/detail-notifications',
            data: { notify },
            success: function(result){
                window.location.href = result;
            },
            error: function(result) {
                console.error('get notification detail error')
            }
        });
    });
    </script>
    @stack('scripts')
</body>

</html>