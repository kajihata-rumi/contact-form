<?php
namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {

        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel1',
            'tel2',
            'tel3',
            'address',
            'building',
            'category_id',
            'detail',
        ]);

        // 表示用（結合）
        $contact['tel'] = ($request->input('tel1') ?? '') . ($request->input('tel2') ?? '') . ($request->input('tel3') ?? '');
        $contact['category_text'] = Category::find($contact['category_id'])->content ?? '';

        return view('confirm', compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'address',
            'building',
            'category_id',
            'detail',
        ]);

        // DB保存用（結合）
        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;
        Contact::create($contact);

        return redirect()->route('contacts.thanks');
    }
    public function thanks()
    {
        return view('thanks');
    }

    public function back(Request $request)
    {
        return redirect()
        ->route('contacts.index')
        ->withInput($request->all());
    }
    }




