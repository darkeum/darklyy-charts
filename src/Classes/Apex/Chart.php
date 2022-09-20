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

    public function formatDatasets($encode = true)
    {
        $result = [];
        if ($this->type == 'donut') {
            foreach ($this->datasets as $dataset) {
                foreach ($dataset->values as $value) {
                    $result[] = $value;
                }
            }
        } else {
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
        }

        return $encode ? json_encode($result) : $result;
    }
}
