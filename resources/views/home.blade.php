<x-layout pageTitle="Profile">
    <div class="container p-4" id="profile">
        <h4 class="text-center mb-4">Welcome {{ $user->first_name }}!</h4>

        <div class="d-flex justify-content-center mb-3">
            <div id="user-picture">
                @if (!$editAvatar)
                    <img src={{ $user->avatar }} alt="profile-picture" id="profile-img">
                    <a href="/edit-avatar" class="btn btn-secondary btn-sm d-block mt-1" id="edit-avatar-btn">Edit
                        Avatar</a>
                @else
                    <x-avatar />
                @endif
            </div>

            <div id="user-details" class="d-flex justify-content-evenly">
                <div id="profile-fields">
                    <p class="mb-3">First Name</p>
                    <p class="mb-3">Last Name</p>
                    <p class="mb-3">Username</p>
                    <p class="mb-3">Email</p>
                </div>

                <div id="profile-details">
                    <p class="mb-3">{{ $user->first_name }}</p>
                    <p class="mb-3">{{ $user->last_name }}</p>
                    <p class="mb-3">{{ $user->username }}</p>
                    <p class="mb-3">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <a href="/reset-password" class="btn btn-secondary mx-3">Reset Password</a>

            <form method="POST" action={{ "/delete-user/{$user->username}" }} class="d-flex justify-content-end">
                @csrf
                @method('DELETE')
                <button type="submit" id="delete-account-btn" class="btn btn-danger">Delete Account</button>
            </form>
        </div>
    </div>
</x-layout>
                                    
