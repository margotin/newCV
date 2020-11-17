<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201112152029 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_categorie (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_categorie_skill (skill_categorie_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_9D847A322E99772F (skill_categorie_id), INDEX IDX_9D847A325585C142 (skill_id), PRIMARY KEY(skill_categorie_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE skill_categorie_skill ADD CONSTRAINT FK_9D847A322E99772F FOREIGN KEY (skill_categorie_id) REFERENCES skill_categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skill_categorie_skill ADD CONSTRAINT FK_9D847A325585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skill_categorie_skill DROP FOREIGN KEY FK_9D847A325585C142');
        $this->addSql('ALTER TABLE skill_categorie_skill DROP FOREIGN KEY FK_9D847A322E99772F');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE skill_categorie');
        $this->addSql('DROP TABLE skill_categorie_skill');
    }
}
