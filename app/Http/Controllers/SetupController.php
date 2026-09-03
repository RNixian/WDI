<?php

namespace App\Http\Controllers;


use App\Models\ItemClassificationModel;
use App\Models\ItemCategoryModel;
use Illuminate\Http\Request;




class SetupController extends Controller
{

 public function materialsetup()
{
return view ('admin.setup.material_su');
}

public function storeclassification(Request $request)
{
    $data = $request->validate([
        'item_class'  => 'required',

    ]);
    $newclass = ItemClassificationModel::create($data);
    return redirect(route('admin.setup.material_su'));
}

public function deleteout_cat($id)
{
    $classfi = ItemClassificationModel::findOrFail($id);
    $classfi->delete();

    return redirect()->back()->with('success', 'Output Category has been deleted successfully!');
}

public function editout_cat($id){

    $classfi = ItemClassificationModel::find($id);
    return view('admin.setup.material_su', compact('classfi'));
    }

    public function updateout_cat(Request $request, $id) {
        $request->validate([
            'item_class' => 'required|min:1|max:255',
        ]);

         $post = ItemClassificationModel::find($id);
         $post->fill($request->all());
         $post->save();
        return redirect()->route('admin.setup.material_su');
    }

    public function searchout_cat(Request $request)
    {
        $classfi = ItemClassificationModel::all();

        $query = ItemClassificationModel::query();

        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('item_class', 'like', '%' . $request->search . '%')
                  ->orWhere('created_at', 'like', '%' . $request->search . '%')
                  ->orWhere('updated_at', 'like', '%' . $request->search . '%');
            });
        }
        return view('admin.setup.material_su', compact('ItemClassificationModel', 'classfi'));
    }

/**********************************************************************************************************************************/

public function storeunder_out_cat(Request $request)
{
    $data = $request->validate([
        'out_cat_id' => 'required|exists:research_out_cat,id',
        'under_roc'  => 'required|string|max:255',

    ]);
    $new_under_out_cat = ItemCategoryModel::create($data);
    return redirect(route('admin.setup.under_out_cat'));
}


public function deleteunder_out_cat($id)
{
    $under_out_cat = ItemCategoryModel::findOrFail($id);
    $under_out_cat->delete();

    return redirect()->back()->with('success', 'Under Output Category has been deleted successfully!');
}

public function editunder_out_cat($id){

    $under_out_cat = ItemCategoryModel::find($id);
    return view('admin.setup.under_out_cat', compact('under_out_cat'));
    }

    public function updateunder_out_cat(Request $request, $id) {
        $request->validate([
            'out_cat_id' => 'required|exists:research_out_cat,id',
            'under_roc'  => 'required|string|max:255',
        ]);

         $post = ItemCategoryModel::find($id);
         $post->fill($request->all());
         $post->save();
        return redirect()->route('admin.setup.under_out_cat');
    }


public function searchunder_out_cat(Request $request)
{
    $under_out_cats = ItemCategoryModel::all();
    $res_out_category = ItemClassificationModel::all();

    $query = ItemCategoryModel::with('outputCategory'); // eager load relationship

    if ($request->has('search') && $request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('under_roc', 'like', '%' . $request->search . '%')
              ->orWhere('created_at', 'like', '%' . $request->search . '%')
              ->orWhere('updated_at', 'like', '%' . $request->search . '%');
        })->orWhereHas('outputCategory', function ($q) use ($request) {
            $q->where('out_cat', 'like', '%' . $request->search . '%');
        });
    }

    $ItemCategoryModel = $query->paginate(5)->withQueryString();

    return view('admin.setup.under_out_cat', compact('ItemCategoryModel', 'under_out_cats', 'res_out_category'));
}



/**********************************************************************************************************************************/
}
