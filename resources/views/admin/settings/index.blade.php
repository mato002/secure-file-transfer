@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0"> System Settings</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf

                            {{-- General Settings --}}
                            <h4 class="mb-3 border-bottom pb-2">General Settings</h4>
                            <div class="mb-3">
                                <label for="site_name" class="form-label fw-bold">Site Name</label>
                                <input type="text" class="form-control" id="site_name" name="site_name" value="{{ $settings['site_name'] ?? '' }}">
                            </div>
                            
                            <div class="mb-3">
                                <label for="system_mode" class="form-label fw-bold">System Mode</label>
                                <select class="form-control" id="system_mode" name="system_mode">
                                    <option value="production" {{ ($settings['system_mode'] ?? '') == 'production' ? 'selected' : '' }}> Production</option>
                                    <option value="maintenance" {{ ($settings['system_mode'] ?? '') == 'maintenance' ? 'selected' : '' }}> Maintenance</option>
                                    <option value="testing" {{ ($settings['system_mode'] ?? '') == 'testing' ? 'selected' : '' }}>Testing</option>
                                </select>
                            </div>

                            {{-- User Management Settings --}}
                            <h4 class="mt-4 mb-3 border-bottom pb-2">User Management</h4>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="allow_registration" name="allow_registration" {{ ($settings['allow_registration'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="allow_registration">Allow User Registration</label>
                            </div>
                            <div class="mb-3">
                                <label for="default_user_role" class="form-label fw-bold">Default User Role</label>
                                <select class="form-control" id="default_user_role" name="default_user_role">
                                    <option value="user" {{ ($settings['default_user_role'] ?? '') == 'user' ? 'selected' : '' }}>Regular User</option>
                                    <option value="admin" {{ ($settings['default_user_role'] ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>

                            {{-- File Upload Settings --}}
                            <h4 class="mt-4 mb-3 border-bottom pb-2">File Upload Settings</h4>
                            <div class="mb-3">
                                <label for="max_file_size" class="form-label fw-bold">Max File Upload Size (MB)</label>
                                <input type="number" class="form-control" id="max_file_size" name="max_file_size" value="{{ $settings['max_file_size'] ?? 10 }}">
                            </div>
                            <div class="mb-3">
                                <label for="allowed_file_types" class="form-label fw-bold">Allowed File Types</label>
                                <input type="text" class="form-control" id="allowed_file_types" name="allowed_file_types" value="{{ $settings['allowed_file_types'] ?? 'pdf,jpg,png,zip' }}">
                            </div>
                            
                            {{-- Security Settings --}}
                            <h4 class="mt-4 mb-3 border-bottom pb-2">Security Settings</h4>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="require_email_verification" name="require_email_verification" {{ ($settings['require_email_verification'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="require_email_verification">Require Email Verification</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="enable_2fa" name="enable_2fa" {{ ($settings['enable_2fa'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="enable_2fa">Enable Two-Factor Authentication</label>
                            </div>
                            
                            {{-- Logging & Download Settings --}}
                            <h4 class="mt-4 mb-3 border-bottom pb-2">Logging & Downloads</h4>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="log_downloads" name="log_downloads" {{ ($settings['log_downloads'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="log_downloads">Enable File Download Logs</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="log_user_activity" name="log_user_activity" {{ ($settings['log_user_activity'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="log_user_activity">Enable User Activity Logging</label>
                            </div>
                            
                            {{-- Email Settings --}}
                            <h4 class="mt-4 mb-3 border-bottom pb-2">Email Settings</h4>
                            <div class="mb-3">
                                <label for="admin_email" class="form-label fw-bold">Admin Email</label>
                                <input type="email" class="form-control" id="admin_email" name="admin_email" value="{{ $settings['admin_email'] ?? '' }}">
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="enable_email_notifications" name="enable_email_notifications" {{ ($settings['enable_email_notifications'] ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="enable_email_notifications">Enable Email Notifications</label>
                            </div>
                            
                            {{-- Submit Button --}}
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success px-4 py-2">Save Settings</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
