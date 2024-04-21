<table class="w-full text-sm text-left text-gray-500 border-separate blade-table rtl:text-right border-spacing-y-3">
    <thead class="mb-3 text-base text-gray-600 capitalize bg-white rounded-lg">
        {{ $thead }}
    </thead>
    <tbody>
        {{ $tbody }}
    </tbody>
    @isset($tfoot)
    <tfoot>
        {{ $tfoot }}
    </tfoot>
    @endisset
</table>