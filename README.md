# Caminho Seguro Web

Plataforma web educativa e gamificada desenvolvida no Curso Técnico em Informática para Internet Integrado do **IF Baiano - Campus Guanambi** (2026), com o objetivo de apresentar o Código de Trânsito Brasileiro (CTB) de maneira simples e interativa para jovens pedestres, ciclistas e futuros motoristas.

## Equipe de Desenvolvimento
- Paola de Azevedo Rodrigues
- Pedro Henrique Prates Almeida
- Sarah Victoria Soares Farias
- Thalisson Caio Ribeiro Santos

## Tecnologias e Arquitetura
- **Linguagem:** PHP 8+ (Programação Orientada a Objetos)
- **Arquitetura:** MVC (`Model`, `View`, `Controller` e `Validators`) com Front Controller em `public/index.php`
- **Banco de Dados:** MySQL via PDO e *Prepared Statements*
- **Front-end:** HTML5, CSS3 e Bootstrap 4 (Template SB Admin 2)

## Instruções para Execução (XAMPP)
1. Coloque a pasta `caminhoseguroWeb2` dentro de `C:\xampp\htdocs\`.
2. Inicie **Apache** e **MySQL** no painel de controle do XAMPP.
3. Abra `http://localhost/phpmyadmin`, acesse a aba **Importar** e importe `database/caminho_seguro.sql`.
4. Acesse no navegador: `http://localhost/caminhoseguroWeb2/`

### Acessos de Teste
- **Administrador:** `admin@caminhoseguro.com` | **Senha:** `123456`
- **Usuário Comum:** `aluno@caminhoseguro.com` | **Senha:** `123456`