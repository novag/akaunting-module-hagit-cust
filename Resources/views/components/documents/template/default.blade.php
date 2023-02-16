<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100%3B500&display=swap');
    @page {
        margin-top: 0;
        margin-left: 80px;
        margin-right: 80px;
    }
    * {
        font-family: "Roboto", sans-serif !important;
    }
    footer {
        width: 100%;
        text-align: center;
        position: fixed;
        bottom: 0;
    }
    .print-template {
        font-size: 12px;
        line-height: 16px;
    }
    .print-template p {
        color: #000000;
    }
    .text {
        color: #000000;
        font-size: 12px;
    }
    .text-highlight {
        color: #36a495;
    }
    .lines tbody td {
        border-bottom-color: #dfdfdf;
    }
    th, td {
        padding: 10px 0 10px 0;
    }
    .mb-0 {
        margin-bottom: 0 !important;
    }
    .font-semibold {
        font-weight: 500;
    }
    .border-footer {
        border-top: 2px solid #36a495;
    }
    .logo-box {
        height: 120px;
        width: 172px;
        top: 0;
        right: 0;
        position: absolute;
        clear: both;
        background-color: black;
    }
    .logo {
        position: absolute;
        margin-bottom: 25px;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        max-width: 90%;
        height: auto;
    }
    .invoice-fields p {
        margin-top: 0 !important;
    }
    .invoice-fields p span {
        margin-bottom: 0 !important;
    }
