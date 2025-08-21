@props([
    'id' => 'data-table',
    'headers' => [],
    'rows' => [],
    'excel' => true,
    'print' => true,
    'pageLength' => 10,
    'lengthMenu' => [5, 10, 25, 50, -1],
    'lengthMenuLabels' => ['5', '10', '25', '50', 'All'],
    'title' => 'Data Export',
    'searchPlaceholder' => 'Search...',
    'resourceName' => 'entries',
])

<div class="w-full overflow-x-auto">
    <table id="{{ $id }}" class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-green-600 text-white">
            <tr>
                @foreach($headers as $header)
                    <th class="px-4 py-2 text-center font-medium uppercase tracking-wider">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            {{ $slot }}
        </tbody>
    </table>
</div>

<!-- DataTables JS & Buttons -->


<script>
$(document).ready(function() {
    // Find index of "Action" column dynamically
    let actionColumnIndex = -1;
    $('#{{ $id }} thead th').each(function(index) {
        if ($(this).text().trim().toLowerCase() === 'action') {
            actionColumnIndex = index;
        }
    });

    var buttons = [];

    @if($excel)
    buttons.push({
        extend: 'excel',
        text: '<i class="fas fa-file-excel mr-1"></i> Excel',
        className: 'text-white bg-green-500 hover:bg-green-600 px-3 py-1 rounded shadow',
        title: '{{ $title }}',
        exportOptions: {
            columns: actionColumnIndex === -1 ? ':visible' : ':not(:eq(' + actionColumnIndex + '))'
        }
    });
    @endif

    @if($print)
    buttons.push({
        extend: 'print',
        text: '<i class="fas fa-print mr-1"></i> Print',
        className: 'text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded shadow',
        title: '{{ $title }}',
        exportOptions: {
            columns: actionColumnIndex === -1 ? ':visible' : ':not(:eq(' + actionColumnIndex + '))'
        },
        customize: function(win) {
            $(win.document.body).find('table')
                .addClass('min-w-full divide-y divide-gray-200 text-sm')
                .css('font-size', 'inherit');
        }
    });
    @endif

    $('#{{ $id }}').DataTable({
        dom: '<"flex flex-col md:flex-row justify-between items-center mb-4"<"mb-2 md:mb-0"l><"mb-2 md:mb-0"f>>' +
             '<"mb-4"B>' +
             'tr' +
             '<"flex flex-col md:flex-row justify-between items-center mt-4"<"mb-2 md:mb-0"i><"mb-2 md:mb-0"p>>',
        buttons: buttons,
        responsive: true,
        pageLength: {{ $pageLength }},
        lengthMenu: [@json($lengthMenu), @json($lengthMenuLabels)],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "{{ $searchPlaceholder }}",
            lengthMenu: "Show _MENU_ {{ $resourceName }}",
            info: "Showing _START_ to _END_ of _TOTAL_ {{ $resourceName }}",
            infoEmpty: "No {{ $resourceName }} available",
            paginate: {
                previous: '<i class="fas fa-angle-left"></i>',
                next: '<i class="fas fa-angle-right"></i>'
            }
        },
        columnDefs: [
            {
                orderable: false,
                targets: actionColumnIndex,
                className: 'text-center'
            },
            {
                targets: '_all',
                className: 'align-middle'
            }
        ],
        initComplete: function() {
            $('.dataTables_filter input').addClass('border border-gray-300 rounded px-3 py-1 focus:ring-2 focus:ring-green-500 focus:outline-none');
            $('.dataTables_length select').addClass('border border-gray-300 rounded px-2 py-1 focus:ring-2 focus:ring-green-500 focus:outline-none');
        }
    });
});
</script>
