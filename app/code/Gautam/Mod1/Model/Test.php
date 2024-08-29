<?php
namespace Gautam\Mod1\Model;

use Gautam\Mod1\Api\Data\CustomCategoryInterface;

class Test
{
    private $customCategory;
    private $paramArray;
    private $paramString;

    public function __construct(
        CustomCategoryInterface $customCategory,
        array $paramArray,
        string $paramString
    ) {
        $this->customCategory = $customCategory;
        $this->paramArray = $paramArray;
        $this->paramString = $paramString;
    }

    public function displayParams()
    {
        echo '<pre>';
        print_r($this->paramArray);
        echo '</pre>';

        echo '<p>' . $this->paramString . '</p>';
    }
}
