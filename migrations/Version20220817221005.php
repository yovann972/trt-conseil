<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220817221005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE applicants (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, cv VARCHAR(255) NOT NULL, is_verify TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apply (id INT AUTO_INCREMENT NOT NULL, jobs_offers_id_id INT DEFAULT NULL, applicants_id_id INT DEFAULT NULL, INDEX IDX_BD2F8C1F32208312 (jobs_offers_id_id), INDEX IDX_BD2F8C1F64854863 (applicants_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jobs_offers (id INT AUTO_INCREMENT NOT NULL, author_id_id INT NOT NULL, title VARCHAR(150) NOT NULL, address VARCHAR(100) NOT NULL, city VARCHAR(100) NOT NULL, zip_code VARCHAR(5) NOT NULL, description LONGTEXT NOT NULL, is_active TINYINT(1) NOT NULL, published_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_1743232669CCBE9A (author_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recuiters (id INT AUTO_INCREMENT NOT NULL, company_name VARCHAR(100) NOT NULL, address VARCHAR(100) NOT NULL, city VARCHAR(80) NOT NULL, zip_code VARCHAR(5) NOT NULL, is_verify TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1F32208312 FOREIGN KEY (jobs_offers_id_id) REFERENCES jobs_offers (id)');
        $this->addSql('ALTER TABLE apply ADD CONSTRAINT FK_BD2F8C1F64854863 FOREIGN KEY (applicants_id_id) REFERENCES applicants (id)');
        $this->addSql('ALTER TABLE jobs_offers ADD CONSTRAINT FK_1743232669CCBE9A FOREIGN KEY (author_id_id) REFERENCES recuiters (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1F32208312');
        $this->addSql('ALTER TABLE apply DROP FOREIGN KEY FK_BD2F8C1F64854863');
        $this->addSql('ALTER TABLE jobs_offers DROP FOREIGN KEY FK_1743232669CCBE9A');
        $this->addSql('DROP TABLE applicants');
        $this->addSql('DROP TABLE apply');
        $this->addSql('DROP TABLE jobs_offers');
        $this->addSql('DROP TABLE recuiters');
    }
}