</style>
<div class="print-template">
    <div class="row">
        <div class="col-100">
            <div class="logo-box">
                @stack('company_logo_input_start')
                @if (!$hideCompanyLogo)
                    <img class="logo" src="{{ $logo }}" alt="{{ setting('company.name') }}"/>
                @endif
                @stack('company_logo_input_end')
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 160px;">
        <div class="col-100">
            <div class="text">
                @stack('company_details_start')
                @if (!$hideCompanyDetails)
                    <span class="text-highlight small-text font-semibold">
                        {{ setting('company.name') }} | {!! str_replace('\n', ', ', setting('company.address')) !!} | {!! setting('company.zip_code') !!} {!! setting('company.city') !!}
                    </span>
                @endif
                @stack('company_details_end')
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-100">
            <div class="text p-index-left">
                @stack('name_input_start')
                @if (!$hideContactName)
                    @if ($print)
                        <span class="font-semibold">
                            {{ $document->contact_name }}
                        </span>
                    @else
                        <x-link href="{{ route($showContactRoute, $document->contact_id) }}"
                                override="class"
                                class="py-1.5 mb-3 sm:mb-0 text-xs bg-transparent hover:bg-transparent font-medium leading-6"
                        >
                            <x-link.hover>
                                <span class="font-semibold">
                                    {{ $document->contact_name }}
                                </span>
                            </x-link.hover>
                        </x-link>
                    @endif
                @endif
                @stack('name_input_end')

                @stack('address_input_start')
                @if (!$hideContactAddress)
                    <span>
                        <br />
                        {!! nl2br($document->contact_address) !!}
                        <br />
                        {!! $document->contact_zip_code !!} {!! $document->contact_city !!}
                        <br />
                        {!! $document->contact_country !!}
                    </span>
                @endif
                @stack('address_input_end')

                @stack('tax_number_input_start')
                @if ( !$hideContactTaxNumber && $document->contact_tax_number)
                    <br />
                    <span>
                        {{ trans('hagit-cust::general.field.tax_id') }}: {{ $document->contact_tax_number }}
                    </span>
                @endif
                @stack('tax_number_input_end')
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 60px;">
        <div class="col-60">
            <div class="text text-dark p-index-left">
                @stack('title_input_start')
                <h2 class="mb-0 mt-0">
                    {{ $textDocumentTitle }}
                </h2>
                @stack('title_input_end')
                @if ($textDocumentSubheading)
                    <h3 class="mb-0 mt-1">
                        {{ $textDocumentSubheading }}
                    </h3>
                @endif
                @stack('subtitle_input_end')
            </div>
        </div>
        <div class="col-40 invoice-fields">
            <div class="text p-index-right">
                @stack('document_number_input_start')
                    @if (!$hideDocumentNumber)
                        <p class="mb-0 mt-0">
                            <span class="font-semibold w-numbers">
                                {{ trans($textDocumentNumber) }}:
                            </span>

                            <span class="float-right">
                                {{ $document->document_number }}
                            </span>
                        </p>
                    @endif
                @stack('document_number_input_end')

                @stack('order_number_input_start')
                    @if (!$hideOrderNumber)
                        @if ($document->order_number)
                            <p class="mb-0 mt-0">
                                <span class="font-semibold w-numbers">
                                    {{ trans($textOrderNumber) }}:
                                </span>

                                <span class="float-right">
                                    {{ $document->order_number }}
                                </span>
                            </p>
                        @endif
                    @endif
                @stack('order_number_input_end')

                @stack('issued_at_input_start')
                    @if (!$hideIssuedAt)
                        <p class="mb-0 mt-0">
                            <span class="font-semibold w-numbers">
                                {{ trans($textIssuedAt) }}:
                            </span>

                            <span class="float-right">
                                @date($document->issued_at)
                            </span>
                        </p>
                    @endif
                @stack('issued_at_input_end')

                @stack('due_at_input_start')
                    @if (!$hideDueAt)
                        <p class="mb-0 mt-0">
                            <span class="font-semibold w-numbers">
                                {{ trans($textDueAt) }}:
                            </span>

                            <span class="float-right">
                                @date($document->due_at)
                            </span>
                        </p>
                    @endif
                @stack('due_at_input_end')
            </div>
        </div>
    </div>

    @if (!$hideItems)
        <div class="row mt-6">
            <div class="col-100">
                <div class="text extra-spacing">
                    <table class="lines">
                        <thead class="border-bottom-1" style="border-color: #dfdfdf;">
                            <tr>
                                @stack('name_th_start')
                                    @if (!$hideItems || (!$hideName && !$hideDescription))
                                        <td class="item text font-semibold text-alignment-left text-left">
                                            <span>
                                                {{ (trans_choice($textItems, 2) != $textItems) ? trans_choice($textItems, 2) : trans($textItems) }}
                                            </span>
                                        </td>
                                    @endif
                                @stack('name_th_end')

                                @stack('quantity_th_start')
                                    @if (!$hideQuantity)
                                        <td class="quantity text font-semibold text-alignment-right text-right">
                                            <span>
                                                {{ trans($textQuantity) }}
                                            </span>
                                        </td>
                                    @endif
                                @stack('quantity_th_end')

                                @stack('price_th_start')
                                    @if (!$hidePrice)
                                        <td class="price text font-semibold text-alignment-right text-right">
                                            <span>
                                                {{ trans($textPrice) }}
                                            </span>
                                        </td>
                                    @endif
                                @stack('price_th_end')

                                @if (!$hideDiscount)
                                    @if (in_array(setting('localisation.discount_location', 'total'), ['item', 'both']))
                                        @stack('discount_td_start')
                                            <td class="discount text font-semibold text-alignment-right text-right">
                                                <span>
                                                    {{ trans('invoices.discount') }}
                                                </span>
                                            </td>
                                        @stack('discount_td_end')
                                    @endif
                                @endif

                                @stack('total_th_start')
                                    @if (!$hideAmount)
                                        <td class="total text font-semibold text-alignment-right text-right">
                                            <span>
                                                {{ trans($textAmount) }}
                                            </span>
                                        </td>
                                    @endif
                                @stack('total_th_end')
                            </tr>
                        </thead>

                        <tbody>
                            @if ($document->items->count())
                                @foreach($document->items as $item)
                                    <x-documents.template.line-item
                                        type="{{ $type }}"
                                        :item="$item"
                                        :document="$document"
                                        hide-items="{{ $hideItems }}"
                                        hide-name="{{ $hideName }}"
                                        hide-description="{{ $hideDescription }}"
                                        hide-quantity="{{ $hideQuantity }}"
                                        hide-price="{{ $hidePrice }}"
                                        hide-discount="{{ $hideDiscount }}"
                                        hide-amount="{{ $hideAmount }}"
                                    />
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text text-center empty-items">
                                        {{ trans('documents.empty_items') }}
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <div class="row mt-1">
        <div class="col-100">
            <table class="lines" style="border-bottom: none;">
                <tbody>
                    @foreach ($document->totals_sorted as $total)
                        @if ($total->code != 'total')
                            @stack($total->code . '_total_tr_start')
                            <tr class="text">
                                <td class="float-left" style="border:none; padding-top:2px; padding-bottom:2px">
                                    {{ trans($total->title) }}
                                </td>

                                <td class="text-right" style="border:none; padding-top:2px; padding-bottom:2px">
                                    <x-money :amount="$total->amount" :currency="$document->currency_code" convert />
                                </td>
                            </tr>
                            @stack($total->code . '_total_tr_end')
                        @else
                            @if ($document->paid)
                                @stack('paid_total_tr_start')
                                <tr class="text">
                                    <td class="float-left" style="border:none; padding-top:2px; padding-bottom:2px">
                                        {{ trans('invoices.paid') }}
                                    </td>

                                    <td class="text-right" style="border:none; padding-top:2px; padding-bottom:2px">
                                        - <x-money :amount="$document->paid" :currency="$document->currency_code" convert />
                                    </td>
                                </tr>
                                @stack('paid_total_tr_end')
                            @endif

                            @stack('grand_total_tr_start')
                            <tr class="text">
                                <td class="float-left font-semibold" style="border:none; padding-top:2px; padding-bottom:2px">
                                    {{ trans($total->name) }}
                                </td>

                                <td class="text-right font-semibold" style="border:none; padding-top:2px; padding-bottom:2px">
                                    <x-money :amount="$document->amount_due" :currency="$document->currency_code" convert />
                                </td>
                            </tr>
                            @stack('grand_total_tr_end')
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-100">
            <div class="text">
                @stack('notes_input_start')
                @if ($document->notes)
                    <p class="font-semibold">
                        {{ trans_choice('general.notes', 2) }}
                    </p>

                    {!! nl2br($document->notes) !!}
                @endif
                @stack('notes_input_end')
            </div>
        </div>
    </div>

    @if (!$hideFooter)
        @stack('footer_input_start')

        <footer class="row mt-4 border-footer">
            <div class="col-100 text-center">
                <div class="text">
                    @if ($document->footer)
                        <p style="margin: 0">
                            {!! nl2br($document->footer) !!}
                        </p>
                    @endif

                    @if (!$hideCompanyDetails)
                        <p style="margin: 0">
                            <span class="font-semibold">{{ setting('company.name') }}</span>
                            <span>|</span>
                            <span>{!! str_replace('\n', ', ', setting('company.address')) !!}</span>
                            <span>|</span>
                            <span>{!! setting('company.zip_code') !!} {!! setting('company.city') !!}</span>
                        </p>
                    @endif

                    <p style="margin: 0">
                        @if (! $hideCompanyPhone && setting('company.phone'))
                            <span>Tel.: {{ setting('company.phone') }}</span>
                            <span>|</span>
                        @endif
                        @if (! $hideCompanyEmail && setting('company.email'))
                            <span>Mail: {{ setting('company.email') }}</span>
                            <span>|</span>
                        @endif
                        <span>Web: www.hagendorn.it</span>
                    </p>

                    <p style="margin: 0">
                        <span>Solaris SE</span>
                        <span>|</span>
                        <span>DE36 1101 0101 5096 3873 14</span>
                        <span>|</span>
                        <span>SOBKDEB2XXX</span>
                    </p>

                    @if (! $hideCompanyTaxNumber && setting('company.tax_number'))
                        <p style="margin: 0">
                            {{ trans('hagit-cust::general.field.vat_id') }}: {{ setting('company.tax_number') }}
                        </p>
                    @endif
                </div>
            </div>
        </footer>

        @stack('footer_input_end')
    @endif
</div>
