<?php

namespace Florengaume\PrettyErrorPagesBundle\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'pretty-error-pages:install',
    description: 'Copie les templates d’erreur Bootstrap dans templates/bundles/TwigBundle/Exception du projet.'
)]
class InstallErrorPagesCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $source = __DIR__ . '/../../templates/bundles/TwigBundle/Exception/';
        $target = getcwd() . '/templates/bundles/TwigBundle/Exception/';
        @mkdir($target, 0777, true);

        $files = glob($source . 'error*.html.twig');
        foreach ($files as $file) {
            $basename = basename($file);
            copy($file, $target . $basename);
            $output->writeln("<info>Copié :</info> $basename");
        }
        $output->writeln("<comment>🎉 Les pages d’erreur sexy sont installées !</comment>");
        return Command::SUCCESS;
    }
}
