<?php

namespace PowerComponents\LivewirePowerGrid\Tests;

use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

class DishesActionTable extends DishTableBase
{
    use ActionButton;

    public array $eventId = [];

    public bool $join = false;

    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'deletedEvent',
            ]
        );
    }

    public function deletedEvent(array $params)
    {
        $this->eventId = $params;
    }

    public function openModal(array $params)
    {
        $this->eventId = $params;
    }

    public function actions(): array
    {
        return [
            Button::add('openModal')
                ->caption('openModal')
                ->class('text-center')
                ->openModal('edit-stock', ['dishId' => 'id']),

            Button::add('emit')
                ->caption(__('delete'))
                ->class('text-center')
                ->emit('deletedEvent', ['dishId' => 'id']),

            Button::add('emitTo')
                ->caption(__('EmitTo'))
                ->class('text-center')
                ->emitTo('dishes-table', 'deletedEvent', ['dishId' => 'id']),

            Button::add('bladeComponent')
            ->bladeComponent('livewire-powergrid::icons.arrow', ['dish-id' => 'id']),
        ];
    }
}
