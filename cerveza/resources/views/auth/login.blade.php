<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cervecería Tío Mingo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gold: #D4A574;
            --deep-amber: #B8860B;
            --dark-brown: #2C1810;
            --warm-cream: #F5E6D3;
            --forest-green: #1B4332;
            --copper: #B87333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--dark-brown);
            color: var(--warm-cream);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated background texture */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                repeating-linear-gradient(
                    90deg,
                    transparent,
                    transparent 2px,
                    rgba(212, 165, 116, 0.03) 2px,
                    rgba(212, 165, 116, 0.03) 4px
                );
            pointer-events: none;
            z-index: 1;
        }

        body::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, var(--deep-amber) 0%, transparent 70%);
            opacity: 0.1;
            animation: pulse 8s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.1; }
            50% { transform: scale(1.2); opacity: 0.15; }
        }

        .login-container {
            position: relative;
            z-index: 2;
            background: rgba(44, 24, 16, 0.95);
            backdrop-filter: blur(10px);
            border: 2px solid var(--primary-gold);
            padding: 3rem;
            max-width: 480px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .login-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 3rem;
            letter-spacing: 3px;
            color: var(--primary-gold);
            text-shadow: 3px 3px 0 var(--deep-amber);
            margin-bottom: 0.5rem;
            animation: slideDown 0.6s ease-out;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .login-subtitle {
            color: rgba(245, 230, 211, 0.8);
            font-size: 0.95rem;
            font-weight: 300;
            letter-spacing: 1px;
        }

        .logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.5rem;
            letter-spacing: 3px;
            color: var(--primary-gold);
            text-shadow: 3px 3px 0 var(--deep-amber);
            position: relative;
        }

        .logo::after {
            content: '🍺';  
            font-size: 2rem;
        }

        .status-message {
            background: rgba(27, 67, 50, 0.3);
            border: 1px solid var(--forest-green);
            color: var(--warm-cream);
            padding: 0.75rem 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            border-radius: 0;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--primary-gold);
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.95rem 1.2rem;
            background: rgba(245, 230, 211, 0.1);
            border: 2px solid rgba(212, 165, 116, 0.3);
            color: var(--warm-cream);
            font-size: 1rem;
            font-family: 'Montserrat', sans-serif;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input:focus {
            border-color: var(--primary-gold);
            background: rgba(245, 230, 211, 0.15);
            box-shadow: 0 0 0 3px rgba(212, 165, 116, 0.1);
        }

        .form-input::placeholder {
            color: rgba(245, 230, 211, 0.4);
        }

        .input-error {
            color: #ff6b6b;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: block;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .checkbox-input {
            width: 18px;
            height: 18px;
            border: 2px solid var(--primary-gold);
            background: rgba(245, 230, 211, 0.1);
            cursor: pointer;
            margin-right: 0.75rem;
            accent-color: var(--primary-gold);
        }

        .checkbox-label {
            color: rgba(245, 230, 211, 0.8);
            font-size: 0.9rem;
            font-weight: 300;
            cursor: pointer;
        }

        .form-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .forgot-password {
            color: var(--primary-gold);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 400;
            transition: color 0.3s ease;
            position: relative;
        }

        .forgot-password::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--primary-gold);
            transition: width 0.3s ease;
        }

        .forgot-password:hover {
            color: var(--deep-amber);
        }

        .forgot-password:hover::after {
            width: 100%;
        }

        .btn-login {
            padding: 0.95rem 2.5rem;
            background: linear-gradient(135deg, var(--primary-gold), var(--deep-amber));
            color: var(--dark-brown);
            border: none;
            font-weight: 700;
            font-size: 0.95rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.3);
            transition: left 0.5s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(212, 165, 116, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 640px) {
            .login-container {
                padding: 2rem 1.5rem;
            }

            .login-logo {
                font-size: 2.5rem;
            }

            .form-footer {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-login {
                width: 100%;
            }

            .forgot-password {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="logo">TÍO MINGO</div>
            <p class="login-subtitle">Acceso al Sistema</p>
        </div>

        <!-- Session Status (uncomment if needed) -->
        <!-- <div class="status-message">
            Your session status message here
        </div> -->

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input 
                    id="email" 
                    class="form-input" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus 
                    autocomplete="username"
                />
                @if ($errors->get('email'))
                    @foreach ((array) $errors->get('email') as $message)
                        <span class="input-error">{{ $message }}</span>
                    @endforeach
                @endif
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input 
                    id="password" 
                    class="form-input"
                    type="password"
                    name="password"
                    required 
                    autocomplete="current-password"
                />
                @if ($errors->get('password'))
                    @foreach ((array) $errors->get('password') as $message)
                        <span class="input-error">{{ $message }}</span>
                    @endforeach
                @endif
            </div>

            <!-- Remember Me -->
            <div class="checkbox-container">
                <input 
                    id="remember_me" 
                    type="checkbox" 
                    class="checkbox-input" 
                    name="remember"
                />
                <label for="remember_me" class="checkbox-label">
                    Remember me
                </label>
            </div>

            <div class="form-footer">
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif

                <button type="submit" class="btn-login">
                    Log in
                </button>
            </div>
        </form>
    </div>
</body>
</html> 