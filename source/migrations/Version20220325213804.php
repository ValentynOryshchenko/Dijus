<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220325213804 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE post (id UUID NOT NULL, enabled BOOLEAN NOT NULL, date_add TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_edit TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D50F9BB844C163492 ON post (enabled, date_add)');
        $this->addSql('COMMENT ON COLUMN post.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN post.date_add IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE post_translation (id UUID NOT NULL, post_id UUID DEFAULT NULL, language VARCHAR(2) NOT NULL, title VARCHAR(250) NOT NULL, text TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5829CF404B89032C ON post_translation (post_id)');
        $this->addSql('COMMENT ON COLUMN post_translation.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN post_translation.post_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE post_translation ADD CONSTRAINT FK_5829CF404B89032C FOREIGN KEY (post_id) REFERENCES post (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE post_translation DROP CONSTRAINT FK_5829CF404B89032C');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE post_translation');
    }
}
