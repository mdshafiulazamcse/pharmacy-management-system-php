// Toggle password visibility
document.querySelectorAll('.toggle-password').forEach(icon => {
    icon.addEventListener('click', function() {
        const input = this.previousElementSibling;
        if (input.type === 'password') {
            input.type = 'text';
            this.classList.remove('fa-eye');
            this.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            this.classList.remove('fa-eye-slash');
            this.classList.add('fa-eye');
        }
    });
});

// Form submission handling
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const messageDiv = this.querySelector('.message');
        messageDiv.style.display = 'block';

        // Simulate form submission
        if (this.id === 'login-form') {
            messageDiv.className = 'message success';
            messageDiv.textContent = 'Login successful!';
        } else if (this.id === 'register-form') {
            const password = document.getElementById('register-password').value;
            const confirmPassword = document.getElementById('register-confirm-password').value;
            
            if (password !== confirmPassword) {
                messageDiv.className = 'message error';
                messageDiv.textContent = 'Passwords do not match!';
                return;
            }
            
            messageDiv.className = 'message success';
            messageDiv.textContent = 'Account created successfully!';
        } else if (this.id === 'forget-password-form') {
            messageDiv.className = 'message success';
            messageDiv.textContent = 'Password reset link sent to your email!';
        }

        // Clear form after successful submission
        if (messageDiv.classList.contains('success')) {
            setTimeout(() => {
                this.reset();
                messageDiv.style.display = 'none';
                if (this.id !== 'login-form') {
                    window.location.href = 'login.html';
                }
            }, 2000);
        }
    });
});
// script.js
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login-form');
    const messageDiv = document.querySelector('.message');
    
    // Toggle password visibility
    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.getElementById('login-password');
    
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    // Handle form submission
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const email = document.getElementById('login-email').value;
        const password = document.getElementById('login-password').value;
        
        // Basic validation
        if (!email || !password) {
            showMessage('Please fill in all fields', 'error');
            return;
        }
        
        // Create form data
        const formData = new FormData();
        formData.append('email', email);
        formData.append('password', password);
        
        // Send login request
        fetch('login_process.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showMessage('Login successful! Redirecting...', 'success');
                setTimeout(() => {
                    window.location.href = 'dashboard.php';
                }, 1500);
            } else {
                showMessage(data.message, 'error');
            }
        })
        .catch(error => {
            showMessage('An error occurred. Please try again.', 'error');
            console.error('Error:', error);
        });
    });
    
    // Helper function to show messages
    function showMessage(message, type) {
        messageDiv.textContent = message;
        messageDiv.className = 'message ' + type;
    }
});