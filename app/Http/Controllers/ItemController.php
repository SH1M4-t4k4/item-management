<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index(Request $request)
    {
        $query = Item::query();

        // 名前または種別で検索
    if ($request->has('keyword') && !empty($request->input('keyword'))) {
        $keyword = $request->input('keyword');
        $query->where(function($q) use ($keyword) {
            $q->where('name', 'like', '%' . $keyword . '%')
            ->orWhere('type', 'like', '%' . $keyword . '%');
        });
    }

        $items = $query->get();

        return view('item.index', compact('items'));
    }

        /**
         * 商品登録
         */
        public function add(Request $request)
        {
            // POSTリクエストのとき
            if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
                'type' => 'nullable|string|max:100',
                'detail' => 'nullable|string|max:500',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
            ]);

            return redirect('/items');
            }

        return view('item.add');
        }

    /**
     * 商品編集フォームの表示
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('item.edit', compact('item'));
    }

    /**
     * 商品の更新
     */
    public function update(Request $request, $id)
    {
        // バリデーション
        $this->validate($request, [
            'name' => ['required', 'max:100', 'regex:/^[^!@#\$%\^&\*\(\)_\+=\{\}\[\]:;"\'<>,\.\?\/\\\\]+$/u'],
            'type' => 'required',
            'detail' => 'required',
        ], [
            'name.regex' => '名前には記号を含めることはできません。'
        ]);

        $item = Item::findOrFail($id);
        $item->name = $request->name;
        $item->type = $request->type;
        $item->detail = $request->detail;
        $item->save();

        return redirect()->route('items.index')->with('success', '商品が更新されました');
    }

    public function delete($id)
    {
        // 該当する商品をデータベースから削除
        $item = Item::findOrFail($id);
        $item->delete();
    
        // 商品一覧ページにリダイレクト
        return redirect()->route('items.index')->with('success', '商品が削除されました。');
    }
}
