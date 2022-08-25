<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220824023122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE applicants DROP FOREIGN KEY FK_7FAFCADB9D86650F');
        $this->addSql('DROP INDEX UNIQ_7FAFCADB9D86650F ON applicants');
        $this->addSql('ALTER TABLE applicants CHANGE user_id_id created_by_id INT NOT NULL');
        $this->addSql('ALTER TABLE applicants ADD CONSTRAINT FK_7FAFCADBB03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7FAFCADBB03A8386 ON applicants (created_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE applicants DROP FOREIGN KEY FK_7FAFCADBB03A8386');
        $this->addSql('DROP INDEX UNIQ_7FAFCADBB03A8386 ON applicants');
        $this->addSql('ALTER TABLE applicants CHANGE created_by_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE applicants ADD CONSTRAINT FK_7FAFCADB9D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7FAFCADB9D86650F ON applicants (user_id_id)');
    }
}
