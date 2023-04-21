<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use Filament\Widgets\BarChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use PhpParser\Node\Stmt\Label;

class PatientsChart extends BarChartWidget {
    protected static ?string $heading = 'Patients';

    protected function getData(): array {
        $data = Trend::model( model: Patient::class )
        ->between(
            start: now()->subYear(),
            end: now()
        )
        ->perMonth()
        ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Patients',
                    'data' => $data->map( fn( TrendValue $value )=>$value->aggregate ),
                ],
            ],
            'labels' => $data->map( fn( TrendValue $value )=>$value->date ),
        ];
    }
}