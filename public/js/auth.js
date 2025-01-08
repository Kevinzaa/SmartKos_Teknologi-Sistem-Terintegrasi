const apiUrl = "http://smartkos.iceiy.com/smartkos/public/auth";

document.getElementById('registerForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const username = document.getElementById('regUsername').value;
    const password = document.getElementById('regPassword').value;

    if (password.length < 8) {
        alert('Password must be at least 8 characters long.');
        return;
    }

    try {
        const response = await fetch(`${apiUrl}/register`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username, password }),
        });

        const result = await response.json();

        if (response.ok) {
            alert(result.message || 'Registration successful.');
            document.getElementById('registerForm').reset();
        } else {
            alert(result.messages?.error || 'Registration failed.');
        }
    } catch (error) {
        console.error('Error during registration:', error);
        alert('An error occurred while registering. Please try again.');
    }
});

document.getElementById('loginForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const username = document.getElementById('logUsername').value;
    const password = document.getElementById('logPassword').value;

    try {
        const response = await fetch(`${apiUrl}/login`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username, password }),
        });

        const result = await response.json();

        if (response.ok) {
            alert(result.message || 'Login successful.');
            localStorage.setItem('authToken', result.token);
            // Redirect to home page
            window.location.href = '/home'; // Arahkan ke halaman home
        } else {
            alert(result.messages.error || 'Login failed.');
        }
    } catch (error) {
        console.error('Error during login:', error);
        alert('An error occurred while logging in. Please try again.');
    }
});


document.getElementById('logoutButton').addEventListener('click', () => {
    localStorage.removeItem('authToken');
    alert('Logged out successfully.');
    showLoginPage();
});

function isAuthenticated() {
    return localStorage.getItem('authToken') !== null;
}

function showManagementPage() {
    document.getElementById('registerSection').style.display = 'none';
    document.getElementById('loginSection').style.display = 'none';
    document.getElementById('managementSection').style.display = 'block';
}

function showLoginPage() {
    document.getElementById('registerSection').style.display = 'block';
    document.getElementById('loginSection').style.display = 'block';
    document.getElementById('managementSection').style.display = 'none';
}

if (isAuthenticated()) {
    showManagementPage();
} else {
    showLoginPage();
}
