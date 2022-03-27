<?php
declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220325173243 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE sms_message (id UUID NOT NULL, code VARCHAR(20) NOT NULL, message TEXT NOT NULL, transport VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_46A7FBA577153098 ON sms_message (code)');
        $this->addSql('COMMENT ON COLUMN sms_message.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE customer (id UUID NOT NULL, name VARCHAR(250) NOT NULL, email VARCHAR(100) NOT NULL, phone VARCHAR(100) NOT NULL, password VARCHAR(50) NOT NULL, roles VARCHAR(10) NOT NULL, country VARCHAR(2) DEFAULT NULL, date_last_login DATE DEFAULT NULL, enabled BOOLEAN NOT NULL, date_add TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_edit TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON customer (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649444F97DD ON customer (phone)');
        $this->addSql('COMMENT ON COLUMN customer.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN customer.date_add IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE sms_message');
        $this->addSql('DROP TABLE "user"');
    }
}
