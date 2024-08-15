<div id="email-verify" class="mb-3">
    <label for="email" class="form-label">Email</label>
    <div class="d-flex justify-content-start align-items-center form-group">
        <input type="email" class="form-control" id="email" name="email" placeholder="test@email.com"
            value={{ $userDetails['email'] ?? old('email') }}>
        @if ($codeStatus == 0)
            <button type="submit" class="btn login-btn" id="auth-next-btn">Next</button>
        @endif
    </div>
    @error('email')
        <p class="mt-1 p-1 small alert alert-danger shadow-sm">
            {{ $message }}
        </p>
    @enderror
</div>
