<?php

namespace Darkeum\Charts\Classes\Apex;

use Illuminate\Support\Collection;
use Darkeum\Charts\Classes\BaseChart;
use Darkeum\Charts\Features\Apex\Chart as ChartFeatures;

class Chart extends BaseChart
{
    use ChartFeatures;

    /**
     * Chartjs dataset class.
     *
     * @var object
     */
    public $dataset = Dataset::class;

    /**
     * Initiates the Chartjs Line Chart.
     *
     * @return self
     */
    public function __construct()
    {
        parent::__construct();

        $this->container = 'charts::apex.container';
        $this->script = 'charts::apex.script';

        return $this->options([]);
    }

    public function formatDatasets()
    {
        $result = [];
        foreach ($this->datasets as $dataset) {
            $new = [];
            foreach ($dataset->values as $value) {
                $new[] = $value;
            }
            $result[] = [
                'name' => $dataset->name,
                'data' => $new,
            ];           
        }
        return json_encode($result);
    }
}
