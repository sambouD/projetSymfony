<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201109152609 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite_complet (id INT AUTO_INCREMENT NOT NULL, ac_date DATE NOT NULL, ac_lieu VARCHAR(255) NOT NULL, ac_theme VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activite_complet_visiteur (activite_complet_id INT NOT NULL, visiteur_id INT NOT NULL, INDEX IDX_C85B5BBFF24F7EB1 (activite_complet_id), INDEX IDX_C85B5BBF7F72333D (visiteur_id), PRIMARY KEY(activite_complet_id, visiteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inviter (id INT AUTO_INCREMENT NOT NULL, praticien_id INT DEFAULT NULL, activite_compl_id INT DEFAULT NULL, specialisation VARCHAR(255) NOT NULL, INDEX IDX_74795AFA2391866B (praticien_id), INDEX IDX_74795AFA7E683D87 (activite_compl_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicament (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offrir (id INT AUTO_INCREMENT NOT NULL, medicament_id INT NOT NULL, rapport_visite_id INT NOT NULL, off_qte INT DEFAULT NULL, INDEX IDX_1D1E4ADEAB0D61F7 (medicament_id), INDEX IDX_1D1E4ADEC2A7FEB5 (rapport_visite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE praticien (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rapport_visite (id INT AUTO_INCREMENT NOT NULL, visiteur_id INT NOT NULL, praticien_id INT NOT NULL, rap_date DATE NOT NULL, rap_bilan VARCHAR(255) NOT NULL, rap_motif VARCHAR(255) NOT NULL, INDEX IDX_D1D741717F72333D (visiteur_id), INDEX IDX_D1D741712391866B (praticien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visiteur (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activite_complet_visiteur ADD CONSTRAINT FK_C85B5BBFF24F7EB1 FOREIGN KEY (activite_complet_id) REFERENCES activite_complet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activite_complet_visiteur ADD CONSTRAINT FK_C85B5BBF7F72333D FOREIGN KEY (visiteur_id) REFERENCES visiteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inviter ADD CONSTRAINT FK_74795AFA2391866B FOREIGN KEY (praticien_id) REFERENCES praticien (id)');
        $this->addSql('ALTER TABLE inviter ADD CONSTRAINT FK_74795AFA7E683D87 FOREIGN KEY (activite_compl_id) REFERENCES activite_complet (id)');
        $this->addSql('ALTER TABLE offrir ADD CONSTRAINT FK_1D1E4ADEAB0D61F7 FOREIGN KEY (medicament_id) REFERENCES medicament (id)');
        $this->addSql('ALTER TABLE offrir ADD CONSTRAINT FK_1D1E4ADEC2A7FEB5 FOREIGN KEY (rapport_visite_id) REFERENCES rapport_visite (id)');
        $this->addSql('ALTER TABLE rapport_visite ADD CONSTRAINT FK_D1D741717F72333D FOREIGN KEY (visiteur_id) REFERENCES visiteur (id)');
        $this->addSql('ALTER TABLE rapport_visite ADD CONSTRAINT FK_D1D741712391866B FOREIGN KEY (praticien_id) REFERENCES praticien (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite_complet_visiteur DROP FOREIGN KEY FK_C85B5BBFF24F7EB1');
        $this->addSql('ALTER TABLE inviter DROP FOREIGN KEY FK_74795AFA7E683D87');
        $this->addSql('ALTER TABLE offrir DROP FOREIGN KEY FK_1D1E4ADEAB0D61F7');
        $this->addSql('ALTER TABLE inviter DROP FOREIGN KEY FK_74795AFA2391866B');
        $this->addSql('ALTER TABLE rapport_visite DROP FOREIGN KEY FK_D1D741712391866B');
        $this->addSql('ALTER TABLE offrir DROP FOREIGN KEY FK_1D1E4ADEC2A7FEB5');
        $this->addSql('ALTER TABLE activite_complet_visiteur DROP FOREIGN KEY FK_C85B5BBF7F72333D');
        $this->addSql('ALTER TABLE rapport_visite DROP FOREIGN KEY FK_D1D741717F72333D');
        $this->addSql('DROP TABLE activite_complet');
        $this->addSql('DROP TABLE activite_complet_visiteur');
        $this->addSql('DROP TABLE inviter');
        $this->addSql('DROP TABLE medicament');
        $this->addSql('DROP TABLE offrir');
        $this->addSql('DROP TABLE praticien');
        $this->addSql('DROP TABLE rapport_visite');
        $this->addSql('DROP TABLE visiteur');
    }
}
