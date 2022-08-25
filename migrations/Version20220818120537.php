<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220818120537 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE applicants ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE applicants ADD CONSTRAINT FK_7FAFCADB9D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7FAFCADB9D86650F ON applicants (user_id_id)');
        $this->addSql('ALTER TABLE recuiters ADD users_email_id INT NOT NULL');
        $this->addSql('ALTER TABLE recuiters ADD CONSTRAINT FK_AB808BE6D373EA13 FOREIGN KEY (users_email_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AB808BE6D373EA13 ON recuiters (users_email_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE applicants DROP FOREIGN KEY FK_7FAFCADB9D86650F');
        $this->addSql('DROP INDEX UNIQ_7FAFCADB9D86650F ON applicants');
        $this->addSql('ALTER TABLE applicants DROP user_id_id');
        $this->addSql('ALTER TABLE recuiters DROP FOREIGN KEY FK_AB808BE6D373EA13');
        $this->addSql('DROP INDEX UNIQ_AB808BE6D373EA13 ON recuiters');
        $this->addSql('ALTER TABLE recuiters DROP users_email_id');
    }
}
