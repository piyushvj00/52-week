@extends('leader.layouts.main')
<!-- @section('title', 'Dashboard') -->

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Details - Seven Unique Tech Solution Pvt Ltd.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .bank-form-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        .form-header-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 25px;
            border-bottom: none;
        }
        .form-header-custom h4 {
            margin: 0;
            font-weight: 600;
        }
        .form-section {
            padding: 30px;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #e1e5e9;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .info-card {
            background: #f8f9ff;
            border-left: 4px solid #667eea;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }
        .info-card h6 {
            color: #495057;
            margin-bottom: 10px;
        }
        .info-card p {
            color: #6c757d;
            margin: 0;
            font-size: 0.9rem;
        }
        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
        }
        .example-text {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 5px;
        }
        .required-field::after {
            content: " *";
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Bank Details</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('leader.dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Bank Details</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <!-- Information Card -->
                <div class="info-card">
                    <h6><i class="bi bi-info-circle me-2"></i>Important Information</h6>
                    <p>Please provide your accurate bank details to ensure seamless transactions. All information will be kept secure and confidential.</p>
                </div>

                <!-- Bank Details Form -->
                <div class="bank-form-container">
                    <div class="form-header-custom">
                        <h4><i class="bi bi-bank me-2"></i>Bank Account Information</h4>
                    </div>

                    <div class="form-section">
                        <form id="bankDetailsForm">
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label for="fullName" class="form-label required-field">Your Full Name (as on account)</label>
                                    <input type="text" class="form-control" id="fullName" placeholder="Enter your full name as it appears on your bank account" required>
                                    <div class="example-text">Example: John David Smith</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="bankName" class="form-label required-field">Bank Name</label>
                                    <input type="text" class="form-control" id="bankName" placeholder="Enter your bank's name" required>
                                    <div class="example-text">Example: Bank of America, Chase, Wells Fargo</div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12 mb-3">
                                    <label for="bankAddress" class="form-label required-field">Bank Address (Main Branch or Your Branch)</label>
                                    <textarea class="form-control" id="bankAddress" rows="3" placeholder="Enter your bank's complete address" required></textarea>
                                    <div class="example-text">Example: 123 Main Street, New York, NY 10001, United States</div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label for="accountNumber" class="form-label required-field">Account Number</label>
                                    <input type="text" class="form-control" id="accountNumber" placeholder="Enter your bank account number" required>
                                    <div class="example-text">Example: 123456789012</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="routingNumber" class="form-label required-field">Routing Number (ABA)</label>
                                    <input type="text" class="form-control" id="routingNumber" placeholder="Enter your bank's routing number" required>
                                    <div class="example-text">Example: 021000021 (9-digit code)</div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label for="swiftCode" class="form-label required-field">SWIFT/BIC Code of Your Bank</label>
                                    <input type="text" class="form-control" id="swiftCode" placeholder="Enter your bank's SWIFT/BIC code" required>
                                    <div class="example-text">Example: BOFAUS3N (for Bank of America)</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="accountType" class="form-label required-field">Account Type</label>
                                    <select class="form-select" id="accountType" required>
                                        <option value="" selected disabled>Select your account type</option>
                                        <option value="checking">Checking Account</option>
                                        <option value="savings">Savings Account</option>
                                        <option value="business">Business Account</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12 mb-3">
                                    <label for="additionalDetails" class="form-label">Additional Payment Details</label>
                                    <textarea class="form-control" id="additionalDetails" rows="4" placeholder="Provide any additional payment information (e.g., PayPal email, other payment methods, special instructions)"></textarea>
                                    <div class="example-text">Example: PayPal: your.email@example.com, or any other payment platforms you use</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="button" class="btn btn-light me-3">Cancel</button>
                                    <button type="submit" class="btn btn-submit">Save Bank Details</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Note -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title mb-3">
                                    <i class="bi bi-shield-check text-success me-2"></i>Security & Privacy
                                </h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-lock text-primary me-2"></i>
                                            <small>Your bank details are encrypted and stored securely</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-eye-slash text-info me-2"></i>
                                            <small>Only authorized personnel can access this information</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-arrow-repeat text-warning me-2"></i>
                                            <small>You can update your information at any time</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('bankDetailsForm');
            
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Basic validation
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('is-invalid');
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });
                
                if (isValid) {
                    // Show success message
                    alert('Your bank details have been saved successfully!');
                    
                    // In a real application, you would submit the form data to the server here
                    // form.submit();
                } else {
                    alert('Please fill in all required fields marked with *');
                }
            });
            
            // Remove invalid class when user starts typing
            const inputs = form.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (this.value.trim()) {
                        this.classList.remove('is-invalid');
                    }
                });
            });
        });
    </script>
</body>
</html>
@endsection