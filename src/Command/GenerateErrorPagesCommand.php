<?php

namespace Florengaume\PrettyErrorPagesBundle\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

#[AsCommand(
    name: 'pretty-error-pages:generate',
    description: 'Génère les pages d’erreur à partir du template et des fichiers de langue.'
)]
class GenerateErrorPagesCommand extends Command
{
    protected function configure()
    {
        $this
            ->addOption('lang', null, InputOption::VALUE_OPTIONAL, 'Langue (fr|en)', 'fr');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $lang = $input->getOption('lang');

        // Gestion claire de l'override du template
        $templateOverridesPath = getcwd() . '/templates/bundles/PrettyErrorPagesBundle/error_base.html.twig';
        $templateDefaultPath = __DIR__ . '/../../templates/error_base.html.twig';

        $templatePath = file_exists($templateOverridesPath) ? $templateOverridesPath : $templateDefaultPath;

        $translationPath = __DIR__ . '/../../translations/messages.' . $lang . '.yaml';
        $outputDir = getcwd() . '/templates/bundles/TwigBundle/Exception/';

        if (!file_exists($templatePath)) {
            $output->writeln("<error>Template introuvable : $templatePath</error>");
            return Command::FAILURE;
        }
        if (!file_exists($translationPath)) {
            $output->writeln("<error>Fichier langue introuvable : $translationPath</error>");
            return Command::FAILURE;
        }

        @mkdir($outputDir, 0777, true);

        $template = file_get_contents($templatePath);
        $translations = Yaml::parseFile($translationPath);

        $errors = [
            'error404.html.twig' => 'error_404',
            'error500.html.twig' => 'error_500',
            'error403.html.twig' => 'error_403',
            'error.html.twig'    => 'error_default'
        ];

        foreach ($errors as $filename => $key) {
            if (!isset($translations[$key])) {
                $output->writeln("<comment>Pas de traduction pour $key</comment>");
                continue;
            }
            $replaced = $template;
            foreach ($translations[$key] as $var => $value) {
                $replaced = str_replace('{{ '.$var.' }}', $value, $replaced);
            }
            file_put_contents($outputDir . $filename, $replaced);
            $output->writeln("<info>Créé : $filename</info>");
        }
        $output->writeln("<comment>✨ Pages d’erreur générées pour '$lang' !</comment>");
        return Command::SUCCESS;
    }
}
