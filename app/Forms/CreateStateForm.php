<?php

namespace App\Forms;

use App\Models\Country;
use PhpOption\Option;
use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\FormBuilder\Text;
use ProtoneMedia\Splade\SpladeForm;

class CreateStateForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form
            ->action(route('admin.states.store'))
            ->method('POST')
            ->class('space-y-4 p-4 bg-white rounded')
            ->fill([
                //
            ]);
    }

    public function fields(): array
    {
        return [
            Text::make('name')
                ->label(__('Name'))
                ->rules(['required','max:100','min:3']),
            Select::make('country_id')
                ->Options(Country::pluck('name', 'id')->toArray())
                ->label('Choose a Country')
                ->rules(['required']),
            Submit::make()
                ->label(__('Save')),
        ];
    }
}
