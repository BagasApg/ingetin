<!DOCTYPE html>
<html lang="en">

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('assets') }}/img/favicon/favicon.ico" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet" />

        <!-- Icons. Uncomment required icon fonts -->
        <link rel="stylesheet" href="{{ asset('assets') }}/vendor/fonts/boxicons.css" />
        <script src="{{ asset('assets/vendor/js/feather.js') }}"></script>

        <!-- Core CSS -->
        {{-- <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" /> --}}
        {{-- <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" /> --}}
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/bootstrap-original.css') }}">
        <link rel="stylesheet" href="{{ asset('assets') }}/css/demo.css" />
        <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css" />
        <script src="{{ asset('assets/vendor/js/bootstrap-original.js') }}"></script>

        <!-- Vendors CSS -->
        <link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

        <!-- Page CSS -->

        <script src="{{ asset('assets') }}/vendor/libs/jquery/jquery.js"></script>

        <!-- Helpers -->
        <script src="{{ asset('assets') }}/vendor/js/helpers.js"></script>

        <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
        <script src="{{ asset('assets') }}/js/config.js"></script>

        {{-- JS Libraries --}}
        <script src="{{ asset('assets/vendor/libs/sweetalert2/dist/sweetalert2.all.js') }}"></script>
        <title>ingetin</title>
    </head>

    <body>
        <input type="hidden"
            value="{{ route('get-todos', request()->cookie('selected-id') ? request()->cookie('selected-id') : 0) }}"
            name="tes" id="titip-url">
        <input type="hidden" value="{{ request()->cookie('selected-id') ? request()->cookie('selected-id') : 0 }}"
            id="titip-id" name="">
        {{-- @dd(request('id')) --}}
        <div class="main-container">
            <div class="row p-0 m-0">
                <div class="col-sm-2 p-0 border" style="height: 100vh">
                    <div class="sidebar-container h-100 pt-2 d-flex flex-column justify-content-between">
                        <div class="sidebar-content">
                            <div class="px-2 pb-4 logo-container d-flex flex-row align-items-center gap-2">
                                <img style="width: 36px; height: 36px" src="{{ asset('assets/ingetin.jpg') }}"
                                    alt="">
                                <h3 class="m-0" id="logo">inget<span class="accent-color">i</span>n</h3>
                            </div>
                            <div
                                class=" mb-2 px-3 list-head d-flex flex-row justify-content-between align-items-center">

                                <h6 class="m-0 fw-bold">Lists</h6>
                                <!-- Button trigger modal -->
                                <div class="">

                                    <div title="Add List"
                                        class="list-add-button d-flex justify-content-center align-items-center p-1"
                                        type="button" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                        <i style="width: 18px; height: 18px" data-feather="plus"></i>

                                    </div>
                                </div>
                            </div>
                            <div class="list-body overflow-auto scrollbar" style="height: 75vh">

                                @foreach ($lists as $list)
                                    <div onclick="show('{{ route('get-todos', $list->id) }}', {{ $list->id }})"
                                        class="list ps-4 py-2">
                                        {{ $list->name }}
                                    </div>
                                @endforeach
                            </div>

                            <!-- Modal -->
                            <div class="col-lg-4 col-md-6">
                                {{-- <small class="text-light fw-semibold">Vertically centered</small> --}}
                                <div class="">

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalCenterTitle">Create new Todo List
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form method="POST" action="{{ route('create-list') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="nameWithTitle" class="form-label">List
                                                                    Name</label>
                                                                <input type="text" id="nameWithTitle"
                                                                    class="form-control" name="name"
                                                                    placeholder="Enter Name" />
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit"
                                                            class="btn accent-color-bg text-white">Create!</button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="height: 10%"
                        class="border-top border-2 bottom-0 py-2 px-2 accent-secondary w-100 profile">
                        <p class="fw-bold">BagasAp</p>
                    </div>

                </div>
            </div>
            <div class="col-sm-7 border p-0 pt-2">
                <div class="list-title px-3 py-2">
                    <div class="title-container d-flex flex-row justify-content-between align-items-center">

                    </div>

                </div>
                <div class="list-create p-2 pt-0 px-3">

                </div>
                <div class="list-todos pt-2" id="list-todos">
                    {{-- <div id="loading-container" style="height: 25vh"
                            class="pt-5 d-flex align-items-center justify-content-center flex-column">
                            <img src="{{ asset('assets/' . rand(1, 4) . '.gif') }}" class="pt-5" style="width: 80px;"
                                alt="">
                            <h5 class="pt-3 breathe-loading">{{ $loadings[(rand(0, 5))] }}</h5>
                        </div> --}}
                </div>
            </div>
            <div class="col-sm-3 p-0 border">
                <div class="desc-container pt-3" id="desc-container">
                    {{-- <div style="height: 75vh !important" class="d-flex justify-content-center align-items-center">

                            <p>Click any task to view its detail.</p>
                        </div> --}}
                </div>
            </div>
        </div>
        </div>

        <input type="hidden" id="loadings" value="{{ json_encode($loadings) }}">

        <script>
            console.log($('.sidebar-container').width());
            // textarea auto resize
            $("textarea").each(function() {
                this.setAttribute("style", "height:" + (this.scrollHeight) +
                    "px;overflow-y:hidden; width: 100% !important");
            }).on("input", function() {
                this.style.height = 0;
                this.style.height = (this.scrollHeight) + "px";
            });
            //=======================//

            var currentSelectedTodo_id;

            function showDesc(id) {
                console.log(currentSelectedTodo_id);
                if (id !== currentSelectedTodo_id) {
                    currentSelectedTodo_id = id;
                    console.log('fetching!');
                    $.get('getdescoftodo/' + id,
                        function(data) {
                            // console.log(data);
                            $('#desc-container').html(data);
                        });
                }
            }



            var currentSelectedList_id;
            const loadings = JSON.parse($('#loadings').val());

            function enterHandle() {
                const selectedList = $('#selected-list-id').val();
                const sentTodoName = $('#create-todo').val();
                const urlStatus = 'process-data-status';
                const urlName = 'process-data-name';
                // console.log(sentTodoName);
                $('#create-todo').blur();
                if ((sentTodoName === "") || !sentTodoName.trim()) {
                    return;
                }
                $('#loading-container').remove();
                // this.blur();
                const values = {
                    'id': selectedList,
                    'name': sentTodoName
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })

                $.ajax({
                    type: "POST",
                    url: "process-createnewtodo",
                    data: values,
                    dataType: "json",
                    success: function(res) {
                        $('.list-todos').append(`<div onclick="showDesc(${res.id})" oncontextmenu="alert('halo')"
            class=" mx-3 my-0 p-3  border-bottom todo-hover"
            style="border-radius: 0; padding-top: 0.67rem !important; padding-bottom: 0.67rem !important">

            <div class="form-check mb-0">
                <input class="form-check-input"
                    onchange="setStatus(${res.id}, '${urlStatus + '/' + res.id}')"
                    type="checkbox" value="" id="defaultCheck1" ${res.status ? 'checked' : ''}>
                {{-- <label onblur="setName({{ $todo->id }}, this)" class="form-check-label" contenteditable="true">
                        {{ $todo->name }} </label>
                         --}}
                <input type="text" onkeydown="event.keyCode === 13 && this.blur();"
                    onchange="setName(${res.id}, '${urlName + '/' + res.id}', this.value)"
                    value="${res.name}" class="todo-input" size="20" style="width: 100% !important">
            </div>
        </div>`);
                        console.log(res.id + '\n' + res.name);
                        // show($('#titip-url').val(), 0);

                    }
                });
            }

            function show(url, id) {
                const randomNumber = Math.floor(Math.random() * 5);

                const gif_url = 'assets/';
                const randomNumber_gifs = Math.floor(Math.random() * 4) + 1;

                console.log(loadings);

                console.log(randomNumber);
                if (id !== currentSelectedList_id) {
                    currentSelectedList_id = id;
                    $('.title-container').html(`
                            <div style="width:100px; height: 28.8px; background-color: rgb(238, 238, 250) !important" class="accent-secondary title-container rounded bg-danger"></div>
                    `);
                    $('#list-todos').html(`
                        <div id="loading-container" style="height: 25vh"
                            class="pt-5 d-flex align-items-center justify-content-center flex-column">
                            <img src="${gif_url + randomNumber_gifs + '.gif'}" class="pt-5" style="width: 80px;"
                                alt="">
                            <h5 class="pt-3 breathe-loading">${loadings[randomNumber]}</h5>
                        </div>
                            `);
                    $('.create-todo').attr('placeholder', '');
                    $('.desc-container').html('');

                    console.log('fetching show');
                    $.get(url,
                        function(data) {


                            console.log($('#selected-list').val());
                            $('#list-todos').html(data);
                            var selectedList = $('#selected-list').val();
                            var selectedList_id = $('#selected-list-id').val();
                            // alert(selectedList_id);
                            const editModal = `
                                    <div class="modal fade" id="editModal" tabindex="-1" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalCenterTitle">Edit List</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="nameWithTitle" class="form-label">List Name</label>
                                                                <form method="POST" action="/edit-list/${selectedList_id}">
                                                                @csrf
                                                            <input autofocus type="text" name="name" value="${selectedList}" id="nameWithTitle" class="form-control" placeholder="Enter Name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                    Cancel
                                                    </button>
                                                    <button type="submit" class="btn accent-color-bg text-white">Edit</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                `;
                            
                            // console.log(editModal);
                            $('.title-container').html(`
                                <h4 class="m-0">${selectedList ? selectedList : ''}</h4>
                                
                                   
                                ${selectedList ? 
                                    `<div title="Edit ${selectedList}" class="list-options d-flex justify-content-center align-items-center p-2 show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i style="width: 20px; height: 20px" data-feather="more-horizontal"></i>

                                    </div>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="d-flex align-items-center gap-3 dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal"><i style="width: 18.6px" data-feather="edit"></i><span>Edit</span></a></li>
                                            <form id="delete-form" action="" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <li><button type="button" onclick="deleteList('/deletelist/${selectedList_id}', '${selectedList}')" class="d-flex align-items-center gap-3 dropdown-item"><i style="width: 18.6px" data-feather="trash"></i><span>Delete</span></button></li>
                                            </form>
                                        </ul>
                                        ${editModal}
                                        ` : ''}
                            `);
                            $('.list-create').html(`
                                ${selectedList ? `<input type="text" onblur="this.value = '';" onkeydown="event.keyCode === 27 && this.blur(); event.keyCode === 13 && enterHandle();" name="create-todo" size="20" class="w-100 create-todo py-2"style="padding-left: 0.53rem !important" id="create-todo" placeholder="+ Add task to ${selectedList}">` : ''}
                            `);
                            $('#desc-container').html(
                                `
                            ${selectedList ? 
                                `<div style="height: 75vh !important" class="d-flex justify-content-center align-items-center"><p>Click any task to view its detail.</p></div>` : ''}`
                            );
                            feather.replace();
                        }
                    );
                }
            }
            console.log($('#titip-url').val());
            setTimeout(() => {

                show($('#titip-url').val(), $('#titip-id').val());
            }, 300);

            // const time = Math.floor(Math.random() * 1000) + 1;
            // setTimeout(() => {
            //     show();

            // }, time);

            // setTimeout(() => {
            //     console.log('second loading');
            //     $('#list-todos').html(`
    //             <div id="loading-container" style="height: 25vh"
    //                 class="pt-5 d-flex align-items-center justify-content-center flex-column">
    //                 <img src="{{ asset('assets/' . rand(1, 4) . '.gif') }}" class="pt-5" style="width: 80px;"
    //                     alt="">
    //                 <h5 class="pt-3 breathe-loading">Loading your todos...</h5>
    //             </div>`);


            // }, 5000);
        </script>
        <script>
            function setDate(id, url, value) {
                var values = {
                    'id': id,
                    'deadline': value
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                $.ajax({
                    type: "POST",
                    url: url,
                    data: values,
                    dataType: "json",
                    success: function(res) {
                        // location.reload();
                        $('#diff-for-' + res.id).html(res.deadline)
                        $('#diff-for-' + res.id).attr('class', res.status);
                    }
                });
            }

            function setStatus(id, url) {

                var values = {
                    'id': id
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                console.log('sent status!');

                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        'values': values
                    },
                    dataType: "json",
                    success: function(response) {}
                });
            }

            function setName(id, url, value) {
                // alert('hi')
                var values = {
                    'id': id,
                    'name': value
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                console.log('sent!');
                $.ajax({
                    type: "POST",
                    url: url,
                    data: values,
                    dataType: "json",
                    success: function(res) {
                        showDesc(res.id);

                    }
                });

            }

            function setDesc(id, url, val) {
                var values = {
                    'id': id,
                    'description': val
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                console.log(id);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: values,
                    dataType: "json",
                    success: function(response) {

                    }
                });
            }

            function deleteList(url, listName) {
                // alert(url + ' ' + listName)
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Are you sure',
                        text: "This action is irreversible. Continue?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Deleted!',
                                'List "' + listName + '" deleted!',
                                'success'
                            ).then(() => {
                                $("#delete-form").attr('action', url);
                                $('#delete-form').submit();

                            })
                        }
                    })
                });
            }
            feather.replace();
        </script>
    </body>

</html>
