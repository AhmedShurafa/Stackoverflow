
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (session('error'))
    <div class="col-sm-12">
        <div class="alert alert-danger text-center" role="alert">
            {{ session('error') }}
        </div>
    </div>
@endif

<div class="form-row">
    <div class="form-group col-6">
        <label for="price" class="text-capitalize">Name</label>
        <input type="text" name="name" class="form-control" value="{{ $badge->name }}" required>
    </div>

    <div class="form-group col-6">
        <label for="price" class="text-capitalize">Type</label>
        <input type="text" name="type" class="form-control" value="{{ $badge->type }}" required>
    </div>

    <div class="form-group col-6">
        <label for="price" class="text-capitalize">Score</label>
        <input type="number" name="score" class="form-control" value="{{ $badge->score }}" required>
    </div>

    <div class="form-group col-6">
        <label for="size" class="text-capitalize">Description</label>
        <textarea name="content" class="form-control" require cols="30" rows="10">{{ $badge->content }}</textarea>
    </div>
</div>
<hr>
<div class="form-row">
    <div class="form-group col text-left">
        <button class="btn btn-success" type="submit">{{ $button }}</button>
    </div>
</div>
