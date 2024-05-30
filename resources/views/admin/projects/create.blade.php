@extends('layouts.admin')

@section('content')
    <header class="py-3 bg-dark text-light">
        <div class="container ">
            <h1>Add New Project</h1>
        </div>
    </header>

    <div class="container py-5">

        @include('partials.validation-message')

        <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <!--project-name--->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('project_name') is-invalid @enderror" name="project_name"
                    id="project_name" aria-describedby="project_nameHelper" placeholder=".."
                    value="{{ old('project_name') }}" />
                <small id="project_nameHelper" class="form-text text-muted">Insert a project_name for thi post</small>
                @error('project_name')
                    <div class="text-danger py-2"> {{ $message }}</div>
                @enderror
            </div>
            <!--project-img--->
            <div class="mb-3">
                <label for="preview_image" class="form-label">preview_image</label>
                <input type="file" class="form-control  @error('preview_image') is-invalid @enderror"
                    name="preview_image" id="preview_image" aria-describedby="preview_imageHelper" placeholder=".."
                    value="{{ old('preview_image') }}" />
                <small id="preview_imageHelper" class="form-text text-muted">Select the preview_image for this
                    project</small>
                @error('preview_image')
                    <div class="text-danger py-2"> {{ $message }}</div>
                @enderror
            </div>
            <!--project-description--->
            <div class="mb-3">
                <label for="description" class="form-label">description</label>
                <textarea name="description" id="description"rows="5" class="form-control  @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger py-2"> {{ $message }}</div>
                @enderror
            </div>

            <!--project-type-->
            <div class="mb-3">
                <label for="type_id" class="form-label">Type</label>
                <select class="form-select" name="type_id" id="type_id">
                    <option selected disabled>Select type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <!--project-type-->

            <div class="mb-3 d-flex gap-3 flex-wrap">
                @foreach ($technologies as $technology)
                    <div class="form-check">

                        <input name="technologies[]" class="form-check-input" type="checkbox" value="{{ $technology->id }}"
                            id="technology-{{ $technology->id }}"
                            {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }} />
                        <label class="form-check-label" for="technology-{{ $technology->id }}">
                            {{ $technology->name }}
                        </label>

                    </div>
                @endforeach

            </div>
            @error('technologies')
                <div class="text-danger py-2">
                    {{ $message }}
                </div>
            @enderror

            <!--project-year--->
            <div class="mb-3">
                <label for="year" class="form-label">Year of project</label>
                <input type="text" class="form-control @error('year_project') is-invalid @enderror" name="year_project"
                    id="year_project" aria-describedby="year_projectHelper" placeholder=".."
                    value="{{ old('year_project') }}" />
                <small id="year_projectHelper" class="form-text text-muted">Insert a year_project of this post</small>
                @error('year_project')
                    <div class="text-danger py-2"> {{ $message }}</div>
                @enderror
            </div>

            <!--project-video--->
            <div class="mb-3">
                <label for="video" class="form-label">Link_video of project</label>
                <input type="text" class="form-control @error('link_video') is-invalid @enderror" name="link_video"
                    id="link_video" aria-describedby="link_videoHelper" placeholder=".." value="{{ old('link_video') }}" />
                <small id="link_videoHelper" class="form-text text-muted">Insert a link_video of this post</small>
                @error('link_video')
                    <div class="text-danger py-2"> {{ $message }}</div>
                @enderror
            </div>

            <!--project-view--->
            <div class="mb-3">
                <label for="view" class="form-label">Link_view of project</label>
                <input type="text" class="form-control @error('link_view') is-invalid @enderror" name="link_view"
                    id="link_view" aria-describedby="link_viewHelper" placeholder=".." value="{{ old('link_view') }}" />
                <small id="link_viewHelper" class="form-text text-muted">Insert a link_view of this post</small>
                @error('link_view')
                    <div class="text-danger py-2"> {{ $message }}</div>
                @enderror
            </div>

            <!--project-git--->
            <div class="mb-3">
                <label for="git" class="form-label">Link_git of project</label>
                <input type="text" class="form-control @error('link_git') is-invalid @enderror" name="link_git"
                    id="link_git" aria-describedby="link_gitHelper" placeholder=".." value="{{ old('link_git') }}" />
                <small id="link_gitHelper" class="form-text text-muted">Insert a link_git of this post</small>
                @error('link_git')
                    <div class="text-danger py-2"> {{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">
                Create

            </button>


        </form>
    </div>
@endsection
