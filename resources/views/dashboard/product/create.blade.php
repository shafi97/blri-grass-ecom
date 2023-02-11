<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onsubmit="ajaxStorePage(event, this, 'createModal')" action="{{ route('admin.product.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="category_id" class="form-label required">Category Name </label>
                            <select class="form-select" name="category_id" id="category_id" required>
                                <option selected disabled value="">Choose...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                                <div class="alert alert-danger">{{ $errors->first('category_id') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label for="sub_category_id" class="form-label">Sub Category Name </label>
                            <select class="form-select" name="sub_category_id" id="sub_category">
                            </select>
                            @if ($errors->has('sub_category_id'))
                                <div class="alert alert-danger">{{ $errors->first('sub_category_id') }}</div>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <label for="name" class="form-label required">Name </label>
                            <input type="search" name="name" class="form-control" value="{{ old('name') }}"
                                required />
                            @if ($errors->has('name'))
                                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>

                        <div class="col-md-3">
                            <label for="weight" class="form-label required">Weight </label>
                            <input type="search" name="weight" class="form-control" value="{{ old('weight') }}"
                            onInput="this.value = this.value.replace(/[^\d/.]/g,'');" required />
                            @if ($errors->has('weight'))
                                <div class="alert alert-danger">{{ $errors->first('weight') }}</div>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <label for="weight_unit" class="form-label required"> </label>
                            <select class="form-select" name="weight_unit" id="weight_unit" required>
                                <option selected disabled value="">Choose...</option>
                                <option value=" Gram">Gram</option>
                                <option value=" Kilogram">Kilogram</option>
                                <option value=" Mon">Mon</option>
                                <option value=" Litter">Litter</option>
                            </select>
                            @if ($errors->has('weight_unit'))
                                <div class="alert alert-danger">{{ $errors->first('weight_unit') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label for="d_o_b" class="form-label">Date of Birth (for calculating age)</label>
                            <input type="date" name="d_o_b" class="form-control" value="{{ old('d_o_b') }}"
                                 />
                            @if ($errors->has('d_o_b'))
                                <div class="alert alert-danger">{{ $errors->first('d_o_b') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label for="size" class="form-label">Size</label>
                            <input type="search" name="size" class="form-control" value="{{ old('size') }}"
                                 />
                            @if ($errors->has('size'))
                                <div class="alert alert-danger">{{ $errors->first('size') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label for="color" class="form-label">Color</label>
                            <input type="search" name="color" class="form-control" value="{{ old('color') }}"
                                 />
                            @if ($errors->has('color'))
                                <div class="alert alert-danger">{{ $errors->first('color') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="search" name="quantity" class="form-control" value="{{ old('quantity') }}"
                            onInput="this.value = this.value.replace(/[^\d/]/g,'');" />
                            @if ($errors->has('quantity'))
                                <div class="alert alert-danger">{{ $errors->first('quantity') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label for="price" class="form-label required">Price</label>
                            <input type="search" name="price" class="form-control" value="{{ old('price') }}"
                                required onInput="this.value = this.value.replace(/[^\d.]/g,'');"/>
                            @if ($errors->has('price'))
                                <div class="alert alert-danger">{{ $errors->first('price') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label for="discount" class="form-label">Discount</label>
                            <input type="search" name="discount" class="form-control" value="{{ old('discount') }}"
                            onInput="this.value = this.value.replace(/[^\d.]/g,'');"/>
                            @if ($errors->has('discount'))
                                <div class="alert alert-danger">{{ $errors->first('discount') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label for="product_code" class="form-label">Product Code</label>
                            <input type="search" name="product_code" class="form-control" value="{{ old('product_code') }}"
                                 />
                            @if ($errors->has('product_code'))
                                <div class="alert alert-danger">{{ $errors->first('product_code') }}</div>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                            @if ($errors->has('description'))
                                <div class="alert alert-danger">{{ $errors->first('description') }}</div>
                            @endif
                        </div>

                        {{-- File --}}
                        <div class="row col-md-12"><h5 style="margin-left: 0px;">Documents</h5></div>
                        <table class=" table-bordered">
                            {{-- <h2>Documents</h2> --}}
                            <tr>
                                <th>File Type</th>
                                <th>File</th>
                                <th>Title</th>
                                <th style="width: 20px;text-align:center;">
                                    <a class="text-primary" style="font-size: 16px"><i class="fas fa-mouse"></i></a>
                                </th>
                            </tr>

                            <tr>
                                <td><select name="file_type[]" class="form-control form-control-sm"><option value="">Choose...</option><option value="1">Image</option><option value="2">Video</option><option value="3">Youtube Link</option></select></td>
                                <td><input type="file" name="file_file[]" multiple class="form-control form-control-sm"/></td>
                                <td><input type="search" name="file_title[]" class="form-control form-control-sm"/></td>
                                <td style="width: 20px"><span class="btn btn-sm btn-success addrow"><i class="fa fa-plus" aria-hidden="true"></i></span></td>
                            </tr>
                            <tbody id="showItem"></tbody>
                        </table>
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
