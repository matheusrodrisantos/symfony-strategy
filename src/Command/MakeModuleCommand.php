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
        $this->addArgument('name', InputArgument::REQUIRED, 'Nome do módulo (ex: Registration)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = ucfirst($input->getArgument('name'));
        $variables = lcfirst($name);
        $routePrefix = strtolower($name);

        $baseDir = "src/$name";
        $filesystem = new Filesystem();

        $folders = ['Controller', 'DTO', 'Entity', 'Factory', 'Repository', 'Service'];
        foreach ($folders as $folder) {
            $filesystem->mkdir("$baseDir/$folder");
        }

        $replacements = [
            'Module' => $name,
            'module' => $variables,
            'routePrefix' => $routePrefix,
        ];

        $stubToPath = [
            'Controller.stub' => "Controller/{$name}Controller.php",
            'DTOInput.stub' => "DTO/{$name}InputDTO.php",
            'DTOOutput.stub' => "DTO/{$name}OutputDTO.php",
            'Entity.stub' => "Entity/{$name}.php",
            'Factory.stub' => "Factory/{$name}Factory.php",
            'Repository.stub' => "Repository/{$name}Repository.php",
            'Service.stub' => "Service/{$name}Service.php",
        ];

        foreach ($stubToPath as $stub => $path) {
            $this->generateFileFromStub("stubs/$stub", "$baseDir/$path", $replacements);
        }

        $output->writeln("✅ Módulo <info>{$name}</info> criado com sucesso!");
        return Command::SUCCESS;
    }

    private function generateFileFromStub(string $stubPath, string $destinationPath, array $replacements): void
    {
        $filesystem = new Filesystem();

        if (!file_exists($stubPath)) {
            throw new \RuntimeException("Stub file not found: $stubPath");
        }

        $content = file_get_contents($stubPath);

        foreach ($replacements as $placeholder => $value) {
            $content = str_replace('{{ ' . $placeholder . ' }}', $value, $content);
        }

        $filesystem->dumpFile($destinationPath, $content);
    }
}
