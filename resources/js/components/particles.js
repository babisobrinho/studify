document.addEventListener('DOMContentLoaded', function() {
    // Criar partículas dinâmicas
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        for (let i = 0; i < 5; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particles');
            
            // Posições e tamanhos aleatórios
            const size = Math.random() * 30 + 10;
            const posX = Math.random() * 100;
            const posY = Math.random() * 100;
            const delay = Math.random() * 5;
            const duration = Math.random() * 10 + 5;
            
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${posX}%`;
            particle.style.top = `${posY}%`;
            particle.style.animationDelay = `${delay}s`;
            particle.style.animationDuration = `${duration}s`;
            
            heroSection.appendChild(particle);
        }
    }
});