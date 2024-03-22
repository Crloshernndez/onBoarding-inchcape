<?php

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240202120000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Rename country_id to country column in client table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE client CHANGE country_id country INT UNSIGNED NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // Puedes implementar la lógica de reversión si es necesario
        $this->addSql('ALTER TABLE client CHANGE country country_id INT UNSIGNED NOT NULL');
    }
}