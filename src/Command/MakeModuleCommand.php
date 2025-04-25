<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

#[AsCommand(
    name: 'app:make-module',
    description: 'Cria a estrutura de diretórios e arquivos base para um novo módulo no padrão da aplicação.',
)]
class MakeModuleCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'Nome do módulo (ex: Registration)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $module = ucfirst($input->getArgument('name'));
        $baseDir = "src/$module";
        $filesystem = new Filesystem();

        $folders = ['Controller', 'DTO', 'Entity', 'Factory', 'Repository', 'Service'];
        foreach ($folders as $folder) {
            $filesystem->mkdir("$baseDir/$folder");
        }

        $files = [
            "Controller/{$module}Controller.php" => "<?php\n\nnamespace App\\$module\\Controller;\n\nclass {$module}Controller\n{\n    // TODO: Adicionar métodos do controller\n}",
            "DTO/{$module}InputDTO.php" => "<?php\n\nnamespace App\\$module\\DTO;\n\nclass {$module}InputDTO\n{\n    // TODO: Adicionar propriedades e construtor\n}",
            "DTO/{$module}OutputDTO.php" => "<?php\n\nnamespace App\\$module\\DTO;\n\nclass {$module}OutputDTO\n{\n    // TODO: Adicionar propriedades e métodos de saída\n}",
            "Entity/{$module}.php" => "<?php\n\nnamespace App\\$module\\Entity;\n\nuse Doctrine\\ORM\\Mapping as ORM;\n\n#[ORM\\Entity()]\nclass {$module}\n{\n    #[ORM\\Id]\n    #[ORM\\GeneratedValue]\n    #[ORM\\Column]\n    private ?int \$id = null;\n\n    // TODO: Adicionar outras propriedades\n\n    public function getId(): ?int\n    {\n        return \$this->id;\n    }\n}",
            "Factory/{$module}Factory.php" => "<?php\n\nnamespace App\\$module\\Factory;\n\nclass {$module}Factory\n{\n    // TODO: Criar métodos de criação entre DTO e Entidade\n}",
            "Repository/{$module}Repository.php" => "<?php\n\nnamespace App\\$module\\Repository;\n\nuse Doctrine\\Bundle\\DoctrineBundle\\Repository\\ServiceEntityRepository;\nuse Doctrine\\Persistence\\ManagerRegistry;\nuse App\\$module\\Entity\\$module;\n\nclass {$module}Repository extends ServiceEntityRepository\n{\n    public function __construct(ManagerRegistry \$registry)\n    {\n        parent::__construct(\$registry, {$module}::class);\n    }\n}",
            "Service/{$module}Service.php" => "<?php\n\nnamespace App\\$module\\Service;\n\nclass {$module}Service\n{\n    // TODO: Criar métodos de negócio\n}"
        ];

        foreach ($files as $path => $content) {
            $filesystem->dumpFile("$baseDir/$path", $content);
        }

        $output->writeln("✅ Módulo <info>$module</info> criado com esqueleto completo!");
        return Command::SUCCESS;
    }
}
