<?php

    namespace App\Twig;

    class PortfolioExtension extends \Twig_Extension
    {
        public function getFunctions()
        {
            return array(
                new \Twig_SimpleFunction('age_from_birthday', array($this, 'ageFromBirthday'))
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
