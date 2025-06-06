<?= $this->extend('layout/layout') ?>

<?= $this->section('title') ?>
Iniciar Sesion
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="register-wrapper">
    <div class="register-container">
        <div class="register-form-container">
            <div class="form-toggle">
                <button class="toggle-btn active" onclick="showLogin()">Iniciar Sesión</button>
                <button class="toggle-btn" onclick="showRegister()">Registrarse</button>
            </div>

            <!-- Login Form -->
            <div id="loginForm" class="form-wrapper active">
                <div class="form-header">
                    <h2>Bienvenido de nuevo</h2>
                    <p>Ingresa tus credenciales para acceder a tu cuenta</p>
                </div>

                <form action="<?php echo site_url('/auth/login_action'); ?>" method="POST" class="auth-form">
                    <div class="input-group">
                        <label for="loginEmail">Correo electrónico</label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="loginEmail" name="email" placeholder="nombre@ejemplo.com" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <div class="label-row">
                            <label for="loginPassword">Contraseña</label>
                            <a href="#" class="forgot-link">¿Olvidaste tu contraseña?</a>
                        </div>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="loginPassword" name="password" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('loginPassword')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">Iniciar Sesión</button>


                </form>
            </div>

            <!-- Register Form -->
            <div id="registerForm" class="form-wrapper">
                <div class="form-header">
                    <h2>Crear una cuenta</h2>
                    <p>Ingresa tus datos para registrarte</p>
                </div>

                <form action="<?php echo base_url('auth/register-action'); ?>" method="POST" class="auth-form">
                    <div class="input-group">
                        <label for="registerName">Nombre completo</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user"></i>
                            <input type="text" id="registerName" name="name" placeholder="Juan Pérez" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="registerEmail">Correo electrónico</label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="registerEmail" name="email" placeholder="nombre@ejemplo.com" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="registerPassword">Contraseña</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="registerPassword" name="password" placeholder="Ingresá tu contraseña" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('registerPassword')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="confirmPassword">Confirmar contraseña</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirmá tu contraseña" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('confirmPassword')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">Registrarse</button>

                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>