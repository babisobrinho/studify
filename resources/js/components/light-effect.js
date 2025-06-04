document.addEventListener('DOMContentLoaded', function() {
    // Efeito de luz que segue o cursor
    const heroSection = document.querySelector('.hero-section');
    const light = document.querySelector('.mouse-light');
    
    if(heroSection && light) {
        let mouseX = 0;
        let mouseY = 0;
        let lightX = 0;
        let lightY = 0;
        const delay = 0.1;
        
        heroSection.addEventListener('mousemove', (e) => {
            const rect = heroSection.getBoundingClientRect();
            mouseX = e.clientX - rect.left;
            mouseY = e.clientY - rect.top;
        });
        
        function animate() {
            // Aplicar suavização ao movimento
            lightX += (mouseX - lightX) * delay;
            lightY += (mouseY - lightY) * delay;
            
            // Atualizar posição da luz
            light.style.left = lightX + 'px';
            light.style.top = lightY + 'px';
            
            requestAnimationFrame(animate);
        }
        
        animate();
        
        // Mostrar/ocultar luz ao entrar/sair do hero section
        heroSection.addEventListener('mouseenter', () => {
            light.style.opacity = '1';
        });
        
        heroSection.addEventListener('mouseleave', () => {
            light.style.opacity = '0';
        });
    }
});