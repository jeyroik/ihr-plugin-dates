<?php
namespace tests;

use jeyroik\components\attributes\THasCreatedAt;
use jeyroik\components\attributes\THasIdString;
use jeyroik\components\attributes\THasUpdatedAt;
use jeyroik\interfaces\attributes\IHaveCreatedAt;
use jeyroik\interfaces\attributes\IHaveIdString;
use jeyroik\interfaces\attributes\IHaveUpdatedAt;

class SomeDate implements IHaveCreatedAt, IHaveUpdatedAt, IHaveIdString
{
    use THasCreatedAt;
    use THasUpdatedAt;
    use THasIdString;
}
