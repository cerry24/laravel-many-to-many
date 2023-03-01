<form action="{{ route($routeName, $project) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($method)

    <div class="mb-3">
        <label for="input-type" class="form-label">Type</label>
        <select class="form-control" name="type_id" id="input-type">
            @foreach ($types as $type)
                <option value="{{ $type->id }}" {{ old('type_id', $project->type_id) == $type->id ? 'selected' : '' }}>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <p class="m-0">Technologies</p>
        @foreach ($technologies as $technology)
            <input class="form-check-input" type="checkbox" name="technologies[]" id="input-technologies" value="{{ $technology->id }}"
                @if ($errors->any())
                    @checked(in_array($technology->id, old('technologies', [])))
                @else
                    @checked($project->technologies->contains($technology->id))
                @endif
            >
            <label for="input-technologies" class="form-check-label me-3">{{ $technology->name }}</label>
        @endforeach
    </div>

    <div class="mb-3">
        <label for="input-title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $project->title) }}" id="input-title">
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="input-thumbnail" class="form-label">Thumbnail</label>
        <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail" value="{{ old('thumbnail', $project->thumbnail) }}" id="input-thumbnail">
        @error('thumbnail')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="input-description" class="form-label">Description</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="input-description" cols="30" rows="10">{{ old('description', $project->description) }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="creation_date" class="form-label">Creation date</label>
        <input type="datetime" class="form-control @error('creation_date') is-invalid @enderror" name="creation_date" value="{{ old('creation_date', $project->creation_date) }}" id="input-creation_date">
        @error('creation_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>