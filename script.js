document.addEventListener('DOMContentLoaded', () => {
    // Work Log Form Validation
    document.getElementById('workLogForm').addEventListener('submit', function(event) {
        const inTime = document.getElementById('inTime').value;
        const outTime = document.getElementById('outTime').value;

        // Convert inTime and outTime to Date objects for comparison
        const inTimeDate = new Date(`2000-01-01T${inTime}`);
        const outTimeDate = new Date(`2000-01-01T${outTime}`);

        if (inTimeDate >= outTimeDate) {
            alert('Out Time must be later than In Time');
            event.preventDefault();
        }
    });

    // Login Form Validation
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', (event) => {
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value.trim();

            if (username !== 'Padmashree' || password !== 'Babydollz') {
                event.preventDefault();
                const errorMessage = document.createElement('div');
                errorMessage.textContent = 'Invalid credentials';
                errorMessage.classList.add('error-message');
                loginForm.appendChild(errorMessage);
            }
        });
    }

    // Mood Form Validation
    const moodForm = document.getElementById('moodForm');
    if (moodForm) {
        moodForm.addEventListener('submit', (event) => {
            const happiness = parseInt(document.getElementById('happiness').value.trim(), 10);
            const anger = parseInt(document.getElementById('anger').value.trim(), 10);
            const sadness = parseInt(document.getElementById('sadness').value.trim(), 10);

            // Check if happiness, anger, and sadness are within valid range (1-10)
            if (isNaN(happiness) || happiness < 1 || happiness > 10 ||
                isNaN(anger) || anger < 1 || anger > 10 ||
                isNaN(sadness) || sadness < 1 || sadness > 10) {
                event.preventDefault();
                const errorMessage = document.createElement('div');
                errorMessage.textContent = 'Please enter valid values for happiness, anger, and sadness (1-10).';
                errorMessage.classList.add('error-message');
                moodForm.appendChild(errorMessage);
            }
        });
    }

    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Show/Hide password functionality
    const showPasswordToggle = document.getElementById('showPasswordToggle');
    const passwordField = document.getElementById('password');
    
    if (showPasswordToggle && passwordField) {
        showPasswordToggle.addEventListener('change', () => {
            if (showPasswordToggle.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    }
});
