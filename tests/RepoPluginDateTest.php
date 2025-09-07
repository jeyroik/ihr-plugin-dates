<?php

use jeyroik\components\repositories\plugins\RepoPluginDates;
use jeyroik\components\repositories\plugins\RepoPluginUuid;
use jeyroik\components\repositories\RepositoryFile;
use jeyroik\components\repositories\THasRepository;
use jeyroik\interfaces\repositories\IRepository;
use PHPUnit\Framework\TestCase;
use tests\SomeDate;

class RepoPluginDateTest extends TestCase
{
    use THasRepository;

    public function testBasic()
    {
        putenv('REPOSITORY__PLUGINS_FILE=/tmp/plugins.php');
        file_put_contents(
            '/tmp/plugins.php',
            '<?php return [' . RepoPluginDates::class . '::class => [], '.RepoPluginUuid::class.'::class => []];'
        );

        if (is_file('/tmp/db.test.json')) {
            unlink('/tmp/db.test.json');
        }
        $table = $this->getRepo(SomeDate::class, RepositoryFile::class, 'test');

        $this->assertInstanceOf(IRepository::class, $table);
        $this->assertEmpty($table->findAll());

        /**
         * @var SomeDate $item
         */
        $item = $table->insertOne([
            'value' => 'some'
        ]);

        $this->assertInstanceOf(SomeDate::class, $item);
        $this->assertEquals(date('Y-m-d h:i:s'), $item->getCreatedAt()->format('Y-m-d H:i:s'));
        
        $item['value'] = 'some2';
        $table->updateOne($item);
        $date = date('Y-m-d H:i:s');

        /**
         * @var SomeDate $item
         */
        $item = $table->findOne([SomeDate::FIELD__ID => $item->getId()]);

        $this->assertNotEmpty($item);
        $this->assertEquals($date, $item->getUpdatedAt()->format('Y-m-d H:i:s'));

        unlink('/tmp/db.test.json');
        unlink('/tmp/plugins.php');
    }
}
