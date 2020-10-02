<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200930153642 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_api ADD team_id_id INT DEFAULT NULL, ADD team_id INT NOT NULL');
        $this->addSql('ALTER TABLE project_api ADD CONSTRAINT FK_3F7E02ECB842D717 FOREIGN KEY (team_id_id) REFERENCES teams (id)');
        $this->addSql('ALTER TABLE project_api ADD CONSTRAINT FK_3F7E02EC296CD8AE FOREIGN KEY (team_id) REFERENCES teams (id)');
        $this->addSql('CREATE INDEX IDX_3F7E02ECB842D717 ON project_api (team_id_id)');
        $this->addSql('CREATE INDEX IDX_3F7E02EC296CD8AE ON project_api (team_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project_api DROP FOREIGN KEY FK_3F7E02ECB842D717');
        $this->addSql('ALTER TABLE project_api DROP FOREIGN KEY FK_3F7E02EC296CD8AE');
        $this->addSql('DROP INDEX IDX_3F7E02ECB842D717 ON project_api');
        $this->addSql('DROP INDEX IDX_3F7E02EC296CD8AE ON project_api');
        $this->addSql('ALTER TABLE project_api DROP team_id_id, DROP team_id');
    }
}
