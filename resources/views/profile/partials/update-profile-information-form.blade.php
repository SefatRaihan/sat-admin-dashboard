<section style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px; border-radius:15px">
    <header class="p-3">
        <form method="post" action="{{ route('profile.update.image') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="d-flex">
                <div>
                    <div class="position-relative d-inline-block">
                        <!-- Profile Image -->
                        <label for="profileImage" style="cursor: pointer; position: relative;">
                            <img id="profileImagePreview"
                                 src="{{ auth()->user()->student->image ? asset(auth()->user()->student->image) : asset('image/default-avatar.png') }}"
                                 alt="Profile Image"
                                 style="height: 65px; width:65px; border-radius:50%; object-fit: cover;">

                            <!-- Upload Icon -->
                            <div class="upload-icon">
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
                        <button type="submit" class="btn btn-sm" style="background-color:#691D5E; border-radius: 8px; color:#fff; width:50%">Upload</button>
                        <button type="button" class="btn btn-sm btn-outline-dark ml-2 reset-filter" style="border: 1px solid #D0D5DD; border-radius: 8px; width:50%" id="removeButton">Remove</button>
                    </div>
                </div>
            </div>
        </form>
    </header>

    <div class="row pr-3 pl-3 pt-0 pb-0">
        <!-- Full Name Section -->
        <div class="col-md-12 d-flex justify-content-between border-bottom mb-2">
            <div>
                <p class="heading">Full Name</p>
                <p class="title">{{ $user->first_name }} {{ $user->last_name }}</p>
            </div>
            <div>
                <button type="button" class="btn btn-outline-dark mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#editNameModal">
                    <i class="fas fa-pen"></i> Edit
                </button>
            </div>
        </div>
        <!-- Date of Birth Section -->
        <div class="col-md-12 d-flex justify-content-between border-bottom mb-2">
            <div>
                <p class="heading">Date of Birth</p>
                <p class="title">{{ auth()->user()->student->date_of_birth }}</p>
            </div>
            <div>
                <button type="button" class="btn btn-outline-dark mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#editDobModal">
                    <i class="fas fa-pen"></i> Edit
                </button>
            </div>
        </div>
        <!-- Email Section -->
        <div class="col-md-12 d-flex justify-content-between border-bottom mb-2">
            <div>
                <p class="heading">Email</p>
                <p class="title">{{ $user->email }}</p>
            </div>
            <div>
                <button type="button" class="btn btn-outline-dark mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#editEmailModal">
                    <i class="fas fa-pen"></i> Edit
                </button>
            </div>
        </div>
        <!-- Phone Number Section -->
        <div class="col-md-12 d-flex justify-content-between border-bottom mb-2">
            <div>
                <p class="heading">Phone Number</p>
                <p class="title">{{ $user->phone }}</p>
            </div>
            <div>
                <button type="button" class="btn btn-outline-dark mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#editPhoneModal">
                    <i class="fas fa-pen"></i> Edit
                </button>
            </div>
        </div>
        <!-- Password Section -->
        <div class="col-md-12 d-flex justify-content-between mb-2">
            <div>
                <p class="heading">Current Password</p>
                <p class="title">********</p>
            </div>
            <div>
                <button type="button" class="btn btn-outline-dark mr-2" style="border: 1px solid #D0D5DD; border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#editPasswordModal">
                    <i class="fas fa-pen"></i> Edit
                </button>
            </div>
        </div>
    </div>

    <!-- Full Name Edit Modal -->
    <div class="modal fade" id="editNameModal" tabindex="-1" aria-labelledby="editNameModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNameModalLabel">Edit Name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('profile.update.name') }}" class="space-y-6">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="first_name" class="form-label heading">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label heading">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn filter-submit-btn" style="background-color:#691D5E; color:#fff;">Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Date of Birth Edit Modal -->
    <div class="modal fade" id="editDobModal" tabindex="-1" aria-labelledby="editDobModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDobModalLabel">Edit Date of Birth</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('profile.update.dob') }}" class="space-y-6">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label heading">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ auth()->user()->student->date_of_birth }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn filter-submit-btn" style="background-color:#691D5E; color:#fff;">Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Email Edit Modal -->
    <div class="modal fade" id="editEmailModal" tabindex="-1" aria-labelledby="editEmailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmailModalLabel">Edit Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('profile.update.email') }}" class="space-y-6">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="email" class="form-label heading">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn filter-submit-btn" style="background-color:#691D5E; color:#fff;">Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Phone Number Edit Modal -->
    <div class="modal fade" id="editPhoneModal" tabindex="-1" aria-labelledby="editPhoneModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPhoneModalLabel">Edit Phone Number</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('profile.update.phone') }}" class="space-y-6">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="phone" class="form-label heading">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn filter-submit-btn" style="background-color:#691D5E; color:#fff;">Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Password Edit Modal -->
    <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('profile.update.password') }}" class="space-y-6">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="mb-3 position-relative">
                            <label for="current_password" class="form-label heading">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                            <span class="toggle-password" onclick="togglePassword('current_password')"><i class="fas fa-eye"></i></span>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label heading">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <span class="toggle-password" onclick="togglePassword('password')"><i class="fas fa-eye"></i></span>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="password_confirmation" class="form-label heading">Confirm New Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            <span class="toggle-password" onclick="togglePassword('password_confirmation')"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn filter-submit-btn" style="background-color:#691D5E; color:#fff;">Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
    .modal-content {
        border-radius: 25px !important;
    }
    .modal-footer {
        border-top: 1px solid #ddd !important;
        padding-top: 8px !important;
    }
    .modal-header {
        background-color: #ffffff !important;
        border-radius: 25px 25px 0px 0px !important;
    }
    .modal-body {
        background-color: #ffffff !important;
    }
    .heading {
        color: #344054;
        font-size: 14px;
        font-weight: 400;
        margin: 0px;
    }

    .title {
        color: #101828;
        font-size: 16px;
        font-weight: 500;
    }

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

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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

        // Password toggle functionality
        window.togglePassword = function(fieldId) {
            var field = $('#' + fieldId);
            var icon = $('#' + fieldId).siblings('.toggle-password').find('i');
            if (field.attr('type') === 'password') {
                field.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                field.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        };
    });
</script>
