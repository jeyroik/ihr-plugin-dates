<?php
namespace jeyroik\components\repositories\plugins;

use jeyroik\components\attributes\THasNowDate;
use jeyroik\components\THasAttributes;
use jeyroik\interfaces\attributes\IHaveCreatedAt;
use jeyroik\interfaces\attributes\IHaveDeletedAt;
use jeyroik\interfaces\attributes\IHaveUpdatedAt;
use jeyroik\interfaces\repositories\plugins\IRepositoryPlugin;

class RepoPluginDates implements IRepositoryPlugin
{
    use THasAttributes;
    use THasNowDate;

    public function __invoke(string $method, array $item): array
    {
        return match ($method) {
            'insertOne' => $this->insertOne($item),
            'updateOne' => $this->updateOne($item),
            'deleteOne' => $this->deleteOne($item),
            default => $item
        };        
    }

    public function insertOne(array $item): array
    {
        $item[IHaveCreatedAt::FIELD__CREATED_AT] = $this->getNowDateString();

        return $item;
    }

    public function updateOne(array $item): array
    {
        $item[IHaveUpdatedAt::FIELD__UPDATED_AT] = $this->getNowDateString();

        return $item;
    }

    public function deleteOne(array $item): array
    {
        $item[IHaveDeletedAt::FIELD__DELETED_AT] = $this->getNowDateString();

        return $item;
    }
}
