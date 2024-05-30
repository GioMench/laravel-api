@extends('layouts.admin')

@section('content')
    <header class="py-3 bg-dark text-light">
        <div class="container">
            <h1>{{ $project->project_name }}</h1>
        </div>


    </header>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col">

                    <img width="400px" src="{{ asset('storage/' . $project->preview_image) }}"
                        alt="{{ $project->project_name }}">

                </div>
                <div class="col">
                    <h4 class="text-muted">description</h4>

                    <p>{{ $project->description }}</p>
                    <div class="metadata">
                        <strong>Type project: </strong>{{ $project->type ? $project->type->name : 'not specified' }}

                        <strong>Techlogies: </strong>
                        @forelse ($project->technologies as $technology)
                            <span>{{ $technology->name}}</span>
                        @empty
                            <span>not specified</span>
                        @endforelse
                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection
