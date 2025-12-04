    </main>
    <style>
        /* Footer Responsive Styles */
        .footer {
            background: var(--darker-bg);
            border-top: 1px solid var(--border-color);
            color: var(--text-primary);
            padding: var(--spacing-2xl) 0 var(--spacing-lg);
            margin-top: auto;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--spacing-md);
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: var(--spacing-xl);
        }

        .footer-section h3 {
            color: var(--primary-color);
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: var(--spacing-md);
            position: relative;
        }

        .footer-section h3::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--primary-color);
        }

        .footer-section p {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: var(--spacing-md);
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-section ul li {
            margin-bottom: var(--spacing-sm);
        }

        .footer-section ul li a {
            color: var(--text-secondary);
            text-decoration: none;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
        }

        .footer-section ul li a:hover {
            color: var(--primary-color);
            transform: translateX(4px);
        }

        .footer-section p i {
            color: var(--primary-color);
            margin-right: var(--spacing-sm);
            width: 16px;
        }

        .social-links {
            display: flex;
            gap: var(--spacing-md);
            margin-top: var(--spacing-md);
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 50%;
            color: var(--text-secondary);
            text-decoration: none;
            transition: var(--transition);
        }

        .social-links a:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            padding: var(--spacing-lg) var(--spacing-md) 0;
            border-top: 1px solid var(--border-color);
            text-align: center;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Footer Responsive Design */
        @media (max-width: 768px) {
            .footer {
                padding: var(--spacing-xl) 0 var(--spacing-md);
            }
            
            .footer-content {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: var(--spacing-lg);
                padding: 0 var(--spacing-sm);
            }
            
            .footer-section h3 {
                font-size: 1.1rem;
            }
            
            .footer-section h3::after {
                width: 30px;
                height: 2px;
            }
            
            .social-links {
                gap: var(--spacing-sm);
            }
            
            .social-links a {
                width: 36px;
                height: 36px;
            }
            
            .footer-bottom {
                padding: var(--spacing-md) var(--spacing-sm) 0;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 576px) {
            .footer {
                padding: var(--spacing-lg) 0 var(--spacing-sm);
            }
            
            .footer-content {
                grid-template-columns: 1fr;
                gap: var(--spacing-md);
                text-align: center;
            }
            
            .footer-section h3::after {
                left: 50%;
                transform: translateX(-50%);
            }
            
            .social-links {
                justify-content: center;
            }
            
            .footer-section p i {
                margin-right: var(--spacing-xs);
            }
            
            .footer-section ul li a {
                justify-content: center;
            }
            
            .footer-section ul li a:hover {
                transform: translateY(-2px);
            }
        }

        @media (max-width: 400px) {
            .footer {
                padding: var(--spacing-md) 0 var(--spacing-sm);
            }
            
            .footer-content {
                gap: var(--spacing-sm);
            }
            
            .footer-section h3 {
                font-size: 1rem;
                margin-bottom: var(--spacing-sm);
            }
            
            .footer-section p {
                font-size: 0.9rem;
            }
            
            .footer-section ul li a {
                font-size: 0.9rem;
            }
            
            .social-links a {
                width: 32px;
                height: 32px;
                font-size: 0.9rem;
            }
            
            .footer-bottom {
                font-size: 0.8rem;
            }
        }
    </style>
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>FoodExpress delivers the best food from your favorite restaurants right to your doorstep.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="/food_delivery/index.php">Home</a></li>
                    <li><a href="/food_delivery/pages/restaurants.php">Restaurants</a></li>
                    <li><a href="/food_delivery/contact.php">Contact Us</a></li>
                    <li><a href="/food_delivery/terms.php">Terms & Conditions</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p><i class="fas fa-phone"></i> +1 234 567 8900</p>
                <p><i class="fas fa-envelope"></i> support@foodexpress.com</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> FoodExpress. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/food_delivery/assets/js/main.js"></script>
</body>
</html>
