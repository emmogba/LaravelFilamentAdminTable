<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class PatientTypeOverview extends BaseWidget {
    protected function getCards(): array {
        return [
            Card::make( label: 'Cats', value: Patient::query()->where( column: 'type', operator: 'cat' )->count() ),
            Card::make( label: 'Dogs', value: Patient::query()->where( column: 'type', operator: 'dog' )->count() ),
            Card::make( label: 'Rabbits', value: Patient::query()->where( column: 'type', operator: 'rabbit' )->count() ),
            Card::make( label: 'Chicken', value: Patient::query()->where( column: 'type', operator: 'chicken' )->count() ),
            Card::make( label: 'Cow', value: Patient::query()->where( column: 'type', operator: 'cow' )->count() ),
        ];
    }
}