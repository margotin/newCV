<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201116100017 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE skill_skill_category (skill_id INT NOT NULL, skill_category_id INT NOT NULL, INDEX IDX_86DD17995585C142 (skill_id), INDEX IDX_86DD1799AC58042E (skill_category_id), PRIMARY KEY(skill_id, skill_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE skill_skill_category ADD CONSTRAINT FK_86DD17995585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skill_skill_category ADD CONSTRAINT FK_86DD1799AC58042E FOREIGN KEY (skill_category_id) REFERENCES skill_category (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE skill_category_skill');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE skill_category_skill (skill_category_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_7437C894AC58042E (skill_category_id), INDEX IDX_7437C8945585C142 (skill_id), PRIMARY KEY(skill_category_id, skill_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE skill_category_skill ADD CONSTRAINT FK_7437C8945585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skill_category_skill ADD CONSTRAINT FK_7437C894AC58042E FOREIGN KEY (skill_category_id) REFERENCES skill_category (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE skill_skill_category');
    }
}
