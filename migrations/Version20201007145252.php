<?php
declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20201007145252 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Filling Source table with necessary data';
    }

    public function up(Schema $schema) : void
    {
        $totalNumbers = 1000000;
        $chunkSize = 10000;
        $a = 1;

        while ($a <= $totalNumbers) {
            $values = [];
            for ($i = 1; $i < $chunkSize; $i++) {
                if ($a > $totalNumbers) {
                    break;
                }
                $b = $a % 3;
                $c = $a % 5;
                $values[] = sprintf('(%d, %d, %d)', $a, $b, $c);
                $a++;
            }
            $sql = sprintf('INSERT INTO source (a, b, c) VALUES %s ', implode(', ', $values));
            $this->addSql($sql);
        }
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('TRUNCATE TABLE source');
    }
}
