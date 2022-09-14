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

use Darkeum\Charts\Classes\BaseChart;
use Darkeum\Charts\Features\C3\Chart as ChartFeatures;
use Illuminate\Support\Collection;

class Chart extends BaseChart
{
    use ChartFeatures;

    /**
     * C3 dataset class.
     *
     * @var object
     */
    public $dataset = Dataset::class;

    /**
     * Initiates the C3 Line Chart.
     *
     * @return self
     */
    public function __construct()
    {
        parent::__construct();

        $this->container = 'charts::c3.container';
        $this->script = 'charts::c3.script';

        return $this;
    }

    /**
     * Formats the datasets.
     *
     * @return void
     */
    public function formatDatasets()
    {
        $datasets = Collection::make($this->datasets);

        return json_encode([
            'columns' => Collection::make($this->datasets)
                ->each(function ($dataset) {
                    $dataset->matchValues(count($this->labels));
                })
                ->map(function ($dataset) {
                    return $dataset->format($this->labels);
                })
                ->toArray(),
            'type'  => $datasets->first()->type,
            'types' => $datasets->mapWithKeys(function ($d) {
                return [$d->name => $d->type];
            })->toArray(),
        ]);
    }
}
