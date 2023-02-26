<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onsubmit="ajaxStore(event, this, 'editModal')" action="{{ route('admin.category.update', $category->id) }}"
                method="POST">
                @csrf @method('PUT')
                <input type="hidden" name="update" value="1">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="name" class="form-label required">Name </label>
                            <input type="search" name="name" class="form-control" value="{{ $category->name }}"
                                required />
                            @if ($errors->has('name'))
                                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="image" class="form-label required">Icon (105px:105px)</label>
                            <img src="{{ imagePath('category', $category->image) }}" height="100px" alt="">
                        </div>
                        <div class="col-md-6">
                            <label for="image" class="form-label">Icon </label>
                            <input type="file" name="image" class="form-control">
                            @if ($errors->has('image'))
                                <div class="alert alert-danger">{{ $errors->first('image') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
