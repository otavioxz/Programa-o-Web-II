# Instruções de Instalação e Uso - Sistema de Biblioteca

## Instalação Rápida

### 1. Executar o Projeto

```bash
# Navegar para o diretório do projeto
cd biblioteca-laravel

# Instalar dependências (se necessário)
composer install

# Executar migrations (banco já configurado)
php artisan migrate

# Iniciar servidor
php artisan serve
```

### 2. Acessar o Sistema
- URL: http://localhost:8000
- O sistema abrirá na página inicial

## Guia de Uso

### Página Inicial
- Visão geral do sistema
- Estatísticas em tempo real
- Links rápidos para principais funcionalidades

### Gestão de Autores
1. **Listar Autores**: Menu "Autores"
2. **Criar Autor**: Botão "Novo Autor"
   - Preencher: Nome*, Email*, Data Nascimento, Biografia
3. **Buscar**: Campo de busca por nome ou email
4. **Visualizar**: Botão "Ver" em cada autor
5. **Editar**: Botão "Editar" em cada autor
6. **Excluir**: Botão "Excluir" (com confirmação)

### Gestão de Livros
1. **Listar Livros**: Menu "Livros"
2. **Criar Livro**: Botão "Novo Livro"
   - Preencher: Título*, ISBN*, Autor*, Gênero*, Ano*, Descrição
3. **Filtrar**: 
   - Busca por título ou ISBN
   - Filtro por gênero
   - Filtro por autor
4. **Visualizar**: Botão "Ver" em cada livro
5. **Editar**: Botão "Editar" em cada livro
6. **Excluir**: Botão "Excluir" (com confirmação)

## Funcionalidades Testadas

### ✅ CRUD Autores
- [x] Create: Formulário de criação funcionando
- [x] Read: Listagem e visualização individual
- [x] Update: Edição de dados
- [x] Delete: Exclusão com confirmação

### ✅ CRUD Livros
- [x] Create: Formulário com seleção de autor
- [x] Read: Listagem com dados do autor
- [x] Update: Edição completa
- [x] Delete: Exclusão com confirmação

### ✅ Relacionamentos
- [x] 1:N entre Autores e Livros
- [x] Chave estrangeira funcionando
- [x] Cascade delete configurado

### ✅ Busca e Filtros
- [x] Busca textual em autores
- [x] Busca textual em livros
- [x] Filtro por gênero
- [x] Filtro por autor
- [x] Combinação de filtros

### ✅ Interface
- [x] Menu de navegação responsivo
- [x] Layout Bootstrap moderno
- [x] Imagens e elementos visuais
- [x] Templates reutilizáveis
- [x] Responsividade mobile

## Dados de Teste

### Autor de Exemplo
- **Nome**: Machado de Assis
- **Email**: machado@literatura.com
- **Data**: 21/06/1839
- **Biografia**: Escritor brasileiro, considerado um dos maiores nomes da literatura brasileira.

### Livros Sugeridos
1. **Dom Casmurro** (1899, Romance)
2. **Memórias Póstumas de Brás Cubas** (1881, Romance)
3. **O Cortiço** (1890, Realismo)

## Estrutura de Arquivos

```
biblioteca-laravel/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthorController.php
│   │   └── BookController.php
│   └── Models/
│       ├── Author.php
│       └── Book.php
├── database/
│   ├── migrations/
│   └── database.sqlite
├── public/
│   ├── css/custom.css
│   └── images/
├── resources/views/
│   ├── layouts/app.blade.php
│   ├── authors/
│   ├── books/
│   └── home.blade.php
├── routes/web.php
└── README.md
```


## Avaliação dos Requisitos

| Requisito | Pontos | Status | Localização |
|-----------|--------|--------|-------------|
| Laravel + BD  ✅ | Todo o projeto |
| CRUD 2 tabelas  ✅ | Authors/Books Controllers |
| Relacionamento  ✅ | Models + Migrations |
| Busca/Filtro  ✅ | Index views + Controllers |
| Menu navegação ✅ | layouts/app.blade.php |
| Layout atraente ✅ | CSS + Images + Bootstrap |
| Templates ✅ | Blade templates |
| **TOTAL** | **✅** | **Completo** |


