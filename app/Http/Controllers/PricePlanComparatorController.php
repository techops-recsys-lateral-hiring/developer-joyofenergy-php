<?php

namespace App\Http\Controllers;

use App\Services\PricePlanService;
use Illuminate\Http\Request;

class PricePlanComparatorController extends Controller
{
    private $pricePlanService;

    public function __construct(){
        $this->pricePlanService = new PricePlanService();
    }

    public function recommendCheapestPricePlans($smartMeterId, $limit = 0){
        $recommendedPlans = $this->pricePlanService->getConsumptionCostOfElectricityReadingsForEachPricePlan($smartMeterId);
        $recommendedPlansAfterSorting = $this->sortPlans($recommendedPlans);

        if($limit != 0 && $limit < count($recommendedPlans)){
            $recommendedPlansAfterSorting = array_slice($recommendedPlansAfterSorting , 0, $limit);
        }
        return response()->json($recommendedPlansAfterSorting, 200);
    }

    public  function calculatedCostForEachPricePlan($smartMeterId){
        $costPricePerPlans = $this->pricePlanService->getCostPlanForAllSuppliersWithCurrentSupplierDetails($smartMeterId);
        return response()->json($costPricePerPlans, 200);
    }


    private function sortPlans($recommendedPlans){
        $sortedPlans = array_column($recommendedPlans, 'value');
        array_multisort($sortedPlans, SORT_ASC, $recommendedPlans);
        return $recommendedPlans;
    }
}
