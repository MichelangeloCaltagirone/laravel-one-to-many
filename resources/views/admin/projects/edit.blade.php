@extends("layouts.app")

@section("content")

<div class="container">

    <form class="card col-8 px-3 m-auto" action="{{ route("admin.projects.update", $project->id) }}" method="POST">
        @method("PUT")
        @csrf

        <div class="my-1">
            <label for="project-name" class="form-label ps-2">Nome Progetto:</label>
            <input type="text" class="form-control" id="project-name" name="name" value="{{ old('name', $project->name) }}">
            @error("name")
                <div class="alert alert-warning">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="my-1">
            <label for="project-category-id" class="form-label ps-2">Scegli Categoria:</label>
            <select id="project-category-id" name="category_id" class="form-control">
                @foreach ($categories as $category )
                    <option value="{{ $category->id }}"
                        @if($category->id == old("category_id", $project->category_id))
                            selected
                        @endif
                        >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error("category_id")
                <div class="alert alert-warning">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="my-1">
            <label for="project-author" class="form-label ps-2">Nome Autore:</label>
            <input type="text" class="form-control" id="project-author" name="author"
            value="{{ old('author', $project->author) }}">
            @error("author")
                <div class="alert alert-warning">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="my-1">
            <label for="project-description" class="form-label ps-2">Descrizione:</label>
            <input type="text" class="form-control" id="project-description" name="description"
            value="{{ old('description', $project->description) }}">
            @error("description")
                <div class="alert alert-warning">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="my-1 d-flex justify-content-around">
            <button class="btn btn-success my-2 px-3" type="submit">Modifica {{ $project->name }}</button>
            <button class="btn btn-warning my-2 px-3" type="reset">Svuota campi</button>
        </div>

    </form>

</div>



@endsection
