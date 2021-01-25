<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210124153203 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE role (id INT NOT NULL, role_group_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_57698A6AD4873F76 ON role (role_group_id)');
        $this->addSql('CREATE TABLE role_right (role_id INT NOT NULL, right_id INT NOT NULL, PRIMARY KEY(role_id, right_id))');
        $this->addSql('CREATE INDEX IDX_43169D3BD60322AC ON role_right (role_id)');
        $this->addSql('CREATE INDEX IDX_43169D3B54976835 ON role_right (right_id)');
        $this->addSql('CREATE TABLE role_user (role_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(role_id, user_id))');
        $this->addSql('CREATE INDEX IDX_332CA4DDD60322AC ON role_user (role_id)');
        $this->addSql('CREATE INDEX IDX_332CA4DDA76ED395 ON role_user (user_id)');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6AD4873F76 FOREIGN KEY (role_group_id) REFERENCES "group" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE role_right ADD CONSTRAINT FK_43169D3BD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE role_right ADD CONSTRAINT FK_43169D3B54976835 FOREIGN KEY (right_id) REFERENCES "right" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE role_right DROP CONSTRAINT FK_43169D3BD60322AC');
        $this->addSql('ALTER TABLE role_user DROP CONSTRAINT FK_332CA4DDD60322AC');
        $this->addSql('DROP SEQUENCE role_id_seq CASCADE');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_right');
        $this->addSql('DROP TABLE role_user');
    }
}
