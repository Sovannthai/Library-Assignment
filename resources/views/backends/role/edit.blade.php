@extends('backends.master')
@section('title','Edit Role')
@section('contents')
<style>
    .row {
        position: relative;
        left: 25px;
    }

    .product,
    .user {
        position: relative;
        left: 10px;
    }

</style>
<div class="card">
    <div class="card-body">
        <form action="{{ route('update_role',['id'=>$role->id]) }}" method="POST" class="">
            @csrf
            @method('PUT')
            <div class="clearfix">
                <div class="">
                    <div class="form-group col-6">
                        <label for="">Role Name</label>
                        <input type="text" name="name" class="form-control" style="position: relative;left:-12px" value="{{ $role->name }}">
                    </div>
                </div>
            </div>
            <div>
                <span>Select Role</span>
            </div>
            <hr>
            <div class="user mt-4">Dashboard</div>
            <div class="row">
                <div class="custom-control col-3 custom-switch">
                    <label style="position: absolute">View</label>
                    <input type="checkbox" name="permissions[]" value="view.dash" @if (in_array('view.dash', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="dashboard" data-id="">
                    <label class="custom-control-label" for="dashboard"></label>
                </div>
            </div>
            <hr>
            <div class="user mt-4">User</div>
            <div class="row">
                <div class="custom-control col-3 custom-switch">
                    <label style="position: absolute">View</label>
                    <input type="checkbox" name="permissions[]" value="view.user" @if (in_array('view.user', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="customSwitches" data-id="">
                    <label class="custom-control-label" for="customSwitches"></label>
                </div>
                <div class="custom-control col-3 custom-switch">
                    <label for="" style="position: absolute">Create</label>
                    <input type="checkbox" name="permissions[]" value="create.user" c @if (in_array('create.user', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="customSwitches1" data-id="">
                    <label class="custom-control-label" for="customSwitches1"></label>
                </div>
                <div class="custom-control col-3 custom-switch">
                    <label for="" style="position: absolute">Edit</label>
                    <input type="checkbox" name="permissions[]" value="edit.user" @if (in_array('edit.user', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="customSwitches2" data-id="">
                    <label class="custom-control-label" for="customSwitches2"></label>
                </div>
                <div class="custom-control col-3 custom-switch">
                    <label for="" style="position: absolute">Delete</label>
                    <input type="checkbox" name="permissions[]" value="delete.user" @if (in_array('delete.user', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="customSwitches3" data-id="">
                    <label class="custom-control-label" for="customSwitches3"></label>
                </div>
            </div>
            <hr>
            <div class="user">Role</div>
            <div class="row">
                <div class="custom-control col-3 custom-switch">
                    <label style="position: absolute">View</label>
                    <input type="checkbox" name="permissions[]" value="view.role" @if (in_array('view.role', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="role" data-id="">
                    <label class="custom-control-label" for="role"></label>
                </div>
                <div class="custom-control col-3 custom-switch">
                    <label for="" style="position: absolute">Create</label>
                    <input type="checkbox" name="permissions[]" value="create.role" @if (in_array('create.role', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="role1" data-id="">
                    <label class="custom-control-label" for="role1"></label>
                </div>
                <div class="custom-control col-3 custom-switch">
                    <label for="" style="position: absolute">Edit</label>
                    <input type="checkbox" name="permissions[]" value="edit.role" @if (in_array('edit.role', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="role2" data-id="">
                    <label class="custom-control-label" for="role2"></label>
                </div>
                <div class="custom-control col-3 custom-switch">
                    <label for="" style="position: absolute">Delete</label>
                    <input type="checkbox" name="permissions[]" value="delete.role" @if (in_array('delete.role', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="role3" data-id="">
                    <label class="custom-control-label" for="role3"></label>
                </div>
            </div>
            <hr>
            <div class="user">Customer</div>
            <div class="row">
                <div class="custom-control col-3 custom-switch">
                    <label style="position: absolute">View</label>
                    <input type="checkbox" name="permissions[]" value="view.customer" @if (in_array('view.customer', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="customer" data-id="">
                    <label class="custom-control-label" for="customer"></label>
                </div>
                <div class="custom-control col-3 custom-switch">
                    <label for="" style="position: absolute">Create</label>
                    <input type="checkbox" name="permissions[]" value="create.customer" @if (in_array('create.customer', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="customer1" data-id="">
                    <label class="custom-control-label" for="customer1"></label>
                </div>
                <div class="custom-control col-3 custom-switch">
                    <label for="" style="position: absolute">Edit</label>
                    <input type="checkbox" name="permissions[]" value="edit.customer" @if (in_array('edit.customer', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="customer2" data-id="">
                    <label class="custom-control-label" for="customer2"></label>
                </div>
                <div class="custom-control col-3 custom-switch">
                    <label for="" style="position: absolute">Delete</label>
                    <input type="checkbox" name="permissions[]" value="delete.customer" @if (in_array('delete.customer', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="customer3" data-id="">
                    <label class="custom-control-label" for="customer3"></label>
                </div>
            </div>
            <hr>
            <div class="user">Catelog</div>
            <div class="row">
                <div class="custom-control col-3 custom-switch">
                    <label style="position: absolute">View</label>
                    <input type="checkbox" name="permissions[]" value="view.catelog" @if (in_array('view.catelog', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="catelog" data-id="">
                    <label class="custom-control-label" for="catelog"></label>
                </div>
                <div class="custom-control col-3 custom-switch">
                    <label for="" style="position: absolute">Create</label>
                    <input type="checkbox" name="permissions[]" value="create.catelog" @if (in_array('create.catelog', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="catelog1" data-id="">
                    <label class="custom-control-label" for="catelog1"></label>
                </div>
                <div class="custom-control col-3 custom-switch">
                    <label for="" style="position: absolute">Edit</label>
                    <input type="checkbox" name="permissions[]" value="edit.catelog" @if (in_array('edit.catelog', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="catelog2" data-id="">
                    <label class="custom-control-label" for="catelog2"></label>
                </div>
                <div class="custom-control col-3 custom-switch">
                    <label for="" style="position: absolute">Delete</label>
                    <input type="checkbox" name="permissions[]" value="delete.catelog" @if (in_array('delete.catelog', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="catelog3" data-id="">
                    <label class="custom-control-label" for="catelog3"></label>
                </div>
            </div>
            <hr>
            <div class="user">Book</div>
            <div class="row">
                <div class="custom-control col-3 custom-switch">
                    <label style="position: absolute">View</label>
                    <input type="checkbox" name="permissions[]" value="view.book" @if (in_array('view.book', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="book" data-id="">
                    <label class="custom-control-label" for="book"></label>
                </div>
                <div class="custom-control col-3 custom-switch">
                    <label for="" style="position: absolute">Create</label>
                    <input type="checkbox" name="permissions[]" value="create.book" @if (in_array('create.book', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="book1" data-id="">
                    <label class="custom-control-label" for="book1"></label>
                </div>
                <div class="custom-control col-3 custom-switch">
                    <label for="" style="position: absolute">Edit</label>
                    <input type="checkbox" name="permissions[]" value="edit.book" @if (in_array('edit.book', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="book2" data-id="">
                    <label class="custom-control-label" for="book2"></label>
                </div>
                <div class="custom-control col-3 custom-switch">
                    <label for="" style="position: absolute">Delete</label>
                    <input type="checkbox" name="permissions[]" value="delete.book" @if (in_array('delete.book', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="book3" data-id="">
                    <label class="custom-control-label" for="book3"></label>
                </div>
            </div>
            <hr>
            <div class="user mt-4">Setting</div>
            <div class="row">
                <div class="custom-control col-3 custom-switch">
                    <label style="position: absolute">View</label>
                    <input type="checkbox" name="permissions[]" value="view.setting" @if (in_array('view.setting', $role_permissions)) checked @endif class="custom-control-input toggle-status" id="setting" data-id="">
                    <label class="custom-control-label" for="setting"></label>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary float-lg-right ml-1">Update</button>
            <a href="{{ route('role.index') }}" class="btn btn-secondary float-lg-right">Close</a>
        </form>
    </div>
</div>
</div>
<!-- switchery js -->
<script src="src/plugins/switchery/switchery.min.js"></script>
@endsection
