<?php

namespace FunnelchatTeam\SequenceEvents;

use Laravel\Nova\Fields\Field;

class SequenceEvents extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'sequence-events';

    public function translate()
    {
        return $this->withMeta([
            'day_is_collect' => [
                ['data' => 'monday', 'label' => __('Monday')],
                ['data' => 'tuesday', 'label' =>  __('Tuesday')],
                ['data' => 'wednesday', 'label' => __('Wednesday')],
                ['data' => 'thursday', 'label' => __('Thursday')],
                ['data' => 'friday', 'label' => __('Friday')],
                ['data' => 'saturday', 'label' => __('Saturday')],
                ['data' => 'sunday', 'label' => __('Sunday')],
                ['data' => 'tomorrow', 'label' => __('Tomorrow')],
            ],
            'duration_type_collect' => [
                ['data' => 'seconds', 'label' => __('Seconds')],
                ['data' => 'minutes', 'label' => __('Minutes')],
                ['data' => 'hour', 'label' => __('Hours')],
                ['data' => 'day', 'label' => __('Days')],
            ],
            'options' => [
                ['data' => 'Day is', 'label' => __('Day is')],
                ['data' => 'Duration', 'label' => __('Duration type')],
            ]
        ]);
    }
}
