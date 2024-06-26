<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Item;
use App\Models\Category;
use App\Models\ServiceType;
use App\Models\Service;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Method to show transactions history based on current logged on member
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        $transactions = Transaction::with('status')->where('member_id', $user->id)
            ->orderBy('created_at', 'DESC')
            ->orderBy('status_id', 'ASC')
            ->get();

        return view('member.transactions_history', compact('user', 'transactions'));
    }

    /**
     * Method to show detail transaction
     *
     * @param  string|int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string|int $id): View
    {
        $user = Auth::user();
        $transactions = TransactionDetail::where('transaction_id', $id)->get();

        return view('member.detail', compact('user', 'transactions', 'id'));
    }
    public function create(Request $request): View
    {
        $location = geoip("IP_ADDRESS");
        $user = Auth::user();
        $items = Item::all();
        $categories = Category::all();
        $services = Service::all();
        $serviceTypes = ServiceType::all();

        // Check if there is an active transaction in session
        if ($request->session()->has('transaction') && $request->session()->has('memberIdTransaction')) {
            $sessionTransaction = $request->session()->get('transaction');

            $memberIdSessionTransaction = $request->session()->get('memberIdTransaction');

            // Get user's voucher
            $vouchers = UserVoucher::where([
                'user_id' => $memberIdSessionTransaction,
                'used'    => 0,
            ])->get();

            // Sum total price
            $totalPrice = 0;
            foreach ($sessionTransaction as &$transaction) {
                $totalPrice += $transaction['subTotal'];
            }

            return view('member.transaction_input', compact(
                'user',
                'items',
                'categories',
                'services',
                'serviceTypes',
                'sessionTransaction',
                'memberIdSessionTransaction',
                'totalPrice',
                'vouchers',
            ));
        }

        return view('member.transaction_input', compact(
            'user',
            'items',
            'categories',
            'services',
            'serviceTypes',
        ));
    }

    /**
     * Store transaction to database
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'payment-amount' => ['required', 'integer'],
        ]);

        DB::beginTransaction();

        $memberId = $request->session()->get('memberIdTransaction');
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        $memberId = $user->id;
        $sessionTransaction = $request->session()->get('transaction');

        // Hitung total harga
        $totalPrice = 0;
        foreach ($sessionTransaction as &$trs) {
            $totalPrice += $trs['subTotal'];
        }
        $discount = 0;

        //Cek apakah ada voucher yang digunakan
        if ($request->input('voucher') != 0) {
            // Ambil banyak potongan dari database

            $userVoucher = UserVoucher::where('id', $request->input('voucher'))->firstOrFail();
            if (!$userVoucher->voucher) {
                abort(404);
            }

            $discount = $userVoucher->voucher->discount_value;

            // Kurangi harga dengan potongan
            $totalPrice -= $discount;
            if ($totalPrice < 0) {
                $totalPrice = 0;
            }

            // Ganti status used pada tabel users_vouchers
            $userVoucher->used = 1;
            $userVoucher->save();
        }

        // Cek apakah menggunakan service type non reguler
        $cost = 0;
        if ($request->input('service-type') != 0) {
            $serviceTypeCost = ServiceType::where('id', $request->input('service-type'))->firstOrFail();
            $cost = $serviceTypeCost->cost;
            // Tambahkan harga dengan cost
            $totalPrice += $cost;
        }

        // Check if payment < total
        if ($request->input('payment-amount') < $totalPrice) {
            return redirect()->route('member.transactions.create')
                ->with('error', 'Pembayaran kurang');
        }

        $transaction = new Transaction([
            'status_id'       => 1,
            'member_id'       => $memberId,
            'member_id'        => $memberId,
            'finish_date'     => null,
            'discount'        => $discount,
            'total'           => $totalPrice,
            'service_type_id' => $request->input('service-type'),
            'service_cost'    => $cost,
            'payment_amount'  => $request->input('payment-amount'),
        ]);
        $transaction->save();

        foreach ($sessionTransaction as &$trs) {
            $price = PriceList::where([
                'item_id'     => $trs['itemId'],
                'category_id' => $trs['categoryId'],
                'service_id'  => $trs['serviceId'],
            ])->firstOrFail();

            $transaction_detail = new TransactionDetail([
                'transaction_id' => $transaction->id,
                'price_list_id'  => $price->id,
                'quantity'       => $trs['quantity'],
                'price'          => $price->price,
                'sub_total'      => $trs['subTotal'],
            ]);
            $transaction_detail->save();
        }

        $user = User::where('id', $memberId)->firstOrFail();
        $user->point = $user->point + 1;
        $user->save();

        $request->session()->forget('transaction');
        $request->session()->forget('memberIdTransaction');

        DB::commit();

        return redirect()->route('member.transactions.create')
            ->with('success', 'Transaksi berhasil disimpan')
            ->with('id_trs', $transaction->id);
    }

    /**
     * Return transaction data by id
     *
     * @param  \App\Models\Transaction $transaction
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * Change transaction status
     *
     * @param  \App\Models\Transaction $transaction
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Transaction $transaction, Request $request): JsonResponse
    {
        $currentDate = null;
        // Jika status 3 maka artinya sudah selesai, set tgl menjadi tgl selesai
        if ($request->input('val') == 3) {
            $currentDate = date('Y-m-d H:i:s');
        }

        $transaction->status_id = $request->input('val', 2);
        $transaction->finish_date = $currentDate;
        $transaction->save();

        return response()->json();
    }
}
