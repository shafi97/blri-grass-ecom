<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onsubmit="ajaxStorePage(event, this, 'createModal')"
                action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="image" class="form-label required">Image</label>
                            <img src="{{ imagePath('slider', $slider->image) }}" alt="" height="100px">
                        </div>
                        <div class="col-md-6">
                            <label for="image" class="form-label required">Image <span class="text-danger">width:1762px x Height:1060px</span> </label>
                            <input type="file" name="image" class="form-control" />
                            @if ($errors->has('image'))
                                <div class="alert alert-danger">{{ $errors->first('image') }}</div>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <label for="text" class="form-label">Description </label>
                            <textarea name="text" id="updateText" cols="30" rows="5" class="form-control"></textarea>
                            @if ($errors->has('text'))
                                <div class="alert alert-danger">{{ $errors->first('text') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('backend/plugins/ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('updateText')
</script>
