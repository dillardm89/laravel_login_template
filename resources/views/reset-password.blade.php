<?php
// Code Status (0 = no code, 1 = code sent, 2 = code verified)
if (session()->has('codeStatus')) {
    $codeStatus = session('codeStatus');
    if ($codeStatus == 2) {
        $action = '/reset-password';
    } else {
        $formActions = ['/email-code', '/verify-code'];
        $action = $formActions[$codeStatus];
    }
} else {
    $codeStatus = 0;
    $action = '/email-code';
}

if (session()->has('userDetails')) {
    $userDetails = session('userDetails');
} else {
    $userDetails = [];
}
?>

<x-layout pageTitle="Authentication">
    <div class="container p-4" id="login-form">
        <h4 class="text-center">Reset Password</h4>
        <form action={{ $action }} method="POST">
            @csrf
            <input type="hidden" id="view" name="view" value="reset-password" />

            <x-validate :codeStatus="$codeStatus" :userDetails="$userDetails" />

            @if ($codeStatus == 1)
                <x-code />
            @elseif($codeStatus == 2)
                <div id="complete-auth">
                    <div class="mb-3 form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @error('password')
                            <p class="mt-1 p-1 small alert alert-danger shadow-sm">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-3 form-group">
                        <label for="password-confirm" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember-checkbox" name="remember-checkbox">
                        <label class="form-check-label" for="remember-checkbox">Remember Me</label>
                    </div>
                </div>
            @endif

            <div class="d-flex justify-content-evenly mb-3">
                @if ($codeStatus == 2)
                    <button type="submit" class="btn login-btn">Reset Password</button>
                @endif

                <a href="/register" class="btn btn-secondary" id="toggle-auth-btn">Switch to
                    Register</a>
            </div>
        </form>
    </div>
</x-layout>
