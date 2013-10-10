<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20131007013434 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "sqlite", "Migration can only be executed safely on 'sqlite'.");
        
        $this->addSql("CREATE TABLE category (id INTEGER NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_64C19C15E237E06 ON category (name)");
        $this->addSql("CREATE TABLE job (id INTEGER NOT NULL, category_id INTEGER DEFAULT NULL, type VARCHAR(255) NOT NULL, company VARCHAR(255) DEFAULT NULL, logo VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, position VARCHAR(255) DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, description VARCHAR(4000) DEFAULT NULL, how_to_apply VARCHAR(4000) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, is_public BOOLEAN DEFAULT NULL, is_activated BOOLEAN DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, expires_at DATETIME DEFAULT NULL, PRIMARY KEY(id))");
        $this->addSql("CREATE UNIQUE INDEX UNIQ_FBD8E0F85F37A13B ON job (token)");
        $this->addSql("CREATE INDEX IDX_FBD8E0F812469DE2 ON job (category_id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "sqlite", "Migration can only be executed safely on 'sqlite'.");
        
        $this->addSql("DROP TABLE category");
        $this->addSql("DROP TABLE job");
    }
}
