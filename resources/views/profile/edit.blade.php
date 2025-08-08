<x-backend.layouts.master>

    <x-backend.layouts.partials.blocks.contentwrapper 
        :headerTitle="'Profile'"
        :prependContent="''">
    </x-backend.layouts.partials.blocks.contentwrapper>


    <div class="mb-4">
        <div class="max-w-2xl sm:px-6 lg:px-8 space-y-6" style="width: 70%">
            <div class="p-3 sm:p-8 bg-white sm:rounded-lg" style="border-radius: 12px; box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div>
                                @if(session('error'))
                                    <div class="bg-danger-300 border border-danger-400 text-danger-800 px-4 py-3 mb-2 rounded relative" role="alert">
                                        <strong class="font-bold">Error:</strong>
                                        <span class="block sm:inline">{{ session('error') }}</span>
                                    </div>
                                @endif

                                @if(session('status'))
                                    <div class="bg-success-300 border border-success-400 text-success-800 px-4 py-3 mb-2 rounded relative" role="alert">
                                        <strong class="font-bold">Success:</strong>
                                        <span class="block sm:inline">{{ session('status') }}</span>
                                    </div>
                                @endif

                                @if($errors->any())
                                    <div class="bg-warning-300 border border-warning-400 text-warning-800 px-4 py-3 mb-2 rounded relative" role="alert">
                                        <strong class="font-bold">Validation Errors:</strong>
                                        <ul class="mt-2 list-disc list-inside">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="position-relative d-inline-block">
                                        <!-- Profile Image -->
                                        <label for="profileImage" style="cursor: pointer; position: relative;">
                                            {{-- @dd($user->profile_image) --}}
                                            <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('image/profile.jpeg') }}" 
                                                 alt="Profile Image" 
                                                 style="height: 116px; width:116px; border-radius:50%; object-fit: cover;">
                                            
                                            <!-- Upload Icon -->
                                            <div class="upload-icon" style="position: absolute; bottom: 5px; right: 5px;">
                                                <img src="{{ asset('image/icon/upload.png') }}" alt="Upload Icon" 
                                                     style="width: 16.67px; height: 15px;">
                                            </div>
                                        </label>
                                
                                        <!-- Hidden File Input -->
                                        <input type="file" id="profileImage" name="profile_image" accept="image/*" style="display: none;" onchange="previewImage(event)">
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-link btn-float font-size-sm font-weight-semibold text-default legitRipple ml-2 text-white btn-sm" style="background-color:#732066;padding: 5px .875rem !important; border-radius:8px">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                    
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <x-input-label for="first_name" :value="__('First Name')" />
                                    <x-text-input id="first_name" name="first_name" type="text" class="form-control mt-1 block w-full" :value="old('first_name', $user->first_name)" required/>
                                    <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                                </div>
                                <div class="col-md-6">
                                    <x-input-label for="last_name" :value="__('Last Name')" />
                                    <x-text-input id="last_name" name="last_name" type="text" class="form-control mt-1 block w-full" :value="old('last_name', $user->last_name)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                                </div>
                                <div class="col-md-6 mt-2">
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
                                <div class="col-md-6 mt-2">
                                    <x-input-label for="phone" :value="__('Phone')" />
                                    <x-text-input id="phone" name="phone" type="text" class="form-control mt-1 block w-full" :value="old('phone', $user->phone)" required/>
                                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                </div>
                                <div class="col-md-6 mt-2">
                                    <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                                    <div class="position-relative">
                                        <x-text-input id="update_password_current_password" name="current_password" type="password" 
                                                      class="form-control mt-1 block w-full pr-10" autocomplete="current-password" />
                                        <span class="toggle-password" toggle="#update_password_current_password">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                </div>
                                
                                <div class="col-md-6 mt-2">
                                    <x-input-label for="update_password_password" :value="__('New Password')" />
                                    <div class="position-relative">
                                        <x-text-input id="update_password_password" name="password" type="password" 
                                                      class="form-control mt-1 block w-full pr-10" autocomplete="new-password" />
                                        <span class="toggle-password" toggle="#update_password_password">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                </div>
                                
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    @push('css')
        <style>
            .upload-icon {
                position: absolute;
                bottom: 5px;
                right: 5px;
                width: 30px;
                height: 30px;
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
    @endpush
    @push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".toggle-password").forEach(function(element) {
                element.addEventListener("click", function() {
                    let input = document.querySelector(this.getAttribute("toggle"));
                    let icon = this.querySelector("i");
        
                    if (input.type === "password") {
                        input.type = "text";
                        icon.classList.remove("fa-eye");
                        icon.classList.add("fa-eye-slash");
                    } else {
                        input.type = "password";
                        icon.classList.remove("fa-eye-slash");
                        icon.classList.add("fa-eye");
                    }
                });
            });
        });
    </script>
    <script>
        function previewImage(event) {
            const input = event.target;
            const reader = new FileReader();
    
            reader.onload = function () {
                const img = document.querySelector('label[for="profileImage"] img');
                img.src = reader.result;
            };
    
            if (input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @endpush

</x-backend.layouts.master>
