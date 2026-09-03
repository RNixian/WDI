<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminModel;
use App\Models\ToolModel;
use App\Models\ToolCategoriesModel;
use App\Models\ToolClassificationModel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class AdminController extends Controller
{
    public function adminloginview()
    {
        return view('admin.adminlogin');
    }

        public function adminsidebar()
    {
        return view('admin.sibebar');
    }

    public function dashboard()
    {
        return view('admin.admindashboard');
    }

    public function adminlogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'masterkey' => 'required',
        ]);

        $admin = AdminModel::where('username', $request->username)->first();

        if ($admin && Hash::check($request->masterkey, $admin->masterkey)) {

            $admin->status = 'active';
            $admin->save();

            Auth::guard('admin')->login($admin);

            return redirect()->route('admin.admindashboard');
        }

        return back()->withErrors([
            'username' => 'Invalid Username or Master Key'
        ]);
    }

    public function logout(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        if ($admin) {
            $admin->status = 'inactive';
            $admin->save();
        }

        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('admin.adminlogin')
            ->with('success', 'You have been logged out.');
    }

    public function adminregister()
    {
        return view('admin.adminregister');
    }

    public function storenewadmin(Request $request)
    {
        $validated = $request->validate([
            'firstname'  => 'required|string',
            'middlename' => 'nullable|string',
            'lastname'   => 'required|string',
            'username'  => 'required|string|min:8|max:20|alpha_num|unique:admin,username',
            'masterkey' => 'required|string|min:8|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
        ]);

        // First admin becomes superadmin
        $role = AdminModel::count() === 0 ? 'superadmin' : 'admin';

        AdminModel::create([
            'firstname'  => $validated['firstname'],
            'middlename' => $validated['middlename'],
            'lastname'   => $validated['lastname'],
            'username'   => $validated['username'],
            'masterkey'  => Hash::make($validated['masterkey']),
            'role'       => $role,
            'status'     => 'inactive',
        ]);

        return redirect()
            ->route('admin.adminlogin')
            ->with('success', 'Registration successful.');
    }

//inventory===============================================================================================
public function inventory()
{
    $tool_classification = ToolClassificationModel::all();
    $tool_cat = ToolCategoriesModel::all();

    $tools = ToolModel::with([
        'tool_class',
        'tool_category'
    ])->paginate(5);

    return view('admin.inventory', compact(
        'tool_cat',
        'tool_classification',
        'tools'
    ));
}

public function gettoolcategory($tool_class_id)
{
    $class = ToolClassificationModel::find($tool_class_id);

    if (!$class) {
        return response()->json([]);
    }

    $categories = ToolCategoriesModel::where('tool_class_id', $class->id)->get();

    return response()->json($categories);
}

public function storetools(Request $request)
{
    $validatedData = $request->validate([
        'tools_description'  => 'required|string|max:255',
        'tool_class_id'      => 'required|integer|exists:tool_classification,id',
        'tool_cat_id'        => 'required|integer|exists:tool_categories,id',
        'size'               => 'nullable|string|max:100',
        'qty'                => 'required|integer|min:0',
        'purchased_at'       => 'required|date',
        'brand'              => 'nullable|string|max:100',
        'status'             => 'required|string|max:50',
        'invoice_reference'  => 'nullable|string|max:255',
        'unit_price'         => 'required|numeric|min:0',
        'serial_tag'         => 'nullable|string|max:100|unique:si_tools,serial_tag',
    ]);

    ToolModel::create($validatedData);

    return redirect()
        ->route('admin.inventory')
        ->with('success', 'Tool added successfully.');
}

public function deletetools($id)
{
    $tools = ToolModel::findOrFail($id);

    $tools->delete();

    return redirect()->back()
        ->with('success', 'Class has been deleted successfully!');
}

public function updatetools(Request $request, $id)
{
    $validatedData = $request->validate([
        'tools_description' => 'required|string|max:255',
        'tool_class_id' => 'required|integer|exists:tool_classification,id',
        'tool_cat_id' => 'required|integer|exists:tool_categories,id',
        'size' => 'nullable|string|max:100',
        'qty' => 'required|integer|min:0',
        'purchased_at' => 'required|date',
        'brand' => 'nullable|string|max:100',
        'status' => 'required|string|max:50',
        'invoice_reference' => 'nullable|string|max:255',
        'unit_price' => 'required|numeric|min:0',
        'serial_tag' => 'nullable|string|max:100|unique:si_tools,serial_tag,' . $id,
    ]);

    $tools = ToolModel::findOrFail($id);

    $tools->update($validatedData);

    return redirect()
        ->route('admin.inventory')
        ->with('success', 'Tool updated successfully.');
}

public function searchtools(Request $request)
{
    $query = ToolModel::with([
        'toolsclassification',
        'toolcategory'
    ]);

    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

            $q->where('tools_description', 'like', '%' . $search . '%')
              ->orWhere('brand', 'like', '%' . $search . '%')
              ->orWhere('status', 'like', '%' . $search . '%')
              ->orWhere('invoice_reference', 'like', '%' . $search . '%')
              ->orWhere('serial_tag', 'like', '%' . $search . '%');

        });
    }

    $tools = $query
        ->paginate(5)
        ->withQueryString();

    $tool_classification = ToolClassificationModel::all();
    $tool_cat = ToolCategoriesModel::all();

    return view('admin.inventory', compact(
        'tools',
        'tool_cat',
        'tool_classification'
    ));
}

