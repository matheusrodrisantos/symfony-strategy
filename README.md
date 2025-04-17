# Evento Manager API

## Sobre o Projeto

Este é um projeto de API para gerenciamento de eventos desenvolvido com Symfony 7.2 e PHP 8.3, utilizado para estudar o padrão de projeto Strategy. A aplicação permite gerenciar eventos e seus participantes através de uma API RESTful.

## Estrutura do Projeto

```
.
├── Evento
│   ├── Controller
│   │   └── EventoController.php
│   ├── DTO
│   ├── Entity
│   │   └── Evento.php
│   ├── Repository
│   │   └── EventoRepository.php
│   └── Service
├── Kernel.php
└── Participante
    ├── Controller
    │   └── ParticipanteController.php
    ├── DTO
    │   ├── ParticipanteInputDTO.php
    │   └── ParticipanteOutputDTO.php
    ├── Entity
    │   └── Participante.php
    ├── Repository
    │   └── ParticipanteRepository.php
    └── Service
        └── ParticipanteService.php
```

## Tecnologias Utilizadas

- **Symfony 7.2**: Framework PHP moderno para desenvolvimento web
- **PHP 8.3**: Versão mais recente do PHP com recursos avançados
- **Doctrine ORM**: Sistema de mapeamento objeto-relacional
- **RESTful API**: Arquitetura para comunicação entre cliente-servidor

## Funcionalidades

- Cadastro e gerenciamento de eventos
- Cadastro e gerenciamento de participantes
- Associação de participantes a eventos
- Implementação do padrão Strategy (em desenvolvimento)

## Próximos Passos

- Implementação completa do padrão Strategy
- Desenvolvimento da interface em React para consumo da API
- Adição de novas funcionalidades como:
  - Sistema de notificações
  - Relatórios de participação
  - Calendário de eventos

## Como Executar

### Pré-requisitos

- PHP 8.3 ou superior
- Composer
- Symfony CLI (opcional)
- Banco de dados (MySQL, PostgreSQL ou SQLite)

### Instalação

1. Clone o repositório
```bash
git clone https://github.com/matheusrodrisantos/symfony-strategy
cd symfony-strategy
```

2. Instale as dependências
```bash
composer install
```

3. Configure o arquivo .env com suas credenciais de banco de dados

4. Crie o banco de dados e execute as migrações
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

5. Inicie o servidor de desenvolvimento
```bash
symfony serve
# ou
php -S localhost:8000 -t public/
```

## Documentação da API

A documentação completa da API será disponibilizada após a finalização da implementação do padrão Strategy.

## Contribuições

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou pull requests.

## Contato

**Matheus Rodrigues**
- Email: matheus.rodrisantos@outlook.com
- Website: [matheusrodrigues.tech](https://matheusrodrigues.tech)

## Licença

Este projeto está licenciado sob a Licença MIT - veja o arquivo LICENSE para mais detalhes.