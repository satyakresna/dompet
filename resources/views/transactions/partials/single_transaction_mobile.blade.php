<span class="pull-right">{{ $transaction->amount_string }}</span>
{{ link_to_route('transactions.index', $transaction->date, [
    'date' => $transaction->date_only,
    'month' => $month,
    'year' => $year,
    'category_id' => request('category_id'),
]) }}
<div>
    {{ $transaction->description }}
    @can('update', $transaction)
        {!! link_to_route(
            'transactions.index',
            __('app.edit'),
            ['action' => 'edit', 'id' => $transaction->id] + request(['month', 'year', 'query', 'category_id']),
            ['id' => 'edit-transaction-'.$transaction->id, 'class' => 'pull-right text-danger']
        ) !!}
    @endcan
</div>
<div>
    @php
        $partnerRoute = route('partners.show', [
            $transaction->partner_id,
            'start_date' => $year.'-'.$month.'-01',
            'end_date' => $year.'-'.$month.'-'.date('t'),
        ]);
    @endphp
    <a href="{{ $partnerRoute }}">{!! optional($transaction->partner)->name_label !!}</a>
    @php
        $categoryRoute = route('categories.show', [
            $transaction->category_id,
            'start_date' => $year.'-'.$month.'-01',
            'end_date' => $year.'-'.$month.'-'.date('t'),
        ]);
    @endphp
    <a href="{{ $categoryRoute }}">{!! optional($transaction->category)->name_label !!}</a>
</div>
<hr style="margin: 6px 0">
