<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Common\DashboardRequest;
use App\Services\Reports\VendorDashboardReportService;

class DashboardController extends Controller
{

    private $reportService;

    public function __construct(VendorDashboardReportService $reportService)
    {
        $this->reportService = $reportService;
    }


    /**
     * Display a listing of the Over All Information on Vendor Dashboard.
     *
     * @return Dashboard page view
     */
    public function index()
    {
        return view('vendor.dashboard', $this->reportService
            ->thisWeekOrdersCount()
            ->thisWeekSalesCount()
            ->newProductsCount()
            ->newRefundsCount()
            ->orderStatusWithCount()
            ->salesOfTheMonth()
            ->thisWeekOrdersCompare()
            ->thisWeekSalesCompare()
            ->newProductsCountCompare()
            ->newRefundsCountCompare()
            ->walletBalances()
            ->getArray());
    }

    /**
     * Get the most ordered products
     * @param DashboardRequest $request
     * @return mixed
     */
    public function mostSoldProducts(DashboardRequest $request)
    {
        return $this->response($this->reportService->mostSoldProducts()->get());
    }


    /**
     * Get the most ordered products
     * @param DashboardRequest $request
     * @return mixed
     */
    public function mostActiveUsers(DashboardRequest $request)
    {
        return $this->reportService->mostActiveUsers()->getResponse();
    }


    /**
     * Get vendor status
     * @param DashboardRequest $request
     * @return mixed
     */
    public function vendorStats(DashboardRequest $request)
    {
        return $this->reportService->vendorStats()->getResponse();
    }


    /**
     * Get item details
     * @param DashboardRequest $request
     * @return Response
     */
    public function getItemData(DashboardRequest $request)
    {
        return $this->reportService->itemDetails($request->uid)->getResponse();
    }


    /**
     * Get user details
     * @param DashboardRequest $request
     * @return Response
     */
    public function getUserData(DashboardRequest $request)
    {
        return $this->reportService->userDetails($request->uid)->getResponse();
    }


    /**
     * Get user details
     * @param DashboardRequest $request
     * @return Response
     */
    public function salesOfTheMonth(DashboardRequest $request)
    {
        return $this->reportService->salesOfTheMonth()->getResponse();
    }
}
