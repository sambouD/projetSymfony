<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201123150608 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_visiteur (role_id INT NOT NULL, visiteur_id INT NOT NULL, INDEX IDX_64766189D60322AC (role_id), INDEX IDX_647661897F72333D (visiteur_id), PRIMARY KEY(role_id, visiteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE role_visiteur ADD CONSTRAINT FK_64766189D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_visiteur ADD CONSTRAINT FK_647661897F72333D FOREIGN KEY (visiteur_id) REFERENCES visiteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activite_complet CHANGE ac_date ac_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE medicament CHANGE id id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE role_visiteur DROP FOREIGN KEY FK_64766189D60322AC');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_visiteur');
        $this->addSql('ALTER TABLE activite_complet CHANGE ac_date ac_date DATE NOT NULL');
        $this->addSql('ALTER TABLE medicament CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