//=====================================================================================================================

public function toolclass()
{
    $ToolClassificationModel = ToolClassificationModel::paginate(5);
    return view('admin.setup.tool_class_su', compact('ToolClassificationModel'));
}

public function storeclass(Request $request)
{
    $data = $request->validate([
        'tool_class' => 'required',
    ]);

    ToolClassificationModel::create($data);

    return redirect()->route('admin.setup.tool_class_su');
}

public function deleteclass($id)
{
    $class = ToolClassificationModel::findOrFail($id);

    $class->delete();

    return redirect()->back()
        ->with('success', 'Class has been deleted successfully!');
}

public function updateclass(Request $request, $id)
{
    $request->validate([
        'tool_class' => 'required|min:1|max:255',
    ]);

    $class = ToolClassificationModel::findOrFail($id);

    $class->update([
        'tool_class' => $request->tool_class,
    ]);

    return redirect()->route('admin.setup.tool_class_su');
}

public function searchclass(Request $request)
{
    $query = ToolClassificationModel::query();

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('tool_class', 'like', '%' . $request->search . '%')
              ->orWhere('created_at', 'like', '%' . $request->search . '%')
              ->orWhere('updated_at', 'like', '%' . $request->search . '%');
        });
    }

    $ToolClassificationModel = $query
        ->paginate(5)
        ->withQueryString();

    return view('admin.setup.tool_class_su', compact('ToolClassificationModel'));
}

//============================================================================================================================================

public function toolcategory()
{
    $ToolCategoriesModel = ToolCategoriesModel::with('toolsclassification')
        ->paginate(5);

    $classification = ToolClassificationModel::all();

    return view('admin.setup.tool_cat_su', compact(
        'ToolCategoriesModel',
        'classification'
    ));
}

public function storecategory(Request $request)
{
    $data = $request->validate([
        'tool_category' => 'required|string|max:255',
        'tool_class_id' => 'required|exists:tool_classification,id',

    ]);

    ToolCategoriesModel::create($data);

    return redirect()
        ->route('admin.setup.tool_cat_su')
        ->with('success', 'Tool category added successfully.');
}

public function deletecategory($id)
{
    $category = ToolCategoriesModel::findOrFail($id);

    $category->delete();

    return redirect()
        ->back()
        ->with('success', 'Tool category has been deleted successfully!');
}

public function updatecategory(Request $request, $id)
{
    $data = $request->validate([
        'tool_category' => 'required|string|max:255',
        'tool_class_id' => 'required|exists:tool_classification,id',

    ]);

    $category = ToolCategoriesModel::findOrFail($id);

    $category->update($data);

    return redirect()
        ->route('admin.setup.tool_cat_su')
        ->with('success', 'Tool category updated successfully.');
}

public function searchcategory(Request $request)
{
    $query = ToolCategoriesModel::with('toolsclassification');

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {

            $q->where('tool_category', 'like', "%{$search}%")
              ->orWhere('created_at', 'like', "%{$search}%")
              ->orWhere('updated_at', 'like', "%{$search}%")

              ->orWhereHas('toolsclassification', function ($q) use ($search) {
                  $q->where('tool_class', 'like', "%{$search}%");
              });

        });
    }

    $ToolCategoriesModel = $query
        ->paginate(5)
        ->withQueryString();

    $classification = ToolClassificationModel::all();

    return view('admin.setup.tool_cat_su', compact(
        'ToolCategoriesModel',
        'classification'
    ));
}

//=====================================================================================================================

public function borrower()
{
    $ToolClassificationModel = ToolClassificationModel::paginate(5);
    return view('admin.setup.tool_class_su', compact('ToolClassificationModel'));
}

public function storeborrower(Request $request)
{
    $data = $request->validate([
        'tool_class' => 'required',
    ]);

    ToolClassificationModel::create($data);

    return redirect()->route('admin.setup.tool_class_su');
}

public function deleteborrower($id)
{
    $class = ToolClassificationModel::findOrFail($id);

    $class->delete();

    return redirect()->back()
        ->with('success', 'Class has been deleted successfully!');
}

public function updateborrower(Request $request, $id)
{
    $request->validate([
        'tool_class' => 'required|min:1|max:255',
    ]);

    $class = ToolClassificationModel::findOrFail($id);

    $class->update([
        'tool_class' => $request->tool_class,
    ]);

    return redirect()->route('admin.setup.tool_class_su');
}

public function searchborrower(Request $request)
{
    $query = ToolClassificationModel::query();

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('tool_class', 'like', '%' . $request->search . '%')
              ->orWhere('created_at', 'like', '%' . $request->search . '%')
              ->orWhere('updated_at', 'like', '%' . $request->search . '%');
        });
    }

    $ToolClassificationModel = $query
        ->paginate(5)
        ->withQueryString();

    return view('admin.setup.tool_class_su', compact('ToolClassificationModel'));
}










}
