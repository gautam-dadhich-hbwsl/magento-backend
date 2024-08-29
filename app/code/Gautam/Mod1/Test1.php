<?php
namespace Gautam\Mod1;

class Test1
{
    protected $category;
    protected $dataArray;
    protected $textString;

    public function __construct(
        array $dataArray,
        string $textString
    ) {
        $this->dataArray = $dataArray;
        $this->textString = $textString;
    }

    public function displayParams()
    {
        echo "\nArray: ";
        print_r($this->dataArray);
        echo "String: " . $this->textString;
    }
}