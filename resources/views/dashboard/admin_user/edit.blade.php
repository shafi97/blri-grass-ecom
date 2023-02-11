<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Admin User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onsubmit="ajaxStore(event, this, 'editModal')" action="{{ route('admin.admin-user.update', $admin_user->id) }}"
                method="POST">
                @csrf @method('PUT')
                <input type="hidden" name="update" value="1">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="role" class="form-label required">Permission </label>
                            <select class="form-select" name="role" required>
                                <option selected disabled value="">Choose...</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" @selected(preg_replace(('/[^a-z ^\d]/'), '', $admin_user->getRoleNames()) ==  $role->name)>{{ ucfirst($role->name) }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('role'))
                                <div class="alert alert-danger">{{ $errors->first('role') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="form-label required">Name </label>
                            <input type="search" name="name" class="form-control" value="{{ $admin_user->name }}"
                                required />
                            @if ($errors->has('name'))
                                <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label required">Email </label>
                            <input type="email" name="email" class="form-control" value="{{ $admin_user->email }}"/>
                            @if ($errors->has('email'))
                                <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone </label>
                            <input type="search" name="phone" class="form-control" value="{{ $admin_user->phone }}" />
                            @if ($errors->has('phone'))
                                <div class="alert alert-danger">{{ $errors->first('phone') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="d_o_b" class="form-label">Date of Birth </label>
                            <input type="date" name="d_o_b" class="form-control" value="{{ $admin_user->d_o_b }}" />
                            @if ($errors->has('d_o_b'))
                                <div class="alert alert-danger">{{ $errors->first('d_o_b') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="image" class="form-label">Photo </label>
                            <input type="file" name="image" class="form-control" value="{{ old('image') }}" />
                            @if ($errors->has('image'))
                                <div class="alert alert-danger">{{ $errors->first('image') }}</div>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <label for="address" class="form-label">Address </label>
                            <input type="search" name="address" class="form-control" value="{{ $admin_user->address }}" />
                            @if ($errors->has('address'))
                                <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label"> password</label>
                            <input type="password" name="password" class="form-control" value=""
                                 />
                            @if ($errors->has('password'))
                                <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Password Confirmation
                            </label>
                            <input type="password" name="password_confirmation" class="form-control"
                                value="{{ old('password_confirmation') }}" />
                            @if ($errors->has('password_confirmation'))
                                <div class="alert alert-danger">{{ $errors->first('password_confirmation') }}</div>
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
