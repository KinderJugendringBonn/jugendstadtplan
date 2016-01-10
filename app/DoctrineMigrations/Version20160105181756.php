<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Kjrb\Bundle\JugendstadtplanBundle\Entity\Kategorie;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160105181756 extends AbstractMigration implements ContainerAwareInterface
{
    /** @var ContainerInterface */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        foreach (array(
                    "Sport" => "sport",
                    "Großveranstaltung" => "event",
                    "Kino, Kunst, Kultur" => "kultur",
                    "Party" => "party",
                    "Essen & Trinken" => "essen",
                    "Spielplätze" => "spielplatz",
                    "Orte & Plätze" => "orte",
                    "Bildung" => "bildung",
                    "Jugendtreffs" => "jugendtreffs",
                    "Jugendgruppen" => "jugendgruppen",
                    "Konzerte" => "konzerte",
                    "Hilfe & Beratung" => "beratung",
                 ) as $name => $icon) {
            $kategorie = new Kategorie($name, $icon);
            $kategorie->setSichtbar(true);

            $em->persist($kategorie);
        }
        $em->flush();
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
    }
}
