<?php

namespace Darkeum\Charts\Support\Livewire;

use Illuminate\View\View;
use Boot\System\Livewire\Component;

/**
 * Class ChartComponent
 *
 * @package App\Support\Livewire
 */
abstract class ChartComponent extends Component
{

    /**
     * @var string|null
     */
    public ?bool $has_second = false;

    public ?string $chart_id = null;

    public ?string $chart_second_id = null;

    /**
     * @var string|null
     */
    public ?string $chart_data_checksum = null;

    public ?string $chart_second_data_checksum = null;

    /**
     * @return string
     */
    protected abstract function chartClass(): string;

    /**
     * @return \App\Support\Livewire\ChartComponentData
     */
    protected abstract function chartData(): ChartComponentData;

    /**
     * @return string
     */
    protected abstract function view(): string;

    /**
     * @return \Illuminate\View\View
     */
    public function render(): View
    {
        $chart_data = $this->chartData();
        $chart_class = $this->chartClass();
        $chart = new $chart_class($chart_data);
        if (!$this->chart_id) {
            $this->chart_id = $chart->id;
        } elseif ($chart_data->checksum() !== $this->chart_data_checksum) {
            $this->emit('chartUpdate', $this->chart_id, $chart_data->labels(), $chart->formatDatasets(false));
        }
        $this->chart_data_checksum = $chart_data->checksum();


        if($this->has_second) {
            $chart_second_data = $this->chartSecondData();
            $chart_second_class = $this->chartSecondClass();
            $chart_second = new $chart_second_class($chart_second_data);
            if (!$this->chart_second_id) {
                $this->chart_second_id = $chart_second->id;
            } elseif ($chart_second_data->checksum() !== $this->chart_second_data_checksum) {
                $this->emit('chartUpdate', $this->chart_second_id, $chart_second_data->labels(), $chart_second->formatDatasets(false));
            }
            $this->chart_second_data_checksum = $chart_second_data->checksum();
        }

        return view($this->view(), [
            'chart' => ($chart ?? null),
            'chart_second' => ($chart_second ?? null),
            'chart_id' => ($this->chart_id),
            'chart_second_id' => ($this->chart_second_id ?? null),
        ]);
    }
}
