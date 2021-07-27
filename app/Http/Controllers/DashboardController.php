<?php

namespace App\Http\Controllers;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $chart1_options = [
            'chart_title' => 'Utilisateurs (par mois)',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
        ];
        $chart1 = new LaravelChart($chart1_options);

        $chart3_options = [
            'chart_title' => 'Tournois (par mois)',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Tournament',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
        ];
        $chart3 = new LaravelChart($chart3_options);

        $chart2_options = [
            'chart_title' => 'Victoires par équipe',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Game',
            'group_by_field' => 'winner',
            'chart_type' => 'pie',
            'relationship_name' => 'getWinner()->name',
        ];
        $chart2 = new LaravelChart($chart2_options);

        $chart4_options = [
            'chart_title' => 'Victoires de tournois par équipe',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Tournament',
            'group_by_field' => 'winner',
            'chart_type' => 'pie',
            'relationship_name' => 'getWinner()->name',
        ];
        $chart4 = new LaravelChart($chart4_options);

        return view('dashboard', compact('chart1', 'chart2', 'chart3', 'chart4'));
    }
}