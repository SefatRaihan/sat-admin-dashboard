<section style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px; border-radius:15px">
    <header class="p-3">
        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="d-flex">
                <div>
                    <div class="position-relative d-inline-block">
                        <!-- Profile Image -->
                        <label for="profileImage" style="cursor: pointer; position: relative;">
                            <img id="profileImagePreview" 
                                 src="{{ auth()->user()->student->image ? asset('storage/' . auth()->user()->student->image) : asset('image/default-avatar.png') }}" 
                                 alt="Profile Image" 
                                 style="height: 65px; width:65px; border-radius:50%; object-fit: cover;">
                            
                            <!-- Upload Icon -->
                            <div class="upload-icon" style="position: absolute; bottom: 5px; right: 5px;">
                                <img src="{{ asset('image/icon/upload.png') }}" alt="Upload Icon" 
                                     style="width: 16.67px; height: 15px;">
                            </div>
                        </label>
                
                        <!-- Hidden File Input -->
                        <input type="file" id="profileImage" name="profile_image" accept="image/*" style="display: none;">
                    </div>
                </div>
                <div class="ml-2">
                    <p class="mt-0 text-sm text-gray-600">
                        {{ __("Upload your profile picture. (file must be less than 2MB).") }}
                    </p>
                    <div class="d-flex">
                        <button type="button" class="btn btn-sm filter-submit-btn" style="background-color:#691D5E; border-radius: 8px; color:#fff; width:50%" id="uploadButton">Upload</button>
                        <button type="button" class="btn btn-sm btn-outline-dark ml-2 reset-filter" style="border: 1px solid #D0D5DD; border-radius: 8px; width:50%" id="removeButton">Remove</button>
                    </div>
                </div>
            </div>
    </header>

    <div class="row pr-3 pl-3 pt-0 pb-0">
        <div class="col-md-12">
            <x-input-label for="first_name" :value="__('Name')" />
            <x-text-input id="first_name" name="first_name" type="text" class="form-control mt-1 block w-full" :value="old('first_name', $user->first_name)" required/>
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>
        {{-- <div class="col-md-6">
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" name="last_name" type="text" class="form-control mt-1 block w-full" :value="old('last_name', $user->last_name)"/>
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div> --}}
        <div class="col-md-12 mt-2">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="form-control mt-1 block w-full" :value="old('email', $user->email)" required readonly/>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        <div class="col-md-12 mt-2">
            <x-input-label for="date_of_birth" :value="__('Date of birth')" />
            <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="form-control mt-1 block w-full" :value="old('date_of_birth', $user->student->date_of_birth)" required/>
            <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
        </div>
    </div>

    <div class="d-flex items-center gap-4 mt-4 p-2 justify-content-end" style="border-top: 1px solid #ddd">
        <button type="button" class="btn btn-sm btn-outline-dark mr-2 cancel" style="border: 1px solid #D0D5DD; border-radius: 8px;">Cancel</button>
        <button type="submit" class="btn btn-sm filter-submit-btn" style="background-color:#691D5E; border-radius: 8px; color:#fff;">Save Change</button>

        @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600"
            >{{ __('Saved.') }}</p>
        @endif
    </div>
</form>
</section>
<style>
    .upload-icon {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 20px;
        height: 20px;
        background-color: #732066;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .position-relative {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 16px;
        color: #888;
    }

    .toggle-password:hover {
        color: #333;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Store the default image URL for the "Remove" functionality
        var defaultImage = $('#profileImagePreview').attr('src');

        // Handle file input change (image preview)
        $('#profileImage').on('change', function(event) {
            var file = event.target.files[0];
            if (file) {
                // Validate file size (2MB = 2 * 1024 * 1024 bytes)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File is too large. Please upload an image less than 2MB.');
                    $(this).val(''); // Clear the file input
                    return;
                }

                // Preview the image
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#profileImagePreview').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        // Handle "Upload" button click
        $('#uploadButton').on('click', function() {
            $('#profileImage').trigger('click'); // Trigger file input click
        });

        // Handle "Remove" button click
        $('#removeButton').on('click', function() {
            $('#profileImagePreview').attr('src', defaultImage); // Reset to default image
            $('#profileImage').val(''); // Clear the file input
        });
    });
</script>