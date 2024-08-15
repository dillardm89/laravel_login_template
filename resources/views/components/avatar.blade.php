    <form action="/edit-avatar" method="POST" enctype="multipart/form-data" id="avatar-form">
        @csrf
        <div class="form-group mb-3">
            <label for="avatar" class="form-label"><strong>Select An Image</strong></label>
            <input type="file" name="avatar" id="avatar" required />
            <p class="mt-1 p-1 alert small alert-danger shadow-sm d-none" id="size-error"></p>
            @error('avatar')
                <p class="mt-1 p-1 alert small alert-danger shadow-sm">{{ $message }}</p>
            @enderror
        </div>
        <div class="d-flex justify-content-evenly">
            <button class="btn mr-3 login-btn">Save</button>
            <a href="/home" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
