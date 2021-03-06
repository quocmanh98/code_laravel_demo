<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/admin/css/style.css">
    <script src="https://cdn.tiny.cloud/1/sw2sl8pyffsot4t1ozvquiihiqtqqxy2u6tkojlxwqkbdgq0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        var editor_config = {
            path_absolute: "http://localhost/PHP3_FPT/Proejct/Ismart/public/",
            selector: 'textarea',
            relative_urls: false,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            file_picker_callback: function(callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        };

        tinymce.init(editor_config);
    </script>
    <title>Admin</title>
</head>

<body>
    <div id="warpper" class="nav-fixed">
        <nav class="topnav shadow navbar-light bg-white d-flex">
            <div class="navbar-brand"><a href="{{route('admin.index')}}">Admin</a></div>
            <div class="nav-right ">
                <div class="btn-group mr-auto">
                    <button type="button" class="btn dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="plus-icon fas fa-plus-circle"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('admin.post.create')}}">Th??m b??i vi???t</a>
                        <a class="dropdown-item" href="{{route('admin.product.create')}}">Th??m s???n ph???m</a>
                        <a class="dropdown-item" href="{{route('admin.order.list')}}">????n h??ng</a>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       {{Auth::user()->name}}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">T??i kho???n</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                     </a>

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                     </form>
                    </div>
                </div>
            </div>
        </nav>
        <!-- end nav  -->
        <div id="page-body" class="d-flex">
            <div id="sidebar" class="bg-white">
                <ul id="sidebar-menu" >
                    <li class="nav-link {{ session('module_active') == 'dashboard' ? 'active':''}}">
                        <a href="{{route('admin.index')}}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Dashboard
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                    </li>
                    <li class="nav-link {{ session('module_active') == 'post' ? 'active':''}}">
                        <a href="{{route('admin.post.create')}}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            B??i vi???t
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{route('admin.post.create')}}">Th??m m???i</a></li>
                            <li><a href="{{route('admin.post.list')}}">Danh s??ch</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ session('module_active') == 'category product' ? 'active':''}}">
                        <a href="{{route('admin.cat.product.create')}}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Danh m???c s???n ph???m
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{route('admin.cat.product.create')}}">Th??m m???i</a></li>
                            <li><a href="{{route('admin.cat.product.list')}}">Danh s??ch</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ session('module_active') == 'category post' ? 'active':''}}">
                        <a href="{{route('admin.cat.post.create')}}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Danh m???c b??i vi???t
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{route('admin.cat.post.create')}}">Th??m m???i</a></li>
                            <li><a href="{{route('admin.cat.post.list')}}">Danh s??ch</a></li>
                        </ul>
                    </li>
                    {{-- <li class="nav-link {{ session('module_active') == 'brand product' ? 'active':''}}">
                        <a href="{{route('admin.brand.product.create')}}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Th????ng hi???u s???n ph???m
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{route('admin.brand.product.create')}}">Th??m m???i</a></li>
                            <li><a href="{{route('admin.brand.product.list')}}">Danh s??ch</a></li>
                        </ul>
                    </li> --}}
                    <li class="nav-link {{ session('module_active') == 'product' ? 'active':''}}">
                        <a href="{{route('admin.product.list')}}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            S???n ph???m
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{route('admin.product.create')}}">Th??m m???i</a></li>
                            <li><a href="{{route('admin.product.list')}}">Danh s??ch</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ session('module_active') == 'order' ? 'active':''}}">
                        <a href="{{route('admin.order.list')}}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            B??n h??ng
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{route('admin.order.list')}}">????n h??ng</a></li>
                        </ul>
                    </li>
                    <li class="nav-link {{ session('module_active') == 'user' ? 'active':''}}" >
                        <a href="{{route('admin.user.list')}}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Qu???n Tr???
                        </a>
                        <i class="arrow fas fa-angle-right"></i>
                        <ul class="sub-menu">
                            <li><a href="{{route('admin.user.create')}}">Th??m m???i</a></li>
                            <li><a href="{{route('admin.user.list')}}">Danh s??ch</a></li>
                        </ul>
                    </li>
                </li>
                <li class="nav-link {{ session('module_active') == 'customer' ? 'active':''}}" >
                    <a href="{{route('admin.customer.list')}}">
                        <div class="nav-link-icon d-inline-flex">
                            <i class="far fa-folder"></i>
                        </div>
                        Kh??ch H??ng
                    </a>
                    <i class="arrow fas fa-angle-right"></i>
                    <ul class="sub-menu">
                        <li><a href="{{route('admin.customer.list')}}">Danh s??ch</a></li>
                    </ul>
                </li>
                </ul>
            </div>
