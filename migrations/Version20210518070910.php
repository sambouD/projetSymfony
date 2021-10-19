<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210518070910 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite_complet (id INT AUTO_INCREMENT NOT NULL, ac_date DATETIME NOT NULL, ac_lieu VARCHAR(255) NOT NULL, ac_theme VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activite_complet_visiteur (activite_complet_id INT NOT NULL, visiteur_id INT NOT NULL, INDEX IDX_C85B5BBFF24F7EB1 (activite_complet_id), INDEX IDX_C85B5BBF7F72333D (visiteur_id), PRIMARY KEY(activite_complet_id, visiteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inviter (id INT AUTO_INCREMENT NOT NULL, praticien_id INT DEFAULT NULL, activite_compl_id INT DEFAULT NULL, specialisation VARCHAR(255) NOT NULL, INDEX IDX_74795AFA2391866B (praticien_id), INDEX IDX_74795AFA7E683D87 (activite_compl_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lieux (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicament (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motif (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offrir (id INT AUTO_INCREMENT NOT NULL, medicament_id INT NOT NULL, rapport_visite_id INT NOT NULL, off_qte INT DEFAULT NULL, INDEX IDX_1D1E4ADEAB0D61F7 (medicament_id), INDEX IDX_1D1E4ADEC2A7FEB5 (rapport_visite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE praticien (id INT AUTO_INCREMENT NOT NULL, specialite_id INT DEFAULT NULL, region_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, INDEX IDX_D9A27D32195E0F0 (specialite_id), INDEX IDX_D9A27D398260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rapport_visite (id INT AUTO_INCREMENT NOT NULL, visiteur_id INT NOT NULL, praticien_id INT NOT NULL, motif_id INT DEFAULT NULL, lieux_id INT DEFAULT NULL, rap_date DATE NOT NULL, rap_bilan VARCHAR(255) NOT NULL, rap_motif VARCHAR(255) NOT NULL, INDEX IDX_D1D741717F72333D (visiteur_id), INDEX IDX_D1D741712391866B (praticien_id), INDEX IDX_D1D74171D0EEB819 (motif_id), INDEX IDX_D1D74171A2C806AC (lieux_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_visiteur (role_id INT NOT NULL, visiteur_id INT NOT NULL, INDEX IDX_64766189D60322AC (role_id), INDEX IDX_647661897F72333D (visiteur_id), PRIMARY KEY(role_id, visiteur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visiteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, login VARCHAR(255) DEFAULT NULL, mdp VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, cp VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, date_embouche DATE DEFAULT NULL, matricule VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activite_complet_visiteur ADD CONSTRAINT FK_C85B5BBFF24F7EB1 FOREIGN KEY (activite_complet_id) REFERENCES activite_complet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activite_complet_visiteur ADD CONSTRAINT FK_C85B5BBF7F72333D FOREIGN KEY (visiteur_id) REFERENCES visiteur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inviter ADD CONSTRAINT FK_74795AFA2391866B FOREIGN KEY (praticien_id) REFERENCES praticien (id)');
        $this->addSql('ALTER TABLE inviter ADD CONSTRAINT FK_74795AFA7E683D87 FOREIGN KEY (activite_compl_id) REFERENCES activite_complet (id)');
        $this->addSql('ALTER TABLE offrir ADD CONSTRAINT FK_1D1E4ADEAB0D61F7 FOREIGN KEY (medicament_id) REFERENCES medicament (id)');
        $this->addSql('ALTER TABLE offrir ADD CONSTRAINT FK_1D1E4ADEC2A7FEB5 FOREIGN KEY (rapport_visite_id) REFERENCES rapport_visite (id)');
        $this->addSql('ALTER TABLE praticien ADD CONSTRAINT FK_D9A27D32195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id)');
        $this->addSql('ALTER TABLE praticien ADD CONSTRAINT FK_D9A27D398260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE rapport_visite ADD CONSTRAINT FK_D1D741717F72333D FOREIGN KEY (visiteur_id) REFERENCES visiteur (id)');
        $this->addSql('ALTER TABLE rapport_visite ADD CONSTRAINT FK_D1D741712391866B FOREIGN KEY (praticien_id) REFERENCES praticien (id)');
        $this->addSql('ALTER TABLE rapport_visite ADD CONSTRAINT FK_D1D74171D0EEB819 FOREIGN KEY (motif_id) REFERENCES motif (id)');
        $this->addSql('ALTER TABLE rapport_visite ADD CONSTRAINT FK_D1D74171A2C806AC FOREIGN KEY (lieux_id) REFERENCES lieux (id)');
        $this->addSql('ALTER TABLE role_visiteur ADD CONSTRAINT FK_64766189D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_visiteur ADD CONSTRAINT FK_647661897F72333D FOREIGN KEY (visiteur_id) REFERENCES visiteur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite_complet_visiteur DROP FOREIGN KEY FK_C85B5BBFF24F7EB1');
        $this->addSql('ALTER TABLE inviter DROP FOREIGN KEY FK_74795AFA7E683D87');
        $this->addSql('ALTER TABLE rapport_visite DROP FOREIGN KEY FK_D1D74171A2C806AC');
        $this->addSql('ALTER TABLE offrir DROP FOREIGN KEY FK_1D1E4ADEAB0D61F7');
        $this->addSql('ALTER TABLE rapport_visite DROP FOREIGN KEY FK_D1D74171D0EEB819');
        $this->addSql('ALTER TABLE inviter DROP FOREIGN KEY FK_74795AFA2391866B');
        $this->addSql('ALTER TABLE rapport_visite DROP FOREIGN KEY FK_D1D741712391866B');
        $this->addSql('ALTER TABLE offrir DROP FOREIGN KEY FK_1D1E4ADEC2A7FEB5');
        $this->addSql('ALTER TABLE praticien DROP FOREIGN KEY FK_D9A27D398260155');
        $this->addSql('ALTER TABLE role_visiteur DROP FOREIGN KEY FK_64766189D60322AC');
        $this->addSql('ALTER TABLE praticien DROP FOREIGN KEY FK_D9A27D32195E0F0');
        $this->addSql('ALTER TABLE activite_complet_visiteur DROP FOREIGN KEY FK_C85B5BBF7F72333D');
        $this->addSql('ALTER TABLE rapport_visite DROP FOREIGN KEY FK_D1D741717F72333D');
        $this->addSql('ALTER TABLE role_visiteur DROP FOREIGN KEY FK_647661897F72333D');
        $this->addSql('DROP TABLE activite_complet');
        $this->addSql('DROP TABLE activite_complet_visiteur');
        $this->addSql('DROP TABLE inviter');
        $this->addSql('DROP TABLE lieux');
        $this->addSql('DROP TABLE medicament');
        $this->addSql('DROP TABLE motif');
        $this->addSql('DROP TABLE offrir');
        $this->addSql('DROP TABLE praticien');
        $this->addSql('DROP TABLE rapport_visite');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_visiteur');
        $this->addSql('DROP TABLE specialite');
        $this->addSql('DROP TABLE visiteur');
    }
}
