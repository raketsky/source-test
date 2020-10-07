<?php
declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20201007141313 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create Source table';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE source (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  a int(11) NOT NULL,
  b int(11) NOT NULL,
  c int(11) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE source');
    }
}
