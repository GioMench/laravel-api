@extends('layouts.admin')

@section('content')
    <header class="py-3 bg-dark text-light">
        <div class="container d-flex align-items-center justify-content-between">
            <h1>Project</h1>

            <a class="btn btn-primary" href="{{ route('admin.projects.create') }}"> New Project</a>
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            <h3 class="text-muted">All projects</h3>
            <div class="table-responsive">
                <!--succes-alert-edit/create-->
                @include('partials.session-message')

                <table class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Preview image</th>
                            <th scope="col">Project name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($projects as $project)
                            <tr class="">
                                <td scope="row">{{ $project->id }}</td>
                                <td>
                                    
                                     <img width="200px" loading="lazy" src="{{asset('storage/' . $project->preview_image)}}" alt="{{$project->project_name}}"> 
                                   
                                    

                                </td>
                                <td>{{ $project->project_name }}</td>
                                <td>{{ $project->slug }}</td>
                                <td>
                                    <a class="btn btn-dark text-uppercase"
                                        href="{{ route('admin.projects.show', $project) }}"style="font-size: 10px">
                                        show
                                    </a>
                                    <a class="btn btn-dark text-uppercase" style="font-size: 10px"
                                        href="{{ route('admin.projects.edit', $project) }}">
                                        Edit
                                    </a>
                                    <!-- Modal trigger button -->
                                    <button type="button" class="btn btn-danger text-uppercase" data-bs-toggle="modal" data-bs-target="#modal-{{ $project->id }}" style="font-size: 10px">
                                        delete
                                    </button>

                                    <!-- Modal Body -->
                                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                    <div class="modal fade" id="modal-{{ $project->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="modalTitleId-{{ $project->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalTitleId">
                                                        Delete
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">Destroy {{ $project->project_name }}?</div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <form action="{{ route('admin.projects.destroy', $project) }}"
                                                        method="project">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            Confirm
                                                        </button>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <td scope="row" colspan="5">No projects yet!</td>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
