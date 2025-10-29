<footer class="footer footer-static footer-light">
    <div class="footer-content">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="clearfix mb-0">
                        <span class="float-md-start d-block d-md-inline-block mt-25">
                            © <script>document.write(new Date().getFullYear())</script>
                            <a class="ms-25 fw-bold" href="#" target="_blank">Ekero Partners</a>
                            <span class="d-none d-sm-inline-block">, All rights reserved</span>
                        </span>
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="float-md-end">
                        <span class="footer-links">
                            <a href="#" class="footer-link">Privacy Policy</a>
                            <a href="#" class="footer-link">Terms of Service</a>
                            <a href="#" class="footer-link">Support</a>
                        </span>
                        <span class="footer-version ms-3">
                            v1.0.0
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<button class="btn btn-primary btn-icon scroll-top" type="button">
    <i data-feather="arrow-up"></i>
</button>

<script src="https://unpkg.com/feather-icons"></script>

<style>
    .footer {
        background: linear-gradient(135deg, #f8f8f8 0%, #ffffff 100%);
        border-top: 1px solid #e8e8e8;
        padding: 20px 0;
        margin-top: auto;
    }

    .footer-content {
        font-size: 0.9rem;
        color: #6e6b7b;
    }

    .footer-link {
        color: #6e6b7b;
        text-decoration: none;
        margin: 0 12px;
        transition: color 0.3s ease;
        font-size: 0.85rem;
    }

    .footer-link:hover {
        color: #7367f0;
        text-decoration: underline;
    }

    .footer-version {
        background: rgba(115, 103, 240, 0.1);
        color: #7367f0;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .scroll-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: linear-gradient(135deg, #7367f0, #9e95f5);
        border: none;
        box-shadow: 0 4px 15px rgba(115, 103, 240, 0.4);
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .scroll-top:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(115, 103, 240, 0.6);
    }

    @media (max-width: 768px) {
        .footer-content .row {
            text-align: center;
        }
        
        .float-md-end {
            float: none !important;
            text-align: center;
            margin-top: 10px;
        }
        
        .footer-links {
            display: block;
            margin-bottom: 10px;
        }
    }
</style>