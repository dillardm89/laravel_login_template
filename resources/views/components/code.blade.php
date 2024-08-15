<div id="code-verify" class="mb-3">
    <label for="code" class="form-label">Code</label>
    <div class="d-flex justify-content-start align-items-center">
        <input type="text" class="form-control" id="code" name="code">
        <button type="submit" class="btn login-btn" id="auth-next-btn">Next</button>
    </div>
    @error('code')
        <p class="mt-1 p-1 small alert alert-danger shadow-sm">
            {{ $message }}
        </p>
    @enderror
</div>
