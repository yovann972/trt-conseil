<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220818125102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recuiters ADD created_by_id INT NOT NULL');
        $this->addSql('ALTER TABLE recuiters ADD CONSTRAINT FK_AB808BE6B03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AB808BE6B03A8386 ON recuiters (created_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recuiters DROP FOREIGN KEY FK_AB808BE6B03A8386');
        $this->addSql('DROP INDEX UNIQ_AB808BE6B03A8386 ON recuiters');
        $this->addSql('ALTER TABLE recuiters DROP created_by_id');
    }
}
