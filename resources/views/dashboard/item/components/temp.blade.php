<td class="align-middle">
    <table class="table table-borderless text-center mb-0">
        @forelse($item->units as $unit)
            <tr>
                <td class="th-sm">{{$unit->quantity . " " . $unit->name}}</td>
                <td class="th-sm">{{$unit->price . " " . $item->currency}}</td>
            </tr>
        @empty
            <tr>
                <td class="th-sm">---</td>
                <td class="th-sm">---</td>
            </tr>
        @endforelse
    </table>
</td>


