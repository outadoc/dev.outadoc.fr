<?php

    namespace App\Twig;

    use Twig\Extension\AbstractExtension;
    use Twig\TwigFunction;

    class PortfolioExtension extends AbstractExtension
    {
        public function getFunctions()
        {
            return array(
                new TwigFunction('age_from_birthday', array($this, 'ageFromBirthday'))
            );
        }

        public function ageFromBirthday($date)
        {
            return floor((time() - strtotime($date)) / 86400 / 365);
        }

        public function getName()
        {
            return 'portfolio_extension';
        }
    }
