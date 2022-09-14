<?php

/*
* @name        DARKLYY Charts
* @link        https://darklyy.ru/
* @copyright   Copyright (C) 2012-2022 ООО «ПРИС»
* @license     LICENSE.txt (see attached file)
* @version     VERSION.txt (see attached file)
* @author      Komarov Ivan
*/

namespace Darkeum\Charts\Classes\C3;

use Darkeum\Charts\Classes\DatasetClass;
use Darkeum\Charts\Features\C3\Dataset as DatasetFeatures;

class Dataset extends DatasetClass
{
    use DatasetFeatures;

    /**
     * Создание нового dataset с указанными значениями.
     *
     * @param string $name
     * @param string $type
     * @param array  $values
     */
    public function __construct(string $name, string $type, array $values)
    {
        parent::__construct($name, $type, $values);
    }

    /**
     * Форматирование dataset для chartjs.
     *
     * @return array
     */
    public function format()
    {
        return array_merge([$this->name], $this->values);
    }
}
