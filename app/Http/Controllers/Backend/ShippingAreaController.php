<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{
    public function DivisionView()
    {
        $divisions = ShipDivision::orderBy('id', 'DESC')->get();

        return view('backend.ship.division.view_division', compact('divisions'));
    }

    public function DivisionStore(Request $request)
    {

        $request->validate([
            'division_name' => 'required',
        ]);

        ShipDivision::insert([
            'division_name' => strtoupper($request->division_name),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'Message' => 'Division Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DivisionEdit($id)
    {
        $division = ShipDivision::findOrFail($id);

        return view('backend.ship.division.edit_division', compact('division'));
    }

    public function DivisionUpdate(Request $request, $id)
    {

        $request->validate([
            'division_name' => 'required',
        ]);

        ShipDivision::findOrFail($id)->update([
            'division_name' => strtoupper($request->division_name),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'Message' => 'Division Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage-division')->with($notification);
    }

    public function DivisionDelete($id)
    {
        ShipDivision::findOrFail($id)->delete();

        $notification = array(
            'Message' => 'Division Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DistrictView()
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::orderBy('id', 'DESC')->get();

        return view('backend.ship.district.view_district', compact('divisions', 'districts'));
    }

    public function DistrictStore(Request $request)
    {

        $request->validate([
            'district_name' => 'required',
            'division_id' => 'required',
        ]);

        ShipDistrict::insert([
            'district_name' => strtoupper($request->district_name),
            'division_id' => $request->division_id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'Message' => 'District Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DistrictEdit($id)
    {
        $district = ShipDistrict::findOrFail($id);
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        return view('backend.ship.district.edit_district', compact('divisions', 'district'));
    }

    public function DistrictUpdate(Request $request, $id)
    {

        $request->validate([
            'district_name' => 'required',
            'division_id' => 'required',
        ]);

        ShipDistrict::findOrFail($id)->update([
            'district_name' => strtoupper($request->district_name),
            'division_id' => $request->division_id,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'Message' => 'District Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage-district')->with($notification);
    }

    public function DistrictDelete($id)
    {
        ShipDistrict::findOrFail($id)->delete();

        $notification = array(
            'Message' => 'District Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function StateView()
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();
        $states = ShipState::orderBy('id', 'DESC')->get();

        return view('backend.ship.state.view_state', compact('divisions', 'districts', 'states'));
    }

    public function GetDistrict($division_id)
    {
        $shipDistrict = ShipDistrict::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($shipDistrict);
    }

    public function StateStore(Request $request)
    {

        $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'state_name' => 'required',
        ]);

        ShipState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => strtoupper($request->state_name),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'Message' => 'State Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function StateEdit(Request $request, $id)
    {
        $state = ShipState::findOrFail($id);
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::orderBy('district_name', 'ASC')->get();
        return view('backend.ship.state.state_edit', compact('divisions', 'districts', 'state'));
    }

    public function StateUpdate(Request $request, $id)
    {

        $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'state_name' => 'required',
        ]);

        ShipState::findOrFail($id)->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => strtoupper($request->state_name),
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'Message' => 'State Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage-state')->with($notification);
    }

    public function StateDelete($id)
    {
        ShipState::findOrFail($id)->delete();

        $notification = array(
            'Message' => 'State Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
