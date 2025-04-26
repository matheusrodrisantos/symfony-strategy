# EventRcc Manager API

## Sobre o Projeto

Este é um projeto de API para gerenciamento de **EventRccs**, desenvolvido com **Symfony 7.2** e **PHP 8.3**. A aplicação segue o padrão de projeto **Strategy** e permite o gerenciamento de EventRccs e seus **participants** através de uma API RESTful.

**Objetivo:** Estudo e implementação de boas práticas de arquitetura e design, com foco no uso do Symfony e no desenvolvimento modular de sistemas.

## Estrutura do Projeto

A estrutura do projeto segue o padrão modular por feature, facilitando a escalabilidade e a manutenção. Cada módulo é responsável por uma funcionalidade específica, como o gerenciamento de eventos, participantes e inscrições.

```
.
├── Command
│   └── MakeModuleCommand.php               # Comando para criar novos módulos
├── EventRcc
│   ├── Controller
│   │   └── EventRccController.php         # Controlador responsável pelas ações de EventRcc
│   ├── DTO
│   │   ├── EventRccInputDTO.php          # DTO para entrada de dados de EventRcc
│   │   └── EventRccOutputDTO.php         # DTO para saída de dados de EventRcc
│   ├── Entity
│   │   └── EventRcc.php                  # Entidade EventRcc
│   ├── Factory
│   │   └── EventRccFactory.php           # Fábrica para criação de EventRcc
│   ├── Repository
│   │   └── EventRccRepository.php        # Repositório para consultas de EventRcc
│   └── Service
│       └── EventRccService.php           # Serviço com lógica de negócios para EventRcc
├── Kernel.php
├── Participant
│   ├── Controller
│   │   └── ParticipantController.php     # Controlador responsável pelas ações de participantes
│   ├── DTO
│   │   ├── ParticipantInputDTO.php      # DTO para entrada de dados de participante
│   │   └── ParticipantOutputDTO.php     # DTO para saída de dados de participante
│   ├── Entity
│   │   └── Participant.php              # Entidade participante
│   ├── Repository
│   │   └── ParticipantRepository.php    # Repositório para consultas de participantes
│   └── Service
│       └── ParticipantService.php       # Serviço com lógica de negócios para participantes
```

## Tecnologias Utilizadas

- **Symfony 7.2**: Framework PHP moderno para desenvolvimento web.
- **PHP 8.3**: Versão mais recente do PHP, trazendo novas funcionalidades e melhorias de performance.
- **Doctrine ORM**: Sistema de mapeamento objeto-relacional, utilizado para persistência de dados.
- **RESTful API**: Arquitetura de comunicação entre cliente e servidor, baseada nos princípios REST.
- **Design Patterns**: Implementação do padrão de projeto **Strategy** para abstração de comportamentos e flexibilidade.

## Funcionalidades

- **Cadastro e gerenciamento de EventRccs**: Criar, editar e visualizar eventos.
- **Cadastro e gerenciamento de participantes**: Gerenciar participantes, com validação de dados.
- **Associação de participantes a EventRccs**: Vincular participantes aos eventos de forma eficiente.
- **Padrão Strategy (em desenvolvimento)**: Implementação para flexibilidade na lógica de negócios, permitindo a alteração dinâmica de comportamentos.

## Próximos Passos

- Finalização da implementação do padrão Strategy.
- Criação de interface gráfica em **React** para consumo da API.
- Novas funcionalidades planejadas:
  - **Sistema de notificações**: Enviar atualizações para participantes e administradores.
  - **Relatórios de participação**: Gerar relatórios detalhados sobre a presença e engajamento dos participantes.
  - **Calendário de EventRccs**: Exibir eventos em formato de calendário, com opções de filtragem.

## Como Executar

### Pré-requisitos

- **PHP 8.3 ou superior**: Para rodar a aplicação corretamente.
- **Composer**: Para gerenciamento das dependências PHP.
- **Symfony CLI (opcional)**: Para facilitar o gerenciamento do Symfony.
- **Banco de dados (MySQL, PostgreSQL ou SQLite)**: Qualquer um desses bancos pode ser usado.

### Instalação

1. Clone o repositório:
```bash
git clone https://github.com/matheusrodrisantos/symfony-strategy
cd symfony-strategy
```

2. Instale as dependências:
```bash
composer install
```

3. Configure o arquivo `.env` com as credenciais do seu banco de dados.

4. Crie o banco de dados e execute as migrações:
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

5. Inicie o servidor de desenvolvimento:
```bash
symfony serve
# ou
php -S localhost:8000 -t public/
```

## Documentação da API

A documentação completa da API será disponibilizada após a finalização da implementação do padrão Strategy.

## Contribuições

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou pull requests. Caso deseje contribuir com melhorias ou novos recursos, consulte a seção **Issues** para sugestões de melhorias e pontos a serem implementados.

## Contato

**Matheus Rodrigues**  
Email: [matheus.rodrisantos@outlook.com](mailto:matheus.rodrisantos@outlook.com)  
Website: [matheusrodrigues.tech](https://matheusrodrigues.tech)

## Licença

Este projeto está licenciado sob a **Licença MIT** - veja o arquivo `LICENSE` para mais detalhes.

