<table class="table table-head-fixed text-nowrap">
    <thead>
    <tr>
        <td colspan="3"> 10 Last Transactions </td>
    </tr>
    </thead>
    <thead>
    <tr>
        <th>ID</th>
        <th>Amount</th>
        <th>Date</th>

    </tr>
    </thead>
    <tbody>
    @foreach(\App\Models\Transaction::query()
        ->where('status',\App\Enums\TransactionStatus::ACCEPTEE)
        ->where('type',\App\Enums\TransactionType::ACHAT)
        ->limit(10)
        ->get()
         as $transaction)
        <tr>
            <td>{{$transaction->hash}}</td>
            <td>{{$transaction->montant}}</td>
            <td>{{$transaction->created_at}}</td>
        </tr>
    @endforeach

    </tbody>
</table>

