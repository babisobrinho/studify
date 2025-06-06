# Studify - Plataforma de Aprendizagem Online

## 📌 Visão Geral

O Studify é uma plataforma de aprendizagem online desenvolvida para organizar e facilitar o estudo de temas tecnológicos através de trilhas interativas. Inspirado nos roadmaps do roadmap.sh, o projeto permite que utilizadores criem, explorem e sigam trilhas de estudo personalizadas, compostas por recursos como vídeos, artigos, cursos e podcasts.

O projeto foi desenvolvido como parte da disciplina WEB - Hipermédia e Acessibilidades (Módulo 5415), seguindo o Ciclo de Vida de Desenvolvimento Web (WDLC) e metodologias ágeis (Scrum).

## ✨ Funcionalidades Principais (MVP)

- Autenticação de utilizadores: Registo, login e recuperação de palavra-passe
- Gestão de trilhas: Criação, edição e visualização de trilhas de estudo
- Acompanhamento de progresso: Barra de progresso e marcação de etapas concluídas
- Interface responsiva: Design adaptado para mobile e desktop, seguindo princípios de acessibilidade (WCAG)
- Trilhas oficiais: Conteúdos pré-selecionados e validados pela equipa Studify

## 🛠️ Tecnologias Utilizadas

- Frontend: HTML, CSS, JavaScript, Bootstrap 5
- Backend: Laravel (PHP)
- Base de Dados: MySQL
- Ferramentas: Git/GitHub, Jira (gestão de tarefas), Figma (design)
- Testes: PHPUnit, Selenium, Lighthouse (acessibilidade)

## 📂 Estrutura do Projeto

```
studify/
├── app/                  # Lógica de backend (Laravel)
├── public/               # Assets públicos (CSS, JS, imagens)
├── resources/            # Views (Blade templates)
├── database/             # Migrações e seeders
├── tests/                # Testes automatizados
├── .env                  # Configurações de ambiente
└── README.md
```
## 🚀 Como Executar o Projeto

### Pré-requisitos:

- PHP ≥ 8.0
- Composer
- MySQL
- Node.js

### Instalação

```
git clone https://github.com/babisobrinho/studify.git
cd studify
composer install
npm install (se necessário)
cp .env.example .env
php artisan key:generate
```

### Configuração da Base de Dados

- Criar uma base de dados MySQL
- Configurar o arquivo .env com as credenciais

### Execução

```
php artisan migrate --seed
php artisan serve
```

Acesse: `http://localhost:8000`

## 📊 Testes e Validação

Foram realizados testes em ambiente simulado para garantir:
- Funcionalidades: Autenticação, CRUD de trilhas
- Responsividade: Adaptação a celulares, tablets e desktops
- Acessibilidade: WCAG 2.1 AA (nota 92/100 no Lighthouse)
- Segurança: Proteção contra OWASP Top 10 (SQL Injection, XSS)

## 📌 Próximos Passos (Melhorias Futuras)

- Implementar gamificação (badges, certificados)
- Adicionar interação social (comentários, seguir utilizadores)
- Integrar APIs externas (YouTube, Medium) para sugestão de conteúdos
- Migrar para microsserviços (escalabilidade)

## 👥 Equipa

Babi Oliveira
Juliana Alves
Lenice Soares
Rebeça Santos
Thalyson Santos

Formadora: Vânia Cardoso
Curso: Tecnologias e Programação de Sistemas de Informação

## 📚 Documentação Adicional

- Manual de Normas Gráficas
- Repositório GitHub
- Relatório Completo