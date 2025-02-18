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
                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="position-relative d-inline-block">
                                        <!-- Profile Image -->
                                        <div>
                                            <img src="{{ asset('image/profile.jpeg') }}" alt="" 
                                                style="height: 116px; width:116px; border-radius:50%;">
                                        </div>
                                        
                                        <!-- Upload Icon (Bottom-Right) -->
                                        <div class="upload-icon">
                                            <img src="{{ asset('image/icon/upload.png') }}" alt="" style="width: 16.67px; height: 15px;">
                                        </div>
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
                                    <x-input-label for="fast_name" :value="__('First Name')" />
                                    <x-text-input id="fast_name" name="fast_name" type="text" class="form-control mt-1 block w-full" :value="old('fast_name', $user->fast_name)" required autofocus autocomplete="name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('fast_name')" />
                                </div>
                                <div class="col-md-6">
                                    <x-input-label for="last_name" :value="__('Last Name')" />
                                    <x-text-input id="last_name" name="last_name" type="text" class="form-control mt-1 block w-full" :value="old('last_name', $user->last_name)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                                </div>
                                <div class="col-md-6 mt-2">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" name="email" type="email" class="form-control mt-1 block w-full" :value="old('email', $user->email)" required readonly autocomplete="username" />
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
                                    <x-text-input id="phone" name="phone" type="text" class="form-control mt-1 block w-full" :value="old('phone', $user->phone)" required />
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
                    
                            <div class="flex items-center gap-4 mt-4">
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
        
    @endpush

</x-backend.layouts.master>
