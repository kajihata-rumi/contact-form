{{-- resources/views/admin/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            管理画面
        </h2>
    </x-slot>

    {{-- ★重要：open / selected はこの x-data の中で使う --}}
    <div x-data="{ open: false, selected: null }" class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- 検索フォーム --}}
                <form method="GET" action="{{ route('admin.search') }}" class="mb-6">
                    <div class="flex flex-wrap gap-3 items-center">
                        <input
                            type="text"
                            name="keyword"
                            placeholder="名前やメールアドレスを入力してください"
                            class="border rounded px-3 py-2"
                            value="{{ request('keyword') }}">

                        <select name="gender" class="border rounded px-3 py-2">
                            <option value="" {{ request('gender')==='' || request('gender')===null ? 'selected' : '' }}>性別</option>
                            <option value="all" {{ request('gender')==='all' ? 'selected' : '' }}>全て</option>
                            <option value="1" {{ request('gender')==='1' ? 'selected' : '' }}>男性</option>
                            <option value="2" {{ request('gender')==='2' ? 'selected' : '' }}>女性</option>
                            <option value="3" {{ request('gender')==='3' ? 'selected' : '' }}>その他</option>
                        </select>

                        <select name="category_id" class="border rounded px-3 py-2">
                            <option value="">お問い合わせの種類</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ (string)request('category_id')===(string)$category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                            @endforeach
                        </select>

                        <input
                            type="date"
                            name="date"
                            class="border rounded px-3 py-2"
                            value="{{ request('date') }}">

                        {{-- ✅これが消えてるはず：検索ボタン --}}
                        <button type="submit" class="btn-primary">検索</button>

                        <a href="{{ route('admin.reset') }}" class="btn-ghost">
                            リセット
                        </a>

                    </div>
                </form>


                {{-- エクスポート --}}
                <div class="mb-4">
                    <a
                        href="{{ route('admin.export', request()->query()) }}"
                        class="px-4 py-2 border rounded inline-block">
                        エクスポート
                    </a>
                </div>

                {{-- ページネーション --}}
                <div class="flex justify-end mb-3">
                    {{ $contacts->links() }}
                </div>

                {{-- 一覧テーブル --}}
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left py-2">お名前</th>
                            <th class="text-left py-2">性別</th>
                            <th class="text-left py-2">メールアドレス</th>
                            <th class="text-left py-2">お問い合わせの種類</th>
                            <th class="text-left py-2"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($contacts as $contact)
                        <tr class="hover:bg-gray-100 transition">
                            <td class="py-2">{{ $contact->last_name }} {{ $contact->first_name }}</td>

                            <td class="py-2">
                                @if($contact->gender == 1)
                                男性
                                @elseif($contact->gender == 2)
                                女性
                                @else
                                その他
                                @endif
                            </td>

                            <td class="py-2">{{ $contact->email }}</td>
                            <td class="py-2">{{ $contact->category->content }}</td>

                            <td class="py-2 space-x-2">
                                @php
                                $modalData = [
                                'id' => $contact->id,
                                'name' => $contact->last_name . ' ' . $contact->first_name,
                                'gender' => $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他'),
                                'email' => $contact->email,
                                'tel' => $contact->tel,
                                'address' => $contact->address,
                                'building' => $contact->building,
                                'category' => optional($contact->category)->content,
                                'detail' => $contact->detail,
                                ];
                                @endphp

                                {{-- 詳細：dispatchじゃなくて open/selected を直接操作 --}}
                                <button
                                    type="button"
                                    class="px-3 py-1 border rounded hover:bg-gray-100"
                                    @click="selected = @js($modalData); open = true">
                                    詳細
                                </button>

                                {{-- 削除（一覧の削除はそのまま） --}}
                                <form
                                    action="{{ route('admin.destroy', $contact->id) }}"
                                    method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('本当に削除しますか？')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger">削除</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        {{-- モーダル --}}
        <div
            x-cloak
            x-show="open"
            class="fixed inset-0 !z-[9999]"
            style="display:none;"
            @keydown.escape.window="open=false">
            {{-- 背景（ここで全面を覆う） --}}
            <div class="fixed inset-0 bg-black/40" @click="open=false"></div>

            {{-- 中央寄せラッパ --}}
            <div class="fixed inset-0 flex items-center justify-center p-6">
                {{-- ここが“箱”。高さ制限＋スクロールを付ける --}}
                <div class="bg-white w-full max-w-2xl rounded-lg shadow-lg p-6 overflow-y-auto max-h-[80vh]">

                    {{-- ヘッダー --}}
                    <div class="flex items-start justify-between mb-4">
                        <h2 class="text-lg font-bold">お問い合わせ詳細</h2>
                        <button type="button" class="px-2 py-1" @click="open=false"></button>
                    </div>

                    {{-- 中身：selected がある時だけ表示 --}}
                    <template x-if="selected">
                        <div class="space-y-3">

                            <div class="grid grid-cols-3 gap-2">
                                <div class="text-gray-600">お名前</div>
                                <div class="col-span-2" x-text="selected.name"></div>

                                <div class="text-gray-600">性別</div>
                                <div class="col-span-2" x-text="selected.gender"></div>

                                <div class="text-gray-600">メールアドレス</div>
                                <div class="col-span-2" x-text="selected.email"></div>

                                <div class="text-gray-600">電話番号</div>
                                <div class="col-span-2" x-text="selected.tel"></div>

                                <div class="text-gray-600">住所</div>
                                <div class="col-span-2" x-text="selected.address"></div>

                                <div class="text-gray-600">建物名</div>
                                <div class="col-span-2" x-text="selected.building"></div>

                                <div class="text-gray-600">お問い合わせの種類</div>
                                <div class="col-span-2" x-text="selected.category"></div>
                            </div>

                            <div class="mt-4">
                                <div class="text-gray-600 mb-1">お問い合わせ内容</div>
                                <div class="border rounded p-3 whitespace-pre-wrap" x-text="selected.detail"></div>
                            </div>

                            {{-- 削除：ここが “template の中” にあるのが超重要 --}}
                            <div class="mt-6 flex justify-center">
                                <form method="POST" :action="'/admin/contacts/' + selected.id"
                                    onsubmit="return confirm('本当に削除しますか？')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-10 py-2 rounded !bg-red-600 !text-white hover:bg-red-700">
                                        削除
                                    </button>
                                </form>
                            </div>

                        </div>
                    </template>

                </div>
            </div>
        </div>
</x-app-layout>