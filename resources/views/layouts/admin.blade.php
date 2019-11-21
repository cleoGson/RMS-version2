<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME', 'Permissions Manager') }}</title>
     <link rel="stylesheet" href="/css/app.css">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    @yield('styles')
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed pace-done sidebar-lg-show">
    <header class="app-header navbar">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            <span class="navbar-brand-full">{{ env('APP_NAME', 'Permissions Manager') }}</span>
            <span class="navbar-brand-minimized">{{ env('APP_NAME', 'Permissions Manager') }}</span>
        </a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="nav navbar-nav ml-auto">
            @if(count(config('panel.available_languages', [])) > 1)
                <li class="nav-item dropdown d-md-down-none">
                    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach(config('panel.available_languages') as $langLocale => $langName)
                            <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                        @endforeach
                    </div>
                </li>
            @endif


        </ul>
    </header>

    <div class="app-body">
        @include('partials.menu')
        <main class="main">


            <div style="padding-top: 20px" class="container-fluid">
                @yield('content')

            </div>


        </main>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".editor").editor();
            $('.dateTimepicker').datetimepicker({ footer: true, modal: true });
            $('.timepicker').timepicker();
        });
    </script>
    <script>
        $('.datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
       <script>
        var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        $('.startDate').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            minDate: today,
            maxDate: function () {
                return $('.endDate').val();
            }
        });
        $('.dateTimepickertwo').datetimepicker({ footer: true, modal: true });
        $('.endDate').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            minDate: function () {
                return $('.startDate').val();
            }
        });
    </script>
    
  
        @include('sweetalert::alert')
        <script type="text/javascript">
            $(document).ready(function() {
                $('.select2-single').select2();
            });
            $('body').on('click', 'a.btn-delete', function (e) {
                e.preventDefault();
                let deleteUrl = $(this).attr('href');
                swal.fire({
                    title: 'Are you sure?',
                    text: 'This operation cannot be undone!',
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Cancel',
                    confirmButtonText: 'Delete',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#dda604',
                    preConfirm: (login) => {
                        let form = document.createElement('form');
                        form.setAttribute('method', 'post');
                        form.setAttribute('action', deleteUrl);

                        let csrfField = document.createElement('input');
                        csrfField.setAttribute('type', 'hidden');
                        csrfField.setAttribute('name', '_token');
                        csrfField.setAttribute('value', $('meta[name="csrf-token"]').attr('content'));
                        form.appendChild(csrfField);

                        let methodField = document.createElement('input');
                        methodField.setAttribute('type', 'hidden');
                        methodField.setAttribute('name', '_method');
                        methodField.setAttribute('value', 'DELETE');
                        form.appendChild(methodField);

                        document.body.appendChild(form);
                        //form.submit();
                        return form.submit()
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(response.statusText)
                                }
                                return response.json()
                            })
                            .catch(error => {
                                Swal.showValidationMessage(
                                    `Request failed: ${error}`
                                )
                            })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                })
            });
        </script>
    @yield('scripts')
</body>

</html>