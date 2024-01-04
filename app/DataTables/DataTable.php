<?php
/**
 * @package DataTable
 * @author techvillage <support@techvill.org>
 * @contributor Millat <[millat.techvill@gmail.com]>
 * @created 07-09-2021
 */
namespace App\DataTables;

use Yajra\DataTables\Services\DataTable as BaseDataTable;
use App\Models\Permission;
use App\Models\Preference;
use Auth;

class DataTable extends BaseDataTable
{
    public $prms;
    public $preference;

    public function __construct()
    {
        $this->prms = Permission::getAuthUserPermmission(optional(Auth::user())->id);
        $this->preference = Preference::getAll()->pluck('value', 'field')->toArray();
    }

    public function hasPermission(array $permissions) :bool
    {
        return (array_intersect($permissions, $this->prms)) ? true : false;
    }
}
