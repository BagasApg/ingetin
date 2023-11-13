{{-- <!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        
        <title>Main</title>
    </head>
    
    <body> --}}
{{-- if($result == 'tes'){
dd('if');
}else if(count($result) == 0){
dd('else if');
} else {
dd('else');
} --}}
@if ($result == 'tes')
    <div id="loading-container" style="height: 45vh"
        class="pt-5 d-flex align-items-center justify-content-center flex-column">
        <img src="{{ asset('assets/nolist.png') }}" class="pt-5" style="width: 80px;" alt="">
        <h5 class="pt-3 text-center">
            No such list, try checking your lists!
        </h5>
    </div>
@elseif($result == 'home')
    <div id="loading-container" style="height: 45vh"
        class="pt-5 d-flex align-items-center justify-content-center flex-column">
        <img src="{{ asset('assets/done.png') }}" class="pt-5" style="width: 80px;" alt="">
        <h5 class="pt-3 text-center">
            Select list to start arranging todos!
        </h5>
    </div>
@elseif (count($result) == 0)
    <div id="loading-container" style="height: 45vh"
        class="pt-5 d-flex align-items-center justify-content-center flex-column">
        <img src="{{ asset('assets/' . rand(1, 4) . '.gif') }}" class="pt-5" style="width: 80px;" alt="">
        <input type="hidden" name="" value="{{ $todolist->name }}" id="selected-list">
        <input type="hidden" name="" value="{{ $todolist->id }}" id="selected-list-id">

        <h5 class="pt-3 text-center">
            No todos found in <span class="fw-bold">{{ $todolist->name }}</span>...
            <br>
            <p class="mt-2">
                Add todos by typing on box above!

            </p>
        </h5>
    </div>
@else
    <input type="hidden" name="" value="{{ $todolist->name ? $todolist->name : '' }}" id="selected-list">
    <input type="hidden" name="" value="{{ $todolist->id ? $todolist->id : '' }}" id="selected-list-id">
    <div class="todos overflow-auto scrollbar" style="height: 83vh">

        @foreach ($result as $todo)
            {{-- <div class="d-flex align-items-center flex-row me-3"> --}}

                {{-- <div class="flex-fill"> --}}

                    <div onclick="showDesc({{ $todo->id }})" 
                        class=" mx-3 my-0 p-3  border-bottom todo-hover d-flex flex-row justify-content-between align-items-center"
                        style="border-radius: 0; padding-top: 0.67rem !important; padding-bottom: 0.67rem !important">

                        <div class="form-check mb-0 flex-fill">
                            <input class="form-check-input"
                                onchange="setStatus({{ $todo->id }}, '{{ route('process-data-status', $todo->id) }}')"
                                type="checkbox" value="" id="defaultCheck1" {{ $todo->status ? 'checked' : '' }}>
                            {{-- <label onblur="setName({{ $todo->id }}, this)" class="form-check-label" contenteditable="true">
                {{ $todo->name }} </label>
                --}}
                            <input type="text" onkeydown="event.keyCode === 13 && this.blur();"
                                onchange="setName({{ $todo->id }},'{{ route('process-data-name', $todo->id) }}', this.value)"
                                value="{{ $todo->name }}" class="todo-input" size="20"
                                style="width: 100% !important">
                        </div>
                        <small id="diff-for-{{ $todo->id }}"
                            class=" {{ $todo->diffStatus() }}">{{ $todo->diff() }}</small>
                    </div>
                {{-- </div> --}}
                {{-- <div class="px-3"> --}}

                    {{-- <i style="width: 18px; height: 18px" data-feather="trash-2"></i> --}}
                {{-- </div> --}}
            {{-- </div> --}}

            {{-- <i data-feather="trash-2"></i> --}}
        @endforeach
    </div>

@endif
<script>
    feather.replace()
</script>
{{-- titip --}}
