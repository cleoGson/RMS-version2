<?php

namespace App\Traits;

trait ChartTrait
{
    protected $type;
    protected $categories;
    protected $series;
    protected $renderTo;
    public function options()
    {
        $option = [

            "chart" => [
                "renderTo" => $this->renderTo??'container',
                "type" => $this->type??'column',
                "options3d" => [
                    "enabled" => true,
                    "alpha" => 0,
                    "beta" => 0,
                    "depth" => 0,
                    "viewDistance" => 25
                ]
            ],
            "title" => [
                "text" => 'Data'
            ],
            "subtitle" => [
                "text" => 'Dataset'
            ],
            "plotOptions" => [
                "column" => [
                    "depth" => 0
                ]
            ],
            "series" => $this->series??[],
            "xAxis" => [
                "categories" => $this->categories??[]
            ],

            "credits" => [
                "enabled" => false
            ]

        ];
        return $option;
    }
}
