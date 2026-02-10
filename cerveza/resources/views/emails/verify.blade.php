<div style="font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; max-width: 600px; margin: 0 auto; background-color: #2C1810;">

    <!-- Header con Gradiente Cervecero -->
    <div style="background: linear-gradient(135deg, #2C1810 0%, #3d2216 50%, #2C1810 100%); padding: 50px 20px; text-align: center; border-radius: 0; position: relative; border-bottom: 3px solid #D4A574;">
        <!-- Textura de fondo -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: repeating-linear-gradient(90deg, transparent, transparent 2px, rgba(212, 165, 116, 0.05) 2px, rgba(212, 165, 116, 0.05) 4px); pointer-events: none;"></div>
        
        <div style="text-align: center; position: relative; z-index: 2;">
            <!-- Logo placeholder - reemplaza con tu logo -->
            <div style="font-size: 60px; margin-bottom: 10px;">🍺</div>
            <h2 style="color: #D4A574; font-size: 42px; font-weight: 700; margin: 0; letter-spacing: 4px; font-family: 'Bebas Neue', sans-serif; text-shadow: 2px 2px 0 rgba(184, 134, 11, 0.5);">TÍO MINGO</h2>
            <p style="color: #F5E6D3; font-size: 14px; margin: 10px 0 0 0; letter-spacing: 2px; font-weight: 300;">CERVECERÍA ARTESANAL</p>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div style="padding: 40px 30px; background-color: #2C1810; background-image: repeating-linear-gradient(90deg, transparent, transparent 2px, rgba(212, 165, 116, 0.02) 2px, rgba(212, 165, 116, 0.02) 4px);">
        <h1 style="color: #D4A574; font-size: 26px; font-weight: 700; margin: 0 0 20px 0; letter-spacing: 1px;">¡Bienvenido {{ $notifiable->name }}! 🍻</h1>
        
        <p style="color: #F5E6D3; font-size: 16px; line-height: 1.8; margin: 0 0 20px 0; opacity: 0.9;">
            Gracias por unirte a la familia <strong style="color: #D4A574;">Cervecería Tío Mingo</strong>. Estás a un paso de descubrir nuestras cervezas artesanales de calidad premium.
        </p>

        <p style="color: #F5E6D3; font-size: 16px; line-height: 1.8; margin: 0 0 30px 0; opacity: 0.9;">
            Por favor, verifica tu dirección de email para acceder a tu cuenta y disfrutar de todas nuestras ofertas exclusivas.
        </p>

        <!-- Botón CTA con estilo cervecero -->
        <div style="text-align: center; margin: 40px 0;">
            <a href="{{ $verificationUrl }}" 
               style="background: linear-gradient(135deg, #D4A574 0%, #B8860B 100%); 
                      color: #2C1810; 
                      padding: 18px 50px; 
                      text-decoration: none; 
                      border-radius: 0;
                      font-weight: 700; 
                      font-size: 16px;
                      letter-spacing: 2px;
                      text-transform: uppercase;
                      display: inline-block; 
                      box-shadow: 0 8px 25px rgba(212, 165, 116, 0.3);
                      border: 2px solid #D4A574;">
                ✓ Verificar Mi Email
            </a>
        </div>

        <!-- Decoración -->
        <div style="text-align: center; margin: 30px 0;">
            <div style="display: inline-block; padding: 0 20px;">
                <span style="color: #D4A574; font-size: 24px;">🌾</span>
                <span style="color: #D4A574; font-size: 24px; margin: 0 10px;">⚗️</span>
                <span style="color: #D4A574; font-size: 24px;">🏆</span>
            </div>
        </div>

        <div style="background: rgba(245, 230, 211, 0.05); border-left: 3px solid #D4A574; padding: 20px; margin: 30px 0;">
            <p style="color: #F5E6D3; font-size: 14px; line-height: 1.6; margin: 0; opacity: 0.8;">
                <strong style="color: #D4A574;">⏱️ Importante:</strong> Este enlace de verificación expira en 60 minutos por motivos de seguridad.
            </p>
        </div>

        <div style="margin-top: 30px; padding-top: 30px; border-top: 1px solid rgba(212, 165, 116, 0.2);">
            <p style="color: #F5E6D3; font-size: 14px; line-height: 1.6; margin: 0; opacity: 0.7;">
                Si no creaste una cuenta en Cervecería Tío Mingo, simplemente ignora este email. Tu dirección no será agregada a nuestra base de datos.
            </p>
        </div>

        <!-- Link alternativo -->
        <div style="margin-top: 30px; padding: 20px; background: rgba(245, 230, 211, 0.03); border: 1px solid rgba(212, 165, 116, 0.2);">
            <p style="color: #D4A574; font-size: 12px; margin: 0 0 10px 0; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">
                ¿Problemas con el botón?
            </p>
            <p style="color: #F5E6D3; font-size: 13px; line-height: 1.6; margin: 0; opacity: 0.8;">
                Copia y pega este enlace en tu navegador:
            </p>
            <p style="color: #B8860B; font-size: 12px; margin: 10px 0 0 0; word-break: break-all;">
                {{ $verificationUrl }}
            </p>
        </div>
    </div>

    <!-- Footer -->
    <div style="text-align: center; padding: 40px 30px; background: linear-gradient(180deg, #2C1810 0%, #1a0f0a 100%); border-radius: 0; border-top: 2px solid #D4A574;">
        <div style="margin-bottom: 20px;">
            <p style="color: #D4A574; font-size: 18px; font-weight: 700; margin: 0 0 5px 0; letter-spacing: 2px; font-family: 'Bebas Neue', sans-serif;">
                CERVECERÍA TÍO MINGO
            </p>
            <p style="color: #F5E6D3; font-size: 13px; margin: 0; opacity: 0.7; font-weight: 300;">
                Cerveza Artesanal · Hecha con Pasión
            </p>
        </div>
        
        <div style="margin: 20px 0; padding: 15px 0; border-top: 1px solid rgba(212, 165, 116, 0.2); border-bottom: 1px solid rgba(212, 165, 116, 0.2);">
            <p style="color: #F5E6D3; font-size: 12px; margin: 0; opacity: 0.6;">
                📍 Dirección de tu cervecería | 📞 +34 XXX XXX XXX<br>
                📧 info@tiomingo.com | 🌐 www.tiomingo.com
            </p>
        </div>
        
        <p style="color: rgba(245, 230, 211, 0.5); font-size: 11px; margin: 15px 0 0 0;">
            &copy; 2026 Cervecería Tío Mingo. Todos los derechos reservados.<br>
            <span style="font-size: 10px; opacity: 0.7;">Disfruta con responsabilidad. Prohibida la venta a menores de 18 años.</span>
        </p>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@300;400;600;700&display=swap');
</style>