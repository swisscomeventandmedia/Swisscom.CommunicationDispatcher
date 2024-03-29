<?php
namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Notification model
 */
class Version20171212225913 extends AbstractMigration
{

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return '';
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on "mysql".');

        $this->addSql('CREATE TABLE swisscom_communicationdispatcher_domain_model_notification (persistence_object_identifier VARCHAR(40) NOT NULL, person VARCHAR(40) DEFAULT NULL, subject VARCHAR(255) NOT NULL, text VARCHAR(255) NOT NULL, isread TINYINT(1) NOT NULL, timestamp DATETIME NOT NULL, INDEX IDX_C9B1358A34DCD176 (person), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE swisscom_communicationdispatcher_domain_model_notification ADD CONSTRAINT FK_C9B1358A34DCD176 FOREIGN KEY (person) REFERENCES neos_party_domain_model_person (persistence_object_identifier) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on "mysql".');

        $this->addSql('DROP TABLE swisscom_communicationdispatcher_domain_model_notification');
    }
}
