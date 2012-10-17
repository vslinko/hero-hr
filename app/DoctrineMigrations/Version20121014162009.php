<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

class Version20121014162009 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $schema->createSequence('vacancies_id_seq');
        $vacancies = $schema->createTable('vacancies');
        $vacancies->addColumn('id', 'integer');
        $vacancies->addColumn('title', 'string', array('length' => 140));
        $vacancies->addColumn('slug', 'string', array('length' => 140));
        $vacancies->setPrimaryKey(array('id'));
        $vacancies->addUniqueIndex(array('slug'));
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('vacancies');
        $schema->dropSequence('vacancies_id_seq');
    }
}
