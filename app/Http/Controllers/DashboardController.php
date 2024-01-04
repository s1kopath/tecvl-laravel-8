<?php

/**
 * @package DashboardController
 * @author techvillage <support@techvill.org>
 * @contributor Sabbir Al-Razi <[sabbir.techvill@gmail.com]>
 * @created 23-05-2021
 */

namespace App\Http\Controllers;

use App\Http\Requests\Common\DashboardRequest;
use App\Models\User;
use App\Services\Reports\AdminDashboardReportService;
use Illuminate\Http\Request;
use Cache;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private $reportService;

    public function __construct(AdminDashboardReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * Display a listing of the Over All Information on Dashboard.
     *
     * @return Dashboard page view
     */
    public function index()
    {
        return view('admin.dashboard', $this->reportService
            ->thisWeekOrdersCount()
            ->thisWeekSalesCount()
            ->newProductsCount()
            ->newRefundsCount()
            ->newVendors()
            ->orderStatusWithCount()
            ->newUsersCount('newUsers')
            ->salesOfTheMonth()
            ->topSoldBrands()
            ->thisWeekOrdersCompare()
            ->thisWeekSalesCompare()
            ->newUsersCompare()
            ->newProductsCountCompare()
            ->newVendorsCompare()
            ->newRefundsCountCompare()
            ->commissionsThisWeek()
            ->commissionThisWeekCompare()
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
     * @param $type
     * @return mixed
     */
    public function vendorStatsType($type)
    {
        return $this->reportService->vendorStats("vendorStats", $type)->getResponse();
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


    /**
     * Most sold brands
     * @param DashboardRequest $request
     * @return Response
     */
    public function topSoldBrands(DashboardRequest $request)
    {
        return $this->reportService->topSoldBrands()->getResponse();
    }


    /**
     * Change Language function
     *
     * @return true or false
     */
    public function switchLanguage(Request $request)
    {
        if ($request->lang) {
            if (empty(Auth::user()->id) && isset(Auth::guard('user')->user()->id) && $request->type == 'user') {
                Cache::put(config('cache.prefix') . '-user-language-' . Auth::guard('user')->user()->id, $request->lang, 5 * 365 * 86400);
                echo 1;
                exit;
            } elseif (isset(Auth::user()->id) && $request->type == 'admin') {
                Cache::put(config('cache.prefix') . '-admin-language-' . Auth::user()->id, $request->lang, 5 * 365 * 86400);
                echo 1;
                exit;
            }
        }
        echo 0;
        exit();
    }

    /**
     * Vendor request list
     *
     * @param DashboardRequest $request
     * @return mixed
     */
    public function vendorReq(DashboardRequest $request)
    {
        return $this->reportService->vendorRequestList()->getResponse();
    }

    /**
     * @param $status
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatus($status = null, $id = null)
    {
        $response = ['status' => 0];
        $result = $this->checkExistance($id, 'users');
        if ($result['status'] === true) {
            if ($status == 'accept') {
                $userStore = (new user)->updateUser(['status' => "Active"], $id);
            } elseif ($status == 'reject') {
                $userStore = (new user)->updateUser(['status' => "Inactive"], $id);
            }
            if ($userStore) {
                $response['status'] = 1;
            }
        }
        if ($response['status'] == 1) {
            return $this->reportService->vendorRequestList()->getResponse();
        }
    }
}
