<x-backend.layouts.master>

    <x-slot name="contentWrapper">
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title p-3 d-flex">
                    <h4><span class="font-weight-semibold">Profile</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements d-none">
                    <div class="d-flex justify-content-end">

                        <div class="d-flex align-items-center justify-content-center" style="height: 40px; width:40px; border:1px solid #EAECF0; border-radius:20px; background-color: #F9FAFB">
                            <img src="{{ asset('image/icon/notification-2.png') }}" alt="">
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="mb-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-3 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="">
                                    <div>
                                        <img src="{{ asset('image/profile.jpeg') }}" alt="" style="height: 116px; width:116px; border-radius:50%;">
                                    </div>
                                    <img src="{{ asset('image/icon/upload.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="#" class="btn btn-link btn-float font-size-sm font-weight-semibold text-default legitRipple ml-2 text-white btn-sm" style="background-color:#732066;padding: 5px .875rem !important; font-size:10px; border-radius:8px">
                                    Save Changes
                                </a>
                            </div>
                        </div>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Profile Information') }}
                            </h2>
                    
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Update your account's profile information and email address.") }}
                            </p>
                        </header>
                    
                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>
                    
                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')
                    
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="form-control mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                    
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="form-control mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
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
                    
                            <div class="flex items-center gap-4 mt-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                    
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
</x-backend.layouts.master>
