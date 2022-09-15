<?php

namespace Darkeum\Charts\Classes\Apex;

use Darkeum\Charts\Classes\DatasetClass;
use Darkeum\Charts\Features\Chartjs\Dataset as DatasetFeatures;

class Dataset extends DatasetClass
{
    use DatasetFeatures;

    /**
     * Creates a new dataset with the given values.
     *
     * @param string $name
     * @param string $type
     * @param array  $values
     */
    public function __construct(string $name, string $type, array $values)
    {
        parent::__construct($name, $type, $values);

        $this->options([
            'borderWidth' => 2,
        ]);
    }

    /**
     * Formats the dataset for chartjs.
     *
     * @return array
     */
    public function format()
    {
        return [
                'data'  => $this->values,
                'name' => $this->name,
            ];
        // return array_merge($this->options, [
        //     'data'  => $this->values,
        //     'name' => $this->name,
        // ]);
    }
}
