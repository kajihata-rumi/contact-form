<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')->paginate(7);

        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
        $query = Contact::with('category');

        // キーワード（名前 or メール）
        $query->when($request->filled('keyword'), function ($q) use ($request) {
            $keyword = $request->keyword;

            $q->where(function ($qq) use ($keyword) {
                // ↓↓↓ ここをあなたのcontactsテーブルのカラム名に合わせる ↓↓↓
                $qq->where('first_name', 'like', "%{$keyword}%")
                    ->orWhere('last_name', 'like', "%{$keyword}%")
                    ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keyword}%"]);
            })
                ->orWhere('email', 'like', "%{$keyword}%");
        });

        // 性別
        $query->when($request->filled('gender') && $request->gender !== 'all', function ($q) use ($request) {
            $q->where('gender', $request->gender);
        });

        // お問い合わせ種類
        $query->when($request->filled('category_id'), function ($q) use ($request) {
            $q->where('category_id', $request->category_id);
        });

        // 日付（created_at）
        $query->when($request->filled('date'), function ($q) use ($request) {
            $q->whereDate('created_at', $request->date);
        });

        $contacts = $query->paginate(7)->appends($request->query());
        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }
    public function reset()
    {
        return redirect()->route('admin.index');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()
            ->route('admin.index')
            ->with('message', '削除しました');
    }
}

