<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

// Importar entidades
use App\Core\Onboarding\Doctrine\Entity\Country;
use App\Core\Onboarding\Doctrine\Entity\Client;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201214630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Verificar si la tabla ya existe
        if (!$schema->hasTable('client')) {
            $this->addSql('CREATE TABLE client (id INT UNSIGNED AUTO_INCREMENT NOT NULL, country_id INT UNSIGNED NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, newsletter TINYINT(1) DEFAULT NULL, language VARCHAR(255) DEFAULT NULL, source VARCHAR(255) DEFAULT NULL, data JSON NOT NULL, address JSON NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, region VARCHAR(255) NOT NULL, brand VARCHAR(255) NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_C7440455F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
            $this->addSql('CREATE TABLE country (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, code VARCHAR(2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
            $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455F92F3E70');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE country');
    }
}