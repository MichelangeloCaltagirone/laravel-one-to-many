@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="card p-1">
            <span>{{ $project->id }} </span>
            <h2>Nome progetto: {{ $project->name }} </h2>
            <h3>Categoria: {{ $project->category->name }}</h3>
            <h3>Autore: {{ $project->author }} </h3>
            <p>
                <strong>Descrizione:</strong>
                {{ $project->description }}
            </p>
            <div>
                <a href="/admin/projects/{{$project->id}}/edit" class="btn btn-sm btn-success mt-2">Modifica</a>
                <form action="{{ route("admin.projects.delete", $project->id) }}" method="POST" class="d-inline">
                    @method("DELETE")
                    @csrf

                    <button type="submit" class="btn btn-sm btn-warning mt-2">
                        Elimina
                    </button>

                </form>
            </div>
        </div>
    </div>

@endsection
