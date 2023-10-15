<div class="desc-head px-3 d-flex flex-column justify-content-between pb-2">
    <div class="d-flex flex-row justify-content-between align-items-center mb-3">
        <h5 class="todo-name-detail m-0">{{ $todo->name }}</h5>
        <form id="delete-form" action="" method="post">
        @csrf
        @method('DELETE')
            <div onclick="deleteTodo('{{ route('delete-todo', $todo->id) }}', '{{ $todo->name }}')" title="Delete {{ $todo->name }}"
                class="delete-todo d-flex justify-content-center align-items-center p-2 show">
                <i style="width: 18px; height: 18px" data-feather="trash"></i>
            </div>
        </form>

    </div>
    <div class="">

        <input value="{{ $todo->deadline }}"
            onchange="setDate({{ $todo->id }}, '{{ route('process-data-date', $todo->id) }}', this.value)"
            type="datetime-local" class="form-control">
    </div>
</div>
<div class="desc-body ps-3 overflow-auto scrollbar" style="height: 80vh">

    <textarea onkeydown="event.keyCode === 27 && this.blur();" placeholder="Description" class="desc-input"
        onchange="setDesc({{ $todo->id }}, '{{ route('process-data-description', $todo->id) }}', this.value)"
        name="desc" id="" style="width: 100% !important">{{ $todo->description }}</textarea>
</div>

<script>
    $("textarea").each(function() {
        this.setAttribute("style", "height:" + (this.scrollHeight) +
            "px;overflow-y:hidden; width: 100% !important");
    }).on("input", function() {
        this.style.height = 0;
        this.style.height = (this.scrollHeight) + "px";
    });

    function deleteTodo(url, name) {
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
                        'Todo "' + name + '" deleted!',
                        'success'
                    ).then(() => {
                        $("#delete-form").attr('action', url);
                        $('#delete-form').submit();

                    })
                }
            })
        });
    }

    feather.replace()
</script>
{{-- <h5>name</h5>
<textarea placeholder="Description" class="desc-input" name="desc"
    id="" style="width: 100% !important">tes</textarea> --}}
