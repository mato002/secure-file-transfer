@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0" style="border-radius: 12px; overflow: hidden;">
                    <div class="card-header text-center py-3" style="background: linear-gradient(135deg, #2563eb, #1e40af);">
                        <h3 class="mb-0 text-white"><i class="fas fa-cog me-2"></i>System Settings</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.settings.update') }}" method="POST">
                            @csrf

                            {{-- General Settings --}}
                            <h4 class="mb-3 border-bottom pb-2 text-primary">
                                <i class="fas fa-globe me-2"></i>General Settings
                            </h4>
                            <div class="mb-3">
                                <label for="site_name" class="form-label fw-bold">Site Name</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: #eef2ff;">
                                        <i class="fas fa-signature text-primary"></i>
                                    </span>
                                    <input type="text" class="form-control" id="site_name" name="site_name" value="{{ $settings['site_name'] ?? '' }}" style="border-radius: 0 8px 8px 0;">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="system_mode" class="form-label fw-bold">System Mode</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: #eef2ff;">
                                        <i class="fas fa-tachometer-alt text-primary"></i>
                                    </span>
                                    <select class="form-control" id="system_mode" name="system_mode" style="border-radius: 0 8px 8px 0;">
                                        <option value="production" {{ ($settings['system_mode'] ?? '') == 'production' ? 'selected' : '' }}> Production</option>
                                        <option value="maintenance" {{ ($settings['system_mode'] ?? '') == 'maintenance' ? 'selected' : '' }}> Maintenance</option>
                                        <option value="testing" {{ ($settings['system_mode'] ?? '') == 'testing' ? 'selected' : '' }}>Testing</option>
                                    </select>
                                </div>
                            </div>

                            {{-- User Management Settings --}}
                            <h4 class="mt-4 mb-3 border-bottom pb-2 text-primary">
                                <i class="fas fa-users me-2"></i>User Management
                            </h4>
                            <div class="form-check form-switch mb-3 ps-5">
                                <input class="form-check-input" type="checkbox" id="allow_registration" name="allow_registration" {{ ($settings['allow_registration'] ?? false) ? 'checked' : '' }} style="width: 3em; height: 1.5em;">
                                <label class="form-check-label fw-bold ms-2" for="allow_registration">Allow User Registration</label>
                            </div>
                            <div class="mb-3">
                                <label for="default_user_role" class="form-label fw-bold">Default User Role</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: #eef2ff;">
                                        <i class="fas fa-user-tag text-primary"></i>
                                    </span>
                                    <select class="form-control" id="default_user_role" name="default_user_role" style="border-radius: 0 8px 8px 0;">
                                        <option value="user" {{ ($settings['default_user_role'] ?? '') == 'user' ? 'selected' : '' }}>Regular User</option>
                                        <option value="admin" {{ ($settings['default_user_role'] ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>
                            </div>

                            {{-- File Upload Settings --}}
                            <h4 class="mt-4 mb-3 border-bottom pb-2 text-primary">
                                <i class="fas fa-file-upload me-2"></i>File Upload Settings
                            </h4>
                            <div class="mb-3">
                                <label for="max_file_size" class="form-label fw-bold">Max File Upload Size (MB)</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: #eef2ff;">
                                        <i class="fas fa-weight-hanging text-primary"></i>
                                    </span>
                                    <input type="number" class="form-control" id="max_file_size" name="max_file_size" value="{{ $settings['max_file_size'] ?? 10 }}" style="border-radius: 0 8px 8px 0;">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="allowed_file_types" class="form-label fw-bold">Allowed File Types</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: #eef2ff;">
                                        <i class="fas fa-file-alt text-primary"></i>
                                    </span>
                                    <input type="text" class="form-control" id="allowed_file_types" name="allowed_file_types" value="{{ $settings['allowed_file_types'] ?? 'pdf,jpg,png,zip' }}" style="border-radius: 0 8px 8px 0;">
                                </div>
                                <div class="form-text">Separate file types with commas (e.g., pdf,jpg,png)</div>
                            </div>
                            
                            {{-- Security Settings --}}
                            <h4 class="mt-4 mb-3 border-bottom pb-2 text-primary">
                                <i class="fas fa-shield-alt me-2"></i>Security Settings
                            </h4>
                            <div class="form-check form-switch mb-3 ps-5">
                                <input class="form-check-input" type="checkbox" id="require_email_verification" name="require_email_verification" {{ ($settings['require_email_verification'] ?? false) ? 'checked' : '' }} style="width: 3em; height: 1.5em;">
                                <label class="form-check-label fw-bold ms-2" for="require_email_verification">Require Email Verification</label>
                            </div>
                            <div class="form-check form-switch mb-3 ps-5">
                                <input class="form-check-input" type="checkbox" id="enable_2fa" name="enable_2fa" {{ ($settings['enable_2fa'] ?? false) ? 'checked' : '' }} style="width: 3em; height: 1.5em;">
                                <label class="form-check-label fw-bold ms-2" for="enable_2fa">Enable Two-Factor Authentication</label>
                            </div>
                            
                            {{-- Logging & Download Settings --}}
                            <h4 class="mt-4 mb-3 border-bottom pb-2 text-primary">
                                <i class="fas fa-chart-line me-2"></i>Logging & Downloads
                            </h4>
                            <div class="form-check form-switch mb-3 ps-5">
                                <input class="form-check-input" type="checkbox" id="log_downloads" name="log_downloads" {{ ($settings['log_downloads'] ?? false) ? 'checked' : '' }} style="width: 3em; height: 1.5em;">
                                <label class="form-check-label fw-bold ms-2" for="log_downloads">Enable File Download Logs</label>
                            </div>
                            <div class="form-check form-switch mb-3 ps-5">
                                <input class="form-check-input" type="checkbox" id="log_user_activity" name="log_user_activity" {{ ($settings['log_user_activity'] ?? false) ? 'checked' : '' }} style="width: 3em; height: 1.5em;">
                                <label class="form-check-label fw-bold ms-2" for="log_user_activity">Enable User Activity Logging</label>
                            </div>
                            
                            {{-- Email Settings --}}
                            <h4 class="mt-4 mb-3 border-bottom pb-2 text-primary">
                                <i class="fas fa-envelope me-2"></i>Email Settings
                            </h4>
                            <div class="mb-3">
                                <label for="admin_email" class="form-label fw-bold">Admin Email</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background-color: #eef2ff;">
                                        <i class="fas fa-envelope text-primary"></i>
                                    </span>
                                    <input type="email" class="form-control" id="admin_email" name="admin_email" value="{{ $settings['admin_email'] ?? '' }}" style="border-radius: 0 8px 8px 0;">
                                </div>
                            </div>
                            <div class="form-check form-switch mb-3 ps-5">
                                <input class="form-check-input" type="checkbox" id="enable_email_notifications" name="enable_email_notifications" {{ ($settings['enable_email_notifications'] ?? false) ? 'checked' : '' }} style="width: 3em; height: 1.5em;">
                                <label class="form-check-label fw-bold ms-2" for="enable_email_notifications">Enable Email Notifications</label>
                            </div>
                            
                            {{-- Submit Button --}}
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary px-4 py-2 fw-bold" style="background: linear-gradient(135deg, #2563eb, #1e40af); border: none; border-radius: 8px;">
                                    <i class="fas fa-save me-2"></i>Save Settings
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #cbd5e1;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }
        
        .form-check-input:checked {
            background-color: #2563eb;
            border-color: #2563eb;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #1e40af, #1e3a8a);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
    </style>
@endsection