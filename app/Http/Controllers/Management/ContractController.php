<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        return view('management.contracts.index', [
            'contracts' => Contract::all()
        ]);
    }

    public function store(Request $request)
    {
        Contract::create($request->all());
        return back();
    }

    public function update(Request $request, Contract $contract)
    {
        $contract->update($request->all());
        return back();
    }

    public function destroy(Contract $contract)
    {
        $contract->delete();
        return back();
    }
}
